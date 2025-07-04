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
      .action-btn {
        padding: 4px 8px;
        border-radius: 4px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 28px;
        margin: 0 2px;
      }
      .action-btn:hover {
        transform: translateY(-1px);
      }
      .action-btn.edit {
        background-color: rgba(37, 99, 235, 0.1);
        color: #2563eb;
      }
      .action-btn.edit:hover {
        background-color: rgba(37, 99, 235, 0.2);
      }
      .action-btn.view {
        background-color: rgba(107, 114, 128, 0.1);
        color: #4b5563;
      }
      .action-btn.view:hover {
        background-color: rgba(107, 114, 128, 0.2);
      }
      .action-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 4px;
      }
      .modal {
        display: none;
        position: fixed;
        z-index: 50;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
      }
      .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 1.5rem;
        border-radius: 0.5rem;
        width: 90%;
        max-width: 32rem;
        position: relative;
      }
      .close {
        position: absolute;
        right: 1rem;
        top: 1rem;
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
        color: #6B7280;
      }
      .close:hover {
        color: #374151;
      }
      /* Custom scrollbar styles */
      .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #CBD5E0 #EDF2F7;
      }
      .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
      }
      .custom-scrollbar::-webkit-scrollbar-track {
        background: #EDF2F7;
        border-radius: 4px;
      }
      .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #CBD5E0;
        border-radius: 4px;
      }
      .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #A0AEC0;
      }
      /* Table container styles */
      .table-container {
        overflow: visible;
      }
      /* Fixed header styles */
      .table-header {
        position: sticky;
        top: 0;
        background-color: #F9FAFB;
        z-index: 10;
      }
      /* Left tab styles */
      .left-tab {
        position: sticky;
        top: 80px; /* Navbar height + some spacing */
        width: 200px;
        background-color: #F9FAFB;
        border-right: 1px solid #E5E7EB;
        height: fit-content;
        z-index: 20;
      }
      .left-tab-item {
        padding: 12px 16px;
        cursor: pointer;
        border-left: 3px solid transparent;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
      .left-tab-item:hover {
        background-color: #F3F4F6;
      }
      .left-tab-item.active {
        background-color: #EFF6FF;
        border-left-color: #2563EB;
        color: #2563EB;
      }
      .left-tab-item i {
        width: 20px;
        text-align: center;
      }
      .tab-content {
        display: none;
      }
      .tab-content.active {
        display: block;
      }

      .main-content {
        height: calc(100vh - 64px); /* Subtract navbar height */
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #CBD5E0 #EDF2F7;
      }
      .main-content::-webkit-scrollbar {
        width: 8px;
      }
      .main-content::-webkit-scrollbar-track {
        background: #EDF2F7;
        border-radius: 4px;
      }
      .main-content::-webkit-scrollbar-thumb {
        background-color: #CBD5E0;
        border-radius: 4px;
      }
      .main-content::-webkit-scrollbar-thumb:hover {
        background-color: #A0AEC0;
      }
      /* Content area styles */
      .content-area {
        overflow: visible;
      }
      /* Table styles */
      table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
      }
      th {
        position: sticky;
        top: 0;
        background-color: #F9FAFB;
        z-index: 10;
        padding: 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #374151;
        border-bottom: 2px solid #E5E7EB;
        white-space: nowrap;
      }
      th:first-child {
        width: 40px;
        padding: 1rem 0.5rem;
        text-align: center;
      }
      td {
        padding: 1rem;
        font-size: 0.875rem;
        color: #4B5563;
        border-bottom: 1px solid #E5E7EB;
      }
      td:first-child {
        width: 40px;
        padding: 1rem 0.5rem;
        text-align: center;
        color: #6B7280;
        font-size: 0.75rem;
      }
      tr:hover {
        background-color: #F9FAFB;
      }
      /* Status badge styles */
      .permit-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
      }
      /* Action button styles */
      .action-container {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
      }
      .action-btn {
        padding: 0.375rem;
        border-radius: 0.375rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }
      .action-btn.view {
        background-color: #EFF6FF;
        color: #2563EB;
      }
      .action-btn.view:hover {
        background-color: #DBEAFE;
      }
      .action-btn.edit {
        background-color: #FEF3C7;
        color: #92400E;
      }
      .action-btn.edit:hover {
        background-color: #FDE68A;
      }
    </style>
  </head>
  <body class="bg-gray-50">


    <!-- Main Content -->
    <div class="main-content">
        <!-- Back to Dashboard Button -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-4">
                <a href="{{route('/')}}" class="inline-flex items-center text-gray-600 hover:text-primary transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Back to Dashboard</span>
                </a>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Visitor Permits</p>
                            <p class="text-2xl font-semibold text-gray-900" id="visitorCount">{{$jmlvisitors}}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-user-friends text-blue-600"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Vendor Permits</p>
                            <p class="text-2xl font-semibold text-gray-900" id="vendorCount">{{$jmlvendors}}</p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-full">
                            <i class="fas fa-truck text-purple-600"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Pending Approvals</p>
                            <p class="text-2xl font-semibold text-gray-900" id="totalPendingCount">{{$jmlpending}}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <i class="fas fa-clock text-yellow-600"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Urgent Permits</p>
                            <p class="text-2xl font-semibold text-gray-900" id="urgentCount">{{$jmlurgent}}</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-full">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex">
                    <!-- Left Tab -->
                    <div class="left-tab">
                        <div class="left-tab-item active" onclick="switchTab('visitor')">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-user text-blue-600"></i>
                                <span>Visitor Permits</span>
                            </div>
                        </div>
                        <div class="left-tab-item" onclick="switchTab('vendor')">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-truck text-purple-600"></i>
                                <span>Work Permits</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div class="flex-1 bg-white rounded-lg shadow-sm border border-gray-200">
                        <!-- Visitor Tab Content -->
                        <div id="visitor-tab" class="tab-content active">
                            <!-- Filter Visitor -->
                   <div class="px-5 py-4 border-b border-gray-200 flex items-center gap-4 bg-white">
    <form id="searchFormVisitor" method="GET" action="{{ route('index_approve') }}" class="w-full">
        <input
            type="text"
            id="search_visitor"
            name="search_visitor"
            value="{{ $searchVisitor ?? '' }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Search Visitor"
        >
    </form>
<form id="statusForm" method="GET"  >

    <select
        id="visitorStatusFilter"
        name="status_filter_visitor"
        class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        onchange="submitForm()"
    >
        <option value="">All Status</option>
        <option value="Pending" {{ $statusFilterVisitor == 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="Approved" {{ $statusFilterVisitor == 'Approved' ? 'selected' : '' }}>Approved</option>
        <option value="Rejected" {{ $statusFilterVisitor == 'Rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
</form>
<form id="dateForm" method="GET" >
    <input
        type="date"
        id="visitorDateFilter"
          name="date_filter_visitor"
        class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
               onchange="submitDateVisitor()"
                  value="{{ old('date_filter_visitor', $dateFilterVisitor ?? '') }}"
    />
</form>
  <button type="button" onclick="resetFilters()" class="ml-4 text-red-500">
        <i class="fa fa-refresh"></i> Reset
    </button>
</div>

                            <div class="content-area">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit Info</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requester</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                     @if(Auth::user()->access_approvals_view == 1 || Auth::user()->access_approvals_edit == 1)
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="visitorTableBody">
                                         @php
                                           $i = $visitors->firstItem();
                                        @endphp
@foreach ($visitors as  $visitor)
                   <tr id="permit-VD001" class="visitor-permit permit-item" >
                      <td class="px-4 py-2">{{ $i++ }}</td>
                    <td class="px-4 py-2">{{ $visitor->permit_number ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $visitor->pic_name ?? '' }}</td>
                    <td class="px-4 py-2">{{ $visitor->purpose_visit ?? '' }}</td>
                    <td class="px-4 py-2">{{ $visitor->request_date_to ?? '' }}</td>
                  <td class="px-4 py-2">
    <span class="permit-status px-2 py-1 text-xs font-medium rounded-full
        {{ $visitor->status == 'Rejected' ? 'bg-red-100 text-red-800' : '' }}
        {{ $visitor->status == 'Approved' ? 'bg-green-100 text-green-800' : '' }}
        {{ $visitor->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
        {{ $visitor->status }}
    </span>
</td>

                   <td class="px-4 py-4 text-sm font-medium">
             <div class="action-container">
         @if(Auth::user()->access_approvals_view == 1)
              <button onclick="window.location.href='{{ route('visitor_view', $visitor->id_visitor) }}'" class="action-btn view" title="View Details">

                <i class="fas fa-eye text-xs"></i>
              </button>
@endif
         @if(Auth::user()->access_approvals_edit == 1)
 @if($visitor->status == "Rejected" && $visitor->check_one_approve == null)
<form id="approve-form-{{$visitor->id_visitor}}" action="{{route('visitor.approve')}}" method="POST">
    @csrf
    <input type="hidden" name="id_visitor" value="{{$visitor->id_visitor}}">
    <button type="button" class="action-btn edit approve-btn" data-id="{{$visitor->id_visitor}}" title="Approve Permit">
            <i class="fas fa-edit text-xs"></i> Approve
    </button>
</form>

@endif
@endif
            </div>
          </td>
                </tr>
            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="pagination p-3">
                                {{ $visitors->withQueryString()->links('pagination::tailwind') }}
                            </div>
                        </div>

                        <!-- Vendor Tab Content -->
                        <div id="vendor-tab" class="tab-content">
                            <!-- Filter Vendor -->
                       <div class="px-6 py-4 border-b border-gray-200 flex items-center gap-4 bg-white">
    <!-- Search Vendor Form -->
    <form id="searchFormVendor" method="GET" class="flex-1 w-full">
        <input
            type="text"
            id="search_vendor"
            name="search_vendor"
            value="{{ $searchVendor ?? '' }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Search Vendor"
        >
    </form>
    <form id="statusForm2" method="GET"  >
<select
        id="vendorStatusFilter"
        name="status_filter_vendor"
        class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
       onchange="submitForm2()"
    >

        <option value="">All Status</option>
        <option value="Pending" {{ $statusFilterVisitor == 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="Approved" {{ $statusFilterVisitor == 'Approved' ? 'selected' : '' }}>Approved</option>
        <option value="Rejected" {{ $statusFilterVisitor == 'Rejected' ? 'selected' : '' }}>Rejected</option>
    </select></form>
                             <form id="dateForm2" method="GET" >
    <input
        type="date"
        id="vendorDateFilter"
          name="date_filter_vendor"
        class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
               onchange="submitDateVendor()"
                  value="{{ old('date_filter_vendor', $dateFilterVendor ?? '') }}"
    />
</form>
  <button type="button" onclick="resetFilters()" class="ml-4 text-red-500">
        <i class="fa fa-refresh"></i><br> Reset
    </button>
 </div>
                            <div class="content-area">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="table-header">
                                        <tr>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit Info</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requester</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                              @if(Auth::user()->access_approvals_view == 1 || Auth::user()->access_approvals_edit == 1)
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="vendorTableBody">
                                        @php
                                           $i = $vendors->firstItem();
                                        @endphp
  @foreach ($vendors as  $vendor)
                   <tr id="permit-VD001" class="vendor-permit permit-item" @if($vendor->mode == "Urgent" ) style="background-color: rgb(254, 242, 242) !important; border-left: 4px solid rgb(239, 68, 68) !important;" @endif>
                      <td class="px-4 py-2">{{ $i++ }}</td>
                    <td class="px-4 py-2">{{ $vendor->permit_number ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $vendor->requestor_name ?? '' }}</td>
                    <td class="px-4 py-2">{{ $vendor->work_description ?? '' }}</td>
                    <td class="px-4 py-2">{{ $vendor->validity_date_to ?? '' }}</td>
                  <td class="px-4 py-2">
    <span class="permit-status px-2 py-1 text-xs font-medium rounded-full
        {{ $vendor->status == 'Rejected' ? 'bg-red-100 text-red-800' : '' }}
        {{ $vendor->status == 'Approved' ? 'bg-green-100 text-green-800' : '' }}
        {{ $vendor->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
        {{ $vendor->status }}
    </span>
</td>

                   <td class="px-4 py-4 text-sm font-medium">
            <div class="action-container">
         @if(Auth::user()->access_approvals_view == 1)
              <button onclick="window.location.href='{{ route('vendor_view', $vendor->id_vendor) }}'" class="action-btn view" title="View Details">

                <i class="fas fa-eye text-xs"></i>
              </button>
@endif
         @if(Auth::user()->access_approvals_edit == 1)
 @if($vendor->status == "Rejected" && $vendor->check_one_approve == null)
    <form id="approve-form-vendor-{{$vendor->id_vendor}}" action="{{route('vendors.approve')}}" method="POST">
      @csrf
      <input type="hidden" name="id_vendor" value="{{$vendor->id_vendor}}">
      <button type="button" class="action-btn edit approve-btn-vendor" data-id="{{$vendor->id_vendor}}" title="Approve Vendor Permit">
        <i class="fas fa-edit text-xs"></i> Approve
      </button>
    </form>

@endif
@endif
            </div>
          </td>
                </tr>
            @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination p-3">

                                 {{ $vendors->withQueryString()->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Change Status</h2>
        <p class="text-sm text-gray-600 mb-4">
          This action can only be performed once. Once approved, if you need to reject this permit,
          please use the Close Permit menu instead.
        </p>
        <div class="flex justify-end space-x-3">
          <button onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
            Cancel
          </button>
          <button onclick="approvePermit()" class="px-4 py-2 bg-green-500 text-white rounded-md text-sm hover:bg-green-600">
            Approve
          </button>
        </div>
      </div>
    </div>
 <script>
document.addEventListener("DOMContentLoaded", function () {
  // Gunakan event delegation dengan menambahkan event listener ke body
  document.body.addEventListener("click", function (e) {
    if (e.target && e.target.matches(".approve-btn")) {  // Jika elemen yang diklik adalah tombol approve-btn
      e.preventDefault();  // Menghindari form submit langsung

      const id = e.target.getAttribute('data-id');  // Mendapatkan ID untuk form yang sesuai
      const form = document.getElementById('approve-form-' + id);  // Menentukan form berdasarkan ID

      // Log untuk memeriksa apakah tombol dan form ditemukan
      console.log("Tombol approve-btn diklik");
      console.log("ID Form: ", id);

      if (form) {
        console.log("Form ditemukan untuk ID: ", id);
      } else {
        console.log("Form tidak ditemukan untuk ID: ", id);
      }

      // Menampilkan SweetAlert untuk konfirmasi
      Swal.fire({
        title: 'Approve Permit?',
        text: "Apakah Anda yakin ingin menyetujui permit ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Setujui!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Log untuk menunjukkan jika tombol konfirmasi di klik
          console.log("Konfirmasi diterima. Menyubmit form.");
          if (form) {
            form.submit();  // Kirim form jika form ada
          }
        } else {
          console.log("Konfirmasi dibatalkan.");
        }
      });
    }
  });
});




</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
  // Event listener untuk tombol approve-btn pada form vendor
  document.body.addEventListener("click", function (e) {
    if (e.target && e.target.matches(".approve-btn-vendor")) {  // Tombol approve-btn untuk vendor
      e.preventDefault();  // Menghindari form submit langsung

      const id = e.target.getAttribute('data-id');  // Mendapatkan ID untuk form yang sesuai
      const form = document.getElementById('approve-form-vendor-' + id);  // Menentukan form berdasarkan ID

      // Log untuk memeriksa apakah tombol dan form ditemukan
      console.log("Tombol approve-btn (Vendor) diklik");
      console.log("ID Form: ", id);
      if (form) {
        console.log("Form ditemukan untuk Vendor ID: ", id);
      } else {
        console.log("Form tidak ditemukan untuk Vendor ID: ", id);
      }

      // Menampilkan SweetAlert untuk konfirmasi
      Swal.fire({
        title: 'Approve Work Permit?',
        text: "Are you sure you want to approve this work permit?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Setujui!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Log untuk menunjukkan jika tombol konfirmasi di klik
          console.log("Konfirmasi diterima. Menyubmit form (Vendor).");
          if (form) {
            form.submit();  // Kirim form jika form ada
          }
        } else {
          console.log("Konfirmasi dibatalkan (Vendor).");
        }
      });
    }
  });
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchVisitor = '{{ request('search_visitor') }}';
        const searchVendor = '{{ request('search_vendor') }}';

        if (searchVisitor) {
            switchTab('visitor');  // Automatically switch to visitor tab if search_visitor is present
        } else if (searchVendor) {
            switchTab('vendor');  // Automatically switch to vendor tab if search_vendor is present
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterVisitor = '{{ request('status_filter_visitor') }}';
        const filterVendor = '{{ request('status_filter_vendor') }}';

        if (filterVisitor) {
            switchTab('visitor');  // Automatically switch to visitor tab if search_visitor is present
        } else if (filterVendor) {
            switchTab('vendor');  // Automatically switch to vendor tab if search_vendor is present
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateVisitor = '{{ request('date_filter_visitor') }}';
        const dateVendor = '{{ request('date_filter_vendor') }}';

        if (dateVisitor) {
            switchTab('visitor');  // Automatically switch to visitor tab if search_visitor is present
        } else if (dateVendor) {
            switchTab('vendor');  // Automatically switch to vendor tab if search_vendor is present
        }
    });
</script>
<script>
       function resetFilters() {




        window.location.href = "{{ route('index_approve') }}";
    }
</script>
<script>
    function submitForm() {
        const form = document.getElementById('statusForm');
        const selectElement = document.getElementById('visitorStatusFilter');

        // Set value of the select element before submitting
        form.submit();
    }
</script>
<script>
    function submitForm2() {
        const form = document.getElementById('statusForm2');
        const selectElement = document.getElementById('vendorStatusFilter');

        // Set value of the select element before submitting
        form.submit();
    }
</script>
<script>
    // Function to submit search form when a status is selected
//    function submitSearchForm(type) {
//     const searchQuery = document.getElementById('search_visitor').value;
//     const statusFilter = document.getElementById('visitorStatusFilter').value;

//     let queryString = '?';

//     if (searchQuery) {
//         queryString += 'search_visitor=' + searchQuery + '&';
//     }

//     if (statusFilter && statusFilter !== 'all') {
//         queryString += 'status_filter=' + statusFilter;
//     }

//     window.location.href = window.location.pathname + queryString;
// }

</script>
<script>
 function switchTab(type) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });

    // Show selected tab content
    document.getElementById(`${type}-tab`).classList.add('active');

    // Update tab items
    document.querySelectorAll('.left-tab-item').forEach(item => {
        item.classList.remove('active');
    });
    document.querySelectorAll('.left-tab-item').forEach(item => {
        if (item.textContent.toLowerCase().includes(type)) {
            item.classList.add('active');
        }
    });

    // Update counts
    updateCounts();
}

// Function to update counts (optional)
function updateCounts() {
    const visitorCount = visitorData.length;
    const vendorCount = vendorData.length;
    const pendingCount = [...visitorData, ...vendorData].filter(item => item.status.toLowerCase() === 'pending').length;

    document.getElementById('visitorCount').textContent = visitorCount;
    document.getElementById('vendorCount').textContent = vendorCount;
    document.getElementById('totalPendingCount').textContent = pendingCount;
}

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Vendor search with keyup event
    $("#search_vendor").on("keyup", function(e) {
        // When Enter is pressed or 3+ characters typed
        if (e.keyCode == 13 || $(this).val().length > 2) {
            $("#searchFormVendor").submit();  // Submit search form for vendors
        }
    });

    // Visitor search with keyup event
    $("#search_visitor").on("keyup", function(e) {
        // When Enter is pressed or 3+ characters typed
        if (e.keyCode == 13 || $(this).val().length > 2) {
            $("#searchFormVisitor").submit();  // Submit search form for visitors
        }
    });
});
</script>

<script>
     function submitDateVisitor() {
        const form = document.getElementById('dateForm');
        const dateInput = document.getElementById('visitorDateFilter');

        // Set value of the input field before submitting
        form.submit();
    }
</script>
<script>
     function submitDateVendor() {
        const form = document.getElementById('dateForm2');
        const dateInput = document.getElementById('vendorDateFilter');

        // Set value of the input field before submitting
        form.submit();
    }
</script>

  </body>
</html>


@endsection
