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
      .stat-card {
        position: relative;
        overflow: hidden;
      }
      .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1));
        border-radius: 50%;
        transform: translate(30%, -30%);
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
    </style>
  </head>
  <body class="bg-gray-50">


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Stats and Quick Actions Section -->
        <div class="lg:col-span-2 space-y-8">
          <!-- Welcome Message -->
          <div class="bg-gradient-to-r from-primary to-blue-600 rounded-lg shadow-sm p-6 text-white">
            <h1 class="text-2xl font-bold mb-2">Welcome, Admin!</h1>
            <p class="text-blue-100">Here is today's activity summary</p>
          </div>

          <!-- Stats Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Employees</h3>
                  <p class="mt-2 text-3xl font-bold text-primary">150</p>
                </div>
                <div class="p-3 rounded-full bg-blue-50">
                  <i class="fas fa-users text-primary text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+5 from last month</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Vehicles</h3>
                  <p class="mt-2 text-3xl font-bold text-green-600">75</p>
                </div>
                <div class="p-3 rounded-full bg-green-50">
                  <i class="fas fa-car text-green-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+2 this week</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Active Permits Today</h3>
                  <p class="mt-2 text-3xl font-bold text-yellow-600">25</p>
                </div>
                <div class="p-3 rounded-full bg-yellow-50">
                  <i class="fas fa-clipboard-list text-yellow-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+8 from yesterday</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Expiring Safety Induction (30 Days)</h3>
                  <p class="mt-2 text-3xl font-bold text-red-600">15</p>
                </div>
                <div class="p-3 rounded-full bg-red-50">
                  <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
              </div>
              <div class="mt-1 flex justify-between items-center">
                <p class="text-xs text-gray-500">Need to be updated</p>
                <a href="analytics.html" class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-medium text-red-600 hover:text-red-700 transition-colors hidden">
                  <i class="fas fa-chart-line mr-0.5 text-[10px]"></i>
                  Check
                </a>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
         @if(Auth::user()->access_newspecial_create == 1)
              <button onclick="window.location.href='{{route('vendor_create')}}'" class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                <i class="fas fa-star text-green-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">New Special</span>
              </button>
              @endif
              <button onclick="window.location.href='{{route('index_approve')}}'" class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                <i class="fas fa-check-circle text-blue-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Approvals</span>
              </button>
              <button onclick="window.location.href='{{route('permit-data')}}'" class="flex flex-col items-center justify-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition">
                <i class="fas fa-users text-orange-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Visitor & Vendor</span>
              </button>
              <button onclick="window.location.href='{{route('vehicle-list')}}'" class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                <i class="fas fa-car text-purple-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Vehicle Data</span>
              </button>
              <button onclick="window.location.href='{{route('employee-data')}}'" class="flex flex-col items-center justify-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                <i class="fas fa-users text-yellow-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Employee Data</span>
              </button>
              <button onclick="window.location.href='{{route('employee-safety-list')}}'" class="flex flex-col items-center justify-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition">
                <i class="fas fa-clipboard-check text-red-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Safety Induction</span>
              </button>
              <button     onclick="window.location.href='{{route('reports')}}'" class="flex flex-col items-center justify-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                <i class="fas fa-chart-bar text-indigo-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Reports</span>
              </button>
            </div>
          </div>

          <!-- Permit Requests Section -->
          <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-medium text-gray-900">Permit Requests</h2>
              <div class="flex space-x-2">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                  Visitor: <span id="visitorPermitCount">3</span>
                </span>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                  Vendor: <span id="vendorPermitCount">2</span>
                </span>
              </div>
            </div>
            <!-- Visitor Permit Requests -->
            <div class="mb-6">
              <h3 class="text-md font-medium text-gray-700 mb-3">Visitor Permits</h3>
              <div class="space-y-4">
                <!-- Visitor Permit 1 -->
                <div id="permit-V001" class="visitor-permit flex items-center justify-between p-4 bg-red-50 rounded-lg border-l-4 border-red-500 relative overflow-hidden">
                  <div class="absolute top-0 right-0 w-24 h-24 bg-red-100 opacity-20 transform rotate-45 translate-x-12 -translate-y-12"></div>
                  <div>
                    <div class="flex items-center space-x-2">
                      <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0001</p>
                      <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full flex items-center">
                        <i class="fas fa-exclamation-circle mr-1 animate-pulse"></i>
                        Urgent
                      </span>
                    </div>
                    <p class="text-xs text-gray-500">Visitor: John Smith</p>
                    <p class="text-xs text-gray-500">Purpose: Client Meeting</p>
                    <p class="text-xs text-gray-500">Date: Today, 2:00 PM - 4:00 PM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('V001')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200 transition-colors">
                      View Details
                    </button>
                  </div>
                </div>
                <!-- Visitor Permit 2 -->
                <div id="permit-V002" class="visitor-permit flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                  <div>
                    <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0002</p>
                    <p class="text-xs text-gray-500">Visitor: Sarah Johnson</p>
                    <p class="text-xs text-gray-500">Purpose: Job Interview</p>
                    <p class="text-xs text-gray-500">Date: Tomorrow, 10:00 AM - 11:00 AM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('V002')" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-medium hover:bg-blue-200">
                      View Details
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Vendor Permit Requests -->
            <div>
              <h3 class="text-md font-medium text-gray-700 mb-3">Vendor Permits</h3>
              <div class="space-y-4">
                <!-- Vendor Permit 1 -->
                <div id="permit-VD001" class="vendor-permit flex items-center justify-between p-4 bg-red-50 rounded-lg border-l-4 border-red-500 relative overflow-hidden">
                  <div class="absolute top-0 right-0 w-24 h-24 bg-red-100 opacity-20 transform rotate-45 translate-x-12 -translate-y-12"></div>
                  <div>
                    <div class="flex items-center space-x-2">
                      <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0003</p>
                      <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full flex items-center">
                        <i class="fas fa-exclamation-circle mr-1 animate-pulse"></i>
                        Urgent
                      </span>
                    </div>
                    <p class="text-xs text-gray-500">Vendor: PT. ABC Services</p>
                    <p class="text-xs text-gray-500">Purpose: Equipment Maintenance</p>
                    <p class="text-xs text-gray-500">Date: Today, 1:00 PM - 5:00 PM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('VD001')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200 transition-colors">
                      View Details
                    </button>
                  </div>
                </div>
                <!-- Vendor Permit 2 -->
                <div id="permit-VD002" class="vendor-permit flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500">
                  <div>
                    <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0004</p>
                    <p class="text-xs text-gray-500">Vendor: XYZ Supplies</p>
                    <p class="text-xs text-gray-500">Purpose: Office Supplies Delivery</p>
                    <p class="text-xs text-gray-500">Date: Tomorrow, 9:00 AM - 10:00 AM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('VD002')" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-medium hover:bg-blue-200">
                      View Details
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sidebar -->


        <div class="space-y-8">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Recent Activities</h2>
            <div class="space-y-4">
              <div class="flex items-start space-x-3">
                <div class="p-2 rounded-full bg-green-100">
                  <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-900">Maintenance completed</p>
                  <p class="text-xs text-gray-500">Generator Room - 2 hours ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="p-2 rounded-full bg-blue-100">
                  <i class="fas fa-user-check text-blue-600"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-900">New visitor registered</p>
                  <p class="text-xs text-gray-500">John Doe - 3 hours ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="p-2 rounded-full bg-purple-100">
                  <i class="fas fa-truck text-purple-600"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-900">Vendor delivery</p>
                  <p class="text-xs text-gray-500">Office supplies - 4 hours ago</p>
                </div>
              </div>
            </div>
          </div>
          <!-- User Management -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">User Management</h2>
            <div class="space-y-3">
              <a href="{{route('regisuser')}}" class="flex items-center p-3 bg-gray-50 rounded-lg menu-item">
                <i class="fas fa-user-plus text-primary text-xl mr-3"></i>
                <span>Add User</span>
              </a>
              <a href="{{route('user-list')}}" class="flex items-center p-3 bg-gray-50 rounded-lg menu-item">
                <i class="fas fa-users-cog text-primary text-xl mr-3"></i>
                <span>User List</span>
              </a>
            </div>
          </div>

          <!-- Quick Tips -->
          <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Tips</h2>
            <div class="space-y-3">
              <div class="flex items-start space-x-3">
                <i class="fas fa-lightbulb text-yellow-500 mt-1"></i>
                <p class="text-sm text-gray-600">Use Quick Actions for fast access to frequently used features</p>
              </div>
              <div class="flex items-start space-x-3">
                <i class="fas fa-bell text-primary mt-1"></i>
                <p class="text-sm text-gray-600">Check notifications for the latest updates</p>
              </div>
              <div class="flex items-start space-x-3">
                <i class="fas fa-chart-line text-green-500 mt-1"></i>
                <p class="text-sm text-gray-600">View statistics to monitor activities</p>
              </div>
            </div>
          </div>
        </div>


    <script>
      function toggleNotifications() {
        const panel = document.getElementById('notificationsPanel');
        panel.classList.toggle('hidden');
      }

      function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
      }

      function logout() {
        // Clear any stored data
        localStorage.clear();
        sessionStorage.clear();
        // Redirect to login page
        window.location.href = 'login.html';
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
  </body>
</html>


@endsection
