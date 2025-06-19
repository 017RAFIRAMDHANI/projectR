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
      /* Safety Light Indicator Styles */
      .safety-light {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        border: 2px solid rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s, border 0.2s;
        opacity: 1 !important;
      }
      .safety-light:hover {
        transform: scale(1.1);
      }
      .safety-light:active {
        transform: scale(0.95);
      }
      .safety-light.green {
        background-color: #22c55e !important;
        box-shadow: 0 0 15px rgba(34, 197, 94, 0.5);
      }
      .safety-light.yellow {
        background-color: #eab308 !important;
        box-shadow: 0 0 15px rgba(234, 179, 8, 0.5);
      }
      .safety-light.red {
        background-color: #ef4444 !important;
        box-shadow: 0 0 15px rgba(239, 68, 68, 0.5);
      }
      .safety-light.active-bullet {
        border: 3px solid #2563eb !important;
        box-shadow: 0 0 0 4px rgba(37,99,235,0.15), 0 0 15px rgba(0,0,0,0.1);
        z-index: 1;
      }
      .safety-status {
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        margin-left: 0.5rem;
      }
      .safety-status.green {
        background-color: #dcfce7;
        color: #166534;
      }
      .safety-status.yellow {
        background-color: #fef9c3;
        color: #854d0e;
      }
      .safety-status.red {
        background-color: #fee2e2;
        color: #991b1b;
      }
      .edit-safety-btn {
        padding: 0.25rem;
        margin-left: 0.5rem;
        color: #6b7280;
        transition: color 0.2s;
      }
      .edit-safety-btn:hover {
        color: #2563eb;
      }
      .indicator-btn {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: none;
        outline: none;
        cursor: pointer;
        transition: background 0.2s;
      }
      .indicator-btn.bg-gray-400 {
        background-color: #9ca3af !important;
      }
    </style>
  </head>
  <body class="bg-gray-50">
    <!-- Navbar -->



    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Back Button -->
      <div class="mb-6">
        <a href="{{route('/')}}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
          <i class="fas fa-arrow-left mr-2"></i>
          Kembali ke Dashboard
        </a>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6">
        <!-- Back Button and Page Title -->
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-semibold text-gray-900">Safety induction</h1>
        </div>

        <!-- Filter Section -->
        <div class="mb-6">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-white p-6 rounded-lg shadow-sm">
            <div>
              <label for="typeFilter" class="block text-sm font-semibold text-gray-700 mb-2">Type</label>
              <div class="relative">
                <select id="typeFilter" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary bg-white appearance-none pr-10">
                  <option value="all">All Types</option>
                  <option value="visitor">Visitor</option>
                  <option value="vendor">Vendor</option>
                  <option value="employee">Employee</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <i class="fas fa-chevron-down text-gray-400"></i>
                </div>
              </div>
            </div>
            <div>
              <label for="badgeStatusFilter" class="block text-sm font-semibold text-gray-700 mb-2">Badge Status</label>
              <div class="relative">
                <select id="badgeStatusFilter" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary bg-white appearance-none pr-10">
                  <option value="all">All Status</option>
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                  <option value="expired">Expired</option>
                  <option value="out">Out</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <i class="fas fa-chevron-down text-gray-400"></i>
                </div>
              </div>
            </div>
            <div>
              <label for="expired30Filter" class="block text-sm font-semibold text-gray-700 mb-2">Additional Filter</label>
              <div class="flex space-x-2 items-center">
                <div class="relative w-full">
                  <select id="expired30Filter" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary bg-white appearance-none pr-10">
                    <option value="all">Show All Data</option>
                    <option value="expired30">Expiring in 30 Days</option>
                    <option value="expiredBefore">Expired Before</option>
                    <option value="expiredAfter">Expired After</option>
                    <option value="expiredBetween">Expired Between</option>
                  </select>
                  <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <i class="fas fa-chevron-down text-gray-400"></i>
                  </div>
                </div>
                <input type="date" id="expiredDateInput1" class="hidden px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" />
                <span id="expiredDateSeparator" class="hidden">-</span>
                <input type="date" id="expiredDateInput2" class="hidden px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" />
              </div>
            </div>
            <div>
              <label for="searchFilter" class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
              <div class="relative">
                <input
                  type="text"
                  id="searchFilter"
                  placeholder="Search by name, company or position..."
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary pr-10"
                />
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <i class="fas fa-search text-gray-400"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Employee List Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Safety badge</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expired Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">History</th>
              </tr>
            </thead>
            <tbody id="employeeTableBody" class="bg-white divide-y divide-gray-200">
              <!-- Table rows will be rendered by JS -->
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
          <div class="flex flex-1 justify-between sm:hidden">
            <button id="prevPageMobile" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
            <button id="nextPageMobile" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
          </div>
          <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                Showing <span id="fromEntry" class="font-medium">1</span> to <span id="toEntry" class="font-medium">10</span> of <span id="totalEntries" class="font-medium">1</span> entries
              </p>
            </div>
            <div>
              <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination" id="paginationNav">
                <!-- Pagination buttons will be rendered by JS -->
              </nav>
            </div>
          </div>
        </div>
      </div>
    </main>

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
                <label class="block text-sm font-medium text-gray-700">Safety Badge</label>
                <select id="editSafety" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option value="">Pilih Kategori</option>
                  <option value="pelanggaran1">Pelanggaran 1</option>
                  <option value="pelanggaran2">Pelanggaran 2</option>
                  <option value="pelanggaran3">Pelanggaran 3</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Expired</label>
                <input type="text" id="editExpired" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-gray-50" readonly />
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Status</label>
              <input type="text" id="editBadge" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
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

    <!-- Safety Status Modal -->
    <div id="safetyModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Update Safety Status</h3>
            <button onclick="closeSafetyModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="space-y-4">
            <div class="grid grid-cols-3 gap-4">
              <button onclick="updateSafetyStatus('green')" class="safety-option-btn p-4 rounded-lg border-2 border-transparent hover:border-green-500 focus:outline-none focus:border-green-500">
                <div class="safety-light green mx-auto mb-2"></div>
                <span class="safety-status green block text-center">Good</span>
              </button>
              <button onclick="updateSafetyStatus('yellow')" class="safety-option-btn p-4 rounded-lg border-2 border-transparent hover:border-yellow-500 focus:outline-none focus:border-yellow-500">
                <div class="safety-light yellow mx-auto mb-2"></div>
                <span class="safety-status yellow block text-center">Warning</span>
              </button>
              <button onclick="updateSafetyStatus('red')" class="safety-option-btn p-4 rounded-lg border-2 border-transparent hover:border-red-500 focus:outline-none focus:border-red-500">
                <div class="safety-light red mx-auto mb-2"></div>
                <span class="safety-status red block text-center">Critical</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal untuk catatan indikator -->
    <div id="indicatorNoteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-2">Add Note</h3>

        <!-- Input tanggal -->
        <label for="indicatorNoteDate" class="block text-sm font-medium text-gray-700 mb-1">Select Date</label>
        <input type="date" id="indicatorNoteDate" class="w-full border border-gray-300 rounded-md p-2 mb-4" />

        <!-- Input catatan -->
        <textarea id="indicatorNoteInput" class="w-full border border-gray-300 rounded-md p-2 mb-4" rows="3" placeholder="Enter note..."></textarea>

        <!-- Tombol aksi -->
        <div class="flex justify-end gap-2">
          <button onclick="closeIndicatorNoteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
          <button onclick="saveIndicatorNote()" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700">Save</button>
        </div>
      </div>
    </div>
    <!-- <i class="fas fa-camera"></i> -->

    <!-- Add Camera Modal -->
    <div id="cameraModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[500px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Take Photo</h3>
            <button onclick="closeCameraModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="space-y-4">
            <div class="relative">
              <video id="cameraPreview" class="w-full h-[300px] bg-gray-100 rounded-lg object-cover"></video>
              <canvas id="photoCanvas" class="hidden"></canvas>
            </div>
            <div class="flex justify-center space-x-4">
              <button onclick="takePhoto()" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700">
                <i class="fas fa-camera mr-2"></i>Take Photo
              </button>
              <button onclick="retakePhoto()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 hidden" id="retakeButton">
                <i class="fas fa-redo mr-2"></i>Retake
              </button>
              <button onclick="savePhoto()" class="px-4 py-2 bg-green-500 text-white rounded-md text-sm hover:bg-green-600 hidden" id="saveButton">
                <i class="fas fa-save mr-2"></i>Save
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Preview Gambar -->
    <div id="imagePreviewModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
      <div class="bg-white rounded-lg shadow-lg p-4 relative max-w-xs w-full">
        <button onclick="closeImagePreviewModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <img id="imagePreviewModalImg" src="" alt="Preview Gambar" class="w-full h-auto rounded object-contain" />
      </div>
    </div>

    <script>
      function viewEmployeeDetails(employeeId) {
        // Di sini Anda bisa menambahkan logika untuk mengambil data karyawan dari server
        // Untuk contoh ini, kita menggunakan data statis
        const employeeData = {
          nik: 'DHI-2024-001',
          name: 'John Doe',
          company: 'Digital Hyperspace Indonesia',
          position: 'Software Engineer',
          joinDate: '01/01/2024',
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

        // Mengambil nilai dari form
        const formData = {
          nik: document.getElementById('editNIK').value,
          name: document.getElementById('editName').value,
          company: document.getElementById('editCompany').value,
          position: document.getElementById('editPosition').value,
          safety: document.getElementById('editSafety').value,
          badge: document.getElementById('editBadge').value,
          notes: document.getElementById('editNotes').value,
          address: document.getElementById('editAddress').value,
          phone: document.getElementById('editPhone').value,
          email: document.getElementById('editEmail').value
        };

        // Di sini Anda bisa menambahkan logika untuk menyimpan perubahan ke server
        console.log('Data yang akan disimpan:', formData);
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

      // Remove toggle functions
      function changeSafetyLight(element) {
        // Function removed
      }

      function updateSafetyLight(select) {
        // Function removed
      }

      let currentSafetyElement = null;

      function openSafetyModal(element) {
        currentSafetyElement = element.closest('td').querySelector('.flex');
        document.getElementById('safetyModal').classList.remove('hidden');
      }

      function closeSafetyModal() {
        document.getElementById('safetyModal').classList.add('hidden');
        currentSafetyElement = null;
      }

      function updateBadgeForRow(row) {
        const safetyStatus = row.querySelector('.safety-status');
        const badgeCell = row.querySelector('.safety-badge-cell');
        if (safetyStatus && badgeCell) {
          if (safetyStatus.textContent.trim() === 'Good') {
            badgeCell.innerHTML = '<span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold"><i class="fas fa-medal mr-1"></i> Safety Passed</span>';
          } else {
            badgeCell.innerHTML = '<span class="inline-flex items-center px-2 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-semibold"><i class="fas fa-times-circle mr-1"></i> Not Passed</span>';
          }
        }
      }

      function changeSafetyStatus(element) {
        const colors = ['green', 'yellow', 'red'];
        const statusTexts = {
          'green': 'Good',
          'yellow': 'Warning',
          'red': 'Critical'
        };

        const currentColor = element.classList[1];
        const currentIndex = colors.indexOf(currentColor);
        const nextIndex = (currentIndex + 1) % colors.length;
        const nextColor = colors[nextIndex];

        element.className = `safety-light ${nextColor}`;
        const statusElement = element.nextElementSibling;
        statusElement.className = `safety-status ${nextColor}`;
        statusElement.textContent = statusTexts[nextColor];
        updateBadgeForRow(element.closest('tr'));
      }

      function updateSafetyStatus(color) {
        if (!currentSafetyElement) return;

        const light = currentSafetyElement.querySelector('.safety-light');
        const status = currentSafetyElement.querySelector('.safety-status');
        const statusTexts = {
          'green': 'Good',
          'yellow': 'Warning',
          'red': 'Critical'
        };

        light.className = `safety-light ${color}`;
        status.className = `safety-status ${color}`;
        status.textContent = statusTexts[color];
        updateBadgeForRow(currentSafetyElement.closest('tr'));

        closeSafetyModal();
      }

      // Close modal when clicking outside
      document.addEventListener('click', function(event) {
        const modal = document.getElementById('safetyModal');
        if (event.target === modal) {
          closeSafetyModal();
        }
      });

      // Setelah DOM siap, update badge sesuai status safety induction
      window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('tr').forEach(function(row) {
          updateBadgeForRow(row);
        });
      });

      // Data penyimpanan catatan per baris dan indikator
      const indicatorNotes = {};
      let currentIndicator = { rowIndex: null, indicatorIndex: null };

      // Event delegation untuk tombol indikator
      // Pastikan dipanggil setelah DOMContentLoaded
      window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.indicator-group').forEach((group, rowIdx) => {
          group.querySelectorAll('.indicator-btn').forEach((btn, idx) => {
            btn.addEventListener('click', function() {
              openIndicatorNoteModal(rowIdx, idx, btn, group);
            });
          });
        });
      });

      function openIndicatorNoteModal(rowIndex, indicatorIndex, btn, group) {
        currentIndicator = { rowIndex, indicatorIndex, btn, group };
        const key = `${rowIndex}-${indicatorIndex}`;
        document.getElementById('indicatorNoteInput').value = indicatorNotes[key] || '';
        document.getElementById('indicatorNoteModal').classList.remove('hidden');
      }

      function closeIndicatorNoteModal() {
        document.getElementById('indicatorNoteModal').classList.add('hidden');
        currentIndicator = null;
      }

      function updateSafetyBadge(row, expiredDate) {
        const badgeCell = row.querySelector('.safety-badge-cell');
        const indicators = row.querySelectorAll('.indicator-btn');

        // Cek tanggal expired
        const today = new Date();
        const expired = new Date(expiredDate);
        const isExpired = today > expired;

        // Cek jika ada indikator merah
        const hasRedIndicator = Array.from(indicators).some(btn =>
          btn.classList.contains('bg-red-500') && !indicatorNotes[`${Array.from(row.parentElement.children).indexOf(row)}-${Array.from(indicators).indexOf(btn)}`]
        );

        if (isExpired) {
          badgeCell.innerHTML = '<span class="inline-flex items-center px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold"><i class="fas fa-times-circle mr-1"></i> Expired</span>';
        } else if (hasRedIndicator) {
          badgeCell.innerHTML = '<span class="inline-flex items-center px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold"><i class="fas fa-times-circle mr-1"></i> Out</span>';
        } else {
          badgeCell.innerHTML = '<span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold"><i class="fas fa-medal mr-1"></i> Active</span>';
        }
      }

      function saveIndicatorNote() {
        const note = document.getElementById('indicatorNoteInput').value.trim();
        const { rowIndex, indicatorIndex, btn, group } = currentIndicator;
        const key = `${rowIndex}-${indicatorIndex}`;
        indicatorNotes[key] = note;

        // Update warna indikator
        if (!note) {
          btn.classList.remove('bg-gray-400');
          if (indicatorIndex === 0) {
            btn.classList.add('bg-green-500');
          } else if (indicatorIndex === 1) {
            btn.classList.add('bg-yellow-500');
          } else if (indicatorIndex === 2) {
            btn.classList.add('bg-red-500');
          }
        } else {
          btn.classList.remove('bg-green-500', 'bg-yellow-500', 'bg-red-500');
          btn.classList.add('bg-gray-400');
        }

        // Update Safety Badge
        const row = group.closest('tr');
        const expiredDate = row.querySelector('input[type="date"]').value;
        updateSafetyBadge(row, expiredDate);

        closeIndicatorNoteModal();
      }

      // Update badge saat load dan setiap perubahan lampu
      window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('tr').forEach(function(row) {
          const expiredDate = row.querySelector('input[type="date"]').value;
          updateSafetyBadge(row, expiredDate);
        });
      });

      // Update badge setiap kali tanggal expired berubah
      document.addEventListener('change', function(event) {
        if (event.target.type === 'date') {
          const row = event.target.closest('tr');
          updateSafetyBadge(row, event.target.value);
        }
      });

      // Dummy data
      let employeesData = [
        {
          fullName: 'John Doe',
          company: 'Digital Hyperspace Indonesia',
          position: 'Safety Officer',
          safetyInduction: 'good',
          expiredDate: '2024-12-31',
          safetyBadge: 'SB-001',
          type: 'employee',
          status: 'active'
        },
        {
          fullName: 'Jane Smith',
          company: 'PT Vendor Jaya',
          position: 'Technician',
          safetyInduction: 'warning',
          expiredDate: '2023-10-15',
          safetyBadge: 'SB-002',
          type: 'vendor',
          status: 'inactive'
        },
        {
          fullName: 'Michael Brown',
          company: 'PT Visitor Makmur',
          position: 'Consultant',
          safetyInduction: 'critical',
          expiredDate: '2022-01-20',
          safetyBadge: 'SB-003',
          type: 'visitor',
          status: 'active'
        },
        {
          fullName: 'Alice Green',
          company: 'PT Vendor Sejahtera',
          position: 'Supervisor',
          safetyInduction: 'good',
          expiredDate: '2025-05-10',
          safetyBadge: 'SB-004',
          type: 'vendor',
          status: 'active'
        },
        {
          fullName: 'Bob White',
          company: 'PT Visitor Sentosa',
          position: 'Inspector',
          safetyInduction: 'warning',
          expiredDate: '2023-07-01',
          safetyBadge: 'SB-005',
          type: 'visitor',
          status: 'inactive'
        }
      ];

      // Pagination variables
      let currentPage = 1;
      const rowsPerPage = 10;

      function getBadgeStatus(emp) {
        const today = new Date();
        // Check if start date and expired date are missing
        if (!emp.startDate && !emp.expiredDate) return 'inactive';

        const expired = new Date(emp.expiredDate);
        // Remove time part for accurate comparison
        today.setHours(0,0,0,0);
        expired.setHours(0,0,0,0);

        if (expired < today) return 'expired';
        if (emp.status === 'active') return 'active';
        return 'out';
      }

      function renderEmployeesTable() {
        const tbody = document.getElementById('employeeTableBody');
        tbody.innerHTML = '';
        const filtered = getFilteredEmployees();
        const start = (currentPage - 1) * rowsPerPage;
        const end = Math.min(start + rowsPerPage, filtered.length);
        for (let i = start; i < end; i++) {
          const emp = filtered[i];
          const badgeStatus = getBadgeStatus(emp);
          let badgeClass = 'bg-gray-200 text-gray-600';
          let badgeText = 'Out';

          if (badgeStatus === 'active') {
            badgeClass = 'bg-green-100 text-green-800';
            badgeText = 'Active';
          }
          if (badgeStatus === 'expired') {
            badgeClass = 'bg-red-100 text-red-800';
            badgeText = 'Expired';
          }
          if (badgeStatus === 'inactive') {
            badgeClass = 'bg-gray-400 text-gray-800';
            badgeText = 'Inactive';
          }
          const isEditingDate = emp._editingDate;
          const tr = document.createElement('tr');
          tr.className = 'table-row-hover';
          tr.innerHTML = renderEmployeeRow(emp);
          tbody.appendChild(tr);
        }
        updatePagination(filtered.length);
      }

      function renderEmployeeRow(emp) {
        const badgeStatus = getBadgeStatus(emp);
        let badgeClass = 'bg-gray-200 text-gray-600';
        let badgeText = 'Out';

        if (badgeStatus === 'active') {
          badgeClass = 'bg-green-100 text-green-800';
          badgeText = 'Active';
        }
        if (badgeStatus === 'expired') {
          badgeClass = 'bg-red-100 text-red-800';
          badgeText = 'Expired';
        }
        if (badgeStatus === 'inactive') {
          badgeClass = 'bg-gray-400 text-gray-800';
          badgeText = 'Inactive';
        }
        return `
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${emp.fullName}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center space-x-2">
              <img src="${emp.photo || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(emp.fullName) + '&background=2563eb&color=fff'}"
                   alt="${emp.fullName}"
                   class="h-10 w-10 rounded-full object-cover cursor-pointer"
                   onclick="openImagePreviewModal(this.src)" />
              <div class="flex space-x-1">
                <input type="file"
                       accept="image/*"
                       class="hidden"
                       id="photoInput-${emp.nik || emp.fullName}"
                       onchange="handlePhotoUpload(event, '${emp.nik || emp.fullName}')">
                <button onclick="document.getElementById('photoInput-${emp.nik || emp.fullName}').click()"
                        class="text-primary hover:text-primary-dark" title="Upload File">
                  <i class="fas fa-upload"></i>
                </button>
                <button onclick="openCameraModal('${emp.nik || emp.fullName}')"
                        class="text-primary hover:text-primary-dark" title="Take Photo">

                </button>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${emp.company}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${emp.position}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center space-x-2 indicator-group">
              <div class="safety-light green indicator-btn" title="Good" style="opacity:1;"></div>
              <div class="safety-light yellow indicator-btn" title="Warning" style="opacity:1;"></div>
              <div class="safety-light red indicator-btn" title="Critical" style="opacity:1;"></div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex flex-col space-y-2">
              <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">Start Date:</label>
                <input type="date"
                       class="form-input rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                       value="${emp.startDate || ''}"
                       onchange="handleStartDateChange(event, '${emp.nik || emp.fullName}')">
              </div>
              <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">Expired Date:</label>
                <input type="date"
                       class="form-input rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                       value="${emp.expiredDate || ''}"
                       id="expiredDate-${emp.nik || emp.fullName}"
                       readonly>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap safety-badge-cell">
            <span class="inline-flex items-center px-2 py-1 rounded ${badgeClass} text-xs font-medium"><i class="fas fa-id-badge mr-1"></i>${emp.safetyBadge} <span class="ml-2">${badgeText}</span></span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${capitalize(emp.type)}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <div class="flex space-x-2">
              <button onclick="viewEmployeeHistory('${emp.nik || emp.fullName}')" class="text-red-600 hover:text-red-700 font-medium" title="View History">
                <i class="fas fa-history mr-1"></i>History
              </button>
            </div>
          </td>
        `;
      }

      function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
      }

      function getFilteredEmployees() {
        const searchTerm = document.getElementById('searchFilter').value.toLowerCase();
        const typeFilter = document.getElementById('typeFilter').value;
        const badgeStatusFilter = document.getElementById('badgeStatusFilter').value;
        const expired30Filter = document.getElementById('expired30Filter').value;
        const now = new Date();
        const in30Days = new Date();
        in30Days.setDate(now.getDate() + 30);
        return employeesData.filter(emp => {
          const matchesSearch = emp.fullName.toLowerCase().includes(searchTerm) ||
                              emp.company.toLowerCase().includes(searchTerm) ||
                              emp.position.toLowerCase().includes(searchTerm);
          const matchesType = typeFilter === 'all' || emp.type === typeFilter;
          const badgeStatus = getBadgeStatus(emp);
          const matchesStatus = badgeStatusFilter === 'all' || badgeStatus === badgeStatusFilter;
          let matchesExpired = true;
          if (expired30Filter === 'expired30') {
            if (emp.expiredDate) {
              const expDate = new Date(emp.expiredDate);
              matchesExpired = expDate >= now && expDate <= in30Days;
            } else {
              matchesExpired = false;
            }
          }
          return matchesSearch && matchesType && matchesStatus && matchesExpired;
        });
      }

      function updatePagination(total) {
        const from = (currentPage - 1) * rowsPerPage + 1;
        const to = Math.min(currentPage * rowsPerPage, total);
        document.getElementById('fromEntry').textContent = total === 0 ? 0 : from;
        document.getElementById('toEntry').textContent = to;
        document.getElementById('totalEntries').textContent = total;
        // Render pagination buttons
        const nav = document.getElementById('paginationNav');
        nav.innerHTML = '';
        const pageCount = Math.ceil(total / rowsPerPage);
        for (let i = 1; i <= pageCount; i++) {
          const btn = document.createElement('button');
          btn.className = `relative inline-flex items-center px-4 py-2 text-sm font-semibold ${i===currentPage?'bg-primary text-white':'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50'} focus:z-20 focus:outline-offset-0`;
          btn.textContent = i;
          if (i === currentPage) btn.setAttribute('aria-current', 'page');
          btn.onclick = () => { currentPage = i; renderEmployeesTable(); };
          nav.appendChild(btn);
        }
      }

      // Filter and pagination event listeners
      document.getElementById('typeFilter').addEventListener('change', () => { currentPage = 1; renderEmployeesTable(); });
      document.getElementById('badgeStatusFilter').addEventListener('change', () => { currentPage = 1; renderEmployeesTable(); });
      document.getElementById('searchFilter').addEventListener('input', () => { currentPage = 1; renderEmployeesTable(); });
      document.getElementById('expired30Filter').addEventListener('change', () => { currentPage = 1; renderEmployeesTable(); });
      document.getElementById('prevPageMobile').addEventListener('click', () => { if(currentPage>1){currentPage--;renderEmployeesTable();} });
      document.getElementById('nextPageMobile').addEventListener('click', () => { const filtered = getFilteredEmployees(); if(currentPage<Math.ceil(filtered.length/rowsPerPage)){currentPage++;renderEmployeesTable();} });

      // Tambahkan event listener untuk expired30Filter agar input tanggal muncul sesuai pilihan
      document.getElementById('expired30Filter').addEventListener('change', function() {
        const val = this.value;
        const input1 = document.getElementById('expiredDateInput1');
        const input2 = document.getElementById('expiredDateInput2');
        const sep = document.getElementById('expiredDateSeparator');
        input1.classList.add('hidden');
        input2.classList.add('hidden');
        sep.classList.add('hidden');
        input1.value = '';
        input2.value = '';
        if (val === 'expiredBefore' || val === 'expiredAfter') {
          input1.classList.remove('hidden');
          input1.placeholder = (val === 'expiredBefore') ? 'Before...' : 'After...';
        } else if (val === 'expiredBetween') {
          input1.classList.remove('hidden');
          input2.classList.remove('hidden');
          sep.classList.remove('hidden');
        }
        // Trigger render table jika filter berubah
        currentPage = 1;
        renderEmployeesTable();
      });
      // Juga trigger render jika input tanggal berubah
      document.getElementById('expiredDateInput1').addEventListener('change', function() { currentPage = 1; renderEmployeesTable(); });
      document.getElementById('expiredDateInput2').addEventListener('change', function() { currentPage = 1; renderEmployeesTable(); });

      // Initial render
      renderEmployeesTable();

      function viewEmployeeHistory(employeeId) {
        window.location.href = `history.html?id=${employeeId}`;
      }

      // Add photo upload handler
      function handlePhotoUpload(event, employeeId) {
        const file = event.target.files[0];
        if (file) {
          if (file.size > 2 * 1024 * 1024) {
            alert('File size should not exceed 2MB');
            return;
          }
          const reader = new FileReader();
          reader.onload = function(e) {
            // Update the image preview di tabel
            const row = event.target.closest('tr');
            const img = row.querySelector('img');
            img.src = e.target.result;
            // Tampilkan modal preview
            document.getElementById('imagePreviewModalImg').src = e.target.result;
            document.getElementById('imagePreviewModal').classList.remove('hidden');
            // Show success message
            const successMessage = document.createElement('div');
            successMessage.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg';
            successMessage.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Photo uploaded successfully';
            document.body.appendChild(successMessage);
            setTimeout(() => {
              successMessage.remove();
            }, 3000);
          }
          reader.readAsDataURL(file);
        }
      }

      let currentStream = null;
      let currentEmployeeId = null;

      // Camera functions
      async function openCameraModal(employeeId) {
        currentEmployeeId = employeeId;
        const modal = document.getElementById('cameraModal');
        modal.classList.remove('hidden');

        try {
          const stream = await navigator.mediaDevices.getUserMedia({
            video: {
              width: { ideal: 1280 },
              height: { ideal: 720 },
              facingMode: 'user'
            }
          });
          currentStream = stream;
          const video = document.getElementById('cameraPreview');
          video.srcObject = stream;
        } catch (err) {
          console.error('Error accessing camera:', err);
          alert('Could not access camera. Please make sure you have granted camera permissions.');
          closeCameraModal();
        }
      }

      function closeCameraModal() {
        const modal = document.getElementById('cameraModal');
        modal.classList.add('hidden');

        if (currentStream) {
          currentStream.getTracks().forEach(track => track.stop());
          currentStream = null;
        }

        // Reset UI
        document.getElementById('retakeButton').classList.add('hidden');
        document.getElementById('saveButton').classList.add('hidden');
        document.getElementById('cameraPreview').classList.remove('hidden');
        document.getElementById('photoCanvas').classList.add('hidden');
      }

      function takePhoto() {
        const video = document.getElementById('cameraPreview');
        const canvas = document.getElementById('photoCanvas');
        const context = canvas.getContext('2d');

        // Set canvas size to match video
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        // Draw video frame to canvas
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Show canvas and hide video
        video.classList.add('hidden');
        canvas.classList.remove('hidden');

        // Show retake and save buttons
        document.getElementById('retakeButton').classList.remove('hidden');
        document.getElementById('saveButton').classList.remove('hidden');
      }

      function retakePhoto() {
        // Show video and hide canvas
        document.getElementById('cameraPreview').classList.remove('hidden');
        document.getElementById('photoCanvas').classList.add('hidden');

        // Hide retake and save buttons
        document.getElementById('retakeButton').classList.add('hidden');
        document.getElementById('saveButton').classList.add('hidden');
      }

      function savePhoto() {
        const canvas = document.getElementById('photoCanvas');
        const imageData = canvas.toDataURL('image/jpeg');

        // Update the employee's photo in the table
        const row = document.querySelector(`tr[data-id="${currentEmployeeId}"]`);
        const img = row.querySelector('img');
        img.src = imageData;

        // Show success message
        const successMessage = document.createElement('div');
        successMessage.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg';
        successMessage.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Photo saved successfully';
        document.body.appendChild(successMessage);

        setTimeout(() => {
          successMessage.remove();
        }, 3000);

        // Close the modal
        closeCameraModal();
      }

      // Close camera modal when clicking outside
      window.onclick = function(event) {
        const modal = document.getElementById('cameraModal');
        if (event.target == modal) {
          closeCameraModal();
        }
      }

      function handleStartDateChange(event, employeeId) {
        const startDate = new Date(event.target.value);
        if (startDate) {
          // Calculate expired date (6 months from start date)
          const expiredDate = new Date(startDate);
          expiredDate.setMonth(expiredDate.getMonth() + 6);

          // Format date to YYYY-MM-DD
          const formattedExpiredDate = expiredDate.toISOString().split('T')[0];

          // Update expired date input
          const expiredDateInput = document.getElementById(`expiredDate-${employeeId}`);
          expiredDateInput.value = formattedExpiredDate;

          // Update employee data
          const employee = employeesData.find(emp => (emp.nik || emp.fullName) === employeeId);
          if (employee) {
            employee.startDate = event.target.value;
            employee.expiredDate = formattedExpiredDate;
          }
        }
      }

      function closeImagePreviewModal() {
        document.getElementById('imagePreviewModal').classList.add('hidden');
      }

      function openImagePreviewModal(src) {
        document.getElementById('imagePreviewModalImg').src = src;
        document.getElementById('imagePreviewModal').classList.remove('hidden');
      }
    </script>
  </body>
</html>

@endsection
