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
    <!-- Navbar -->


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
                  <h3 class="text-gray-500 text-sm font-medium">Today's Visitors</h3>
                  <p class="mt-2 text-3xl font-bold text-yellow-600">25</p>
                </div>
                <div class="p-3 rounded-full bg-yellow-50">
                  <i class="fas fa-user-clock text-yellow-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+8 from yesterday</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Safety Induction Completed</h3>
                  <p class="mt-2 text-3xl font-bold text-red-600">120</p>
                </div>
                <div class="p-3 rounded-full bg-red-50">
                  <i class="fas fa-clipboard-check text-red-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+3 this week</p>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <button
                onclick="window.location.href='{{route('permit-data')}}'"
                class="flex flex-col items-center justify-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition"
              >
                <i class="fas fa-users text-orange-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Visitor & Vendor</span>
              </button>
              <button
                onclick="window.location.href='{{route('vehicle-list')}}'"
                class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition"
              >
                <i class="fas fa-car text-purple-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Vehicle Data</span>
              </button>
              <button
                onclick="window.location.href='{{route('employee-data')}}'"
                class="flex flex-col items-center justify-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition"
              >
                <i class="fas fa-users text-yellow-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Employee Data</span>
              </button>
              <button
                onclick="window.location.href='{{route('employee-safety-list-fm')}}'"
                class="flex flex-col items-center justify-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition"
              >
                <i class="fas fa-clipboard-check text-red-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Safety Induction</span>
              </button>
              <button
                onclick="window.location.href='reports.html'"
                class="flex flex-col items-center justify-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition"
              >
                <i class="fas fa-chart-bar text-indigo-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Reports</span>
              </button>
            </div>
          </div>

          <!-- Recent Activities -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-semibold text-gray-900">Recent Activities</h2>
              <a href="#" class="text-sm text-primary btn-hover px-2 py-1 rounded">View All</a>
            </div>
            <div class="space-y-4">
              <div class="flex items-start space-x-4 p-3 rounded-lg btn-hover">
                <div class="p-2 rounded-full bg-blue-50">
                  <i class="fas fa-user-plus text-primary"></i>
                </div>
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">New visitor registered</p>
                  <p class="text-sm text-gray-500">John Doe from PT ABC</p>
                  <p class="text-xs text-gray-400 mt-1">5 minutes ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4 p-3 rounded-lg btn-hover">
                <div class="p-2 rounded-full bg-yellow-50">
                  <i class="fas fa-clipboard-check text-yellow-600"></i>
                </div>
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">New vendor approved</p>
                  <p class="text-sm text-gray-500">PT XYZ</p>
                  <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4 p-3 rounded-lg btn-hover">
                <div class="p-2 rounded-full bg-green-50">
                  <i class="fas fa-car text-green-600"></i>
                </div>
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">New vehicle registered</p>
                  <p class="text-sm text-gray-500">Toyota Avanza (B 1234 ABC)</p>
                  <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-8">
          <!-- User Management -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">User Management</h2>
            <div class="space-y-3">
              <a href="" class="flex items-center p-3 bg-gray-50 rounded-lg menu-item">
                <i class="fas fa-user-plus text-primary text-xl mr-3"></i>
                <span>Add User</span>
              </a>
              <a href="#" class="flex items-center p-3 bg-gray-50 rounded-lg menu-item">
                <i class="fas fa-users-cog text-primary text-xl mr-3"></i>
                <span>User List</span>
              </a>
              <a href="#" class="flex items-center p-3 bg-gray-50 rounded-lg menu-item">
                <i class="fas fa-user-shield text-primary text-xl mr-3"></i>
                <span>Role Management</span>
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
      </div>
    </main>

    <!-- Notifications Panel -->
    <div
      id="notificationsPanel"
      class="hidden fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg border border-gray-200"
    >
      <div class="p-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Notifikasi</h3>
        <button onclick="toggleNotifications()" class="text-gray-400 btn-hover p-1 rounded">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
        <div class="p-4 btn-hover">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-red-50">
              <i class="fas fa-exclamation-circle text-red-500"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Pending Approval</p>
              <p class="text-sm text-gray-500">8 approval menunggu persetujuan</p>
              <p class="text-xs text-gray-400 mt-1">Baru saja</p>
            </div>
          </div>
        </div>
        <div class="p-4 btn-hover">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-yellow-50">
              <i class="fas fa-user-clock text-yellow-500"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Visitor Hari Ini</p>
              <p class="text-sm text-gray-500">25 visitor terdaftar hari ini</p>
              <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
            </div>
          </div>
        </div>
        <div class="p-4 btn-hover">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-blue-50">
              <i class="fas fa-users text-blue-500"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Karyawan Baru</p>
              <p class="text-sm text-gray-500">3 karyawan baru terdaftar minggu ini</p>
              <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
            </div>
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
