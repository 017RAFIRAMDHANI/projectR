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
    </script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Column - Role List -->
        <div class="lg:col-span-4 space-y-6">
          <!-- User List -->
          <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-lg font-medium text-gray-900">Users</h2>
            </div>
            <div class="space-y-4">
              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex justify-between items-center">
                  <div>
                    <h3 class="text-md font-medium text-gray-900">John Doe</h3>
                    <p class="text-sm text-gray-500">john@example.com</p>
                  </div>
                  <select class="form-select text-sm border-gray-300 rounded-md" onchange="updateUserRole(this.value)">
                    <option value="dhi">DHI</option>
                    <option value="fm">FM</option>
                    <option value="client">Client</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Role List -->
          <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-lg font-medium text-gray-900">Roles</h2>
            </div>
            <div class="space-y-4">
              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex justify-between items-center">
                  <div>
                    <h3 class="text-md font-medium text-gray-900">DHI</h3>
                    <p class="text-sm text-gray-500">Full access to all features and settings</p>
                  </div>
                </div>
              </div>

              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex justify-between items-center">
                  <div>
                    <h3 class="text-md font-medium text-gray-900">FM</h3>
                    <p class="text-sm text-gray-500">Access to employee data and approvals</p>
                  </div>
                </div>
              </div>

              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex justify-between items-center">
                  <div>
                    <h3 class="text-md font-medium text-gray-900">Client</h3>
                    <p class="text-sm text-gray-500">Basic access to personal data and requests</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column - Permissions -->
        <div class="lg:col-span-8">
          <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-lg font-medium text-gray-900">Permissions</h2>
              <button onclick="savePermissions()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                Save Changes
              </button>
            </div>
            <div id="permissionsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Static Permissions for all Roles -->

              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center mb-3">
                  <i class="fas fa-home text-primary mr-2"></i>
                  <h3 class="text-md font-medium text-gray-700">New Special</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">View</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Create</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Update</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Delete</span>
                  </label>
                </div>
              </div>

              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center mb-3">
                  <i class="fas fa-users text-primary mr-2"></i>
                  <h3 class="text-md font-medium text-gray-700">Employee Data</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">View</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Create</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Update</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Delete</span>
                  </label>
                </div>
              </div>

              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center mb-3">
                  <i class="fas fa-check-circle text-primary mr-2"></i>
                  <h3 class="text-md font-medium text-gray-700">Approvals</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">View</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Create</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Update</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Delete</span>
                  </label>
                </div>
              </div>

              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center mb-3">
                  <i class="fas fa-user-plus text-primary mr-2"></i>
                  <h3 class="text-md font-medium text-gray-700">Visitor & Vendor</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">View</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Create</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Update</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Delete</span>
                  </label>
                </div>
              </div>

              <!-- Vehicle List -->
              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center mb-3">
                  <i class="fas fa-car text-primary mr-2"></i>
                  <h3 class="text-md font-medium text-gray-700">Vehicle List</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">View</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Create</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Update</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Delete</span>
                  </label>
                </div>
              </div>

              <!-- Safety Induction -->
              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center mb-3">
                  <i class="fas fa-clipboard-check text-primary mr-2"></i>
                  <h3 class="text-md font-medium text-gray-700">Safety Induction</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">View</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" disabled>
                    <span class="text-sm text-gray-600">Create</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Update</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" disabled>
                    <span class="text-sm text-gray-600">Delete</span>
                  </label>
                </div>
              </div>

              <!-- Reports -->
              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center mb-3">
                  <i class="fas fa-chart-bar text-primary mr-2"></i>
                  <h3 class="text-md font-medium text-gray-700">Reports</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" >
                    <span class="text-sm text-gray-600">View</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" >
                    <span class="text-sm text-gray-600">Create</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" >
                    <span class="text-sm text-gray-600">Update</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" >
                    <span class="text-sm text-gray-600">Delete</span>
                  </label>
                </div>
              </div>

              <!-- Role Management -->
              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center mb-3">
                  <i class="fas fa-user-shield text-primary mr-2"></i>
                  <h3 class="text-md font-medium text-gray-700">Role Management</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">View</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Create</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Update</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary" checked>
                    <span class="text-sm text-gray-600">Delete</span>
                  </label>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </main>

    <script>
      // Function to save permissions
      function savePermissions() {
        const checkboxes = document.querySelectorAll('#permissionsContainer input[type="checkbox"]');
        const permissions = {};

        checkboxes.forEach(checkbox => {
          const menuName = checkbox.closest('.bg-gray-50').querySelector('h3').textContent;
          const permission = checkbox.nextElementSibling.textContent.toLowerCase();
          if (!permissions[menuName]) {
            permissions[menuName] = [];
          }
          if (checkbox.checked) {
            permissions[menuName].push(permission);
          }
        });

        console.log('Saving permissions:', permissions);
        alert('Permissions saved successfully!');
      }
    </script>
</body>
</html>

@endsection
