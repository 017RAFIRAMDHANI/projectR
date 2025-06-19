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
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1));
        pointer-events: none;
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
    <!-- Navbar -->


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Stats and Quick Actions Section -->
        <div class="lg:col-span-2 space-y-8">
          <!-- Welcome Message -->
          <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-sm p-6 text-white">
            <h1 class="text-2xl font-bold mb-2">Welcome, Security!</h1>
            <p class="text-white/80">Here is today's activity summary</p>
          </div>

          <!-- Stats Grid -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Vehicles</h3>
                  <p class="mt-2 text-3xl font-bold text-primary">150</p>
                </div>
                <div class="p-3 rounded-full bg-blue-50">
                  <i class="fas fa-car text-primary text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+5 from last month</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Employees</h3>
                  <p class="mt-2 text-3xl font-bold text-green-600">75</p>
                </div>
                <div class="p-3 rounded-full bg-green-50">
                  <i class="fas fa-users text-green-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+3 this week</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Visitor & Vendor</h3>
                  <p class="mt-2 text-3xl font-bold text-orange-600">20</p>
                </div>
                <div class="p-3 rounded-full bg-orange-50">
                  <i class="fas fa-users text-orange-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+2 today</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Safety Induction</h3>
                  <p class="mt-2 text-3xl font-bold text-yellow-600">12</p>
                </div>
                <div class="p-3 rounded-full bg-yellow-50">
                  <i class="fas fa-clipboard-check text-yellow-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">Updated</p>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <a href="{{route('permit-data')}}" class="flex flex-col items-center justify-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition">
                <i class="fas fa-users text-orange-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Visitor & Vendor</span>
              </a>
              <a href="{{route('vehicle-list')}}" class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                <i class="fas fa-car text-primary text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Vehicle List</span>
              </a>
              <a href="{{route('employee-data')}}" class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                <i class="fas fa-users text-green-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Employee List</span>
              </a>
              <a href="{{route('employee-safety-list')}}" class="flex flex-col items-center justify-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                <i class="fas fa-clipboard-check text-yellow-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Safety Induction List</span>
              </a>
              <a href="{{route('reports')}}" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                <i class="fas fa-chart-bar text-gray-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Report</span>
              </a>
            </div>
          </div>

          <!-- Active Tasks -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-medium text-gray-900">Active Tasks</h2>
              <a href="tasks.html" class="text-sm text-primary hover:text-blue-700">View All</a>
            </div>
            <div class="space-y-4">
              <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg">
                <div class="flex items-center">
                  <i class="fas fa-users text-orange-600 text-xl mr-3"></i>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Permit Verification</p>
                    <p class="text-xs text-gray-500">Check and verify visitor & vendor permits</p>
                  </div>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">Today</span>
              </div>
              <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                <div class="flex items-center">
                  <i class="fas fa-car text-blue-600 text-xl mr-3"></i>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Vehicle Inspection</p>
                    <p class="text-xs text-gray-500">Inspect vehicles for compliance</p>
                  </div>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Ongoing</span>
              </div>
              <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                <div class="flex items-center">
                  <i class="fas fa-users text-green-600 text-xl mr-3"></i>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Employee Safety Check</p>
                    <p class="text-xs text-gray-500">Review employee safety status</p>
                  </div>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Weekly</span>
              </div>
              <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                <div class="flex items-center">
                  <i class="fas fa-clipboard-check text-yellow-600 text-xl mr-3"></i>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Safety Induction Review</p>
                    <p class="text-xs text-gray-500">Update and review safety induction records</p>
                  </div>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Monthly</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activities -->
        <div class="lg:col-span-1">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Recent Activities</h2>
            <div class="space-y-4">
              <div class="flex items-start space-x-4">
                <div class="p-2 rounded-full bg-blue-100">
                  <i class="fas fa-car text-blue-600"></i>
                </div>
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">New vehicle entry</p>
                  <p class="text-sm font-medium text-gray-900">Kendaraan baru masuk</p>
                  <p class="text-sm text-gray-500">Toyota Avanza (B 1234 ABC)</p>
                  <p class="text-xs text-gray-400 mt-1">5 menit yang lalu</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <div class="p-2 rounded-full bg-yellow-100">
                  <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                </div>
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">STNK akan expired</p>
                  <p class="text-sm text-gray-500">Honda Brio (B 5678 DEF)</p>
                  <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <div class="p-2 rounded-full bg-green-100">
                  <i class="fas fa-user-check text-green-600"></i>
                </div>
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Karyawan baru terdaftar</p>
                  <p class="text-sm text-gray-500">John Doe</p>
                  <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Notifications Panel -->


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
        const button = event.target.closest('button');

        if (!panel.contains(event.target) && !button) {
          panel.classList.add('hidden');
        }
      });

      // Close user menu when clicking outside
      document.addEventListener('click', function(event) {
        const menu = document.getElementById('userMenu');
        const button = event.target.closest('button');

        if (!menu.contains(event.target) && !button) {
          menu.classList.add('hidden');
        }
      });
    </script>
  </body>
</html>

@endsection
