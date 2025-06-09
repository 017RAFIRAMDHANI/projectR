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
      .table-row-hover {
        transition: background-color 0.2s ease;
      }
      .table-row-hover:hover {
        background-color: rgba(0, 0, 0, 0.02);
      }
    </style>
  </head>
  <body class="bg-gray-50">

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Back Button -->
      <div class="mb-6">
        <a href="fh-dashboard.html" class="inline-flex items-center text-gray-600 hover:text-gray-900">
          <i class="fas fa-arrow-left mr-2"></i>
          Back to Dashboard
        </a>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6">
        <!-- Page Title and Add Button -->
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-semibold text-gray-900">Employee Data</h1>
 @if(Auth::user()->role == "FM" || Auth::user()->role == "DHI")
          <button onclick="addNewEmployee()" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Add Employee
          </button>
@endif
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 flex flex-wrap gap-4 bg-white p-4 rounded-lg shadow-sm">
          <div class="flex-1 min-w-[200px]">
            <label for="typeFilter" class="block text-sm font-semibold text-gray-700 mb-1">Permit Type</label>
            <select id="typeFilter" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
              <option value="all">All Types</option>
              <option value="visitor">Visitor</option>
              <option value="vendor">Vendor</option>
              <option value="employee">Employee</option>
            </select>
          </div>
          <div class="flex-1 min-w-[200px]">
            <label for="statusFilter" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
            <select id="statusFilter" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
              <option value="all">All Status</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
          <div class="flex-1 min-w-[200px]">
            <label for="searchFilter" class="block text-sm font-semibold text-gray-700 mb-1">Search</label>
            <input
              type="text"
              id="searchFilter"
              placeholder="Search employees..."
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
        </div>

        <!-- Employee List Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                   @if(Auth::user()->role == "FM" || Auth::user()->role == "DHI")
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                @endif
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Sample Employee Row -->
              <tr class="table-row-hover">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Doe 22</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Digital Hyperspace Indonesia</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Software Engineer</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Employee</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Active</span>
                </td>
                @if(Auth::user()->role == "FM" || Auth::user()->role == "DHI")
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <button class="text-primary hover:text-blue-700 mr-3" title="Edit">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="text-yellow-600 hover:text-yellow-700 mr-3" title="View Details">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-700" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
                @endif
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
          <div class="flex flex-1 justify-between sm:hidden">
            <button class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
              Previous
            </button>
            <button class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
              Next
            </button>
          </div>
          <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> entries
              </p>
            </div>
            <div>
              <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <button class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                  <span class="sr-only">Previous</span>
                  <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button aria-current="page" class="relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                  1
                </button>
                <button class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                  2
                </button>
                <button class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                  <span class="sr-only">Next</span>
                  <i class="fas fa-chevron-right text-sm"></i>
                </button>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Add Employee Modal -->
    <div id="addEmployeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Add Employee</h2>
          <button onclick="closeAddEmployeeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
        </div>
        <form id="addEmployeeForm" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" id="addFullName" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Company</label>
            <input type="text" id="addCompany" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Position</label>
            <input type="text" id="addPosition" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Type</label>
            <input type="text" value="Employee" class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100" disabled />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select id="addStatus" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" onclick="closeAddEmployeeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700">Add</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit Employee Modal -->
    <div id="editEmployeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Edit Employee</h2>
          <button onclick="closeEditEmployeeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
        </div>
        <form id="editEmployeeForm" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" id="editFullName" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Company</label>
            <input type="text" id="editCompany" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Position</label>
            <input type="text" id="editPosition" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Type</label>
            <input type="text" value="Employee" class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100" disabled />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select id="editStatus" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" onclick="closeEditEmployeeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700">Save</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Preview Employee Modal -->
    <div id="previewEmployeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Employee Details</h2>
          <button onclick="closePreviewEmployeeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
        </div>
        <div class="space-y-3">
          <div>
            <span class="block text-xs text-gray-500">Full Name</span>
            <span id="previewFullName" class="block font-medium text-gray-900"></span>
          </div>
          <div>
            <span class="block text-xs text-gray-500">Company</span>
            <span id="previewCompany" class="block font-medium text-gray-900"></span>
          </div>
          <div>
            <span class="block text-xs text-gray-500">Position</span>
            <span id="previewPosition" class="block font-medium text-gray-900"></span>
          </div>
          <div>
            <span class="block text-xs text-gray-500">Type</span>
            <span class="block font-medium text-gray-900">Employee</span>
          </div>
          <div>
            <span class="block text-xs text-gray-500">Status</span>
            <span id="previewStatus" class="block font-medium text-gray-900"></span>
          </div>
        </div>
        <div class="flex justify-end mt-4">
          <button onclick="closePreviewEmployeeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Close</button>
        </div>
      </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <div class="mb-4">
          <h3 id="confirmationMessage" class="text-lg font-medium text-gray-900 text-center">Are you sure you want to proceed?</h3>
        </div>
        <div class="flex justify-center gap-4">
          <button id="confirmYesBtn" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700">Yes</button>
          <button id="confirmNoBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">No</button>
        </div>
      </div>
    </div>

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

      // Function to filter employees
      function filterEmployees() {
        const typeFilter = document.getElementById('typeFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;
        const searchFilter = document.getElementById('searchFilter').value.toLowerCase();

        const employees = document.querySelectorAll('tbody tr');

        employees.forEach(employee => {
          const employeeType = employee.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
          const employeeStatus = employee.querySelector('td:nth-child(5) span').textContent.trim().toLowerCase();
          const employeeText = employee.textContent.toLowerCase();

          const typeMatch = typeFilter === 'all' || employeeType === typeFilter;
          const statusMatch = statusFilter === 'all' || employeeStatus === statusFilter;
          const searchMatch = searchFilter === '' || employeeText.includes(searchFilter);

          if (typeMatch && statusMatch && searchMatch) {
            employee.classList.remove('hidden');
          } else {
            employee.classList.add('hidden');
          }
        });
      }

      // Function to go to page
      function goToPage(page) {
        // In a real application, this would fetch the data for the selected page
        console.log(`Navigating to page ${page}`);
        // Update the active page button
        document.querySelectorAll('[aria-current="page"]').forEach(el => {
          el.removeAttribute('aria-current');
          el.classList.remove('bg-primary', 'text-white');
          el.classList.add('text-gray-900');
        });
        const newActiveButton = document.querySelector(`button:nth-child(${page + 1})`);
        if (newActiveButton) {
          newActiveButton.setAttribute('aria-current', 'page');
          newActiveButton.classList.add('bg-primary', 'text-white');
          newActiveButton.classList.remove('text-gray-900');
        }
      }

      // Add event listeners for filters
      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('typeFilter').addEventListener('change', filterEmployees);
        document.getElementById('statusFilter').addEventListener('change', filterEmployees);
        document.getElementById('searchFilter').addEventListener('input', filterEmployees);
      });

      // Add click handlers to pagination buttons
      document.querySelectorAll('nav button').forEach(button => {
        if (button.textContent.match(/^\d+$/)) {
          button.addEventListener('click', () => goToPage(parseInt(button.textContent)));
        }
      });

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

      // Modal open/close functions
      function openAddEmployeeModal() {
        document.getElementById('addEmployeeModal').classList.remove('hidden');
      }
      function closeAddEmployeeModal() {
        document.getElementById('addEmployeeModal').classList.add('hidden');
        document.getElementById('addEmployeeForm').reset();
      }
      function openEditEmployeeModal(index) {
        const data = employeesData[index];
        document.getElementById('editFullName').value = data.fullName;
        document.getElementById('editCompany').value = data.company;
        document.getElementById('editPosition').value = data.position;
        document.getElementById('editStatus').value = data.status;
        document.getElementById('editEmployeeForm').setAttribute('data-index', index);
        document.getElementById('editEmployeeModal').classList.remove('hidden');
      }
      function closeEditEmployeeModal() {
        document.getElementById('editEmployeeModal').classList.add('hidden');
        document.getElementById('editEmployeeForm').reset();
      }
      function openPreviewEmployeeModal(index) {
        const data = employeesData[index];
        document.getElementById('previewFullName').textContent = data.fullName;
        document.getElementById('previewCompany').textContent = data.company;
        document.getElementById('previewPosition').textContent = data.position;
        document.getElementById('previewStatus').textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
        document.getElementById('previewEmployeeModal').classList.remove('hidden');
      }
      function closePreviewEmployeeModal() {
        document.getElementById('previewEmployeeModal').classList.add('hidden');
      }


      // Confirmation modal logic
      let confirmAction = null;
      function showConfirmation(message, onYes) {
        document.getElementById('confirmationMessage').textContent = message;
        document.getElementById('confirmationModal').classList.remove('hidden');
        confirmAction = onYes;
      }
      document.getElementById('confirmYesBtn').onclick = function() {
        document.getElementById('confirmationModal').classList.add('hidden');
        if (typeof confirmAction === 'function') confirmAction();
      };
      document.getElementById('confirmNoBtn').onclick = function() {
        document.getElementById('confirmationModal').classList.add('hidden');
        confirmAction = null;
      };


      // Edit Employee with confirmation
      document.getElementById('editEmployeeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const idx = this.getAttribute('data-index');
        showConfirmation('Are you sure you want to save changes to this employee?', function() {
          employeesData[idx].fullName = document.getElementById('editFullName').value;
          employeesData[idx].company = document.getElementById('editCompany').value;
          employeesData[idx].position = document.getElementById('editPosition').value;
          employeesData[idx].status = document.getElementById('editStatus').value;
          renderEmployeesTable();
          closeEditEmployeeModal();
        });
      });

      // Delete Employee with confirmation
      function deleteEmployee(idx) {
        showConfirmation('Are you sure you want to delete this employee?', function() {
          employeesData.splice(idx, 1);
          renderEmployeesTable();
        });
      }

      // Open Add Employee Modal from button
      document.querySelector('button[onclick="addNewEmployee()"],button[onclick="openAddEmployeeModal()"]')?.addEventListener('click', openAddEmployeeModal);
      // Replace the old function with the new one
      window.addNewEmployee = openAddEmployeeModal;

      // Initial render
      renderEmployeesTable();
    </script>
  </body>
</html>

@endsection
