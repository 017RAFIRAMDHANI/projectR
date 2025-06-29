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
  <!-- Filter Section -->
<!-- Filter Section -->
<div class="mb-6">
  <div class="grid grid-cols-1 md:grid-cols-12 gap-4 bg-white p-6 rounded-lg shadow-sm items-end">

    <!-- Type Filter (2 kolom) -->
    <div class="md:col-span-2">
      <label for="typeFilter" class="block text-sm font-semibold text-gray-700 mb-2">Type</label>
      <div class="relative">
        <form id="formType" method="GET">
          <select name="typeFilterPilihan" onchange="selectTypeOption()" id="typeFilterPilihan"
            class="shadow-none w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none
                   focus:ring-2 focus:ring-primary focus:border-primary bg-white appearance-none pr-10">
            <option value=" ">All Types</option>
            <option value="Visitor">Visitor</option>
            <option value="Vendor">Vendor</option>
            <option value="Employe">Employee</option>
          </select>
        </form>
        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
          <i class="fas fa-chevron-down text-gray-400"></i>
        </div>
      </div>
    </div>

    <!-- Badge Status (2 kolom) -->
    <div class="md:col-span-2">
      <label for="badgeStatusFilter" class="block text-sm font-semibold text-gray-700 mb-2">Badge Status</label>
      <div class="relative">
        <form id="formStatus" method="GET">
          <select onchange="selectStatusOption()" id="PilihStatus" name="PilihStatus"
            class="shadow-none w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none
                   focus:ring-2 focus:ring-primary focus:border-primary bg-white appearance-none pr-10">
            <option value="">All Status</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            <option value="Expired">Expired</option>
            <option value="Out">Out</option>
          </select>
        </form>
        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
          <i class="fas fa-chevron-down text-gray-400"></i>
        </div>
      </div>
    </div>

    <!-- Additional Filter (2 kolom) -->
    <div class="md:col-span-2">
      <label for="expired30Filter" class="block text-sm font-semibold text-gray-700 mb-2">Additional Filter</label>
      <div class="flex space-x-2 items-center">
        <div class="relative w-full">
          <select id="expired30Filter" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary bg-white appearance-none pr-10"  onchange="toggleDateInputs()">
            <option value="all">Show All Data</option>
            <option value="expired30">Expiring in 30 Days</option>
            <option value="expiredBefore">Expired Before</option>
            <option value="expiredAfter">Expired After</option>
          </select>
          <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
            <i class="fas fa-chevron-down text-gray-400"></i>
          </div>
        </div>

        </div>
    </div>
     <div class="md:col-span-2" id="expiredDateFilterDiv" style="display:none;">
      <label for="expired30Filter" class="block text-sm font-semibold text-gray-700 mb-2">Filter</label>
      <div class="flex space-x-2 items-center">
        <div class="relative w-full">
          <input type="date" id="expiredDateInput1" class="hidden" />
          <input type="date" id="expiredDateInput2" class="hidden" />
        </div>
      </div>
    </div>
    <!-- Search (5 kolom) -->
    <div class="md:col-span-3">
      <label for="searchFilterInput" class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
      <div class="relative">
        <form method="get" id="formSearch">
          <input type="text" id="searchFilterInput" name="searchFilterInput"
            placeholder="Search by name, company or position..."
            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none
                   focus:ring-2 focus:ring-primary focus:border-primary pr-10" />
          <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
          </div>
        </form>
      </div>
    </div>

    <!-- Reset Button (1 kolom) -->
    <div class="md:col-span-1 flex items-center justify-end">
      <button type="button" onclick="resetFilters()" class="text-red-500 whitespace-nowrap">
        <i class="fa fa-refresh"></i> Reset
      </button>
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">History</th>
                   </tr>
            </thead>
           <tbody id="employeeTableBody" class="bg-white divide-y divide-gray-200">
  <!-- Static HTML rows replacing JS-rendered employee data -->

  @foreach ($safetis as $item)
  <tr class="table-row-hover">
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
         @if($item->vendor)
                {{ $item->name }}
            @elseif($item->visitor)
                {{ $item->name }}
            @elseif($item->employe)
                {{ $item->employe->name }}
            @endif
    </td>
<td class="px-6 py-4 whitespace-nowrap">
  <div class="flex items-center space-x-2">
<img
  id="photo-preview-{{ $item->id_safeti }}"
  src="{{ $item->file_gambar ? asset('storage/' . $item->file_gambar) : 'https://ui-avatars.com/api/?name=' . urlencode($item->name ?? 'User') . '&background=2563eb&color=fff' }}"
  alt="{{ $item->name ?? 'User' }}"
  class="h-10 w-10 rounded-full object-cover cursor-pointer"
  onclick="openImagePreviewModal(this.src)"
/>

    <div class="flex space-x-1">
      <input
        type="file"
        accept="image/*"
        class="hidden"
        id="photoInput-{{ $item->id_safeti }}"
        onchange="uploadPhoto(event, {{ $item->id_safeti }})"
      >
      <button
        onclick="document.getElementById('photoInput-{{ $item->id_safeti }}').click()"
        class="text-primary hover:text-primary-dark"
        title="Upload File"
      >
        <i class="fas fa-upload"></i>
      </button>
    </div>
  </div>
</td>

<input type="hidden" class="id-safeti" value="{{ $item->id_safeti }}">

    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
   @if($item->vendor)
                {{ $item->vendor->company_name }}
            @elseif($item->visitor)
                {{ $item->visitor->company_name }}
            @elseif($item->employe)
                {{ $item->employe->company_name }}
            @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
         @if($item->vendor)
                Vendor
            @elseif($item->visitor)
             Visitor
            @elseif($item->employe)
                {{ $item->employe->position }}
            @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="flex items-center space-x-2 indicator-group">
 <div class="safety-light indicator-btn {{ $item->lampu_green == "false" ? 'bg-gray-400' : 'green' }}"
     data-row="{{ $loop->index }}"
     data-color="green"
     data-note="{{ $item->catatan_lampu_green }}"
     data-date="{{ $item->date_lampu_green }}"
     onclick="openIndicatorNoteModal(this)">
</div>

<div class="safety-light indicator-btn {{ $item->lampu_yellow == "false" ? 'bg-gray-400' : 'yellow' }}"
     data-row="{{ $loop->index }}"
     data-color="yellow"
     data-note="{{ $item->catatan_lampu_yellow }}"
     data-date="{{ $item->date_lampu_yellow }}"
     onclick="openIndicatorNoteModal(this)">
</div>

<div class="safety-light indicator-btn {{ $item->lampu_red == "false" ? 'bg-gray-400' : 'red' }}"
     data-row="{{ $loop->index }}"
     data-color="red"
     data-note="{{ $item->catatan_lampu_red }}"
     data-date="{{ $item->date_lampu_red }}"
     onclick="openIndicatorNoteModal(this)">
</div>


        {{-- <div class="safety-light green indicator-btn" title="Good" style="opacity:1;"></div>
        <div class="safety-light yellow indicator-btn" title="Warning" style="opacity:1;"></div>
        <div class="safety-light red indicator-btn" title="Critical" style="opacity:1;"></div> --}}
      </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="flex flex-col space-y-2">
        <div class="flex items-center space-x-2">
          <label class="text-sm font-medium text-gray-700">Start Date:</label>
          <input type="date" name="date_from" value="{{ $item->start_date ?? ''}}"   onchange="handleStartDateChange(this)">
        </div>
        <div class="flex items-center space-x-2">
          <label class="text-sm font-medium text-gray-700">Expired Date:</label>
       <input type="date" name="date_to" value="{{ $item->expired_date ?? ''}}"  readonly>
        </div>
      </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap safety-badge-cell">
          @if($item->status_safeti == 'Active')
        <span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">
            <i class="fas fa-medal mr-1"></i> Active
        </span>
    @elseif($item->status_safeti == 'Expired')
        <span class="inline-flex items-center px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">
            <i class="fas fa-times-circle mr-1"></i> Expired
        </span>
    @elseif($item->status_safeti == 'Out')
        <span class="inline-flex items-center px-2 py-1 rounded-full bg-gray-100 text-gray-800 text-xs font-semibold">
            <i class="fas fa-sign-out-alt mr-1"></i> Out
        </span>
      @elseif($item->status_safeti == 'Inactive')
        <span class="inline-flex items-center px-2 py-1 rounded-full bg-gray-200 text-gray-800 text-xs font-semibold">
            <i class="fas fa-id-badge mr-1"></i> Inactive
        </span>
    @endif
      {{-- <span class="inline-flex items-center px-2 py-1 rounded bg-green-100 text-green-800 text-xs font-medium">
        <i class="fas fa-id-badge mr-1"></i>SB-001 <span class="ml-2">Active</span>
      </span> --}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->type ?? ''}}</td>
    @if($item->id_history_safeti )
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
      <div class="flex space-x-2">
<form action="{{route('history')}}" method="get">
    <input type="hidden" name="id_history_safeti" value="{{$item->id_history_safeti ?? ''}}">
        <button   class="text-red-600 hover:text-red-700 font-medium" title="View History">
          <i class="fas fa-history mr-1"></i>History
        </button>
</form>
</div>
</td>
@endif

    @if($item->status_safeti == "Expired" || $item->status_safeti == "Out")
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
      <div class="flex space-x-2">
<form id="resetForm-{{ $item->id_safeti }}" action="{{ route('history.reset') }}" method="get">
  <input type="hidden" name="id_safeti" value="{{ $item->id_safeti ?? '' }}">
  <button type="button" onclick="confirmReset('{{ $item->id_safeti }}')" class="text-red-600 hover:text-red-700 font-medium" title="View History">
    <i class="fas fa-history mr-1"></i>Reset
  </button>
</form>

</div>
</td>
@endif

  </tr>


  @endforeach
</tbody>

          </table>
        </div>

        <!-- Pagination -->
<div class="p-3">
          {{ $safetis->withQueryString()->links('pagination::tailwind') }}
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
<!-- Modal Preview Gambar -->
<div id="imagePreviewModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-lg p-4 relative max-w-xs w-full">
    <button onclick="closeImagePreviewModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
    <img id="imagePreviewModalImg" src="" alt="Preview Gambar" class="w-full h-auto rounded object-contain" />
  </div>
</div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
  // Object penyimpan catatan: { rowIndex: { color: { note: '...', date: '...' } } }
  const indicatorNotes = {};
  let currentIndicator = { row: null, color: null, btn: null };

function openIndicatorNoteModal(button) {
  const rowIndex = button.dataset.row;
  const color = button.dataset.color;

  currentIndicator = {
    row: rowIndex,
    color: color,
    btn: button
  };

  // Ambil langsung dari data attribute tombol
  const note = button.dataset.note || '';
  const date = button.dataset.date || ''; // ← ini sudah YYYY-MM-DD

  document.getElementById('indicatorNoteInput').value = note;
  document.getElementById('indicatorNoteDate').value = date;

  document.getElementById('indicatorNoteModal').classList.remove('hidden');
}


  function closeIndicatorNoteModal() {
    document.getElementById('indicatorNoteModal').classList.add('hidden');
    currentIndicator = { row: null, color: null, btn: null };
  }

 function saveIndicatorNote() {
    const note = document.getElementById('indicatorNoteInput').value;
    const date = document.getElementById('indicatorNoteDate').value;

    const { row, color, btn } = currentIndicator;

    if (!indicatorNotes[row]) indicatorNotes[row] = {};
    indicatorNotes[row][color] = { note, date };

    const group = btn.closest('.indicator-group');
    const buttons = group.querySelectorAll('.indicator-btn');

    const idSafetiInput = btn.closest('tr').querySelector('.id-safeti');
    const idSafeti = idSafetiInput ? idSafetiInput.value : null;

    const isGray = btn.classList.contains('bg-gray-400');

    // ✅ Jika tombol yang diklik sedang abu, artinya mau diaktifkan kembali
   if (isGray) {
  btn.classList.remove('green', 'yellow', 'red', 'bg-gray-400');
  btn.classList.add(color);

  if (idSafeti) {
    fetch('/update-lampu-status', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        id_safeti: idSafeti,
        lampu: color,
        value: "true",
        status: 'Active' ,
        note: note,
        date: date

        // 💡 tambahkan status Active di sini
      })
    });

    // ✅ Update badge status di frontend
    const badgeCell = btn.closest('tr').querySelector('.safety-badge-cell');
    if (badgeCell) {
      badgeCell.innerHTML = `
        <span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">
          <i class="fas fa-medal mr-1"></i> Active
        </span>
      `;
    }
  }
}
else if (color === 'red') {
      // ✅ Kalau tombol merah aktif diklik → matikan semua
      buttons.forEach(b => {
        const bColor = b.dataset.color;
        b.classList.remove('green', 'yellow', 'red', 'bg-gray-400');
        b.classList.add('bg-gray-400');

        indicatorNotes[row][bColor] = null;

        if (idSafeti) {
          fetch('/update-lampu-status', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
              id_safeti: idSafeti,
              lampu: bColor,
              value: "false",
              status: 'Out',
              note: note,
              date: date,
              ismerah: "yes"

            })
          });
        }
      });

      // Update badge status jadi "Out"
      const badgeCell = btn.closest('tr').querySelector('.safety-badge-cell');
      if (badgeCell) {
        badgeCell.innerHTML = `
          <span class="inline-flex items-center px-2 py-1 rounded-full bg-gray-100 text-gray-800 text-xs font-semibold">
            <i class="fas fa-sign-out-alt mr-1"></i> Out
          </span>
        `;
      }
    } else {
      // ✅ Hijau/Kuning aktif diklik → matikan satu
      btn.classList.remove('green', 'yellow', 'red');
      btn.classList.add('bg-gray-400');
      indicatorNotes[row][color] = null;

      if (idSafeti) {
        fetch('/update-lampu-status', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({
            id_safeti: idSafeti,
            lampu: color,
            value: "false",
            note: note,
            date: date,
            ishistori:"yes",
          })
        });
      }
    }

    closeIndicatorNoteModal();
  }
</script>

<script>
function handleStartDateChange(startInput) {
  const row = startInput.closest('tr');
  const expiredInput = row.querySelector('input[type="date"]:not([onchange])');
  const idInput = row.querySelector('.id-safeti');

  if (!expiredInput || !idInput) return;

  const startDate = new Date(startInput.value);
  const expiredDate = new Date(startDate);
  expiredDate.setMonth(expiredDate.getMonth() + 6);
  const formatted = expiredDate.toISOString().split('T')[0];
  expiredInput.value = formatted;

  const badgeCell = row.querySelector('.safety-badge-cell');
  badgeCell.innerHTML = `
    <span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">
      <i class="fas fa-medal mr-1"></i> Active
    </span>
  `;

  // 🔁 Kirim AJAX ke backend
  fetch("{{ route('update.safety.status') }}", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({
      id_safeti: idInput.value,
      status: "Active",
       start_date: startInput.value,
      expired_date: formatted
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log("Status updated via AJAX.");
    } else {
      alert("Gagal update status.");
    }
  })
  .catch(error => {
    console.error("Error:", error);
    alert("Terjadi kesalahan.");
  });
}
</script>




<script>
function uploadPhoto(event, id_safeti) {
  const input = event.target;
  const file = input.files[0];
  if (!file) return;

  const formData = new FormData();
  formData.append('photo', file);
  formData.append('id_safeti', id_safeti);
  formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

  fetch('{{ route("upload.photo") }}', {
    method: 'POST',
    body: formData,
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      const img = document.getElementById('photo-preview-' + id_safeti);
      img.src = data.photo_url + '?t=' + new Date().getTime(); // untuk bypass cache
    } else {
      alert('Upload gagal.');
    }
  })
  .catch(err => {
    console.error('Upload error:', err);
    alert('Terjadi kesalahan saat upload.');
  });
}
</script>


<script>
function openImagePreviewModal(imageSrc) {
  const modal = document.getElementById('imagePreviewModal');
  const modalImg = document.getElementById('imagePreviewModalImg');

  modalImg.src = imageSrc;
  modal.classList.remove('hidden');
}

function closeImagePreviewModal() {
  const modal = document.getElementById('imagePreviewModal');
  const modalImg = document.getElementById('imagePreviewModalImg');

  modalImg.src = '';
  modal.classList.add('hidden');
}
</script>


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







    </script>
  <script>
               function resetFilters() {




        window.location.href = "{{ route('employee-safety-list') }}";
    }
    </script>

<script>
$(document).ready(function() {
    // Vendor search with keyup event
    $("#searchFilterInput").on("keyup", function(e) {
        // When Enter is pressed or 3+ characters typed
        if (e.keyCode == 13 || $(this).val().length > 2) {
            $("#formSearch").submit();  // Submit search form for vendors
        }
    });


});
</script>
<script>
    function selectTypeOption() {
        const form = document.getElementById('formType');
        const selectElement = document.getElementById('typeFilterPilihan');

        // Set value of the select element before submitting
        form.submit();
    }
</script>
<script>
    function selectStatusOption() {
        const form = document.getElementById('formStatus');
        const selectElement = document.getElementById('PilihStatus');

        // Set value of the select element before submitting
        form.submit();
    }
</script>
<script>
  function confirmReset(id) {
    Swal.fire({
      title: 'Yakin reset?',
      text: "Status akan direset permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, reset!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        const form = document.getElementById('resetForm-' + id);
        if (form) {
          form.submit();
        } else {
          console.error('Form tidak ditemukan untuk ID:', id);
        }
      }
    });
  }
</script>

<script>
function toggleDateInputs() {
  const filterValue = document.getElementById('expired30Filter').value;
  const input1 = document.getElementById('expiredDateInput1');
  const input2 = document.getElementById('expiredDateInput2');
  const filterDiv = document.getElementById('expiredDateFilterDiv');

  if (filterValue === 'expiredBefore' || filterValue === 'expiredAfter') {
    // Show the date inputs and the div containing them
    input1.classList.remove('hidden');
    input2.classList.remove('hidden');
    filterDiv.style.display = 'block'; // Make the div visible
  } else {
    // Hide the date inputs and the div containing them
    input1.classList.add('hidden');
    input2.classList.add('hidden');
    filterDiv.style.display = 'none'; // Hide the div completely
  }
}

// Initialize the page by ensuring inputs are hidden by default
window.onload = function() {
  toggleDateInputs();
}


</script>
  </body>
</html>

@endsection
