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
    <!-- Only view and back actions, no approve/reject -->
  </head>
  <body class="bg-gray-50">

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center">

<form id="permitForm" action="{{route('visitor.approve')}}" method="POST">
   @csrf

   <input type="hidden" name="id_visitor" value="{{$dataVisitor->id_visitor}}">
          <h1 class="text-2xl font-bold text-gray-900">Permit Visitor Detail</h1>
        </div>
        <div class="flex space-x-3">
          <button onclick="printPermitDetails()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
            <i class="fas fa-print mr-2"></i> Print
          </button>
          <button onclick="downloadPermitPDF()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
            <i class="fas fa-file-pdf mr-2"></i> Download PDF
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

      <!-- Permit Details (content same as permit-details.html) -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Basic Information (To be filled by requester) -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-user-circle mr-2 text-primary"></i> To be filled by requester
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
              <div>
                <p class="text-sm font-medium text-gray-500">Company</p>
                <p class="text-base text-gray-900" id="applicantCompany"></p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Requested Duration</p>
                <p class="text-base text-gray-900" id="requestedDuration"></p>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
              <div>
                <p class="text-sm font-medium text-gray-500">Requested Date From</p>
                <p class="text-base text-gray-900" id="requestedDateFrom"></p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Requested Date To</p>
                <p class="text-base text-gray-900" id="requestedDateTo"></p>
              </div>
            </div>
            <div class="flex items-center space-x-4 mb-2">
              <span class="text-sm font-medium text-gray-500">Purpose:</span>
              <span class="text-base text-gray-900" id="purpose"></span>
              <span class="text-base text-gray-900" id="purposeDelivery"></span>
              <span class="text-base text-gray-900" id="noId"></span>
            </div>
            <div class="mb-2">
              <p class="text-sm font-medium text-gray-500">Purpose Details</p>
              <p class="text-base text-gray-900" id="purposeDetails"></p>
            </div>
            <div class="mb-2">
              <p class="text-sm font-medium text-gray-500">Destination / Area</p>
              <p class="text-base text-gray-900" id="destinationArea"></p>
            </div>
          </div>

          <!-- If Visitor -->
          <div class="bg-white p-6 rounded-lg shadow-sm mt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-2 flex items-center">
              <i class="fas fa-users mr-2 text-primary"></i> If Visitor: Full Name & ID Card No
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Full Name</p>
                <div class="space-y-1" id="visitorNames"></div>
              </div>
              <div>
                <p class="text-xs font-medium text-gray-500 mb-1">ID Card</p>
                <div class="space-y-1" id="visitorIds"></div>
              </div>
            </div>
          </div>

          <!-- If Delivery -->
          <div class="bg-white p-6 rounded-lg shadow-sm mt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-2 flex items-center">
              <i class="fas fa-box mr-2 text-primary"></i> If Delivery: Details Materials & Quantity
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Materials</p>
                <div class="space-y-1" id="deliveryMaterials"></div>
              </div>
              <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Qty</p>
                <div class="space-y-1" id="deliveryQty"></div>
              </div>
            </div>
          </div>

          <!-- Person in Charge -->
          <div class="bg-white p-6 rounded-lg shadow-sm mt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-2 flex items-center">
              <i class="fas fa-user-tie mr-2 text-primary"></i> Person in Charge from GC / Owner
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Name</p>
                <p class="text-sm text-gray-900" id="picName"></p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Contact No</p>
                <p class="text-sm text-gray-900" id="picContact"></p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Car Plate No (if any)</p>
                <p class="text-sm text-gray-900" id="picCarPlate"></p>
              </div>
            </div>
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
              <!-- ... (approval history content) ... -->
            </div>
          </div>
          <!-- Only Back button, no approve/reject -->
           <!-- Action Buttons -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-tasks mr-2 text-primary"></i> Actions
            </h3>
            <div id="actionButtons" class="space-y-3">
         @if(Auth::user()->access_approvals_edit == 1)
                @if($dataVisitor->check_one_approve == null && $dataVisitor->status == 'Rejected' || $dataVisitor->status == 'Pending')
              <button
                type="submit"
                  id="submitButton"
                class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition mb-2"
              >
                <i class="fas fa-check mr-2"></i> Approve Permit
              </button>
              @endif
            </form>
@if($dataVisitor->status == 'Pending')
          <form action="{{route('visitor.reject')}}" method="POST" id="rejectForm">
        @csrf
          <input type="hidden" name="id_visitor" value="{{$dataVisitor->id_visitor}}">
        <input type="hidden" name="visitor" value="{{$dataVisitor->visitor}}">
           <textarea name="rejected" id="rejectNoteInput" style="display:none;"></textarea>
        <button
            type="button"
            id="rejectButton"
            class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition mb-2"
        >
            <i class="fas fa-times mr-2"></i> Reject Permit
        </button>
 </form>

@endif
@endif


        <button
            type="button"
            onclick="window.location.href='{{route('index_approve')}}'"
            class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
        >
            <i class="fas fa-arrow-left mr-2"></i> Back to Approvals
        </button>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Notifications Panel -->
<script>
      document.getElementById('rejectButton').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent form submission

        // Show SweetAlert confirmation popup for rejection
        Swal.fire({
            title: 'Are you sure you want to reject this permit?',
            text: 'Please provide a note for rejection (optional).',
            icon: 'warning',
            input: 'textarea',
            inputPlaceholder: 'Enter rejection note...',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject it!',
            cancelButtonText: 'No, cancel!',
            preConfirm: (note) => {
                // If the user provides a note, save it in the hidden textarea field
                if (note) {
                    document.getElementById('rejectNoteInput').value = note;
                }
                // Submit the rejection form after confirmation
                document.getElementById('rejectForm').submit();
            }
        });
    });
</script>
<script>
   // Listen for click event on the submit button
   document.getElementById('submitButton').addEventListener('click', function (e) {
      e.preventDefault(); // Prevent form submission

      // Show SweetAlert confirmation popup
      Swal.fire({
         title: 'Are you sure?',
         text: 'You are about to approve this permit.',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonText: 'Yes, approve it!',
         cancelButtonText: 'No, cancel!',
      }).then((result) => {
         if (result.isConfirmed) {
            // If user clicks 'Yes', submit the form
            document.getElementById('permitForm').submit();
         }
      });
   });
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
      // Function to print permit details
      function printPermitDetails() {
        window.print();
      }
      // Function to download permit as PDF
      function downloadPermitPDF() {
        alert('Downloading permit as PDF...');
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

      // Load permit details from URL parameters (copied from permit-details.html)
      document.addEventListener('DOMContentLoaded', function() {
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
            requestedDuration: '1 Day',
            requestedDateFrom: '2024-03-20',
            requestedDateTo: '2024-03-21',
            purpose: 'Visitor',
            purposeDelivery: '',
            noId: '123',
            purposeDetails: 'Meeting with project team',
            destinationArea: 'Main Office - Level 3',
            visitorList: [
              { name: 'John Doe', id: '1234567890' },
              { name: 'Jane Smith', id: '0987654321' }
            ],
            deliveryList: [
              { material: 'Document', qty: '1' },
              { material: 'Package', qty: '2' }
            ],
            pic: { name: 'Mike Johnson', contact: '08123456789', carPlate: 'B 1234 ABC' },
            status: 'Pending',
            submittedDate: 'April 15, 2024, 10:30 AM',
            priority: 'Normal',
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
            requestedDuration: '1 Day',
            requestedDateFrom: '2024-03-22',
            requestedDateTo: '2024-03-22',
            purpose: 'Visitor',
            purposeDelivery: '',
            noId: '124',
            purposeDetails: 'Job Interview',
            destinationArea: 'HR Office',
            visitorList: [
              { name: 'Sarah Johnson', id: '1122334455' }
            ],
            deliveryList: [],
            pic: { name: 'Michael Brown', contact: '08123456788', carPlate: '' },
            status: 'Pending',
            submittedDate: 'April 16, 2024, 9:15 AM',
            priority: 'Normal',
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
            requestedDuration: '1 Day',
            requestedDateFrom: '2024-04-20',
            requestedDateTo: '2024-04-20',
            purpose: 'Visitor',
            purposeDelivery: '',
            noId: '125',
            purposeDetails: 'Project Review',
            destinationArea: 'Project Room 3',
            visitorList: [
              { name: 'Michael Brown', id: '2233445566' },
              { name: 'Emily Davis', id: '3344556677' }
            ],
            deliveryList: [],
            pic: { name: 'Emily Davis', contact: '08123456787', carPlate: '' },
            status: 'Pending',
            submittedDate: 'April 17, 2024, 2:45 PM',
            priority: 'High',
            approvalHistory: [
              { date: 'April 17, 2024, 2:45 PM', action: 'Submitted', by: 'Michael Brown' },
              { date: 'April 17, 2024, 3:30 PM', action: 'Under Review', by: 'Facility Handler' }
            ]
          }
        };

        // Set the data in the UI
        const data = permitData[permitId] || permitData['V001'];

        // Update page title
        document.title = `Permit ${data.permitNumber} - Digital Hyperspace Indonesia`;

        // Update all data fields
        document.getElementById('permitNumber').textContent = data.permitNumber;
        document.getElementById('permitStatus').textContent = data.status;
        document.getElementById('priority').textContent = data.priority;
        document.getElementById('submittedDate').textContent = data.submittedDate;
        document.getElementById('applicantCompany').textContent = data.applicantCompany || '';
        document.getElementById('requestedDuration').textContent = data.requestedDuration || '';
        document.getElementById('requestedDateFrom').textContent = data.requestedDateFrom || '';
        document.getElementById('requestedDateTo').textContent = data.requestedDateTo || '';
        document.getElementById('purpose').textContent = data.purpose || '';
        document.getElementById('purposeDelivery').textContent = data.purposeDelivery || '';
        document.getElementById('noId').textContent = data.noId || '';
        document.getElementById('purposeDetails').textContent = data.purposeDetails || '';
        document.getElementById('destinationArea').textContent = data.destinationArea || '';
        // Visitor List
        const visitorNames = document.getElementById('visitorNames');
        const visitorIds = document.getElementById('visitorIds');
        visitorNames.innerHTML = '';
        visitorIds.innerHTML = '';
        if (data.visitorList && Array.isArray(data.visitorList)) {
          data.visitorList.forEach(v => {
            const nameP = document.createElement('p');
            nameP.className = 'text-sm text-gray-900';
            nameP.textContent = v.name;
            visitorNames.appendChild(nameP);
            const idP = document.createElement('p');
            idP.className = 'text-sm text-gray-900';
            idP.textContent = v.id;
            visitorIds.appendChild(idP);
          });
        }
        // Delivery List
        const deliveryMaterials = document.getElementById('deliveryMaterials');
        const deliveryQty = document.getElementById('deliveryQty');
        deliveryMaterials.innerHTML = '';
        deliveryQty.innerHTML = '';
        if (data.deliveryList && Array.isArray(data.deliveryList)) {
          data.deliveryList.forEach(d => {
            const matP = document.createElement('p');
            matP.className = 'text-sm text-gray-900';
            matP.textContent = d.material;
            deliveryMaterials.appendChild(matP);
            const qtyP = document.createElement('p');
            qtyP.className = 'text-sm text-gray-900';
            qtyP.textContent = d.qty;
            deliveryQty.appendChild(qtyP);
          });
        }
        // PIC
        document.getElementById('picName').textContent = (data.pic && data.pic.name) || '';
        document.getElementById('picContact').textContent = (data.pic && data.pic.contact) || '';
        document.getElementById('picCarPlate').textContent = (data.pic && data.pic.carPlate) || '';
        // Approval History
        const historyContainer = document.getElementById('approvalHistory');
        historyContainer.innerHTML = '';
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
      });
    </script>
  </body>
</html>

@endsection
