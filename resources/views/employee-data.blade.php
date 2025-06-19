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
    <!-- Navbar -->

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Back Button -->
      <div class="mb-6">
        <a href="{{route('/')}}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
          <i class="fas fa-arrow-left mr-2"></i>
          Back to Dashboard
        </a>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6">
        <!-- Page Title and Add Button -->
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-semibold text-gray-900">Employee Data</h1>
          <button onclick="addNewEmployee()" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Add Employee
          </button>
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Card</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Sample Employee Row -->
              <tr class="table-row-hover">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Digital Hyperspace Indonesia</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Software Engineer</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Employee</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <button onclick="previewIdCard('john-doe-id')" class="text-primary hover:text-blue-700">
                    <i class="fas fa-id-card mr-1"></i>View ID Card
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Active</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <button class="text-primary hover:text-blue-700 mr-3" title="Edit" onclick="editEmployee('john-doe')">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="text-yellow-600 hover:text-yellow-700 mr-3" title="View Details" onclick="previewEmployee('john-doe')">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="text-red-600 hover:text-red-700" title="Delete">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
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
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Add Employee</h2>
          <button onclick="closeAddEmployeeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
        </div>
        <form id="addEmployeeForm" class="space-y-4">
          <div class="grid grid-cols-2 gap-4">
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
              <label class="block text-sm font-medium text-gray-700">ID Card / Passport</label>
              <div class="mt-1">
                <div class="flex items-center justify-center w-full">
                  <label class="flex flex-col w-full h-48 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 rounded-lg">
                    <div class="flex flex-col items-center justify-center h-full">
                      <img id="idCardPreview" src="" alt="" class="hidden w-full h-full object-contain p-4">
                      <div id="uploadIcon" class="flex flex-col items-center justify-center p-6">
                        <i class="fas fa-id-card text-gray-400 text-4xl mb-4"></i>
                        <p class="text-base text-gray-600 font-medium mb-2">Click to upload ID Card or Passport</p>
                        <p class="text-sm text-gray-500">PNG, JPG, or PDF (max. 2MB)</p>
                      </div>
                    </div>
                    <input type="file" id="idCardInput" class="opacity-0" accept=".png,.jpg,.jpeg,.pdf" />
                  </label>
                </div>
              </div>
              <p class="mt-2 text-sm text-gray-500">Please upload a clear photo of your ID Card or Passport</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Status</label>
              <select id="addStatus" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" onclick="closeAddEmployeeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-blue-600">
              Add Employee
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit Employee Modal -->
    <div id="editEmployeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Edit Employee</h2>
          <button onclick="closeEditEmployeeModal()" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <form id="editEmployeeForm" class="space-y-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Full Name</label>
              <input type="text" id="editFullName" name="editFullName" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Company</label>
              <input type="text" id="editCompany" name="editCompany" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Position</label>
              <input type="text" id="editPosition" name="editPosition" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Type</label>
              <input type="text" id="editType" name="editType" value="Employee" class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100" disabled />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">ID Card / Passport</label>
              <div class="mt-1">
                <div class="flex items-center justify-center w-full">
                  <label class="flex flex-col w-full h-48 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 rounded-lg">
                    <div class="flex flex-col items-center justify-center h-full">
                      <img id="editIdCardPreview" src="" alt="" class="hidden w-full h-full object-contain p-4">
                      <div id="editUploadIcon" class="flex flex-col items-center justify-center p-6">
                        <i class="fas fa-id-card text-gray-400 text-4xl mb-4"></i>
                        <p class="text-base text-gray-600 font-medium mb-2">Click to upload ID Card or Passport</p>
                        <p class="text-sm text-gray-500">PNG, JPG, or PDF (max. 2MB)</p>
                      </div>
                    </div>
                    <input type="file" id="editIdCardInput" name="editIdCardInput" class="opacity-0" accept=".png,.jpg,.jpeg,.pdf" />
                  </label>
                </div>
              </div>
              <p class="mt-2 text-sm text-gray-500">Please upload a clear photo of your ID Card or Passport</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Status</label>
              <select id="editStatus" name="editStatus" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" onclick="closeEditEmployeeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-blue-600">
              Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Preview Employee Modal -->
    <div id="previewEmployeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Employee Details</h2>
          <button onclick="closePreviewEmployeeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
        </div>
        <div class="space-y-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Full Name</label>
              <p id="previewFullName" class="mt-1 text-sm text-gray-900"></p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Company</label>
              <p id="previewCompany" class="mt-1 text-sm text-gray-900"></p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Position</label>
              <p id="previewPosition" class="mt-1 text-sm text-gray-900"></p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Type</label>
              <p id="previewType" class="mt-1 text-sm text-gray-900"></p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">ID Card / Passport</label>
              <div class="mt-1">
                <button onclick="previewIdCard('preview-id')" class="text-primary hover:text-blue-700">
                  <i class="fas fa-id-card mr-1"></i>View ID Card
                </button>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Status</label>
              <p id="previewStatus" class="mt-1 text-sm text-gray-900"></p>
            </div>
          </div>
              </div>
            </div>
          </div>

    <!-- ID Card Preview Modal -->
    <div id="idCardPreviewModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl mx-4">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">ID Card / Passport Preview</h2>
          <button onclick="closeIdCardPreview()" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="flex justify-center">
          <img id="idCardPreviewImage" src="" alt="ID Card Preview" class="max-w-full max-h-[70vh] object-contain">
        </div>
      </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
        <div class="text-center">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Confirmation</h3>
          <p id="confirmationMessage" class="text-sm text-gray-500 mb-6"></p>
          <div class="flex justify-center space-x-4">
            <button id="confirmNoBtn" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button id="confirmYesBtn" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-blue-600">
              Confirm
            </button>
        </div>
        </div>
      </div>
    </div>

    <!-- KTP Preview Modal -->
    <div id="ktpPreviewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
      <div class="bg-white rounded-lg p-4 max-w-2xl w-full mx-4">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-gray-900">KTP Photo Preview</h3>
          <button onclick="closeKTPPreview()" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="relative">
          <img
            id="ktpPreviewLarge"
            src=""
            alt="KTP Photo Preview"
            class="w-full h-auto rounded-lg"
          />
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
      function editEmployee(employeeId) {
        console.log('Edit button clicked for employee:', employeeId);
        console.log('Current employees data:', employeesData);

        // Find the employee in the data array
        const employeeIndex = employeesData.findIndex(emp => emp.fullName.replace(/\s+/g, '-') === employeeId);
        console.log('Found employee at index:', employeeIndex);

        if (employeeIndex === -1) {
          console.error('Employee not found:', employeeId);
          return;
        }

        const employeeData = employeesData[employeeIndex];
        console.log('Employee data to edit:', employeeData);

        // Set the form's data-index attribute
        const editForm = document.getElementById('editEmployeeForm');
        editForm.setAttribute('data-index', employeeIndex);
        console.log('Set form data-index to:', employeeIndex);

        // Populate the edit form
        document.getElementById('editFullName').value = employeeData.fullName;
        document.getElementById('editCompany').value = employeeData.company;
        document.getElementById('editPosition').value = employeeData.position;
        document.getElementById('editStatus').value = employeeData.status.toLowerCase();

        // Set ID card preview if exists
        if (employeeData.idCard) {
          editIdCardPreview.src = employeeData.idCard;
          editIdCardPreview.classList.remove('hidden');
          editUploadIcon.classList.add('hidden');
        } else {
          editIdCardPreview.classList.add('hidden');
          editUploadIcon.classList.remove('hidden');
        }

        // Show the modal
        document.getElementById('editEmployeeModal').classList.remove('hidden');
      }
      function closeEditEmployeeModal() {
        document.getElementById('editEmployeeModal').classList.add('hidden');
        document.getElementById('editEmployeeForm').reset();
        // Reset ID card preview
        editIdCardPreview.classList.add('hidden');
        editUploadIcon.classList.remove('hidden');
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

      // Initialize employees data from localStorage if available
      let employeesData = JSON.parse(localStorage.getItem('employeesData')) || [
        {
          fullName: 'John Doe',
          company: 'Digital Hyperspace Indonesia',
          position: 'Software Engineer',
          type: 'Employee',
          status: 'active',
          idCard: null
        }
      ];

      // Save data to localStorage whenever it changes
      function saveEmployeesData() {
        localStorage.setItem('employeesData', JSON.stringify(employeesData));
        console.log('Saved employees data:', employeesData);
      }

      function renderEmployeesTable() {
        console.log('Rendering table with data:', employeesData);
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = '';
        employeesData.forEach((emp, idx) => {
          const tr = document.createElement('tr');
          tr.className = 'table-row-hover';
          tr.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${emp.fullName}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${emp.company}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${emp.position}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${emp.type}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <button onclick="previewIdCard('${emp.fullName.replace(/\s+/g, '-')}-id')" class="text-primary hover:text-blue-700">
                <i class="fas fa-id-card mr-1"></i>View ID Card
              </button>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 py-1 text-xs font-medium rounded-full ${emp.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-600'}">${emp.status.charAt(0).toUpperCase() + emp.status.slice(1)}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              <button class="text-primary hover:text-blue-700 mr-3" title="Edit" onclick="editEmployee('${emp.fullName.replace(/\s+/g, '-')}')">
                <i class="fas fa-edit"></i>
              </button>
              <button class="text-yellow-600 hover:text-yellow-700 mr-3" title="View Details" onclick="previewEmployee('${emp.fullName.replace(/\s+/g, '-')}')">
                <i class="fas fa-eye"></i>
              </button>
              <button class="text-red-600 hover:text-red-700" title="Delete" onclick="deleteEmployee(${idx})">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          `;
          tbody.appendChild(tr);
        });
        saveEmployeesData(); // Save after rendering
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

      // Add Employee with confirmation
      document.getElementById('addEmployeeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showConfirmation('Are you sure you want to add this employee?', function() {
          const fullName = document.getElementById('addFullName').value;
          const company = document.getElementById('addCompany').value;
          const position = document.getElementById('addPosition').value;
          const status = document.getElementById('addStatus').value;
          employeesData.push({ fullName, company, position, type: 'employee', status });
          renderEmployeesTable();
          closeAddEmployeeModal();
        });
      });

      // Edit Employee with confirmation
      document.getElementById('editEmployeeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const idx = this.getAttribute('data-index');
        console.log('Submitting edit form with index:', idx);

        if (idx === null) {
          console.error('No employee index found');
          return;
        }

        showConfirmation('Are you sure you want to save changes to this employee?', function() {
          console.log('Saving changes for employee at index:', idx);
          console.log('Current employee data:', employeesData[idx]);

          // Update employee data
          employeesData[idx] = {
            ...employeesData[idx],
            fullName: document.getElementById('editFullName').value,
            company: document.getElementById('editCompany').value,
            position: document.getElementById('editPosition').value,
            status: document.getElementById('editStatus').value,
            idCard: editIdCardPreview.src || null
          };

          console.log('Updated employee data:', employeesData[idx]);

          // Update the table and save data
          renderEmployeesTable();

          // Close the modal
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

      // ID Card Preview
      const idCardInput = document.getElementById('idCardInput');
      const idCardPreview = document.getElementById('idCardPreview');
      const uploadIcon = document.getElementById('uploadIcon');

      idCardInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function(e) {
              idCardPreview.src = e.target.result;
              idCardPreview.classList.remove('hidden');
              uploadIcon.classList.add('hidden');
            }
          reader.readAsDataURL(file);
          } else {
            idCardPreview.classList.add('hidden');
            uploadIcon.classList.remove('hidden');
            alert('Please upload an image file (PNG, JPG, or JPEG)');
      }
        }
      });

      // Edit ID Card Preview
      const editIdCardInput = document.getElementById('editIdCardInput');
      const editIdCardPreview = document.getElementById('editIdCardPreview');
      const editUploadIcon = document.getElementById('editUploadIcon');

      editIdCardInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function(e) {
              editIdCardPreview.src = e.target.result;
              editIdCardPreview.classList.remove('hidden');
              editUploadIcon.classList.add('hidden');
            }
          reader.readAsDataURL(file);
          } else {
            editIdCardPreview.classList.add('hidden');
            editUploadIcon.classList.remove('hidden');
            alert('Please upload an image file (PNG, JPG, or JPEG)');
      }
        }
      });

      function previewIdCard(employeeId) {
        // Here you would typically fetch the ID card image from your backend
        const idCardImage = 'path/to/id-card-image.jpg'; // Replace with actual image path
        document.getElementById('idCardPreviewImage').src = idCardImage;
        document.getElementById('idCardPreviewModal').classList.remove('hidden');
      }

      function closeIdCardPreview() {
        document.getElementById('idCardPreviewModal').classList.add('hidden');
      }

      function previewEmployee(employeeId) {
        // Here you would typically fetch employee data from your backend
        const employeeData = {
          id: employeeId,
          fullName: 'John Doe',
          company: 'Digital Hyperspace Indonesia',
          position: 'Software Engineer',
          type: 'Employee',
          status: 'Active',
          idCard: 'path/to/id-card-image.jpg'
        };

        // Populate the preview
        document.getElementById('previewFullName').textContent = employeeData.fullName;
        document.getElementById('previewCompany').textContent = employeeData.company;
        document.getElementById('previewPosition').textContent = employeeData.position;
        document.getElementById('previewType').textContent = employeeData.type;
        document.getElementById('previewStatus').textContent = employeeData.status;

        // Show the modal
        document.getElementById('previewEmployeeModal').classList.remove('hidden');
      }
    </script>
  </body>
</html>


@endsection
