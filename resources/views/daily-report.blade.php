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
  </head>
  <body class="bg-gray-50">
    <!-- Navbar -->
   

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Back Button -->
      <div class="mb-6">
        <a href="client-dashboard.html" class="inline-flex items-center text-gray-600 hover:text-gray-900">
          <i class="fas fa-arrow-left mr-2"></i>
          Kembali ke Dashboard
        </a>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6">

        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-semibold text-gray-900">Laporan Harian</h1>
          <button onclick="addNewReport()" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Tambah Laporan
          </button>
        </div>

        <!-- Filter -->
        <div class="mb-6 flex flex-wrap gap-4">
          <div class="flex-1 min-w-[200px]">
            <input
              type="date"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
          <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="">Semua Shift</option>
            <option value="pagi">Shift Pagi</option>
            <option value="siang">Shift Siang</option>
            <option value="malam">Shift Malam</option>
          </select>
          <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="">Status Laporan</option>
            <option value="draft">Draft</option>
            <option value="submitted">Submitted</option>
            <option value="approved">Approved</option>
          </select>
        </div>

        <!-- Report List -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendaraan Masuk</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendaraan Keluar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Karyawan Masuk</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Karyawan Keluar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Sample Report Row -->
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">01/03/2024</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Shift Pagi</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">25</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">20</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">45</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">40</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Approved</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <button class="text-primary hover:text-blue-700 mr-3" title="Edit">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="text-yellow-600 hover:text-yellow-700 mr-3" title="Lihat Detail">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="text-red-600 hover:text-red-700" title="Hapus">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex items-center justify-between">
          <div class="text-sm text-gray-700">
            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">20</span> data
          </div>
          <div class="flex gap-2">
            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Sebelumnya</button>
            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Selanjutnya</button>
          </div>
        </div>
      </div>
    </main>

    <!-- Add/Edit Report Modal -->
    <div id="reportModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Tambah Laporan Harian</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <form id="reportForm" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Shift</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option value="">Pilih Shift</option>
                  <option value="pagi">Shift Pagi</option>
                  <option value="siang">Shift Siang</option>
                  <option value="malam">Shift Malam</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Kendaraan Masuk</label>
                <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Kendaraan Keluar</label>
                <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Karyawan Masuk</label>
                <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Karyawan Keluar</label>
                <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Catatan</label>
              <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" rows="3" placeholder="Tambahkan catatan..."></textarea>
            </div>

            <div class="flex justify-end gap-3">
              <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                Batal
              </button>
              <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Detail Report Modal -->
    <div id="detailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Detail Laporan</h3>
            <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <p class="mt-1 text-sm text-gray-900" id="detailDate">01/03/2024</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Shift</label>
                <p class="mt-1 text-sm text-gray-900" id="detailShift">Shift Pagi</p>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Kendaraan Masuk</label>
                <p class="mt-1 text-sm text-gray-900" id="detailVehiclesIn">25</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Kendaraan Keluar</label>
                <p class="mt-1 text-sm text-gray-900" id="detailVehiclesOut">20</p>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Karyawan Masuk</label>
                <p class="mt-1 text-sm text-gray-900" id="detailEmployeesIn">45</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Karyawan Keluar</label>
                <p class="mt-1 text-sm text-gray-900" id="detailEmployeesOut">40</p>
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Catatan</label>
              <p class="mt-1 text-sm text-gray-900" id="detailNotes">Semua berjalan dengan baik, tidak ada kejadian yang perlu dilaporkan.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      function addNewReport() {
        document.getElementById('reportModal').classList.remove('hidden');
      }

      function closeModal() {
        document.getElementById('reportModal').classList.add('hidden');
      }

      function viewReportDetails(reportId) {
        // Di sini Anda bisa menambahkan logika untuk mengambil data laporan dari server
        const reportData = {
          date: '01/03/2024',
          shift: 'Shift Pagi',
          vehiclesIn: '25',
          vehiclesOut: '20',
          employeesIn: '45',
          employeesOut: '40',
          notes: 'Semua berjalan dengan baik, tidak ada kejadian yang perlu dilaporkan.'
        };

        // Mengisi data ke modal detail
        document.getElementById('detailDate').textContent = reportData.date;
        document.getElementById('detailShift').textContent = reportData.shift;
        document.getElementById('detailVehiclesIn').textContent = reportData.vehiclesIn;
        document.getElementById('detailVehiclesOut').textContent = reportData.vehiclesOut;
        document.getElementById('detailEmployeesIn').textContent = reportData.employeesIn;
        document.getElementById('detailEmployeesOut').textContent = reportData.employeesOut;
        document.getElementById('detailNotes').textContent = reportData.notes;

        // Menampilkan modal
        document.getElementById('detailModal').classList.remove('hidden');
      }

      function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
      }

      // Event listener untuk form
      document.getElementById('reportForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Di sini Anda bisa menambahkan logika untuk menyimpan data ke server
        alert('Laporan berhasil disimpan!');
        closeModal();
      });

      // Update tombol aksi di tabel
      document.querySelectorAll('tr').forEach(row => {
        const editBtn = row.querySelector('button[title="Edit"]');
        const viewBtn = row.querySelector('button[title="Lihat Detail"]');

        if (editBtn) {
          editBtn.onclick = () => editReport(row.cells[0].textContent);
        }
        if (viewBtn) {
          viewBtn.onclick = () => viewReportDetails(row.cells[0].textContent);
        }
      });

      // Close modals when clicking outside
      document.addEventListener('click', function(event) {
        const reportModal = document.getElementById('reportModal');
        const detailModal = document.getElementById('detailModal');

        if (event.target === reportModal) {
          closeModal();
        }
        if (event.target === detailModal) {
          closeDetailModal();
        }
      });

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
    </script>
  </body>
</html>

@endsection
