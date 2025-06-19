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
              <p class="text-sm font-medium text-gray-900">Sertifikasi Akan Expired</p>
              <p class="text-sm text-gray-500">Karyawan: John Doe</p>
              <p class="text-xs text-gray-400 mt-1">5 menit yang lalu</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-yellow-100">
              <i class="fas fa-hard-hat text-yellow-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Pelatihan Keselamatan Diperlukan</p>
              <p class="text-sm text-gray-500">Tim Konstruksi</p>
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
              <p class="text-sm font-medium text-gray-900">Karyawan Baru Ditambahkan</p>
              <p class="text-sm text-gray-500">Jane Smith - Safety Officer</p>
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
          <h1 class="text-2xl font-semibold text-gray-900">Daftar Karyawan</h1>
          <button onclick="addNewEmployee()" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Tambah Karyawan
          </button>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 flex flex-wrap gap-4">
          <div class="flex-1 min-w-[200px]">
            <input
              type="text"
              placeholder="Cari karyawan..."
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
          <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="">Semua Departemen</option>
            <option value="it">IT</option>
            <option value="hr">HR</option>
            <option value="finance">Finance</option>
            <option value="operations">Operations</option>
            <option value="marketing">Marketing</option>
            <option value="sales">Sales</option>
          </select>
          <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="">Status Karyawan</option>
            <option value="active">Aktif</option>
            <option value="inactive">Tidak Aktif</option>
            <option value="probation">Masa Percobaan</option>
          </select>
        </div>

        <!-- Employee List Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Safety Induction</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Expired</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Safety Badge</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Sample Employee Row -->
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">DHI-2024-001</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Digital Hyperspace Indonesia</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Software Engineer</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <select class="text-sm border border-gray-300 rounded-md px-2 py-1">
                    <option value="">Pilih Kategori</option>
                    <option value="pelanggaran1">Pelanggaran 1</option>
                    <option value="pelanggaran2">Pelanggaran 2</option>
                    <option value="pelanggaran3">Pelanggaran 3</option>
                  </select>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <input type="date" class="text-sm border border-gray-300 rounded-md px-2 py-1" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <input type="text" placeholder="Nomor Badge" class="text-sm border border-gray-300 rounded-md px-2 py-1" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <textarea class="text-sm border border-gray-300 rounded-md px-2 py-1" rows="1" placeholder="Tambah catatan..."></textarea>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Aktif</span>
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
                <button class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                  <span class="sr-only">Sebelumnya</span>
                  <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button aria-current="page" class="relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                  1
                </button>
                <button class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                  2
                </button>
                <button class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                  <span class="sr-only">Selanjutnya</span>
                  <i class="fas fa-chevron-right text-sm"></i>
                </button>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Add/Edit Employee Modal -->
    <div id="employeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Karyawan Baru</h3>
          <form class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Perusahaan</label>
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Position</label>
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Status Karyawan</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option value="active">Aktif</option>
                  <option value="inactive">Tidak Aktif</option>
                  <option value="probation">Masa Percobaan</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Safety Induction</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option value="">Pilih Kategori</option>
                  <option value="pelanggaran1">Pelanggaran 1</option>
                  <option value="pelanggaran2">Pelanggaran 2</option>
                  <option value="pelanggaran3">Pelanggaran 3</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Expired</label>
                <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Safety Badge</label>
              <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Alamat</label>
              <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" rows="2"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="tel" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
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

    <!-- Detail Employee Modal -->
    <div id="detailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Detail Karyawan</h3>
            <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">NIK</label>
                <p class="mt-1 text-sm text-gray-900" id="detailNIK">DHI-2024-001</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <p class="mt-1 text-sm text-gray-900" id="detailName">John Doe</p>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Perusahaan</label>
                <p class="mt-1 text-sm text-gray-900" id="detailCompany">Digital Hyperspace Indonesia</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Position</label>
                <p class="mt-1 text-sm text-gray-900" id="detailPosition">Software Engineer</p>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                <p class="mt-1 text-sm text-gray-900" id="detailJoinDate">01/01/2024</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Status Karyawan</label>
                <p class="mt-1 text-sm text-gray-900" id="detailStatus">Aktif</p>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Safety Induction</label>
                <p class="mt-1 text-sm text-gray-900" id="detailSafety">Pelanggaran 1</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Expired</label>
                <p class="mt-1 text-sm text-gray-900" id="detailExpired">31/12/2024</p>
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Safety Badge</label>
              <p class="mt-1 text-sm text-gray-900" id="detailBadge">SB-001</p>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Catatan</label>
              <p class="mt-1 text-sm text-gray-900" id="detailNotes">Karyawan baru bergabung pada Januari 2024</p>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Alamat</label>
              <p class="mt-1 text-sm text-gray-900" id="detailAddress">Jl. Contoh No. 123, Jakarta</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <p class="mt-1 text-sm text-gray-900" id="detailPhone">081234567890</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="mt-1 text-sm text-gray-900" id="detailEmail">john.doe@example.com</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Employee Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Edit Karyawan</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <form id="editForm" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" id="editNIK" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required readonly />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="editName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Perusahaan</label>
                <input type="text" id="editCompany" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Position</label>
                <input type="text" id="editPosition" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Safety Induction</label>
                <select id="editSafety" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option value="">Pilih Kategori</option>
                  <option value="pelanggaran1">Pelanggaran 1</option>
                  <option value="pelanggaran2">Pelanggaran 2</option>
                  <option value="pelanggaran3">Pelanggaran 3</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Expired</label>
                <input type="date" id="editExpired" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Safety Badge</label>
              <input type="text" id="editBadge" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Catatan</label>
              <textarea id="editNotes" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" rows="3" placeholder="Tambahkan catatan..."></textarea>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Alamat</label>
              <textarea id="editAddress" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" rows="2"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="tel" id="editPhone" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="editEmail" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
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
      function addNewEmployee() {
        document.getElementById('employeeModal').classList.remove('hidden');
      }

      function closeModal() {
        document.getElementById('employeeModal').classList.add('hidden');
      }

      // Close modal when clicking outside
      document.addEventListener('click', function(event) {
        const modal = document.getElementById('employeeModal');
        const modalContent = modal.querySelector('div');

        if (event.target === modal) {
          closeModal();
        }
      });

      function viewEmployeeDetails(employeeId) {
        // Di sini Anda bisa menambahkan logika untuk mengambil data karyawan dari server
        // Untuk contoh ini, kita menggunakan data statis
        const employeeData = {
          nik: 'DHI-2024-001',
          name: 'John Doe',
          company: 'Digital Hyperspace Indonesia',
          position: 'Software Engineer',
          joinDate: '01/01/2024',
          status: 'Aktif',
          safety: 'Pelanggaran 1',
          expired: '31/12/2024',
          badge: 'SB-001',
          notes: 'Karyawan baru bergabung pada Januari 2024',
          address: 'Jl. Contoh No. 123, Jakarta',
          phone: '081234567890',
          email: 'john.doe@example.com'
        };

        // Mengisi data ke modal detail
        document.getElementById('detailNIK').textContent = employeeData.nik;
        document.getElementById('detailName').textContent = employeeData.name;
        document.getElementById('detailCompany').textContent = employeeData.company;
        document.getElementById('detailPosition').textContent = employeeData.position;
        document.getElementById('detailJoinDate').textContent = employeeData.joinDate;
        document.getElementById('detailStatus').textContent = employeeData.status;
        document.getElementById('detailSafety').textContent = employeeData.safety;
        document.getElementById('detailExpired').textContent = employeeData.expired;
        document.getElementById('detailBadge').textContent = employeeData.badge;
        document.getElementById('detailNotes').textContent = employeeData.notes;
        document.getElementById('detailAddress').textContent = employeeData.address;
        document.getElementById('detailPhone').textContent = employeeData.phone;
        document.getElementById('detailEmail').textContent = employeeData.email;

        // Menampilkan modal
        document.getElementById('detailModal').classList.remove('hidden');
      }

      function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
      }

      function editEmployee(employeeId) {
        // Di sini Anda bisa menambahkan logika untuk mengambil data karyawan dari server
        // Untuk contoh ini, kita menggunakan data statis
        const employeeData = {
          nik: 'DHI-2024-001',
          name: 'John Doe',
          company: 'Digital Hyperspace Indonesia',
          position: 'Software Engineer',
          safety: 'pelanggaran1',
          expired: '2024-12-31',
          badge: 'SB-001',
          notes: 'Karyawan baru bergabung pada Januari 2024',
          address: 'Jl. Contoh No. 123, Jakarta',
          phone: '081234567890',
          email: 'john.doe@example.com'
        };

        // Mengisi data ke form edit
        document.getElementById('editNIK').value = employeeData.nik;
        document.getElementById('editName').value = employeeData.name;
        document.getElementById('editCompany').value = employeeData.company;
        document.getElementById('editPosition').value = employeeData.position;
        document.getElementById('editSafety').value = employeeData.safety;
        document.getElementById('editExpired').value = employeeData.expired;
        document.getElementById('editBadge').value = employeeData.badge;
        document.getElementById('editNotes').value = employeeData.notes;
        document.getElementById('editAddress').value = employeeData.address;
        document.getElementById('editPhone').value = employeeData.phone;
        document.getElementById('editEmail').value = employeeData.email;

        // Menampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
      }

      function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
      }

      // Event listener untuk form edit
      document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Di sini Anda bisa menambahkan logika untuk menyimpan perubahan ke server
        alert('Data karyawan berhasil diperbarui!');
        closeEditModal();
      });

      // Update tombol aksi di tabel
      document.querySelectorAll('tr').forEach(row => {
        const editBtn = row.querySelector('button[title="Edit"]');
        const viewBtn = row.querySelector('button[title="Lihat Detail"]');

        if (editBtn) {
          editBtn.onclick = () => editEmployee(row.cells[0].textContent);
        }
        if (viewBtn) {
          viewBtn.onclick = () => viewEmployeeDetails(row.cells[0].textContent);
        }
      });

      // Close modals when clicking outside
      document.addEventListener('click', function(event) {
        const detailModal = document.getElementById('detailModal');
        const editModal = document.getElementById('editModal');

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
