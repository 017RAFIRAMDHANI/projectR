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
 // Function to handle permit approval
      function approvePermit(permitId, type) {
        // In a real application, this would send a request to the server
        alert(`Permit ${permitId} (${type}) has been approved.`);
        // Update UI to reflect the change
        document.getElementById('permitStatus').textContent = 'Approved';
        document.getElementById('permitStatus').classList.remove('bg-yellow-100', 'text-yellow-800');
        document.getElementById('permitStatus').classList.add('bg-green-100', 'text-green-800');

        // Update action buttons
        document.getElementById('actionButtons').innerHTML = `
          <button onclick="window.location.href='approvals.html'" class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Approvals
          </button>
        `;
      }

      // Function to handle permit rejection
      function rejectPermit(permitId, type) {
        // In a real application, this would send a request to the server
        alert(`Permit ${permitId} (${type}) has been rejected.`);
        // Update UI to reflect the change
        document.getElementById('permitStatus').textContent = 'Rejected';
        document.getElementById('permitStatus').classList.remove('bg-yellow-100', 'text-yellow-800');
        document.getElementById('permitStatus').classList.add('bg-red-100', 'text-red-800');

        // Update action buttons
        document.getElementById('actionButtons').innerHTML = `
          <button onclick="window.location.href='approvals.html'" class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Approvals
          </button>
        `;
      }

      // Function to mark permit as pending
      function markAsPending(permitId, type) {
        // In a real application, this would send a request to the server
        alert(`Permit ${permitId} (${type}) has been marked as pending.`);
        // Update UI to reflect the change
        document.getElementById('permitStatus').textContent = 'Pending';
        document.getElementById('permitStatus').classList.remove('bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800');
        document.getElementById('permitStatus').classList.add('bg-yellow-100', 'text-yellow-800');
      }

      // Load permit details from URL parameters
      document.addEventListener('DOMContentLoaded', function() {
        // In a real application, this would fetch data from a server
        // For this example, we'll use sample data
        const urlParams = new URLSearchParams(window.location.search);
        const permitId = urlParams.get('id') || 'V001';
        const permitType = urlParams.get('type') || 'visitor';

        // Sample data - in a real app, this would come from an API
        const permitData = {
          'V001': {
            permitNumber: 'DHI/PERMIT/2024/04/0001',
            applicantName: 'John Smith',
            applicantEmail: 'john.smith@example.com',
            applicantPhone: '+62 812-3456-7890',
            applicantCompany: 'ABC Corporation',
            applicantType: 'Visitor',
            purpose: 'Client Meeting',
            description: 'Meeting with the client to discuss project requirements and timeline.',
            location: 'Main Conference Room',
            startDate: 'Today, 2:00 PM',
            endDate: 'Today, 4:00 PM',
            status: 'Pending',
            submittedDate: 'April 15, 2024, 10:30 AM',
            priority: 'Normal',
            numberOfVisitors: 3,
            equipment: 'Laptop, Projector',
            specialRequirements: 'None',
            hostName: 'Sarah Johnson',
            hostDepartment: 'Sales',
            hostEmail: 'sarah.johnson@dhi.com',
            hostPhone: '+62 812-3456-7891',
            securityNotes: 'Please check ID at reception',
            approvalHistory: [
              { date: 'April 15, 2024, 10:30 AM', action: 'Submitted', by: 'John Smith' },
              { date: 'April 15, 2024, 11:15 AM', action: 'Under Review', by: 'Facility Handler' }
            ]
          },
          'V002': {
            permitNumber: 'DHI/PERMIT/2024/04/0002',
            applicantName: 'Sarah Johnson',
            applicantEmail: 'sarah.johnson@example.com',
            applicantPhone: '+62 812-3456-7894',
            applicantCompany: 'XYZ Inc.',
            applicantType: 'Visitor',
            purpose: 'Job Interview',
            description: 'Interview for the position of Senior Developer.',
            location: 'HR Office',
            startDate: 'Tomorrow, 10:00 AM',
            endDate: 'Tomorrow, 11:30 AM',
            status: 'Pending',
            submittedDate: 'April 16, 2024, 9:15 AM',
            priority: 'Normal',
            numberOfVisitors: 1,
            equipment: 'None',
            specialRequirements: 'None',
            hostName: 'Michael Brown',
            hostDepartment: 'HR',
            hostEmail: 'michael.brown@dhi.com',
            hostPhone: '+62 812-3456-7895',
            securityNotes: 'Please check ID at reception',
            approvalHistory: [
              { date: 'April 16, 2024, 9:15 AM', action: 'Submitted', by: 'Sarah Johnson' },
              { date: 'April 16, 2024, 10:00 AM', action: 'Under Review', by: 'Facility Handler' }
            ]
          },
          'V003': {
            permitNumber: 'DHI/PERMIT/2024/04/0003',
            applicantName: 'Michael Brown',
            applicantEmail: 'michael.brown@example.com',
            applicantPhone: '+62 812-3456-7896',
            applicantCompany: 'Tech Solutions',
            applicantType: 'Visitor',
            purpose: 'Project Review',
            description: 'Review of the ongoing project with the development team.',
            location: 'Project Room 3',
            startDate: 'April 20, 2024, 1:00 PM',
            endDate: 'April 20, 2024, 3:00 PM',
            status: 'Pending',
            submittedDate: 'April 17, 2024, 2:45 PM',
            priority: 'High',
            numberOfVisitors: 2,
            equipment: 'Laptop, Projector',
            specialRequirements: 'None',
            hostName: 'Emily Davis',
            hostDepartment: 'Development',
            hostEmail: 'emily.davis@dhi.com',
            hostPhone: '+62 812-3456-7897',
            securityNotes: 'Please check ID at reception',
            approvalHistory: [
              { date: 'April 17, 2024, 2:45 PM', action: 'Submitted', by: 'Michael Brown' },
              { date: 'April 17, 2024, 3:30 PM', action: 'Under Review', by: 'Facility Handler' }
            ]
          },
          'VD001': {
            permitNumber: 'DHI/PERMIT/2024/04/0004',
            applicantName: 'Tech Solutions Inc.',
            applicantEmail: 'contact@techsolutions.com',
            applicantPhone: '+62 812-3456-7892',
            applicantCompany: 'Tech Solutions Inc.',
            applicantType: 'Vendor',
            purpose: 'Server Maintenance',
            description: 'Regular maintenance of server equipment and software updates.',
            location: 'Server Room',
            startDate: 'Today, 3:00 PM',
            endDate: 'Today, 5:00 PM',
            status: 'Pending',
            submittedDate: 'April 16, 2024, 11:20 AM',
            priority: 'Urgent',
            numberOfVisitors: 2,
            equipment: 'Laptop, Network Tools, Replacement Parts',
            specialRequirements: 'Access to server room key',
            hostName: 'Michael Brown',
            hostDepartment: 'IT',
            hostEmail: 'michael.brown@dhi.com',
            hostPhone: '+62 812-3456-7893',
            securityNotes: 'Escort required to server room',
            approvalHistory: [
              { date: 'April 16, 2024, 11:20 AM', action: 'Submitted', by: 'Tech Solutions Inc.' },
              { date: 'April 16, 2024, 12:05 PM', action: 'Under Review', by: 'Facility Handler' }
            ]
          },
          'VD002': {
            permitNumber: 'DHI/PERMIT/2024/04/0005',
            applicantName: 'Clean Pro Services',
            applicantEmail: 'info@cleanpro.com',
            applicantPhone: '+62 812-3456-7898',
            applicantCompany: 'Clean Pro Services',
            applicantType: 'Vendor',
            purpose: 'Office Cleaning',
            description: 'Regular cleaning service for the entire office area.',
            location: 'Entire Office Area',
            startDate: 'Tomorrow, 8:00 AM',
            endDate: 'Tomorrow, 10:00 AM',
            status: 'Pending',
            submittedDate: 'April 17, 2024, 3:30 PM',
            priority: 'Normal',
            numberOfVisitors: 4,
            equipment: 'Cleaning Supplies, Vacuum Cleaners',
            specialRequirements: 'Access to storage room',
            hostName: 'David Wilson',
            hostDepartment: 'Facilities',
            hostEmail: 'david.wilson@dhi.com',
            hostPhone: '+62 812-3456-7899',
            securityNotes: 'Please check ID at reception',
            approvalHistory: [
              { date: 'April 17, 2024, 3:30 PM', action: 'Submitted', by: 'Clean Pro Services' },
              { date: 'April 17, 2024, 4:15 PM', action: 'Under Review', by: 'Facility Handler' }
            ]
          }
        };

        // Set the data in the UI
        const data = permitData[permitId] || permitData['V001'];

        // Update page title
        document.title = `Permit ${data.permitNumber} - Digital Hyperspace Indonesia`;

        // Update all data fields
        document.getElementById('permitNumber').textContent = data.permitNumber;
        document.getElementById('applicantName').textContent = data.applicantName;
        document.getElementById('applicantEmail').textContent = data.applicantEmail;
        document.getElementById('applicantPhone').textContent = data.applicantPhone;
        document.getElementById('applicantCompany').textContent = data.applicantCompany;
        document.getElementById('applicantType').textContent = data.applicantType;
        document.getElementById('purpose').textContent = data.purpose;
        document.getElementById('description').textContent = data.description;
        document.getElementById('location').textContent = data.location;
        document.getElementById('startDate').textContent = data.startDate;
        document.getElementById('endDate').textContent = data.endDate;
        document.getElementById('permitStatus').textContent = data.status;
        document.getElementById('submittedDate').textContent = data.submittedDate;
        document.getElementById('priority').textContent = data.priority;
        document.getElementById('numberOfVisitors').textContent = data.numberOfVisitors;
        document.getElementById('equipment').textContent = data.equipment;
        document.getElementById('specialRequirements').textContent = data.specialRequirements;
        document.getElementById('hostName').textContent = data.hostName;
        document.getElementById('hostDepartment').textContent = data.hostDepartment;
        document.getElementById('hostEmail').textContent = data.hostEmail;
        document.getElementById('hostPhone').textContent = data.hostPhone;
        document.getElementById('securityNotes').textContent = data.securityNotes;

        // Set status badge color
        if (data.status === 'Pending') {
          document.getElementById('permitStatus').classList.add('bg-yellow-100', 'text-yellow-800');
        } else if (data.status === 'Approved') {
          document.getElementById('permitStatus').classList.add('bg-green-100', 'text-green-800');
        } else if (data.status === 'Rejected') {
          document.getElementById('permitStatus').classList.add('bg-red-100', 'text-red-800');
        }

        // Set priority badge color
        if (data.priority === 'Urgent') {
          document.getElementById('priority').classList.add('bg-red-100', 'text-red-800');
        } else if (data.priority === 'High') {
          document.getElementById('priority').classList.add('bg-orange-100', 'text-orange-800');
        } else if (data.priority === 'Normal') {
          document.getElementById('priority').classList.add('bg-blue-100', 'text-blue-800');
        } else if (data.priority === 'Low') {
          document.getElementById('priority').classList.add('bg-green-100', 'text-green-800');
        }

        // Populate approval history
        const historyContainer = document.getElementById('approvalHistory');
        historyContainer.innerHTML = ''; // Clear existing history
        data.approvalHistory.forEach(item => {
          const historyItem = document.createElement('div');
          historyItem.className = 'flex items-start space-x-4 py-2 border-b border-gray-200';
          historyItem.innerHTML = `
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">${item.action}</p>
              <p class="text-sm text-gray-500">By: ${item.by}</p>
              <p class="text-xs text-gray-400">${item.date}</p>
            </div>
          `;
          historyContainer.appendChild(historyItem);
        });

        // Update action buttons based on permit type and status
        const actionButtons = document.getElementById('actionButtons');

        // If the permit is already approved or rejected, only show the back button
        if (data.status === 'Approved' || data.status === 'Rejected') {
          actionButtons.innerHTML = `
            <button
              onclick="window.location.href='approvals.html'"
              class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition"
            >
              <i class="fas fa-arrow-left mr-2"></i> Back to Approvals
            </button>
          `;
        } else {
          // For pending permits, show all action buttons
          actionButtons.innerHTML = `
            <button
              onclick="approvePermit('${permitId}', '${permitType}')"
              class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition mb-2"
            >
              <i class="fas fa-check mr-2"></i> Approve Permit
            </button>
            <button
              onclick="rejectPermit('${permitId}', '${permitType}')"
              class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition mb-2"
            >
              <i class="fas fa-times mr-2"></i> Reject Permit
            </button>
            <button
              onclick="markAsPending('${permitId}', '${permitType}')"
              class="w-full px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition mb-2"
            >
              <i class="fas fa-clock mr-2"></i> Mark as Pending
            </button>
            <button
              onclick="window.location.href='approvals.html'"
              class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
            >
              <i class="fas fa-arrow-left mr-2"></i> Back to Approvals
            </button>
          `;
        }
      });
    </script>
  </head>
  <body class="bg-gray-50">


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center">
          <button
            onclick="window.location.href='approvals.html'"
            class="mr-4 text-gray-500 hover:text-gray-700"
          >
            <i class="fas fa-arrow-left text-xl"></i>
          </button>
          <h1 class="text-2xl font-bold text-gray-900">Permit Details</h1>
        </div>
        <div class="flex space-x-3">
          <button
            onclick="printPermitDetails()"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
          >
            <i class="fas fa-print mr-2"></i> Print
          </button>
          <button
            onclick="downloadPermitPDF()"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
          >
            <i class="fas fa-file-pdf mr-2"></i> Download PDF
          </button>
          <button
            onclick="sendEmailNotification()"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
          >
            <i class="fas fa-envelope mr-2"></i> Send Email
          </button>
        </div>
      </div>

      <!-- Permit Header -->
      <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
          <div>
            <h2 class="text-xl font-semibold text-gray-900" id="permitNumber">DHI/PERMIT/2024/04/0001</h2>
            <p class="text-sm text-gray-500 mt-1">Submitted on <span id="submittedDate">April 15, 2024, 10:30 AM</span></p>
          </div>
          <div class="mt-4 md:mt-0 flex space-x-3">
            <span id="permitStatus" class="px-3 py-1 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
            <span id="priority" class="px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">Normal</span>
          </div>
        </div>
      </div>

      <!-- Permit Details -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Basic Information -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-user-circle mr-2 text-primary"></i> Basic Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-500">Applicant Name</p>
                <p class="text-base text-gray-900" id="applicantName">John Smith</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Applicant Type</p>
                <p class="text-base text-gray-900" id="applicantType">Visitor</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Email</p>
                <p class="text-base text-gray-900" id="applicantEmail">john.smith@example.com</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Phone</p>
                <p class="text-base text-gray-900" id="applicantPhone">+62 812-3456-7890</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Company</p>
                <p class="text-base text-gray-900" id="applicantCompany">ABC Corporation</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Number of Visitors</p>
                <p class="text-base text-gray-900" id="numberOfVisitors">3</p>
              </div>
            </div>
          </div>

          <!-- Visit Details -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-calendar-alt mr-2 text-primary"></i> Visit Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-500">Purpose</p>
                <p class="text-base text-gray-900" id="purpose">Client Meeting</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Location</p>
                <p class="text-base text-gray-900" id="location">Main Conference Room</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Start Date/Time</p>
                <p class="text-base text-gray-900" id="startDate">Today, 2:00 PM</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">End Date/Time</p>
                <p class="text-base text-gray-900" id="endDate">Today, 4:00 PM</p>
              </div>
              <div class="md:col-span-2">
                <p class="text-sm font-medium text-gray-500">Description</p>
                <p class="text-base text-gray-900" id="description">Meeting with the client to discuss project requirements and timeline.</p>
              </div>
            </div>
          </div>

          <!-- Equipment and Requirements -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-tools mr-2 text-primary"></i> Equipment and Requirements
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-500">Equipment</p>
                <p class="text-base text-gray-900" id="equipment">Laptop, Projector</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Special Requirements</p>
                <p class="text-base text-gray-900" id="specialRequirements">None</p>
              </div>
            </div>
          </div>

          <!-- Host Information -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-user-tie mr-2 text-primary"></i> Host Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-500">Host Name</p>
                <p class="text-base text-gray-900" id="hostName">Sarah Johnson</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Department</p>
                <p class="text-base text-gray-900" id="hostDepartment">Sales</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Email</p>
                <p class="text-base text-gray-900" id="hostEmail">sarah.johnson@dhi.com</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Phone</p>
                <p class="text-base text-gray-900" id="hostPhone">+62 812-3456-7891</p>
              </div>
            </div>
          </div>

          <!-- Security Notes -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-shield-alt mr-2 text-primary"></i> Security Notes
            </h3>
            <p class="text-base text-gray-900" id="securityNotes">Please check ID at reception</p>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
          <!-- Approval History -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-history mr-2 text-primary"></i> Approval History
            </h3>
            <div id="approvalHistory" class="space-y-2">
              <!-- History items will be populated by JavaScript -->
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-tasks mr-2 text-primary"></i> Actions
            </h3>
            <div id="actionButtons" class="space-y-3">
              <button
                onclick="approvePermit('V001', 'visitor')"
                class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
              >
                <i class="fas fa-check mr-2"></i> Approve Permit
              </button>
              <button
                onclick="rejectPermit('V001', 'visitor')"
                class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition"
              >
                <i class="fas fa-times mr-2"></i> Reject Permit
              </button>
              <button
                onclick="markAsPending('V001', 'visitor')"
                class="w-full px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition"
              >
                <i class="fas fa-clock mr-2"></i> Mark as Pending
              </button>
              <button
                onclick="window.location.href='approvals.html'"
                class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
              >
                <i class="fas fa-arrow-left mr-2"></i> Back to Approvals
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>


  </body>
</html>
@endsection

@include('layouts.footer')
