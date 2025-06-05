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


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Stats and Quick Actions Section -->
        <div class="lg:col-span-2 space-y-8">
          <!-- Welcome Message -->
          <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-sm p-6 text-white">
            <h1 class="text-2xl font-bold mb-2">Selamat Datang, Satpam!</h1>
            <p class="text-white/80">Berikut adalah ringkasan aktivitas hari ini</p>
          </div>

          <!-- Stats Grid -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Kendaraan</h3>
                  <p class="mt-2 text-3xl font-bold text-primary">150</p>
                </div>
                <div class="p-3 rounded-full bg-blue-50">
                  <i class="fas fa-car text-primary text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+5 dari bulan lalu</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Karyawan</h3>
                  <p class="mt-2 text-3xl font-bold text-green-600">75</p>
                </div>
                <div class="p-3 rounded-full bg-green-50">
                  <i class="fas fa-users text-green-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+3 minggu ini</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Kendaraan Masuk</h3>
                  <p class="mt-2 text-3xl font-bold text-yellow-600">25</p>
                </div>
                <div class="p-3 rounded-full bg-yellow-50">
                  <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">Hari ini</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">STNK Expired</h3>
                  <p class="mt-2 text-3xl font-bold text-red-600">5</p>
                </div>
                <div class="p-3 rounded-full bg-red-50">
                  <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">Perlu perhatian</p>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <a href="vehicle-list.html" class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                <i class="fas fa-car text-primary text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Daftar Kendaraan</span>
              </a>
              <a href="employee-safety-list.html" class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                <i class="fas fa-users text-green-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Daftar Karyawan</span>
              </a>
              <a href="daily-report.html" class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                <i class="fas fa-clipboard-list text-purple-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Laporan Harian</span>
              </a>
              <a href="#" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                <i class="fas fa-cog text-gray-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Pengaturan</span>
              </a>
            </div>
          </div>

          <!-- Active Tasks -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-medium text-gray-900">Tugas Aktif</h2>
              <a href="tasks.html" class="text-sm text-primary hover:text-blue-700">Lihat Semua</a>
            </div>
            <div class="space-y-4">
              <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                  <p class="text-sm font-medium text-gray-900">Pemeriksaan Kendaraan</p>
                  <p class="text-xs text-gray-500">Jadwal: Hari ini, 14:00</p>
                  <p class="text-xs text-gray-500">Prioritas: Tinggi</p>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Urgent</span>
              </div>
              <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                  <p class="text-sm font-medium text-gray-900">Verifikasi STNK</p>
                  <p class="text-xs text-gray-500">Jadwal: Besok, 10:00</p>
                  <p class="text-xs text-gray-500">Prioritas: Sedang</p>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activities -->
        <div class="lg:col-span-1">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Aktivitas Terbaru</h2>
            <div class="space-y-4">
              <div class="flex items-start space-x-4">
                <div class="p-2 rounded-full bg-blue-100">
                  <i class="fas fa-car text-blue-600"></i>
                </div>
                <div class="flex-1">
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
    <div
      id="notificationsPanel"
      class="hidden fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg border border-gray-200"
    >
      <div class="p-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Notifikasi</h3>
        <button onclick="toggleNotifications()" class="text-gray-400 btn-hover">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-red-100">
              <i class="fas fa-exclamation-circle text-red-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">STNK Expired</p>
              <p class="text-sm text-gray-500">5 kendaraan memiliki STNK yang akan expired dalam 30 hari</p>
              <p class="text-xs text-gray-400 mt-1">5 menit yang lalu</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-yellow-100">
              <i class="fas fa-car text-yellow-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Kendaraan Masuk</p>
              <p class="text-sm text-gray-500">25 kendaraan masuk hari ini</p>
              <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-green-100">
              <i class="fas fa-users text-green-600"></i>
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
