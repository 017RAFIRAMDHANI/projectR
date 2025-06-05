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
    <script src="main.js" defer></script>
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

      // Function to handle permit approval
      function approvePermit(permitId, type) {
        // In a real application, this would send a request to the server
        alert(`Permit ${permitId} (${type}) has been approved.`);
        // Update UI to reflect the change
        document.getElementById(`permit-${permitId}`).classList.add('hidden');
        updatePermitCounts();
      }

      // Function to handle permit rejection
      function rejectPermit(permitId, type) {
        // In a real application, this would send a request to the server
        alert(`Permit ${permitId} (${type}) has been rejected.`);
        // Update UI to reflect the change
        document.getElementById(`permit-${permitId}`).classList.add('hidden');
        updatePermitCounts();
      }

      // Function to update permit counts
      function updatePermitCounts() {
        const visitorCount = document.querySelectorAll('.visitor-permit:not(.hidden)').length;
        const vendorCount = document.querySelectorAll('.vendor-permit:not(.hidden)').length;

        document.getElementById('visitorPermitCount').textContent = visitorCount;
        document.getElementById('vendorPermitCount').textContent = vendorCount;
        document.getElementById('totalPermitCount').textContent = visitorCount + vendorCount;
      }

      // Function to view permit details
      function viewPermitDetails(permitNumber) {
        // Redirect to the permit details page
        window.location.href = `permit-details.html?permitNumber=${permitNumber}`;
      }

      // Function to close the permit details modal
      function closePermitDetailsModal() {
        document.getElementById('permitDetailsModal').classList.add('hidden');
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

      // Close modal when clicking outside
      document.addEventListener('click', function(event) {
        const modal = document.getElementById('permitDetailsModal');
        const modalContent = document.getElementById('modalContent');

        if (modalContent && !modalContent.contains(event.target) && !modal.classList.contains('hidden')) {
          modal.classList.add('hidden');
        }
      });
    </script>
    <style>
      .welcome-banner {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
      }
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
          <div class="welcome-banner rounded-lg shadow-sm p-6 text-white">
            <h1 class="text-2xl font-bold mb-2">Selamat Datang, Admin!</h1>
            <p class="text-white/80">Berikut adalah ringkasan aktivitas hari ini</p>
          </div>

          <!-- Stats Grid -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Karyawan</h3>
                  <p class="mt-2 text-3xl font-bold text-primary">120</p>
                </div>
                <div class="p-3 rounded-full bg-blue-50">
                  <i class="fas fa-users text-primary text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+3 dari bulan lalu</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Kendaraan</h3>
                  <p class="mt-2 text-3xl font-bold text-green-600">45</p>
                </div>
                <div class="p-3 rounded-full bg-green-50">
                  <i class="fas fa-car text-green-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+1 minggu ini</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Visitor Hari Ini</h3>
                  <p class="mt-2 text-3xl font-bold text-yellow-600">15</p>
                </div>
                <div class="p-3 rounded-full bg-yellow-50">
                  <i class="fas fa-user-clock text-yellow-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+5 dari kemarin</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Pending Approval</h3>
                  <p class="mt-2 text-3xl font-bold text-red-600">5</p>
                </div>
                <div class="p-3 rounded-full bg-red-50">
                  <i class="fas fa-tasks text-red-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">2 memerlukan perhatian</p>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <button
                onclick="window.location.href='maintenance.html'"
                class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition"
              >
                <i class="fas fa-tools text-primary text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Maintenance</span>
              </button>
              <button
                onclick="window.location.href='approvals.html'"
                class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition"
              >
                <i class="fas fa-check-circle text-green-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Approvals</span>
              </button>
              <button
                onclick="window.location.href='inventory.html'"
                class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition"
              >
                <i class="fas fa-boxes text-purple-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Inventory</span>
              </button>
              <button
                onclick="window.location.href='reports.html'"
                class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition"
              >
                <i class="fas fa-chart-bar text-gray-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Reports</span>
              </button>
            </div>
          </div>

          <!-- Permit Requests Section -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
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
                <div id="permit-V001" class="visitor-permit flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                  <div>
                    <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0001</p>
                    <p class="text-xs text-gray-500">Visitor: John Smith</p>
                    <p class="text-xs text-gray-500">Purpose: Client Meeting</p>
                    <p class="text-xs text-gray-500">Date: Today, 2:00 PM - 4:00 PM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('V001')" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-medium hover:bg-blue-200">
                      View Details
                    </button>
                    <button onclick="approvePermit('V001', 'visitor')" class="px-3 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium hover:bg-green-200">
                      Approve
                    </button>
                    <button onclick="rejectPermit('V001', 'visitor')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200">
                      Reject
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
                    <button onclick="approvePermit('V002', 'visitor')" class="px-3 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium hover:bg-green-200">
                      Approve
                    </button>
                    <button onclick="rejectPermit('V002', 'visitor')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200">
                      Reject
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
                <div id="permit-VD001" class="vendor-permit flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500">
                  <div>
                    <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0003</p>
                    <p class="text-xs text-gray-500">Vendor: PT. ABC Services</p>
                    <p class="text-xs text-gray-500">Purpose: Equipment Maintenance</p>
                    <p class="text-xs text-gray-500">Date: Today, 1:00 PM - 5:00 PM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('VD001')" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-medium hover:bg-blue-200">
                      View Details
                    </button>
                    <button onclick="approvePermit('VD001', 'vendor')" class="px-3 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium hover:bg-green-200">
                      Approve
                    </button>
                    <button onclick="rejectPermit('VD001', 'vendor')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200">
                      Reject
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
                    <button onclick="approvePermit('VD002', 'vendor')" class="px-3 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium hover:bg-green-200">
                      Approve
                    </button>
                    <button onclick="rejectPermit('VD002', 'vendor')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200">
                      Reject
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-8">
          <!-- Maintenance Schedule -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Maintenance Schedule</h2>
            <div class="space-y-4">
              <div class="flex items-start space-x-3">
                <div class="p-2 rounded-full bg-yellow-100">
                  <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-900">AC Maintenance</p>
                  <p class="text-xs text-gray-500">Due in 2 days</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="p-2 rounded-full bg-red-100">
                  <i class="fas fa-exclamation-circle text-red-600"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-900">Fire Alarm System</p>
                  <p class="text-xs text-gray-500">Due today</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Activities -->
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

          <!-- Quick Links -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Menu Tambahan</h2>
            <div class="space-y-3">
              <a href="daily-report.html" class="flex items-center p-3 bg-gray-50 rounded-lg menu-item">
                <i class="fas fa-clipboard-list text-primary text-xl mr-3"></i>
                <span>Laporan Harian</span>
              </a>
              <a href="#" class="flex items-center p-3 bg-gray-50 rounded-lg menu-item">
                <i class="fas fa-chart-bar text-primary text-xl mr-3"></i>
                <span>Laporan Statistik</span>
              </a>
              <a href="#" class="flex items-center p-3 bg-gray-50 rounded-lg menu-item">
                <i class="fas fa-cog text-primary text-xl mr-3"></i>
                <span>Pengaturan</span>
              </a>
            </div>
          </div>

          <!-- Quick Tips -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Tips</h2>
            <div class="space-y-3">
              <div class="flex items-start space-x-3">
                <i class="fas fa-lightbulb text-yellow-500 mt-1"></i>
                <p class="text-sm text-gray-600">Gunakan Quick Actions untuk akses cepat ke fitur yang sering digunakan</p>
              </div>
              <div class="flex items-start space-x-3">
                <i class="fas fa-bell text-primary mt-1"></i>
                <p class="text-sm text-gray-600">Periksa notifikasi untuk update terbaru</p>
              </div>
              <div class="flex items-start space-x-3">
                <i class="fas fa-chart-line text-green-500 mt-1"></i>
                <p class="text-sm text-gray-600">Lihat statistik untuk monitoring aktivitas</p>
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
              <p class="text-sm font-medium text-gray-900">Maintenance Alert</p>
              <p class="text-sm text-gray-500">Fire alarm system maintenance due today</p>
              <p class="text-xs text-gray-400 mt-1">5 minutes ago</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-yellow-100">
              <i class="fas fa-user-clock text-yellow-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">New Permit Request</p>
              <p class="text-sm text-gray-500">Visitor permit from John Smith</p>
              <p class="text-xs text-gray-400 mt-1">15 minutes ago</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-green-100">
              <i class="fas fa-check-circle text-green-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Task Completed</p>
              <p class="text-sm text-gray-500">Generator maintenance completed</p>
              <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-blue-100">
              <i class="fas fa-truck text-blue-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Vendor Delivery</p>
              <p class="text-sm text-gray-500">Office supplies delivery scheduled</p>
              <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Permit Details Modal -->
    <div id="permitDetailsModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
      <div id="modalContent" class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4">
        <div class="p-6">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Permit Details</h3>
            <button onclick="closePermitDetailsModal()" class="text-gray-400 btn-hover">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="space-y-4">
            <div>
              <h4 class="text-sm font-medium text-gray-500">Permit Number</h4>
              <p class="mt-1 text-sm text-gray-900">DHI/PERMIT/2024/04/0001</p>
            </div>
            <div>
              <h4 class="text-sm font-medium text-gray-500">Visitor Information</h4>
              <p class="mt-1 text-sm text-gray-900">John Smith</p>
              <p class="text-sm text-gray-500">john.smith@example.com</p>
              <p class="text-sm text-gray-500">+1 234 567 8900</p>
            </div>
            <div>
              <h4 class="text-sm font-medium text-gray-500">Visit Details</h4>
              <p class="mt-1 text-sm text-gray-900">Client Meeting</p>
              <p class="text-sm text-gray-500">Date: Today, 2:00 PM - 4:00 PM</p>
              <p class="text-sm text-gray-500">Location: Conference Room A</p>
            </div>
            <div>
              <h4 class="text-sm font-medium text-gray-500">Additional Notes</h4>
              <p class="mt-1 text-sm text-gray-900">Meeting with the marketing team to discuss the new campaign.</p>
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-3">
            <button onclick="closePermitDetailsModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium btn-hover">
              Close
            </button>
            <button onclick="approvePermit('V001', 'visitor')" class="px-4 py-2 bg-green-600 text-white rounded-md text-sm font-medium btn-hover">
              Approve
            </button>
            <button onclick="rejectPermit('V001', 'visitor')" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-medium btn-hover">
              Reject
            </button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

@endsection
