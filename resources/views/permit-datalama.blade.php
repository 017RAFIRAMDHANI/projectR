@extends('layouts.app')

@section('content')
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: "#2563eb",
              secondary: "#64748b",
            },
          },
        },
      };
    </script>
    <script>
      // Function to toggle notifications panel
      function toggleNotifications() {
        const panel = document.getElementById('notificationsPanel');
        panel.classList.toggle('hidden');
      }

      // Function to toggle user menu
      function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
      }

      // Function to show confirmation modal
      function showCloseConfirmation(permitId) {
        const modal = document.getElementById('closeConfirmationModal');
        if (!modal) return;
        modal.setAttribute('data-permit-id', permitId);
        modal.classList.remove('hidden');
      }

      // Function to hide confirmation modal
      function hideCloseConfirmation() {
        const modal = document.getElementById('closeConfirmationModal');
        if (!modal) return;
        modal.classList.add('hidden');
        modal.removeAttribute('data-permit-id');
      }

      // Function to close permit
      function closePermit() {
        const modal = document.getElementById('closeConfirmationModal');
        if (!modal) return;
        const permitId = modal.getAttribute('data-permit-id');
        if (!permitId) return;
        const permitElement = document.getElementById(`permit-${permitId}`);
        if (!permitElement) {
          alert('Permit row not found!');
          return;
        }
        const statusElement = permitElement.querySelector('.permit-status');
        const closeButton = permitElement.querySelector('.close-button');
        if (statusElement) {
          statusElement.textContent = 'Closed';
          statusElement.classList.remove('bg-green-100', 'text-green-800');
          statusElement.classList.add('bg-gray-100', 'text-gray-800');
        }
        if (closeButton) {
          closeButton.disabled = true;
          closeButton.classList.add('opacity-50', 'cursor-not-allowed', 'text-gray-400');
          closeButton.classList.remove('text-red-600', 'hover:text-red-900');
          closeButton.innerHTML = '<i class="fas fa-times-circle"></i> Closed';
        }
        hideCloseConfirmation();
        updatePermitCounts();
        console.log('Permit closed:', permitId); // Debug log
        renderCloseButtons();
      }

      // Function to view permit details
      function viewPermitDetails(permitId, type) {
        if (type === 'vendor') {
          window.location.href = `permit-vendor-detail.html?id=${permitId}&type=${type}`;
        } else if (type === 'visitor') {
          window.location.href = `permit-visitor-detail.html?id=${permitId}&type=${type}`;
        } else {
          window.location.href = `permit-details.html?id=${permitId}&type=${type}`;
        }
      }

      // Function to update permit counts
      function updatePermitCounts() {
        const openCount = document.querySelectorAll('.permit-status:not(.bg-gray-100):not(.bg-red-100)').length;
        const closedCount = document.querySelectorAll('.permit-status.bg-gray-100').length;
        const expiredCount = document.querySelectorAll('.permit-status.bg-red-100').length;

        document.getElementById('openCount').textContent = openCount;
        document.getElementById('closedCount').textContent = closedCount;
        document.getElementById('expiredCount').textContent = expiredCount;
        document.getElementById('totalCount').textContent = openCount + closedCount + expiredCount;
      }

      // Function to filter permits
      function filterPermits() {
        try {
          const typeFilter = document.getElementById('typeFilter')?.value || 'all';
          const statusFilter = document.getElementById('statusFilter')?.value || 'all';
          const searchFilter = (document.getElementById('searchFilter')?.value || '').toLowerCase();

          const permits = document.querySelectorAll('.permit-item');
          let visibleCount = 0;

          permits.forEach(permit => {
            const permitType = permit.classList.contains('visitor-permit') ? 'visitor' : 'vendor';
            const permitStatus = permit.querySelector('.permit-status')?.textContent.trim().toLowerCase() || '';
            const permitText = permit.textContent.toLowerCase();

            const typeMatch = typeFilter === 'all' || permitType === typeFilter;
            const statusMatch = statusFilter === 'all' || permitStatus === statusFilter;
            const searchMatch = searchFilter === '' || permitText.includes(searchFilter);

            if (typeMatch && statusMatch && searchMatch) {
              permit.classList.remove('hidden');
              visibleCount++;
            } else {
              permit.classList.add('hidden');
            }
          });

          // Update pagination
          updatePagination(visibleCount);
          renderCloseButtons();
        } catch (error) {
          console.error('Error filtering permits:', error);
        }
      }

      // Function to update pagination
      function updatePagination(totalItems) {
        const itemsPerPage = 10;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const currentPage = parseInt(document.querySelector('[aria-current="page"]')?.textContent || '1');

        // Update pagination info
        const startItem = (currentPage - 1) * itemsPerPage + 1;
        const endItem = Math.min(currentPage * itemsPerPage, totalItems);

        document.getElementById('paginationInfo').innerHTML = `
          Showing <span class="font-medium">${startItem}</span> to <span class="font-medium">${endItem}</span> of <span class="font-medium">${totalItems}</span> results
        `;

        // Update pagination buttons
        const paginationNav = document.querySelector('nav[aria-label="Pagination"]');
        if (!paginationNav) return;

        let paginationHTML = `
          <button onclick="goToPage(${currentPage - 1})" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" ${currentPage === 1 ? 'disabled' : ''}>
            <span class="sr-only">Previous</span>
            <i class="fas fa-chevron-left text-sm"></i>
          </button>
        `;

        for (let i = 1; i <= totalPages; i++) {
          if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
            paginationHTML += `
              <button onclick="goToPage(${i})" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold ${i === currentPage ? 'bg-primary text-white' : 'text-gray-900'} ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" ${i === currentPage ? 'aria-current="page"' : ''}>
                ${i}
              </button>
            `;
          } else if (i === currentPage - 2 || i === currentPage + 2) {
            paginationHTML += `
              <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">
                ...
              </span>
            `;
          }
        }

        paginationHTML += `
          <button onclick="goToPage(${currentPage + 1})" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" ${currentPage === totalPages ? 'disabled' : ''}>
            <span class="sr-only">Next</span>
            <i class="fas fa-chevron-right text-sm"></i>
          </button>
        `;

        paginationNav.innerHTML = paginationHTML;
        renderCloseButtons();
      }

      // Function to go to specific page
      function goToPage(page) {
        const itemsPerPage = 10;
        const permits = document.querySelectorAll('.permit-item:not(.hidden)');
        const totalItems = permits.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        if (page < 1 || page > totalPages) return;

        permits.forEach((permit, index) => {
          const startIndex = (page - 1) * itemsPerPage;
          const endIndex = page * itemsPerPage;

          if (index >= startIndex && index < endIndex) {
            permit.classList.remove('hidden');
          } else {
            permit.classList.add('hidden');
          }
        });

        updatePagination(totalItems);
        renderCloseButtons();
      }

      // Close notifications panel when clicking outside
      document.addEventListener('click', function(event) {
        const panel = document.getElementById('notificationsPanel');
        const button = document.querySelector('button[onclick="toggleNotifications()"]');

        if (!panel.contains(event.target) && !button.contains(event.target) && !panel.classList.contains('hidden')) {
          panel.classList.add('hidden');
        }
      });

      // Close user menu when clicking outside
      document.addEventListener('click', function(event) {
        const menu = document.getElementById('userMenu');
        const button = document.querySelector('button[onclick="toggleUserMenu()"]');

        if (!menu.contains(event.target) && !button.contains(event.target) && !menu.classList.contains('hidden')) {
          menu.classList.add('hidden');
        }
      });

      // Close confirmation modal when clicking outside
      document.addEventListener('click', function(event) {
        const modal = document.getElementById('closeConfirmationModal');
        if (!modal) return;

        const modalContent = modal.querySelector('div');
        if (!modalContent) return;

        if (!modalContent.contains(event.target) && !modal.classList.contains('hidden')) {
          hideCloseConfirmation();
        }
      });

      // Event Listeners
      document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM Content Loaded'); // Debug log

        // Add filter event listeners
        const typeFilter = document.getElementById('typeFilter');
        const statusFilter = document.getElementById('statusFilter');
        const searchFilter = document.getElementById('searchFilter');

        if (typeFilter) typeFilter.addEventListener('change', filterPermits);
        if (statusFilter) statusFilter.addEventListener('change', filterPermits);
        if (searchFilter) searchFilter.addEventListener('input', filterPermits);

        // Initial count update
        updatePermitCounts();

        // Bind confirmCloseButton event ONCE after DOM loaded
        const confirmBtn = document.getElementById('confirmCloseButton');
        if (confirmBtn) {
          confirmBtn.onclick = closePermit;
        }

        // Add event listener for Escape key
        document.addEventListener('keydown', function(event) {
          if (event.key === 'Escape') {
            hideCloseConfirmation();
          }
        });

        // Initialize pagination
        filterPermits();

        // After the table is rendered, in DOMContentLoaded, add this logic:
        renderCloseButtons();
      });

      // Function to render close buttons
      function renderCloseButtons() {
        document.querySelectorAll('.permit-item').forEach(function(row) {
          const status = row.querySelector('.permit-status');
          const closeBtnSpan = row.querySelector('.dynamic-close-btn');
          if (status && closeBtnSpan) {
            const stat = status.textContent.trim().toLowerCase();
            const permitId = row.id.replace('permit-', '');
            if (stat === 'open') {
              closeBtnSpan.innerHTML = `<button type="button" onclick="showCloseConfirmation('${permitId}')" class="close-button text-red-600 hover:text-red-900" id="close-btn-${permitId}"><i class='fas fa-times-circle'></i> Close</button>`;
            } else if (stat === 'closed') {
              closeBtnSpan.innerHTML = `<button type="button" disabled class="close-button text-gray-400 cursor-not-allowed opacity-50"><i class='fas fa-times-circle'></i> Closed</button>`;
            } else if (stat === 'expired') {
              closeBtnSpan.innerHTML = `<button type="button" disabled class="close-button text-gray-400 cursor-not-allowed opacity-50"><i class='fas fa-times-circle'></i> Expired</button>`;
            } else {
              closeBtnSpan.innerHTML = '';
            }
          }
        });
      }
    </script>
    <style>
      .btn-hover {
        transition: background-color 0.2s ease;
      }
      .btn-hover:hover {
        background-color: rgba(0, 0, 0, 0.05);
      }
      .btn-hover:active {
        background-color: rgba(0, 0, 0, 0.1);
      }
      .menu-item {
        transition: background-color 0.2s ease;
      }
      .menu-item:hover {
        background-color: rgba(0, 0, 0, 0.05);
      }
      .menu-item:active {
        background-color: rgba(0, 0, 0, 0.1);
      }
    </style>
  </head>
  <body class="bg-gray-50">
   

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-4">
          <a href="fh-dashboard.html" class="text-gray-600 hover:text-primary transition-colors">
            <i class="fas fa-arrow-left text-xl"></i>
          </a>
          <h1 class="text-2xl font-bold text-gray-900">Permit Data</h1>
        </div>
        <div class="flex space-x-2">
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">
            Open: <span id="openCount">3</span>
          </span>
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-gray-100 text-gray-800">
            Closed: <span id="closedCount">2</span>
          </span>
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-800">
            Expired: <span id="expiredCount">1</span>
          </span>
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
            Total: <span id="totalCount">6</span>
          </span>
        </div>
      </div>

      <!-- Filters -->
      <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label for="typeFilter" class="block text-sm font-medium text-gray-700 mb-1">Permit Type</label>
            <select id="typeFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="all">All Types</option>
              <option value="visitor">Visitor</option>
              <option value="vendor">Vendor</option>
            </select>
          </div>
          <div>
            <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="statusFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="all">All Status</option>
              <option value="open">Open</option>
              <option value="closed">Closed</option>
              <option value="expired">Expired</option>
            </select>
          </div>
          <div>
            <label for="searchFilter" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input
              type="text"
              id="searchFilter"
              placeholder="Search permits..."
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
            >
          </div>
        </div>
      </div>

      <!-- Permits Table -->
      <div class="bg-white rounded-lg shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="w-1/4 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit Info</th>
              <th scope="col" class="w-1/6 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
              <th scope="col" class="w-1/6 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
              <th scope="col" class="w-1/6 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
              <th scope="col" class="w-1/6 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
              <th scope="col" class="w-1/6 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th scope="col" class="w-1/6 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Visitor Permit 1 -->
            <tr id="permit-V001" class="visitor-permit permit-item">
              <td class="px-4 py-4 text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0001</td>
              <td class="px-4 py-4 text-sm text-gray-500">John Smith</td>
              <td class="px-4 py-4">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Visitor</span>
              </td>
              <td class="px-4 py-4 text-sm text-gray-500">Client Meeting</td>
              <td class="px-4 py-4 text-sm text-gray-500">Today, 2:00 PM - 4:00 PM</td>
              <td class="px-4 py-4">
                <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Open</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button type="button"
                  onclick="viewPermitDetails('V001', 'visitor')"
                  class="text-primary hover:text-blue-700 mr-2">
                  <i class="fas fa-eye"></i> View
                </button>
                <span class="dynamic-close-btn"></span>
              </td>
            </tr>

            <!-- Visitor Permit 2 -->
            <tr id="permit-V002" class="visitor-permit permit-item">
              <td class="px-4 py-4 text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0002</td>
              <td class="px-4 py-4 text-sm text-gray-500">Sarah Johnson</td>
              <td class="px-4 py-4">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Visitor</span>
              </td>
              <td class="px-4 py-4 text-sm text-gray-500">Job Interview</td>
              <td class="px-4 py-4 text-sm text-gray-500">Tomorrow, 10:00 AM - 11:30 AM</td>
              <td class="px-4 py-4">
                <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Open</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button type="button"
                  onclick="viewPermitDetails('V002', 'visitor')"
                  class="text-primary hover:text-blue-700 mr-2">
                  <i class="fas fa-eye"></i> View
                </button>
                <span class="dynamic-close-btn"></span>
              </td>
            </tr>

            <!-- Visitor Permit 3 (Closed) -->
            <tr id="permit-V003" class="visitor-permit permit-item">
              <td class="px-4 py-4 text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0003</td>
              <td class="px-4 py-4 text-sm text-gray-500">Michael Brown</td>
              <td class="px-4 py-4">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Visitor</span>
              </td>
              <td class="px-4 py-4 text-sm text-gray-500">Project Review</td>
              <td class="px-4 py-4 text-sm text-gray-500">April 20, 2024, 1:00 PM - 3:00 PM</td>
              <td class="px-4 py-4">
                <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">Closed</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button type="button"
                  onclick="viewPermitDetails('V003', 'visitor')"
                  class="text-primary hover:text-blue-700 mr-2">
                  <i class="fas fa-eye"></i> View
                </button>
                <span class="dynamic-close-btn"></span>
              </td>
            </tr>

            <!-- Vendor Permit 1 (Expired) -->
            <tr id="permit-VD001" class="vendor-permit permit-item">
              <td class="px-4 py-4 text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0004</td>
              <td class="px-4 py-4 text-sm text-gray-500">Tech Solutions Inc.</td>
              <td class="px-4 py-4">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">Vendor</span>
              </td>
              <td class="px-4 py-4 text-sm text-gray-500">Server Maintenance</td>
              <td class="px-4 py-4 text-sm text-gray-500">Today, 3:00 PM - 5:00 PM</td>
              <td class="px-4 py-4">
                <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Expired</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button type="button"
                  onclick="viewPermitDetails('VD001', 'vendor')"
                  class="text-primary hover:text-blue-700 mr-2">
                  <i class="fas fa-eye"></i> View
                </button>
                <span class="dynamic-close-btn"></span>
              </td>
            </tr>

            <!-- Vendor Permit 2 -->
            <tr id="permit-VD002" class="vendor-permit permit-item">
              <td class="px-4 py-4 text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0005</td>
              <td class="px-4 py-4 text-sm text-gray-500">Clean Pro Services</td>
              <td class="px-4 py-4">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">Vendor</span>
              </td>
              <td class="px-4 py-4 text-sm text-gray-500">Office Cleaning</td>
              <td class="px-4 py-4 text-sm text-gray-500">Tomorrow, 8:00 AM - 10:00 AM</td>
              <td class="px-4 py-4">
                <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Open</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button type="button"
                  onclick="viewPermitDetails('VD002', 'vendor')"
                  class="text-primary hover:text-blue-700 mr-2">
                  <i class="fas fa-eye"></i> View
                </button>
                <span class="dynamic-close-btn"></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
          <button onclick="goToPage(currentPage - 1)" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Previous
          </button>
          <button onclick="goToPage(currentPage + 1)" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Next
          </button>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
          <div>
            <p id="paginationInfo" class="text-sm text-gray-700">
              Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">0</span> results
            </p>
          </div>
          <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
              <button onclick="goToPage(1)" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Previous</span>
                <i class="fas fa-chevron-left text-sm"></i>
              </button>
              <button aria-current="page" class="relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                1
              </button>
              <button onclick="goToPage(2)" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Next</span>
                <i class="fas fa-chevron-right text-sm"></i>
              </button>
            </nav>
          </div>
        </div>
      </div>
    </main>

    <!-- Close Confirmation Modal -->
    <div id="closeConfirmationModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
          <div class="flex items-center justify-center mb-4">
            <div class="p-3 rounded-full bg-red-100">
              <i class="fas fa-exclamation-circle text-red-600 text-2xl"></i>
            </div>
          </div>
          <h3 class="text-lg font-medium text-gray-900 text-center mb-2">Close Permit</h3>
          <p class="text-sm text-gray-500 text-center mb-6">Are you sure you want to close this permit?</p>
          <div class="flex justify-center space-x-4">
            <button type="button" onclick="hideCloseConfirmation()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
              Cancel
            </button>
            <button type="button" id="confirmCloseButton" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              Close Permit
            </button>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>

@endsection
