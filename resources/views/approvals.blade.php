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
    <script>

      // Function to view permit details
      function viewPermitDetails(permitId, type, data) {
        // Redirect to the permit details page
        window.location.href = `permit-details.html?id=${permitId}&type=${type}`;
      }

      // Function to close the permit details modal
      function closePermitDetailsModal() {
        document.getElementById('permitDetailsModal').classList.add('hidden');
      }

      // Function to approve permit
      function approvePermit(permitId, type) {
        // In a real application, this would send a request to the server
        alert(`Permit ${permitId} (${type}) has been approved.`);

        // Update UI to reflect the change
        const permitElement = document.getElementById(`permit-${permitId}`);
        const statusElement = permitElement.querySelector('.permit-status');

        statusElement.textContent = 'Approved';
        statusElement.classList.remove('bg-yellow-100', 'text-yellow-800');
        statusElement.classList.add('bg-green-100', 'text-green-800');

        // Disable action buttons
        const actionButtons = permitElement.querySelectorAll('.action-buttons button');
        actionButtons.forEach(button => {
          button.disabled = true;
          button.classList.add('opacity-50', 'cursor-not-allowed');
        });

        // Update counts
        updatePermitCounts();
      }

      // Function to reject permit
      function rejectPermit(permitId, type) {
        // In a real application, this would send a request to the server
        alert(`Permit ${permitId} (${type}) has been rejected.`);

        // Update UI to reflect the change
        const permitElement = document.getElementById(`permit-${permitId}`);
        const statusElement = permitElement.querySelector('.permit-status');

        statusElement.textContent = 'Rejected';
        statusElement.classList.remove('bg-yellow-100', 'text-yellow-800');
        statusElement.classList.add('bg-red-100', 'text-red-800');

        // Disable action buttons
        const actionButtons = permitElement.querySelectorAll('.action-buttons button');
        actionButtons.forEach(button => {
          button.disabled = true;
          button.classList.add('opacity-50', 'cursor-not-allowed');
        });

        // Update counts
        updatePermitCounts();
      }

      // Function to update permit counts
      function updatePermitCounts() {
        const visitorPendingCount = document.querySelectorAll('.visitor-permit .permit-status:not(.bg-green-100):not(.bg-red-100)').length;
        const vendorPendingCount = document.querySelectorAll('.vendor-permit .permit-status:not(.bg-green-100):not(.bg-red-100)').length;

        document.getElementById('visitorPendingCount').textContent = visitorPendingCount;
        document.getElementById('vendorPendingCount').textContent = vendorPendingCount;
        document.getElementById('totalPendingCount').textContent = visitorPendingCount + vendorPendingCount;
      }

      // Function to filter permits
      function filterPermits() {
        const typeFilter = document.getElementById('typeFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;
        const searchFilter = document.getElementById('searchFilter').value.toLowerCase();

        const permits = document.querySelectorAll('.permit-item');

        permits.forEach(permit => {
          const permitType = permit.classList.contains('visitor-permit') ? 'visitor' : 'vendor';
          const permitStatus = permit.querySelector('.permit-status').textContent.trim().toLowerCase();
          const permitText = permit.textContent.toLowerCase();

          const typeMatch = typeFilter === 'all' || (typeFilter === 'visitor' && permitType === 'visitor') || (typeFilter === 'vendor' && permitType === 'vendor');
          const statusMatch = statusFilter === 'all' || (statusFilter === 'pending' && permitStatus === 'pending') || (statusFilter === 'approved' && permitStatus === 'approved') || (statusFilter === 'rejected' && permitStatus === 'rejected');
          const searchMatch = searchFilter === '' || permitText.includes(searchFilter);

          if (typeMatch && statusMatch && searchMatch) {
            permit.classList.remove('hidden');
          } else {
            permit.classList.add('hidden');
          }
        });
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

      // Add event listeners for filters
      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('typeFilter').addEventListener('change', filterPermits);
        document.getElementById('statusFilter').addEventListener('change', filterPermits);
        document.getElementById('searchFilter').addEventListener('input', filterPermits);
      });
    </script>
  </head>
  <body class="bg-gray-50">
    <!-- Navbar -->


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Permit Approvals</h1>
        <div class="flex space-x-2">
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
            Visitor: <span id="visitorPendingCount">3</span> Pending
          </span>
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-purple-100 text-purple-800">
            Vendor: <span id="vendorPendingCount">2</span> Pending
          </span>
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">
            Total: <span id="totalPendingCount">5</span> Pending
          </span>
        </div>
      </div>

      <!-- Filters -->
      <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label for="typeFilter" class="block text-sm font-medium text-gray-700 mb-1">Permit Type</label>
            <select id="typeFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="all">All Types</option>
              <option value="visitor">Visitor</option>
              <option value="vendor">Vendor</option>
            </select>
          </div>
          <div>
            <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="statusFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="all">All Status</option>
              <option value="pending">Pending</option>
              <option value="approved">Approved</option>
              <option value="rejected">Rejected</option>
            </select>
          </div>
          <div>
            <label for="searchFilter" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input
              type="text"
              id="searchFilter"
              placeholder="Search permits..."
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
            >
          </div>
        </div>
      </div>

      <!-- Permits Table -->
      <div class="bg-white rounded-lg shadow-sm overflow-x-auto">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit Number</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Visitor Permit 1 -->
              <tr id="permit-V001" class="visitor-permit permit-item hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0001</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Smith</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Visitor</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Client Meeting</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 2:00 PM - 4:00 PM</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium action-buttons">
                  <button onclick="viewPermitDetails('V001', 'visitor', {
                    permitNumber: 'DHI/PERMIT/2024/04/0001',
                    applicantName: 'John Smith',
                    purpose: 'Client Meeting',
                    location: 'Main Conference Room',
                    startDate: 'Today, 2:00 PM',
                    endDate: 'Today, 4:00 PM',
                    status: 'Pending',
                    submittedDate: 'April 15, 2024, 10:30 AM'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="approvePermit('V001', 'visitor')" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-3 py-1 rounded mr-2 transition">
                    <i class="fas fa-check mr-1"></i> Approve
                  </button>
                  <button onclick="rejectPermit('V001', 'visitor')" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded transition">
                    <i class="fas fa-times mr-1"></i> Reject
                  </button>
                </td>
              </tr>

              <!-- Visitor Permit 2 -->
              <tr id="permit-V002" class="visitor-permit permit-item">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0002</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sarah Johnson</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Visitor</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Job Interview</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tomorrow, 10:00 AM - 11:30 AM</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium action-buttons">
                  <button onclick="viewPermitDetails('V002', 'visitor', {
                    permitNumber: 'DHI/PERMIT/2024/04/0002',
                    applicantName: 'Sarah Johnson',
                    purpose: 'Job Interview',
                    location: 'HR Office',
                    startDate: 'Tomorrow, 10:00 AM',
                    endDate: 'Tomorrow, 11:30 AM',
                    status: 'Pending',
                    submittedDate: 'April 16, 2024, 9:15 AM'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="approvePermit('V002', 'visitor')" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-3 py-1 rounded mr-2 transition">
                    <i class="fas fa-check mr-1"></i> Approve
                  </button>
                  <button onclick="rejectPermit('V002', 'visitor')" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded transition">
                    <i class="fas fa-times mr-1"></i> Reject
                  </button>
                </td>
              </tr>

              <!-- Visitor Permit 3 -->
              <tr id="permit-V003" class="visitor-permit permit-item">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0003</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Michael Brown</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Visitor</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Project Review</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">April 20, 2024, 1:00 PM - 3:00 PM</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium action-buttons">
                  <button onclick="viewPermitDetails('V003', 'visitor', {
                    permitNumber: 'DHI/PERMIT/2024/04/0003',
                    applicantName: 'Michael Brown',
                    purpose: 'Project Review',
                    location: 'Project Room 3',
                    startDate: 'April 20, 2024, 1:00 PM',
                    endDate: 'April 20, 2024, 3:00 PM',
                    status: 'Pending',
                    submittedDate: 'April 17, 2024, 2:45 PM'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="approvePermit('V003', 'visitor')" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-3 py-1 rounded mr-2 transition">
                    <i class="fas fa-check mr-1"></i> Approve
                  </button>
                  <button onclick="rejectPermit('V003', 'visitor')" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded transition">
                    <i class="fas fa-times mr-1"></i> Reject
                  </button>
                </td>
              </tr>

              <!-- Vendor Permit 1 -->
              <tr id="permit-VD001" class="vendor-permit permit-item">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0004</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tech Solutions Inc.</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">Vendor</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Server Maintenance</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 3:00 PM - 5:00 PM</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium action-buttons">
                  <button onclick="viewPermitDetails('VD001', 'vendor', {
                    permitNumber: 'DHI/PERMIT/2024/04/0004',
                    applicantName: 'Tech Solutions Inc.',
                    purpose: 'Server Maintenance',
                    location: 'Server Room',
                    startDate: 'Today, 3:00 PM',
                    endDate: 'Today, 5:00 PM',
                    status: 'Pending',
                    submittedDate: 'April 16, 2024, 11:20 AM'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="approvePermit('VD001', 'vendor')" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-3 py-1 rounded mr-2 transition">
                    <i class="fas fa-check mr-1"></i> Approve
                  </button>
                  <button onclick="rejectPermit('VD001', 'vendor')" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded transition">
                    <i class="fas fa-times mr-1"></i> Reject
                  </button>
                </td>
              </tr>

              <!-- Vendor Permit 2 -->
              <tr id="permit-VD002" class="vendor-permit permit-item">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0005</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Clean Pro Services</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">Vendor</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Office Cleaning</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tomorrow, 8:00 AM - 10:00 AM</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium action-buttons">
                  <button onclick="viewPermitDetails('VD002', 'vendor', {
                    permitNumber: 'DHI/PERMIT/2024/04/0005',
                    applicantName: 'Clean Pro Services',
                    purpose: 'Office Cleaning',
                    location: 'Entire Office Area',
                    startDate: 'Tomorrow, 8:00 AM',
                    endDate: 'Tomorrow, 10:00 AM',
                    status: 'Pending',
                    submittedDate: 'April 17, 2024, 3:30 PM'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="approvePermit('VD002', 'vendor')" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-3 py-1 rounded mr-2 transition">
                    <i class="fas fa-check mr-1"></i> Approve
                  </button>
                  <button onclick="rejectPermit('VD002', 'vendor')" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded transition">
                    <i class="fas fa-times mr-1"></i> Reject
                  </button>
                </td>
              </tr>

              <!-- Approved Permit Example -->
              <tr id="permit-V004" class="visitor-permit permit-item">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0006</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Emily Davis</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Visitor</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Client Presentation</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">April 18, 2024, 9:00 AM - 11:00 AM</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Approved</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium action-buttons">
                  <button onclick="viewPermitDetails('V004', 'visitor', {
                    permitNumber: 'DHI/PERMIT/2024/04/0006',
                    applicantName: 'Emily Davis',
                    purpose: 'Client Presentation',
                    location: 'Conference Room A',
                    startDate: 'April 18, 2024, 9:00 AM',
                    endDate: 'April 18, 2024, 11:00 AM',
                    status: 'Approved',
                    submittedDate: 'April 15, 2024, 3:20 PM'
                  })" class="text-primary hover:text-blue-700">
                    <i class="fas fa-eye"></i> View
                  </button>
                </td>
              </tr>

              <!-- Rejected Permit Example -->
              <tr id="permit-VD003" class="vendor-permit permit-item">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0007</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Security Systems Ltd.</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">Vendor</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Security Camera Installation</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">April 22, 2024, 1:00 PM - 5:00 PM</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="permit-status px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Rejected</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium action-buttons">
                  <button onclick="viewPermitDetails('VD003', 'vendor', {
                    permitNumber: 'DHI/PERMIT/2024/04/0007',
                    applicantName: 'Security Systems Ltd.',
                    purpose: 'Security Camera Installation',
                    location: 'Entire Building',
                    startDate: 'April 22, 2024, 1:00 PM',
                    endDate: 'April 22, 2024, 5:00 PM',
                    status: 'Rejected',
                    submittedDate: 'April 16, 2024, 4:15 PM'
                  })" class="text-primary hover:text-blue-700">
                    <i class="fas fa-eye"></i> View
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>

   @include('layouts.footer')

    <!-- Permit Details Modal -->
    <div id="permitDetailsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div id="modalContent" class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
          <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Permit Details</h3>
          <button onclick="closePermitDetailsModal()" class="text-gray-400 hover:text-gray-500">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Field</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Permit Number</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="permitNumber">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Applicant Name</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="applicantName">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Applicant Type</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="applicantType">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Purpose</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="purpose">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Location</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="location">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Start Date/Time</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="startDate">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">End Date/Time</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="endDate">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Status</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="status">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Submitted Date</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="submittedDate">-</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-6 flex justify-end">
          <button onclick="closePermitDetailsModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
            Close
          </button>
        </div>
      </div>
    </div>
  </body>
</html>

@endsection
