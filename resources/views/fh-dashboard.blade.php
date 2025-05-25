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
  </head>
  <body class="bg-gray-50">


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Stats and Quick Actions Section -->
        <div class="lg:col-span-2 space-y-8">
          <!-- Stats Grid -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Active Tasks</h3>
              <p class="mt-2 text-3xl font-semibold text-primary">8</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Pending Approvals</h3>
              <p class="mt-2 text-3xl font-semibold text-yellow-600" id="totalPermitCount">5</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Maintenance Due</h3>
              <p class="mt-2 text-3xl font-semibold text-red-600">2</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Facilities Status</h3>
              <p class="mt-2 text-3xl font-semibold text-green-600">95%</p>
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
                      <i class="fas fa-eye mr-1"></i> View Details
                    </button>
                    <button onclick="approvePermit('V001', 'visitor')" class="px-3 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium hover:bg-green-200">
                      <i class="fas fa-check mr-1"></i> Approve
                    </button>
                    <button onclick="rejectPermit('V001', 'visitor')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200">
                      <i class="fas fa-times mr-1"></i> Reject
                    </button>
                  </div>
                </div>

                <!-- Visitor Permit 2 -->
                <div id="permit-V002" class="visitor-permit flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                  <div>
                    <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0002</p>
                    <p class="text-xs text-gray-500">Visitor: Sarah Johnson</p>
                    <p class="text-xs text-gray-500">Purpose: Job Interview</p>
                    <p class="text-xs text-gray-500">Date: Tomorrow, 10:00 AM - 11:30 AM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('V002')" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-medium hover:bg-blue-200">
                      <i class="fas fa-eye mr-1"></i> View Details
                    </button>
                    <button onclick="approvePermit('V002', 'visitor')" class="px-3 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium hover:bg-green-200">
                      <i class="fas fa-check mr-1"></i> Approve
                    </button>
                    <button onclick="rejectPermit('V002', 'visitor')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200">
                      <i class="fas fa-times mr-1"></i> Reject
                    </button>
                  </div>
                </div>

                <!-- Visitor Permit 3 -->
                <div id="permit-V003" class="visitor-permit flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                  <div>
                    <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0003</p>
                    <p class="text-xs text-gray-500">Visitor: Michael Brown</p>
                    <p class="text-xs text-gray-500">Purpose: Project Review</p>
                    <p class="text-xs text-gray-500">Date: April 20, 2024, 1:00 PM - 3:00 PM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('V003')" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-medium hover:bg-blue-200">
                      <i class="fas fa-eye mr-1"></i> View Details
                    </button>
                    <button onclick="approvePermit('V003', 'visitor')" class="px-3 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium hover:bg-green-200">
                      <i class="fas fa-check mr-1"></i> Approve
                    </button>
                    <button onclick="rejectPermit('V003', 'visitor')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200">
                      <i class="fas fa-times mr-1"></i> Reject
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
                    <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0004</p>
                    <p class="text-xs text-gray-500">Vendor: Tech Solutions Inc.</p>
                    <p class="text-xs text-gray-500">Purpose: Server Maintenance</p>
                    <p class="text-xs text-gray-500">Date: Today, 3:00 PM - 5:00 PM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('VD001')" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-medium hover:bg-blue-200">
                      <i class="fas fa-eye mr-1"></i> View Details
                    </button>
                    <button onclick="approvePermit('VD001', 'vendor')" class="px-3 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium hover:bg-green-200">
                      <i class="fas fa-check mr-1"></i> Approve
                    </button>
                    <button onclick="rejectPermit('VD001', 'vendor')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200">
                      <i class="fas fa-times mr-1"></i> Reject
                    </button>
                  </div>
                </div>

                <!-- Vendor Permit 2 -->
                <div id="permit-VD002" class="vendor-permit flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500">
                  <div>
                    <p class="text-sm font-medium text-gray-900">DHI/PERMIT/2024/04/0005</p>
                    <p class="text-xs text-gray-500">Vendor: Clean Pro Services</p>
                    <p class="text-xs text-gray-500">Purpose: Office Cleaning</p>
                    <p class="text-xs text-gray-500">Date: Tomorrow, 8:00 AM - 10:00 AM</p>
                  </div>
                  <div class="flex space-x-2">
                    <button onclick="viewPermitDetails('VD002')" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-medium hover:bg-blue-200">
                      <i class="fas fa-eye mr-1"></i> View Details
                    </button>
                    <button onclick="approvePermit('VD002', 'vendor')" class="px-3 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium hover:bg-green-200">
                      <i class="fas fa-check mr-1"></i> Approve
                    </button>
                    <button onclick="rejectPermit('VD002', 'vendor')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs font-medium hover:bg-red-200">
                      <i class="fas fa-times mr-1"></i> Reject
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Active Tasks -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-medium text-gray-900">Active Tasks</h2>
              <a href="tasks.html" class="text-sm text-primary hover:text-blue-700">View All</a>
            </div>
            <div class="space-y-4">
              <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                  <p class="text-sm font-medium text-gray-900">Server Room Maintenance</p>
                  <p class="text-xs text-gray-500">Due: Today, 2:00 PM</p>
                  <p class="text-xs text-gray-500">Priority: High</p>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Urgent</span>
              </div>
              <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                  <p class="text-sm font-medium text-gray-900">HVAC System Check</p>
                  <p class="text-xs text-gray-500">Due: Tomorrow, 10:00 AM</p>
                  <p class="text-xs text-gray-500">Priority: Medium</p>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="lg:col-span-1">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h2>
            <div class="space-y-4">
              <div class="flex items-start space-x-4">
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Approved visitor permit</p>
                  <p class="text-sm text-gray-500">1 hour ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Rejected vendor permit</p>
                  <p class="text-sm text-gray-500">2 hours ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Maintenance task completed</p>
                  <p class="text-sm text-gray-500">3 hours ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">New maintenance request</p>
                  <p class="text-sm text-gray-500">4 hours ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Inventory updated</p>
                  <p class="text-sm text-gray-500">5 hours ago</p>
                </div>
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
      <div class="p-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
      </div>
      <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">New Visitor Permit Request</p>
          <p class="text-sm text-gray-500">John Smith - Client Meeting</p>
          <p class="text-xs text-gray-400 mt-1">Just now</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">New Vendor Permit Request</p>
          <p class="text-sm text-gray-500">Tech Solutions Inc. - Server Maintenance</p>
          <p class="text-xs text-gray-400 mt-1">30 minutes ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Maintenance Request</p>
          <p class="text-sm text-gray-500">Server room requires immediate attention</p>
          <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Inventory Alert</p>
          <p class="text-sm text-gray-500">Low stock of replacement parts</p>
          <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Task Assignment</p>
          <p class="text-sm text-gray-500">New task assigned to you</p>
          <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">System Update</p>
          <p class="text-sm text-gray-500">Facility management system updated</p>
          <p class="text-xs text-gray-400 mt-1">4 hours ago</p>
        </div>
      </div>
    </div>

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
