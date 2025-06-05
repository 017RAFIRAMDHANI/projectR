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
      .action-btn {
        transition: all 0.2s ease;
      }
      .action-btn:hover {
        transform: scale(1.1);
      }
      .pagination-btn {
        transition: all 0.2s ease;
      }
      .pagination-btn:hover {
        background-color: rgba(0, 0, 0, 0.05);
      }
      .pagination-btn:active {
        background-color: rgba(0, 0, 0, 0.1);
      }
    </style>
  </head>
  <body class="bg-gray-50">


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
              <p class="text-sm font-medium text-gray-900">STNK Akan Expired</p>
              <p class="text-sm text-gray-500">Kendaraan dengan plat B 1234 ABC</p>
              <p class="text-xs text-gray-400 mt-1">5 menit yang lalu</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-yellow-100">
              <i class="fas fa-tools text-yellow-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Maintenance Diperlukan</p>
              <p class="text-sm text-gray-500">Kendaraan dengan plat B 5678 DEF</p>
              <p class="text-xs text-gray-400 mt-1">15 menit yang lalu</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-green-100">
              <i class="fas fa-check-circle text-green-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Kendaraan Baru Ditambahkan</p>
              <p class="text-sm text-gray-500">Kendaraan dengan plat B 9012 GHI</p>
              <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
            </div>
          </div>
        </div>
      </div>
    </div>

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
        <!-- Back Button and Page Title -->
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-semibold text-gray-900">Daftar Kendaraan</h1>
          <button onclick="addNewVehicle()" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Tambah Kendaraan
          </button>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 flex flex-wrap gap-4">
          <div class="flex-1 min-w-[200px]">
            <input
              type="text"
              placeholder="Cari kendaraan..."
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
          <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="">Semua Tipe</option>
            <option value="mobil">Mobil</option>
            <option value="motor">Motor</option>
            <option value="truck">Truck</option>
          </select>
          <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="">Status Kendaraan</option>
            <option value="active">Aktif</option>
            <option value="maintenance">Maintenance</option>
            <option value="inactive">Tidak Aktif</option>
          </select>
        </div>

        <!-- Vehicle List Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Polisi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merk</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STNK Expired</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Sample Vehicle Row -->
              <tr class="table-row-hover">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">B 1234 ABC</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Mobil</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Toyota</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Avanza</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2020</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <input type="date" class="text-sm border border-gray-300 rounded-md px-2 py-1" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Aktif</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <textarea class="text-sm border border-gray-300 rounded-md px-2 py-1" rows="1" placeholder="Tambah catatan..."></textarea>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <button class="text-primary hover:text-blue-700 mr-3 action-btn" title="Edit">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="text-yellow-600 hover:text-yellow-700 mr-3 action-btn" title="Lihat Detail">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="text-red-600 hover:text-red-700 action-btn" title="Hapus">
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
              Sebelumnya
            </button>
            <button class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
              Selanjutnya
            </button>
          </div>
          <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">20</span> data
              </p>
            </div>
            <div>
              <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <button class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 pagination-btn">
                  <span class="sr-only">Sebelumnya</span>
                  <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button aria-current="page" class="relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary pagination-btn">
                  1
                </button>
                <button class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 pagination-btn">
                  2
                </button>
                <button class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 pagination-btn">
                  <span class="sr-only">Selanjutnya</span>
                  <i class="fas fa-chevron-right text-sm"></i>
                </button>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Add/Edit Vehicle Modal -->
    <div id="vehicleModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Tambah Kendaraan Baru</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <form id="vehicleForm" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">No. Polisi</label>
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tipe Kendaraan</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option value="">Pilih Tipe</option>
                  <option value="mobil">Mobil</option>
                  <option value="motor">Motor</option>
                  <option value="truck">Truck</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Merk</label>
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Model</label>
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">STNK Expired</label>
                <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
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

    <!-- Detail Vehicle Modal -->
    <div id="detailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Detail Kendaraan</h3>
            <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">No. Polisi</label>
                <p class="mt-1 text-sm text-gray-900" id="detailPlate">B 1234 ABC</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tipe Kendaraan</label>
                <p class="mt-1 text-sm text-gray-900" id="detailType">Mobil</p>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Merk</label>
                <p class="mt-1 text-sm text-gray-900" id="detailBrand">Toyota</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Model</label>
                <p class="mt-1 text-sm text-gray-900" id="detailModel">Avanza</p>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                <p class="mt-1 text-sm text-gray-900" id="detailYear">2020</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">STNK Expired</label>
                <p class="mt-1 text-sm text-gray-900" id="detailStnkExpired">31/12/2024</p>
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Catatan</label>
              <p class="mt-1 text-sm text-gray-900" id="detailNotes">Kendaraan dalam kondisi baik</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Vehicle Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Edit Kendaraan</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <form id="editForm" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">No. Polisi</label>
                <input type="text" id="editPlate" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required readonly />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tipe Kendaraan</label>
                <select id="editType" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option value="">Pilih Tipe</option>
                  <option value="mobil">Mobil</option>
                  <option value="motor">Motor</option>
                  <option value="truck">Truck</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Merk</label>
                <input type="text" id="editBrand" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Model</label>
                <input type="text" id="editModel" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                <input type="number" id="editYear" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">STNK Expired</label>
                <input type="date" id="editStnkExpired" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Catatan</label>
              <textarea id="editNotes" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" rows="3" placeholder="Tambahkan catatan..."></textarea>
            </div>

            <div class="flex justify-end gap-3">
              <button type="button" onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                Batal
              </button>
              <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700">
                Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      function addNewVehicle() {
        document.getElementById('vehicleModal').classList.remove('hidden');
      }

      function closeModal() {
        document.getElementById('vehicleModal').classList.add('hidden');
      }

      function viewVehicleDetails(plateNumber) {
        // Di sini Anda bisa menambahkan logika untuk mengambil data kendaraan dari server
        const vehicleData = {
          plate: 'B 1234 ABC',
          type: 'Mobil',
          brand: 'Toyota',
          model: 'Avanza',
          year: '2020',
          stnkExpired: '31/12/2024',
          notes: 'Kendaraan dalam kondisi baik'
        };

        // Mengisi data ke modal detail
        document.getElementById('detailPlate').textContent = vehicleData.plate;
        document.getElementById('detailType').textContent = vehicleData.type;
        document.getElementById('detailBrand').textContent = vehicleData.brand;
        document.getElementById('detailModel').textContent = vehicleData.model;
        document.getElementById('detailYear').textContent = vehicleData.year;
        document.getElementById('detailStnkExpired').textContent = vehicleData.stnkExpired;
        document.getElementById('detailNotes').textContent = vehicleData.notes;

        // Menampilkan modal
        document.getElementById('detailModal').classList.remove('hidden');
      }

      function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
      }

      function editVehicle(plateNumber) {
        // Di sini Anda bisa menambahkan logika untuk mengambil data kendaraan dari server
        const vehicleData = {
          plate: 'B 1234 ABC',
          type: 'mobil',
          brand: 'Toyota',
          model: 'Avanza',
          year: '2020',
          stnkExpired: '2024-12-31',
          notes: 'Kendaraan dalam kondisi baik'
        };

        // Mengisi data ke form edit
        document.getElementById('editPlate').value = vehicleData.plate;
        document.getElementById('editType').value = vehicleData.type;
        document.getElementById('editBrand').value = vehicleData.brand;
        document.getElementById('editModel').value = vehicleData.model;
        document.getElementById('editYear').value = vehicleData.year;
        document.getElementById('editStnkExpired').value = vehicleData.stnkExpired;
        document.getElementById('editNotes').value = vehicleData.notes;

        // Menampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
      }

      function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
      }

      // Event listener untuk form
      document.getElementById('vehicleForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Di sini Anda bisa menambahkan logika untuk menyimpan data ke server
        alert('Data kendaraan berhasil disimpan!');
        closeModal();
      });

      // Event listener untuk form edit
      document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Di sini Anda bisa menambahkan logika untuk menyimpan perubahan ke server
        alert('Data kendaraan berhasil diperbarui!');
        closeEditModal();
      });

      // Update tombol aksi di tabel
      document.querySelectorAll('tr').forEach(row => {
        const editBtn = row.querySelector('button[title="Edit"]');
        const viewBtn = row.querySelector('button[title="Lihat Detail"]');

        if (editBtn) {
          editBtn.onclick = () => editVehicle(row.cells[0].textContent);
        }
        if (viewBtn) {
          viewBtn.onclick = () => viewVehicleDetails(row.cells[0].textContent);
        }
      });

      // Close modals when clicking outside
      document.addEventListener('click', function(event) {
        const vehicleModal = document.getElementById('vehicleModal');
        const detailModal = document.getElementById('detailModal');
        const editModal = document.getElementById('editModal');

        if (event.target === vehicleModal) {
          closeModal();
        }
        if (event.target === detailModal) {
          closeDetailModal();
        }
        if (event.target === editModal) {
          closeEditModal();
        }
      });

      // Notification functions
      function toggleNotifications() {
        const panel = document.getElementById('notificationsPanel');
        panel.classList.toggle('hidden');
        // Close profile menu if open
        document.getElementById('userMenu').classList.add('hidden');
      }

      // Profile menu functions
      function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
        // Close notifications if open
        document.getElementById('notificationsPanel').classList.add('hidden');
      }

      // Close dropdowns when clicking outside
      document.addEventListener('click', function(event) {
        const notificationsPanel = document.getElementById('notificationsPanel');
        const userMenu = document.getElementById('userMenu');

        if (!event.target.closest('#notificationsPanel') && !event.target.closest('button[onclick="toggleNotifications()"]')) {
          notificationsPanel.classList.add('hidden');
        }

        if (!event.target.closest('#userMenu') && !event.target.closest('button[onclick="toggleUserMenu()"]')) {
          userMenu.classList.add('hidden');
        }
      });

      function logout() {
        localStorage.clear();
        sessionStorage.clear();
        window.location.href = 'login.html';
      }
    </script>
  </body>
</html>

@endsection
