@extends('layouts.app')

@section('content')
    <style>
        #notificationsPanel {
        z-index: 9999 !important;
      }
      .table-container, .main-content, .content-area {
        overflow: visible !important;
      }
    </style>
   <style>
      html, body {
        height: 100%;
        overflow: hidden;
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
        top: 80px;
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

      /* Main content scrollbar */
      .main-content {
        height: calc(100vh - 64px);
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
        text-align: left;
        color: #374151;
        border-bottom: 1px solid #E5E7EB;
      }
      td {
        padding: 1rem;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #E5E7EB;
      }
      tr:hover {
        background-color: #F9FAFB;
      }
    </style>
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

      // Function to switch between Visitor and Vendor Permits tabs
      function switchTab(tabType) {
        // Hide all tab content
        document.querySelectorAll('.tab-content').forEach(item => {
          item.classList.remove('active');
        });
        // Show content for the selected tab
        document.getElementById(tabType).classList.add('active');

        // Update the active tab button style
        document.querySelectorAll('.left-tab-item').forEach(item => {
          item.classList.remove('active');
        });
        document.querySelector(`.left-tab-item[data-tab="${tabType}"]`).classList.add('active');
      }
    </script>

    <style>
      .tab-content {
        display: none;
      }
      .tab-content.active {
        display: block;
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
      .left-tab-item.active {
        background-color: #EFF6FF;
        border-left-color: #2563EB;
        color: #2563EB;
      }
    </style>

    <div class="main-content">
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
                <p class="text-sm text-gray-600">Open Permits</p>
                <p class="text-2xl font-semibold text-gray-900" id="openCount">{{ $openCount }}</p>
              </div>
              <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-check-circle text-green-600"></i>
              </div>
            </div>
          </div>
          <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-600">Closed Permits</p>
                <p class="text-2xl font-semibold text-gray-900" id="closedCount">{{ $closedCount }}</p>
              </div>
              <div class="p-3 bg-gray-100 rounded-full">
                <i class="fas fa-times-circle text-gray-600"></i>
              </div>
            </div>
          </div>
          <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-600">Expired Permits</p>
                <p class="text-2xl font-semibold text-gray-900" id="expiredCount">{{ $expiredCount }}</p>
              </div>
              <div class="p-3 bg-red-100 rounded-full">
                <i class="fas fa-exclamation-circle text-red-600"></i>
              </div>
            </div>
          </div>
          <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-600">Total Permits</p>
                <p class="text-2xl font-semibold text-gray-900" id="totalCount">{{ $totalCount }}</p>
              </div>
              <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-file-alt text-blue-600"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content Area -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
          <div class="flex">
            <!-- Left Tab -->
            <div class="left-tab">
              <div class="left-tab-item active" data-tab="visitor" onclick="switchTab('visitor')">
                <div class="flex items-center space-x-3">
                  <i class="fas fa-user text-blue-600"></i>
                  <span>Visitor Permits</span>
                </div>
              </div>
              <div class="left-tab-item" data-tab="vendor" onclick="switchTab('vendor')">
                <div class="flex items-center space-x-3">
                  <i class="fas fa-truck text-purple-600"></i>
                  <span>Work Permits</span>
                </div>
              </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1">
              <!-- Tab Content: Visitor Permits -->
              <div id="visitor" class="tab-content active">
                <!-- Filter Section for Visitor -->
           <div class="px-6 py-4 border-b border-gray-200 flex items-center gap-4 w-full">
    <form id="formSearchVisitor" method="get" class="flex-1">
        <input type="text" name="search_visitor" id="search_visitor" placeholder="Search Visitor..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </form>
    {{-- <select id="visitorDateFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="all">All Dates</option>
        <option value="today">Today</option>
        <option value="this_week">This Week</option>
        <option value="this_month">This Month</option>
    </select> --}}
    <form id="statusForm" method="GET">
        <select onchange="submitForm()" name="visitorStatusFilter" id="visitorStatusFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Status</option>
            <option value="Open">Open</option>
            <option value="Closed">Closed</option>
            <option value="Expired">Expired</option>
        </select>
    </form>
    <button type="button" onclick="resetFilters()" class="ml-4 text-red-500">
        <i class="fa fa-refresh"></i> Reset
    </button>
</div>


                <!-- Visitor Table -->
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
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="visitorTableBody">
                        @php

                       $iVisitor =1;
                        @endphp
  @foreach ($dataVisitor as $visitor)
 @if($visitor->visitor)
<tr id="permit-{{ $visitor->id_approved }}">
  <td class="px-4 py-4 text-sm font-medium text-gray-900">{{$iVisitor++}}</td>
  <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ $visitor->visitor->permit_number }}</td>
  <td class="px-4 py-4 text-sm text-gray-500">{{ $visitor->visitor->pic_name }}</td>
  <td class="px-4 py-4 text-sm text-gray-500">{{ $visitor->visitor->purpose_detail }}</td>
  <td class="px-4 py-4 text-sm text-gray-500">{{ $visitor->visitor->request_date_from }} - {{ $visitor->visitor->request_date_to }}</td>
<td class="px-4 py-4">
  <span class="permit-status px-2 py-1 text-xs font-medium rounded-full
    @if($visitor->status == 'Open')
      bg-green-100 text-green-800
    @elseif($visitor->status == 'Closed')
      bg-gray-100 text-gray-600
    @elseif($visitor->status == 'Expired')
      bg-red-100 text-red-800
    @endif">
    {{ $visitor->status }}
  </span>
</td>

  <td class="px-4 py-4 text-sm font-medium text-gray-900">

    <a href="{{route('visitor_view',$visitor->visitor->id_visitor)}}" class="action-btn view">
      <i class="fas fa-eye"></i>
    </a>
@if(Auth::user()->access_visvin_delete == 1)
<button @if($visitor->status == "Closed") disabled @else  @endif type="button" onclick="closePermit('{{ $visitor->id_approved }}')" class="action-btn close-btn @if($visitor->status == 'Closed') bg-gray-100 text-gray-600 @else bg-red-100 text-red-600 @endif hover:bg-red-200">
  <i class="fas fa-times-circle mr-1"></i> Close
</button>
@endif

  </td>
</tr>
@endif
  @endforeach
                    </tbody>
                  </table>
                  <div class="p-3">

                      {{ $dataVisitor->withQueryString()->links('pagination::tailwind') }}
                    </div>
                </div>
              </div>

              <!-- Tab Content: Vendor Permits -->
              <div id="vendor" class="tab-content">
                <!-- Filter Section for Vendor -->
               <div class="px-6 py-4 border-b border-gray-200 flex gap-4 w-full">
    <!-- Search Form -->
    <form id="searchFormVendor" method="get" class="flex-1">
        <input type="text" name="search_vendor" id="search_vendor" placeholder="Search Vendor..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </form>

    <!-- Date Filter -->
    {{-- <select id="vendorDateFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="all">All Dates</option>
        <option value="today">Today</option>
        <option value="this_week">This Week</option>
        <option value="this_month">This Month</option>
    </select> --}}

    <!-- Status Filter -->
    <form id="statusForm2" method="GET">
        <select onchange="submitForm2()" name="vendorStatusFilter" id="vendorStatusFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Status</option>
            <option value="Open">Open</option>
            <option value="Closed">Closed</option>
            <option value="Expired">Expired</option>
        </select>
    </form>

    <!-- Reset Button -->
    <button type="button" onclick="resetFilters()" class="ml-4 text-red-500">
        <i class="fa fa-refresh"></i> Reset
    </button>
</div>


                <!-- Vendor Table -->
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
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="vendorTableBody">
                          @php

                        $iVendor = 1;
                        @endphp
                        @foreach ($dataVendor as $vendor)
 @if ($vendor->vendor)

                <tr id="permit-{{ $vendor->id_approved }}">
  <td class="px-4 py-4 text-sm font-medium text-gray-900">{{$iVendor++}}</td>
  <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ $vendor->vendor->permit_number }}</td>
  <td class="px-4 py-4 text-sm text-gray-500">{{ $vendor->vendor->requestor_name }}</td>
  <td class="px-4 py-4 text-sm text-gray-500">{{ $vendor->vendor->work_description }}</td>
  <td class="px-4 py-4 text-sm text-gray-500">{{ $vendor->vendor->validity_date_from }} - {{ $vendor->vendor->validity_date_to }}</td>
<td class="px-4 py-4">
  <span class="permit-status px-2 py-1 text-xs font-medium rounded-full
    @if($vendor->status == 'Open')
      bg-green-100 text-green-800
    @elseif($vendor->status == 'Closed')
      bg-gray-100 text-gray-600
    @elseif($vendor->status == 'Expired')
      bg-red-100 text-red-800
    @endif">
    {{ $vendor->status }}
  </span>
</td>
  <td class="px-4 py-4 text-sm font-medium text-gray-900">
  <a href="{{route('vendor_view',$vendor->vendor->id_vendor)}}" class="action-btn view">
                  <i class="fas fa-eye"></i>
                </a>
                @if(Auth::user()->access_visvin_delete == 1)
              <button @if($vendor->status == "Closed") disabled @else  @endif type="button" onclick="closePermit('{{ $vendor->id_approved }}')" class="action-btn close-btn @if($vendor->status == "Closed") bg-gray-100 text-gray-600 @else bg-red-100 text-red-600 @endif hover:bg-red-200">
  <i class="fas fa-times-circle mr-1"></i> Close
</button>
@endif
  </td>
</tr>
@endif
 @endforeach


                    </tbody>
                  </table>
                </div>
                  <div class="p-3">

                      {{ $dataVendor->withQueryString()->links('pagination::tailwind') }}
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
       function resetFilters() {




        window.location.href = "{{ route('permit-data') }}";
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterVisitor = '{{ request('visitorStatusFilter') }}';
        const filterVendor = '{{ request('vendorStatusFilter') }}';

        if (filterVisitor) {
            switchTab('visitor');  // Automatically switch to visitor tab if search_visitor is present
        } else if (filterVendor) {
            switchTab('vendor');  // Automatically switch to vendor tab if search_vendor is present
        }
    });
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
            $("#formSearchVisitor").submit();  // Submit search form for visitors
        }
    });
});
</script>
    <script>

function closePermit(permitId) {
    const button = document.querySelector(`#permit-${permitId} .close-btn`);

    // Jika tombol sudah di-disable, tidak melakukan apa-apa lagi
    if (button.disabled) {
        return;
    }
  // Confirm before making the change
  if (confirm("Are you sure you want to close this permit?")) {


      button.disabled = true;
        button.classList.remove('bg-red-100', 'text-red-600');
        button.classList.add('bg-gray-100', 'text-gray-600', 'cursor-not-allowed'); // Disable cursor

    // Send the AJAX request
    $.ajax({
      url: '{{ route("updatePermitStatus") }}',  // Define route for updating status
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',  // CSRF token for security
        permit_id: permitId,           // Pass the permit ID
        status: 'Closed'               // Set the new status to 'closed'
      },
      success: function(response) {
        // If the status change is successful, update the status in the table
        if (response.status === 'success') {
          // Find the row with the matching permit ID and update the status column
          const row = document.getElementById('permit-' + permitId);
          row.querySelector('.permit-status').innerHTML = 'Closed';
          row.querySelector('.permit-status').classList.remove('bg-green-100', 'text-green-800');
          row.querySelector('.permit-status').classList.add('bg-gray-100', 'text-gray-600');
        } else {
          alert('Failed to close permit. Please try again.');
        }
      },
      error: function(xhr, status, error) {
        alert('An error occurred. Please try again.');
      }
    });
  }
}

    </script>
@endsection
