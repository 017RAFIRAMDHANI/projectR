@extends('layouts.app')

@section('content')
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
      /* Pagination styles */
      .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
        padding: 1rem;
        background-color: white;
        border-top: 1px solid #E5E7EB;
      }
      .pagination button {
        padding: 0.5rem 1rem;
        border: 1px solid #E5E7EB;
        border-radius: 0.375rem;
        background-color: white;
        color: #374151;
        font-size: 0.875rem;
        transition: all 0.2s;
      }
      .pagination button:hover:not(:disabled) {
        background-color: #F3F4F6;
      }
      .pagination button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
      }
      .pagination button.active {
        background-color: #2563EB;
        color: white;
        border-color: #2563EB;
      }
      .pagination-info {
        font-size: 0.875rem;
        color: #6B7280;
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
                <p class="text-2xl font-semibold text-gray-900" id="openCount">0</p>
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
                <p class="text-2xl font-semibold text-gray-900" id="closedCount">0</p>
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
                <p class="text-2xl font-semibold text-gray-900" id="expiredCount">0</p>
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
                <p class="text-2xl font-semibold text-gray-900" id="totalCount">0</p>
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
                  <span>Vendor Permits</span>
                </div>
              </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1">
              <!-- Tab Content: Visitor Permits -->
              <div id="visitor" class="tab-content active">
                <!-- Filter Section for Visitor -->
                <div class="px-6 py-4 border-b border-gray-200 flex gap-4">
                  <input type="text" id="visitorSearchFilter" placeholder="Search Visitor..." class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                  <select id="visitorDateFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Dates</option>
                    <option value="today">Today</option>
                    <option value="this_week">This Week</option>
                    <option value="this_month">This Month</option>
                  </select>
                  <select id="visitorStatusFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Statuses</option>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                    <option value="expired">Expired</option>
                  </select>
                </div>

                <!-- Visitor Table -->
                <div class="content-area">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="table-header">
                      <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit Info</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="visitorTableBody">
  @foreach ($dataVisitor as $visitor)
 @if($visitor->visitor)
<tr id="permit-{{ $visitor->id_approved }}">
  <td class="px-4 py-4 text-sm font-medium text-gray-900">#</td>
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
    <button type="button" onclick="viewPermitDetails('{{ $visitor->id_approved }}', 'visitor')" class="action-btn view">
      <i class="fas fa-eye"></i>
    </button>
    <button type="button" onclick="closePermit('{{ $visitor->id_approved }}')" class="action-btn bg-red-100 text-red-600 hover:bg-red-200">
      <i class="fas fa-times-circle mr-1"></i> Close
    </button>
  </td>
</tr>
@endif
  @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Tab Content: Vendor Permits -->
              <div id="vendor" class="tab-content">
                <!-- Filter Section for Vendor -->
                <div class="px-6 py-4 border-b border-gray-200 flex gap-4">
                  <input type="text" id="vendorSearchFilter" placeholder="Search Vendor..." class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                  <select id="vendorDateFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Dates</option>
                    <option value="today">Today</option>
                    <option value="this_week">This Week</option>
                    <option value="this_month">This Month</option>
                  </select>
                  <select id="vendorStatusFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Statuses</option>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                    <option value="expired">Expired</option>
                  </select>
                </div>

                <!-- Vendor Table -->
                <div class="content-area">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="table-header">
                      <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit Info</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="vendorTableBody">
                        @foreach ($dataVendor as $vendor)
 @if ($vendor->vendor)

                <tr id="permit-{{ $vendor->id_approved }}">
  <td class="px-4 py-4 text-sm font-medium text-gray-900">#</td>
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
  <button type="button" onclick="viewPermitDetails('V002', 'visitor')" class="action-btn view">
                  <i class="fas fa-eye"></i>
                </button>
              <button type="button" onclick="closePermit('{{ $vendor->id_approved }}')" class="action-btn bg-red-100 text-red-600 hover:bg-red-200">
  <i class="fas fa-times-circle mr-1"></i> Close
</button>

  </td>
</tr>
@endif
 @endforeach


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

function closePermit(permitId) {
  // Confirm before making the change
  if (confirm("Are you sure you want to close this permit?")) {
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
