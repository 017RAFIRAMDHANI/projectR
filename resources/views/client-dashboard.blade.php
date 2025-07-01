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
            <h1 class="text-2xl font-bold mb-2">Welcome, {{Auth::user()->name ?? ''}}</h1>
            <p class="text-white/80">Here is today's activity summary</p>
          </div>

          <!-- Stats Grid -->
             <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Employees</h3>
                  <p class="mt-2 text-3xl font-bold text-primary">{{$jmlEmploye ?? ''}}</p>
                </div>
                <div class="p-3 rounded-full bg-blue-50">
                  <i class="fas fa-users text-primary text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+{{$jmlEmployeT}} for today</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Vehicles</h3>
                  <p class="mt-2 text-3xl font-bold text-green-600">{{$jmlVehicle ?? ''}}</p>
                </div>
                <div class="p-3 rounded-full bg-green-50">
                  <i class="fas fa-car text-green-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+{{$jmlVehicleT}} for today</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Active Permits Today</h3>
                  <p class="mt-2 text-3xl font-bold text-yellow-600">{{$dataAktifPermit ?? ''}}</p>
                </div>
                <div class="p-3 rounded-full bg-yellow-50">
                  <i class="fas fa-clipboard-list text-yellow-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+{{$dataAktifPermitT}} for today</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Expiring Safety Induction (30 Days)</h3>
                  <p class="mt-2 text-3xl font-bold text-red-600">{{$safetiCount ?? ''}}</p>
                </div>
                <div class="p-3 rounded-full bg-red-50">
                  <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
              </div>
              <div class="mt-1 flex justify-between items-center">
                <p class="text-xs text-gray-500">expired in 30 days</p>
                <a href="analytics.html" class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-medium text-red-600 hover:text-red-700 transition-colors hidden">
                  <i class="fas fa-chart-line mr-0.5 text-[10px]"></i>
                  Check
                </a>
              </div>
            </div>
          </div>


          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
           @if (Auth::user()->access_visvin_view == 1)
                      <button
                onclick="window.location.href='{{route('permit-data')}}'"
                class="flex flex-col items-center justify-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition"
              >
                <i class="fas fa-users text-orange-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Visitor & Vendor</span>
              </button>
@endif
   @if (Auth::user()->access_vehicle_view == 1)
              <button
                onclick="window.location.href='{{route('vehicle-list')}}'"
                class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition"
              >
                <i class="fas fa-car text-purple-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Vehicle Data</span>
              </button>
              @endif
                 @if (Auth::user()->access_report_view == 1)
              <button
                onclick="window.location.href='{{route('employee-data')}}'"
                class="flex flex-col items-center justify-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition"
              >
                <i class="fas fa-users text-yellow-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Employee Data</span>
              </button>
              @endif
                 @if (Auth::user()->access_safety_view == 1)
              <button
                onclick="window.location.href='{{route('employee-safety-list')}}'"
                class="flex flex-col items-center justify-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition"
              >
                <i class="fas fa-clipboard-check text-red-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Safety Induction</span>
              </button>
              @endif
                 @if (Auth::user()->access_report_view == 1)
              <button
                onclick="window.location.href='{{route('reports')}}'"
                class="flex flex-col items-center justify-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition"
              >
                <i class="fas fa-chart-bar text-indigo-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Reports</span>
              </button>
              @endif
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
          <div class="space-y-4" id="recentActivitiesContainer">
        <!-- Data akan diisi oleh JavaScript -->
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




<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menyisipkan data histori dari Blade ke JavaScript
        const dataAktifitas = @json($dataAktifitas);

        // Menampilkan data histori ke dalam container
        const container = document.getElementById('recentActivitiesContainer');
        container.innerHTML = '';  // Bersihkan isi sebelumnya

        dataAktifitas.forEach(item => {
            // Tentukan ikon dan warna berdasarkan item.type
            let iconClass = '';
            let bgColor = '';
            let textColor = '';
            switch(item.type) {
               case 'Vendor':
                    iconClass = 'fas fa-user';
                    iconColor = 'bg-blue-100';
                    textColor = 'text-blue-600';
                    break;
                case 'Visitor':
                    iconClass = 'fas fa-user';
                    iconColor = 'bg-green-100';
                       textColor = 'text-green-600';
                    break;
                case 'Vehicle':
                    iconClass = 'fas fa-car';
                    iconColor = 'bg-purple-100';
                       textColor = 'text-purple-600';
                    break;
                case 'Employee':
                    iconClass = 'fas fa-users';
                    iconColor = 'bg-yellow-50';
                       textColor = 'text-yellow-600';
                    break;
                case 'Employee Safety':
                    iconClass = 'fas fa-clipboard-check';
                    iconColor = 'bg-red-50';
                       textColor = 'text-red-600';
                    break;
                case 'Employee Safety Freedoms':
                      iconClass = 'fas fa-clipboard-check';
                    iconColor = 'bg-red-50';
                       textColor = 'text-red-600';
                    break;
                default:
                    iconClass = 'fas fa-exclamation-circle';
                    bgColor = 'bg-red-100';
                    textColor = 'text-red-600';
            }

            // Membuat elemen baru untuk menampilkan aktivitas
            const itemElement = document.createElement('div');
            itemElement.classList.add('flex', 'items-start', 'space-x-3');

            itemElement.innerHTML = `
                <div class="p-2 rounded-full ${bgColor}">
                    <i class="${iconClass} ${textColor}"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">${item.judul}</p>
                    <p class="text-xs text-gray-500">${item.text}</p>
                    <p class="text-xs text-gray-400 mt-1">${new Date(item.created_at).toLocaleString()}</p>  <!-- Waktu diformat dengan JavaScript -->
                </div>
            `;

            container.appendChild(itemElement);
        });
    });
</script>
  </body>
</html>

@endsection
