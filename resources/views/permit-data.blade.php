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
        closePermit(permitId); // Directly call closePermit
      }

      // Function to close permit
      function closePermit(permitId) {
        // Find the permit in allPermits and update its status
        const permitToClose = allPermits.find(permit => permit.id === permitId);
        if (permitToClose) {
          permitToClose.status = 'Closed';

          // --- Manual update for immediate visual feedback ---
          const permitElement = document.getElementById(`permit-${permitId}`);
          if (permitElement) {
            const closeButton = permitElement.querySelector('.action-btn.close-button');
            const statusSpan = permitElement.querySelector('.permit-status');

            if (closeButton) {
              closeButton.disabled = true;
              closeButton.classList.remove('bg-red-100', 'text-red-600', 'hover:bg-red-200');
              closeButton.classList.add('opacity-50', 'cursor-not-allowed', 'bg-gray-700', 'text-gray-100');
            }
            if (statusSpan) {
                statusSpan.textContent = 'Closed';
                statusSpan.classList.remove('bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800');
                statusSpan.classList.add('bg-gray-100', 'text-gray-800');
            }
          }
          // --- End Manual update ---
        }

        filterPermits(); // Still call this to ensure full table consistency with filters
        updatePermitCounts();
        console.log('Permit closed:', permitId); // Debug log
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

      // Dummy data for permits
      const allPermits = [
        {
          id: 'V001',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'John Smith',
          purpose: 'Client Meeting',
          dateTime: 'Today, 2:00 PM - 4:00 PM',
          status: 'Open'
        },
        {
          id: 'V002',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'Sarah Johnson',
          purpose: 'Job Interview',
          dateTime: 'Tomorrow, 10:00 AM - 11:30 AM',
          status: 'Open'
        },
        {
          id: 'V003',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'Michael Brown',
          purpose: 'Project Review',
          dateTime: 'April 20, 2024, 1:00 PM - 3:00 PM',
          status: 'Closed'
        },
        {
          id: 'V004',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'Emily White',
          purpose: 'Deliveries',
          dateTime: 'April 21, 2024, 9:00 AM - 10:00 AM',
          status: 'Open'
        },
        {
          id: 'V005',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'David Green',
          purpose: 'Interview',
          dateTime: 'April 22, 2024, 11:00 AM - 12:00 PM',
          status: 'Open'
        },
        {
          id: 'V006',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'Olivia Black',
          purpose: 'Meeting',
          dateTime: 'April 23, 2024, 3:00 PM - 5:00 PM',
          status: 'Open'
        },
        {
          id: 'V007',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'James Blue',
          purpose: 'Training',
          dateTime: 'April 24, 2024, 9:30 AM - 11:00 AM',
          status: 'Closed'
        },
        {
          id: 'V008',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'Sophia Red',
          purpose: 'Consultation',
          dateTime: 'April 25, 2024, 1:00 PM - 2:00 PM',
          status: 'Open'
        },
        {
          id: 'V009',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'Daniel Yellow',
          purpose: 'Workshop',
          dateTime: 'April 26, 2024, 10:00 AM - 1:00 PM',
          status: 'Expired'
        },
        {
          id: 'V010',
          type: 'visitor',
          permitInfo: 'Visitor Permit',
          applicant: 'Chloe Purple',
          purpose: 'Presentation',
          dateTime: 'April 27, 2024, 2:00 PM - 4:00 PM',
          status: 'Open'
        },
        {
          id: 'VD001',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'Tech Solutions Inc.',
          purpose: 'Server Maintenance',
          dateTime: 'Today, 3:00 PM - 5:00 PM',
          status: 'Expired',
          priority: 'urgent' // Added for urgent styling
        },
        {
          id: 'VD002',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'Clean Pro Services',
          purpose: 'Office Cleaning',
          dateTime: 'Tomorrow, 8:00 AM - 10:00 AM',
          status: 'Open'
        },
        {
          id: 'VD003',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'Secure IT Co.',
          purpose: 'Security Audit',
          dateTime: 'April 20, 2024, 9:00 AM - 12:00 PM',
          status: 'Closed'
        },
        {
          id: 'VD004',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'Green Landscaping',
          purpose: 'Garden Maintenance',
          dateTime: 'April 21, 2024, 10:00 AM - 12:00 PM',
          status: 'Open'
        },
        {
          id: 'VD005',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'ElectriCorp',
          purpose: 'Electrical Repair',
          dateTime: 'April 22, 2024, 1:00 PM - 3:00 PM',
          status: 'Open'
        },
        {
          id: 'VD006',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'PlumbMaster',
          purpose: 'Pipe Inspection',
          dateTime: 'April 23, 2024, 9:00 AM - 11:00 AM',
          status: 'Open'
        },
        {
          id: 'VD007',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'Build Right Inc.',
          purpose: 'Renovation Work',
          dateTime: 'April 24, 2024, 8:00 AM - 5:00 PM',
          status: 'Expired',
          priority: 'urgent'
        },
        {
          id: 'VD008',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'Data Solutions',
          purpose: 'Network Upgrade',
          dateTime: 'April 25, 2024, 2:00 PM - 6:00 PM',
          status: 'Open'
        },
        {
          id: 'VD009',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'Eco Waste Mgmt.',
          purpose: 'Waste Collection',
          dateTime: 'April 26, 2024, 7:00 AM - 8:00 AM',
          status: 'Open'
        },
        {
          id: 'VD010',
          type: 'vendor',
          permitInfo: 'Vendor Permit',
          applicant: 'Quick Fix Repairs',
          purpose: 'Equipment Repair',
          dateTime: 'April 27, 2024, 11:00 AM - 1:00 PM',
          status: 'Open'
        }
      ];

      let currentPage = 1;
      const itemsPerPage = 20;
      let currentTabType = 'visitor'; // Initialize with a default tab type

      // Function to render a single permit row
      function renderPermitRow(item, index) {
        const rowNumber = (currentPage - 1) * itemsPerPage + index + 1;
        const statusClass = item.status === 'Open' ? 'bg-green-100 text-green-800' :
                            item.status === 'Closed' ? 'bg-gray-100 text-gray-800' :
                            'bg-red-100 text-red-800';

        let rowStyle = '';
        if (item.type === 'vendor' && item.priority === 'urgent') {
          rowStyle = 'background-color: #FEF2F2 !important; border-left: 4px solid #EF4444 !important;';
        }

        // Determine button state based on status
        const closeButtonDisabled = item.status === 'Closed' || item.status === 'Expired';
        const closeButtonClasses = closeButtonDisabled ? 'opacity-50 cursor-not-allowed bg-gray-200 text-gray-800' : 'bg-red-100 text-red-600 hover:bg-red-200';
        const closeButtonInnerHtml = '<i class="fas fa-times-circle mr-1"></i> Close';

        return `
          <tr id="permit-${item.id}" class="${item.type}-permit permit-item" style="${rowStyle}">
            <td class="px-4 py-4 text-sm font-medium text-gray-900">${rowNumber}</td>
            <td class="px-4 py-4 text-sm font-medium text-gray-900">${item.permitInfo}</td>
            <td class="px-4 py-4 text-sm text-gray-500">${item.applicant}</td>
            <td class="px-4 py-4 text-sm text-gray-500">${item.purpose}</td>
            <td class="px-4 py-4 text-sm text-gray-500">${item.dateTime}</td>
            <td class="px-4 py-4">
              <span class="permit-status px-2 py-1 text-xs font-medium rounded-full ${statusClass}">${item.status}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="action-container">
                <button type="button"
                  onclick="viewPermitDetails('${item.id}', '${item.type}')"
                  class="action-btn view">
                  <i class="fas fa-eye"></i>
                </button>
                <button type="button"
                  onclick="showCloseConfirmation('${item.id}')"
                  class="action-btn ${closeButtonClasses}"
                  ${closeButtonDisabled ? 'disabled' : ''}>
                  ${closeButtonInnerHtml}
                </button>
              </div>
            </td>
          </tr>
        `;
      }

      // Function to display permits in the table
      function displayPermits(permitsToDisplay) {
        const tableBody = document.getElementById('permitTableBody');
        if (!tableBody) return;
        tableBody.innerHTML = ''; // Clear existing rows

        permitsToDisplay.forEach((item, index) => {
          tableBody.innerHTML += renderPermitRow(item, index);
        });
      }

      // Function to update permit counts
      function updatePermitCounts() {
        const openCount = allPermits.filter(permit => permit.status === 'Open').length;
        const closedCount = allPermits.filter(permit => permit.status === 'Closed').length;
        const expiredCount = allPermits.filter(permit => permit.status === 'Expired').length;

        document.getElementById('openCount').textContent = openCount;
        document.getElementById('closedCount').textContent = closedCount;
        document.getElementById('expiredCount').textContent = expiredCount;
        document.getElementById('totalCount').textContent = openCount + closedCount + expiredCount;
      }

      // Function to filter permits
      function filterPermits() {
        try {
          const dateFilter = document.getElementById('dateFilter')?.value || 'all';
          const statusFilter = document.getElementById('statusFilter')?.value || 'all';
          const searchFilter = (document.getElementById('searchFilter')?.value || '').toLowerCase();

          const filteredPermits = allPermits.filter(permit => {
            const permitType = permit.type; // Get permit type from data
            const permitStatus = permit.status.toLowerCase();
            const permitText = JSON.stringify(permit).toLowerCase();
            const permitDateTime = permit.dateTime;

            // Date filtering logic
            let dateMatch = true;
            if (dateFilter !== 'all') {
              const permitDate = parseDateTime(permitDateTime);
              const now = new Date();

              if (dateFilter === 'today') {
                dateMatch = isSameDay(permitDate, now);
              } else if (dateFilter === 'this_week') {
                dateMatch = isSameWeek(permitDate, now);
              } else if (dateFilter === 'this_month') {
                dateMatch = isSameMonth(permitDate, now);
              }
            }

            const statusMatch = statusFilter === 'all' || permitStatus === statusFilter;
            const searchMatch = searchFilter === '' || permitText.includes(searchFilter);
            const typeMatch = currentTabType === 'all' || permitType === currentTabType; // Use currentTabType for filtering

            return dateMatch && statusMatch && searchMatch && typeMatch;
          });

          updatePagination(filteredPermits);
        } catch (error) {
          console.error('Error filtering permits:', error);
        }
      }

      // Helper function to parse date string
      function parseDateTime(dateTimeString) {
        let datePart = dateTimeString.split(',')[0].trim();
        let year = new Date().getFullYear();

        if (datePart === 'Today') {
            return new Date();
        } else if (datePart === 'Tomorrow') {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            return tomorrow;
        } else {
            const parts = datePart.split(' ');
            if (parts.length >= 3) {
                const month = parts[0];
                const day = parseInt(parts[1].replace(',', ''));
                year = parseInt(parts[2]);
                return new Date(`${month} ${day}, ${year}`);
            } else if (parts.length >= 2 && !isNaN(parseInt(parts[1]))) {
                const month = parts[0];
                const day = parseInt(parts[1]);
                return new Date(`${month} ${day}, ${year}`);
            }
        }
        return new Date(dateTimeString);
      }

      // Helper function to check if two dates are the same day
      function isSameDay(d1, d2) {
        return d1.getFullYear() === d2.getFullYear() &&
               d1.getMonth() === d2.getMonth() &&
               d1.getDate() === d2.getDate();
      }

      // Helper function to check if two dates are in the same week
      function isSameWeek(d1, d2) {
        const startOfWeek1 = new Date(d1);
        startOfWeek1.setDate(d1.getDate() - d1.getDay()); // Sunday as start of week

        const startOfWeek2 = new Date(d2);
        startOfWeek2.setDate(d2.getDate() - d2.getDay());

        return isSameDay(startOfWeek1, startOfWeek2);
      }

      // Helper function to check if two dates are in the same month
      function isSameMonth(d1, d2) {
        return d1.getFullYear() === d2.getFullYear() &&
               d1.getMonth() === d2.getMonth();
      }

      // Function to update pagination
      function updatePagination(filteredPermits) {
        const totalItems = filteredPermits.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        // Ensure currentPage is within valid range
        if (currentPage > totalPages && totalPages > 0) {
          currentPage = totalPages;
        } else if (totalPages === 0) {
          currentPage = 1; // Reset to 1 if no items
        }

        const startItem = (currentPage - 1) * itemsPerPage + 1;
        const endItem = Math.min(currentPage * itemsPerPage, totalItems);

        document.getElementById('paginationInfo').innerHTML = `
          Showing <span class="font-medium">${startItem}</span> to <span class="font-medium">${endItem}</span> of <span class="font-medium">${totalItems}</span> results
        `;

        // Render current page items
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const permitsToDisplay = filteredPermits.slice(startIndex, endIndex);
        displayPermits(permitsToDisplay);

        // Update pagination buttons
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');
        const pageNumbersDiv = document.getElementById('pageNumbers');

        if (prevButton) prevButton.disabled = currentPage === 1;
        if (nextButton) nextButton.disabled = currentPage === totalPages || totalPages === 0;

        if (pageNumbersDiv) {
          pageNumbersDiv.innerHTML = '';
          for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.onclick = () => goToPage(i);
            button.classList.add('px-3', 'py-1', 'rounded', 'font-semibold');
            if (i === currentPage) {
              button.classList.add('bg-blue-600', 'text-white');
            } else {
              button.classList.add('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
            }
            button.textContent = i;
            pageNumbersDiv.appendChild(button);
          }
          if (totalPages === 0) {
            pageNumbersDiv.innerHTML = '<span class="px-3 py-1 text-gray-500">No pages</span>';
          }
        }
      }

      // Function to go to specific page
      function goToPage(page) {
        currentPage = page;
        filterPermits(); // Re-filter and re-render for the new page
      }

      // Event listeners for filters and pagination
      document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('dateFilter')?.addEventListener('change', filterPermits);
        document.getElementById('statusFilter')?.addEventListener('change', filterPermits);
        document.getElementById('searchFilter')?.addEventListener('input', filterPermits);

        // Initial load: Set active tab and then filter
        switchTab('visitor'); // Default to 'visitor' tab on load
        updatePermitCounts();
      });

      // Close notifications panel when clicking outside
      document.addEventListener('click', function(event) {
        const panel = document.getElementById('notificationsPanel');
        const button = document.querySelector('button[onclick="toggleNotifications()"]');

        if (panel && button && !panel.contains(event.target) && !button.contains(event.target) && !panel.classList.contains('hidden')) {
          panel.classList.add('hidden');
        }
      });

      // Close user menu when clicking outside
      document.addEventListener('click', function(event) {
        const menu = document.getElementById('userMenu');
        const button = document.querySelector('button[onclick="toggleUserMenu()"]');

        if (menu && button && !menu.contains(event.target) && !button.contains(event.target) && !menu.classList.contains('hidden')) {
          menu.classList.add('hidden');
        }
      });

      // Function to switch tabs (Visitor/Vendor Permits)
      function switchTab(tabType) {
        document.querySelectorAll('.left-tab-item').forEach(item => {
          item.classList.remove('active');
        });
        document.querySelector(`.left-tab-item[onclick="switchTab('${tabType}')"]`).classList.add('active');

        currentTabType = tabType; // Update the global tab type

        filterPermits(); // Re-filter based on the new tab
      }
    </script>
    <style>
      html, body {
        height: 100%;
        overflow: hidden;
      }
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
      .action-btn {
        padding: 4px 8px;
        border-radius: 4px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 28px;
        margin: 0 2px;
      }
      .action-btn:hover {
        transform: translateY(-1px);
      }
      .action-btn.edit {
        background-color: rgba(37, 99, 235, 0.1);
        color: #2563eb;
      }
      .action-btn.edit:hover {
        background-color: rgba(37, 99, 235, 0.2);
      }
      .action-btn.view {
        background-color: rgba(107, 114, 128, 0.1);
        color: #4b5563;
      }
      .action-btn.view:hover {
        background-color: rgba(107, 114, 128, 0.2);
      }
      .action-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 4px;
      }
      /* Custom scrollbar styles */
      .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #CBD5E0 #EDF2F7;
      }
      .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
      }
      .custom-scrollbar::-webkit-scrollbar-track {
        background: #EDF2F7;
        border-radius: 4px;
      }
      .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #CBD5E0;
        border-radius: 4px;
      }
      .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #A0AEC0;
      }
      /* Table container styles */
      .table-container {
        overflow: visible;
      }
      /* Fixed header styles */
      .table-header {
        position: sticky;
        top: 0;
        background-color: #F9FAFB;
        z-index: 10;
      }
      /* Left tab styles */
      .left-tab {
        position: sticky;
        top: 80px;
        width: 200px;
        background-color: #F9FAFB;
        border-right: 1px solid #E5E7EB;
        height: fit-content;
        z-index: 20;
      }
      .left-tab-item {
        padding: 12px 16px;
        cursor: pointer;
        border-left: 3px solid transparent;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
      .left-tab-item:hover {
        background-color: #F3F4F6;
      }
      .left-tab-item.active {
        background-color: #EFF6FF;
        border-left-color: #2563EB;
        color: #2563EB;
      }
      .left-tab-item i {
        width: 20px;
        text-align: center;
      }
      .tab-content {
        display: none;
      }
      .tab-content.active {
        display: block;
      }
      /* Pagination styles */
      .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
        padding: 1rem;
        background-color: white;
        border-top: 1px solid #E5E7EB;
      }
      .pagination button {
        padding: 0.5rem 1rem;
        border: 1px solid #E5E7EB;
        border-radius: 0.375rem;
        background-color: white;
        color: #374151;
        font-size: 0.875rem;
        transition: all 0.2s;
      }
      .pagination button:hover:not(:disabled) {
        background-color: #F3F4F6;
      }
      .pagination button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
      }
      .pagination button.active {
        background-color: #2563EB;
        color: white;
        border-color: #2563EB;
      }
      .pagination-info {
        font-size: 0.875rem;
        color: #6B7280;
      }
      /* Main content scrollbar */
      .main-content {
        height: calc(100vh - 64px);
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #CBD5E0 #EDF2F7;
      }
      .main-content::-webkit-scrollbar {
        width: 8px;
      }
      .main-content::-webkit-scrollbar-track {
        background: #EDF2F7;
        border-radius: 4px;
      }
      .main-content::-webkit-scrollbar-thumb {
        background-color: #CBD5E0;
        border-radius: 4px;
      }
      .main-content::-webkit-scrollbar-thumb:hover {
        background-color: #A0AEC0;
      }
      /* Content area styles */
      .content-area {
        overflow: visible;
      }
      /* Table styles */
      table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
      }
      th {
        position: sticky;
        top: 0;
        background-color: #F9FAFB;
        z-index: 10;
        padding: 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-align: left;
        color: #374151;
        border-bottom: 1px solid #E5E7EB;
      }
      td {
        padding: 1rem;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #E5E7EB;
      }
      tr:hover {
        background-color: #F9FAFB;
      }
    </style>
  </head>
  <body class="bg-gray-50">

    <!-- Main Content -->
    <div class="main-content">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-4">
          <a href="{{route('/')}}" class="inline-flex items-center text-gray-600 hover:text-primary transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            <span>Back to Dashboard</span>
          </a>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
          <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-600">Open Permits</p>
                <p class="text-2xl font-semibold text-gray-900" id="openCount">0</p>
              </div>
              <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-check-circle text-green-600"></i>
              </div>
            </div>
          </div>
          <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-600">Closed Permits</p>
                <p class="text-2xl font-semibold text-gray-900" id="closedCount">0</p>
              </div>
              <div class="p-3 bg-gray-100 rounded-full">
                <i class="fas fa-times-circle text-gray-600"></i>
              </div>
            </div>
          </div>
          <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-600">Expired Permits</p>
                <p class="text-2xl font-semibold text-gray-900" id="expiredCount">0</p>
              </div>
              <div class="p-3 bg-red-100 rounded-full">
                <i class="fas fa-exclamation-circle text-red-600"></i>
              </div>
            </div>
          </div>
          <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-600">Total Permits</p>
                <p class="text-2xl font-semibold text-gray-900" id="totalCount">0</p>
              </div>
              <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-file-alt text-blue-600"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content Area -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
          <div class="flex">
            <!-- Left Tab -->
            <div class="left-tab">
              <div class="left-tab-item active" onclick="switchTab('visitor')">
                <div class="flex items-center space-x-3">
                  <i class="fas fa-user text-blue-600"></i>
                  <span>Visitor Permits</span>
                </div>
              </div>
              <div class="left-tab-item" onclick="switchTab('vendor')">
                <div class="flex items-center space-x-3">
                  <i class="fas fa-truck text-purple-600"></i>
                  <span>Vendor Permits</span>
                </div>
              </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1">
              <!-- Filter Section -->
              <div class="px-6 py-4 border-b border-gray-200 flex gap-4">
                <input type="text" id="searchFilter" placeholder="Search..." class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <select id="dateFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="all">All Dates</option>
                  <option value="today">Today</option>
                  <option value="this_week">This Week</option>
                  <option value="this_month">This Month</option>
                </select>
                <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="all">All Statuses</option>
                  <option value="open">Open</option>
                  <option value="closed">Closed</option>
                  <option value="expired">Expired</option>
                </select>
              </div>

              <!-- Table Section -->
              <div class="content-area">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="table-header">
                    <tr>
                      <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                      <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit Info</th>
                      <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                      <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                      <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
                      <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                      <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200" id="permitTableBody">
                    <!-- Permit data will be populated here -->
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              <div class="pagination">
                <button id="prevPage" onclick="goToPage(currentPage - 1)" disabled>
                  <i class="fas fa-chevron-left"></i>
                </button>
                <div id="pageNumbers" class="flex gap-2">
                  <!-- Page numbers will be populated here -->
                </div>
                <button id="nextPage" onclick="goToPage(currentPage + 1)">
                  <i class="fas fa-chevron-right"></i>
                </button>
                <span class="pagination-info" id="paginationInfo">Showing 1-20 of 20</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </body>
</html>

@endsection
