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
    <!-- Script dan modal sama seperti permit-details.html -->
  </head>
  <body class="bg-gray-50">
    <!-- Navbar -->

<form id="permitForm" action="{{route('vendors.approve')}}" method="POST">
   @csrf

   <input type="hidden" name="id_vendor" value="{{$dataVendor->id_vendor}}">
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center">
          <a href='{{route('index_approve')}}' class="mr-4 text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left text-xl"></i>
          </a>
          <h1 class="text-2xl font-bold text-gray-900">Vendor Permit Details</h1>
        </div>
        <div class="flex space-x-3">
          <button onclick="printPermitDetails()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
            <i class="fas fa-print mr-2"></i> Print
          </button>

          <a href="{{route('pdf_vendor',$dataVendor->id_vendor)}}"  name="submit" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
            <i class="fas fa-file-pdf mr-2"></i> Download PDF
          </a>
        </div>
      </div>

      <!-- Permit Header -->
      <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
          <div>
            <h2 class="text-xl font-semibold text-gray-900" id="permitNumber">{{$dataVendor->permit_number}}</h2>
            <p class="text-sm text-gray-500 mt-1">Submitted on <span id="submittedDate">{{$dataVendor->created_at}}</span></p>
          </div>
          <div class="mt-4 md:mt-0 flex space-x-3">
        <span id="permitStatus"
    class="px-3 py-1 text-sm font-medium rounded-full
    @if($dataVendor->status == 'Approved')
        bg-green-100 text-green-800
    @elseif($dataVendor->status == 'Rejected')
        bg-red-100 text-red-800
    @else
        bg-yellow-100 text-yellow-800
    @endif">
    {{ $dataVendor->status }}
</span>

           <span id="priority"
    class="px-3 py-1 text-sm font-medium rounded-full
    @if($dataVendor->mode == 'Urgent')
        bg-red-100 text-red-800
    @elseif($dataVendor->mode == 'Normal')
        bg-blue-100 text-blue-800
    @endif">
    {{ $dataVendor->mode }}
</span>
  </div>
        </div>
      </div>

      <!-- Permit Details (Vendor) -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-6">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-building mr-2 text-primary"></i> Vendor & Work Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
            <div>
    <p class="text-sm font-medium text-gray-500">Company Name</p>
    <p class="text-base text-gray-900" id="companyName">{{ $dataVendor->company_name }}</p>
</div>
<div>
    <p class="text-sm font-medium text-gray-500">Requestor Name</p>
    <p class="text-base text-gray-900" id="requestorName">{{ $dataVendor->requestor_name }}</p>
</div>
            </div>
         <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
    <div>
        <p class="text-sm font-medium text-gray-500">Email</p>
        <p class="text-base text-gray-900" id="requestorEmail">{{ $dataVendor->email }}</p>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-500">Phone Number</p>
        <p class="text-base text-gray-900" id="requestorPhone">{{ $dataVendor->phone_number }}</p>
    </div>
</div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
    <div>
        <p class="text-sm font-medium text-gray-500">Location</p>
        <p class="text-base text-gray-900" id="location">{{ $dataVendor->specific_location }}</p>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-500">Building / Level / Room</p>
        <p class="text-base text-gray-900" id="buildingInfo">{{ $dataVendor->building }} / {{ $dataVendor->level }} / {{ $dataVendor->specific_location }}</p>
    </div>
</div>

<div class="mb-2">
    <p class="text-sm font-medium text-gray-500">Purpose of Work</p>
    <p class="text-base text-gray-900" id="purpose">{{ $dataVendor->work_description }}</p>
</div>

<div class="grid grid-cols-2 gap-4 mb-2">
    <div>
        <p class="text-sm font-medium text-gray-500">Start Date</p>
        <p class="text-base text-gray-900" id="startDate">{{ $dataVendor->validity_date_from }}</p>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-500">End Date</p>
        <p class="text-base text-gray-900" id="endDate">{{ $dataVendor->validity_date_to }}</p>
    </div>
</div>

      <div class="mb-2">
    <p class="text-sm font-medium text-gray-500">Does work generate dust?</p>
    <p class="text-base text-gray-900" id="generatesDust">{{ $dataVendor->generate_dust ? 'Yes' : 'No' }}</p>
</div>

<div class="mb-2">
    <p class="text-sm font-medium text-gray-500">Protection System Affected</p>
    <p class="text-base text-gray-900" id="protectionSystem">{{ $dataVendor->fire_system }}</p>
</div>

<div class="mb-2">
    <p class="text-sm font-medium text-gray-500">Method of Statement (MOS)</p>
    <p class="text-base text-gray-900" id="mosFileName">
        <button  class="view-pdf-btn" type="button" data-file="{{ Str::startsWith($dataVendor->file_mos, 'http') ? $dataVendor->file_mos : asset('storage/' . $dataVendor->file_mos) }}"
>
    LIHAT FILE
</button>

    </p>
</div>
<div class="mb-2">
    <p class="text-sm font-medium text-gray-500">ID Card Foto</p>
    <p class="text-base text-gray-900" id="mosFileName">
        <button class="view-pdf-btn" type="button" data-file="{{ Str::startsWith($dataVendor->up_id_card_foto, 'http') ? $dataVendor->up_id_card_foto : asset('storage/' . $dataVendor->up_id_card_foto) }}"
>
    LIHAT FILE
</button>

    </p>
</div>

<div class="mb-2">
    <p class="text-sm font-medium text-gray-500">Urgency</p>
  <p class="text-base text-gray-900 inline-block rounded px-2
    @if($dataVendor->mode == 'Urgent')
        bg-red-100 text-red-800
    @elseif($dataVendor->mode == 'Normal')
        bg-blue-100 text-blue-800
    @endif" id="urgency">
    {{ $dataVendor->mode }}
</p>

</div>
          <div class="mb-2">
    <h4 class="text-md font-semibold text-gray-800 mb-2">Worker Details</h4>
    <div id="workerDetails">
        @for ($i = 1; $i <= 30; $i++)
            @php
                $workerName = 'worker' . $i . '_name';
                $workerId = 'worker' . $i . '_id_card';
            @endphp

            @if (!empty($dataVendor->$workerName) && !empty($dataVendor->$workerId))
                <div class="grid grid-cols-2 gap-4 mb-2">
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Name {{$i}}</p>
                        <p class="text-sm text-gray-900">{{ $dataVendor->$workerName }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">ID No/Permit No {{$i}}</p>
                        <p class="text-sm text-gray-900">{{ $dataVendor->$workerId }}</p>
                    </div>
                </div>
            @endif
        @endfor
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
                @foreach ($dataVendorHistori as $item)

                <div class="flex items-start space-x-4 py-2 border-b border-gray-200">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{$item->judul ?? ''}}</p>
                        <p class="text-sm text-gray-500">{{$item->text ?? ''}}</p>
                        <p class="text-xs text-gray-400">{{$item->created_at ?? ''}}</p>
                    </div>
                </div>
                @endforeach
              {{-- <div class="flex items-start space-x-4 py-2 border-b border-gray-200">
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Under Review</p>
                  <p class="text-sm text-gray-500">By: Facility Handler</p>
                  <p class="text-xs text-gray-400">April 15, 2024, 11:15 AM</p>
                </div>
              </div>
              <div class="flex items-start space-x-4 py-2 border-b border-gray-200">
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Approved</p>
                  <p class="text-sm text-gray-500">By: Sarah Johnson</p>
                  <p class="text-xs text-gray-400">April 15, 2024, 12:00 PM</p>
                </div>
              </div> --}}
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
              <i class="fas fa-tasks mr-2 text-primary"></i> Actions
            </h3>
            <div id="actionButtons" class="space-y-3">
         @if(Auth::user()->access_approvals_edit == 1)
                @if($dataVendor->check_one_approve == null && $dataVendor->status == 'Rejected' || $dataVendor->status == 'Pending')
                 <textarea name="approved" id="approveNoteInput" style="display:none;"></textarea>
                <button
                type="submit"
                  id="submitButton"
                class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition mb-2"
              >
                <i class="fas fa-check mr-2"></i> Approve Permit
              </button>
              @endif
            </form>

               <form action="{{route('vendors.info')}}" method="POST" id="infoForm">
        @csrf
        <input type="hidden" name="id_vendor" value="{{$dataVendor->id_vendor}}">
           <textarea name="infoted" id="infoNoteInput" style="display:none;"></textarea>
        <button
            type="button"
            id="infoButton"
            class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition mb-2"
        >
            <i class="fas fa-info-circle mr-2"></i> Request for more information
        </button>
 </form>
@if($dataVendor->status == 'Pending')
          <form action="{{route('vendors.reject')}}" method="POST" id="rejectForm">
        @csrf
        <input type="hidden" name="id_vendor" value="{{$dataVendor->id_vendor}}">
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

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-2" id="confirmModalTitle">Are you sure?</h3>
        <p class="mb-4" id="confirmModalText">Are you sure you want to approve this permit?</p>
        <div class="flex justify-end gap-2">
          <button onclick="closeConfirmModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">No</button>
          <button onclick="confirmModalYes()" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700">Yes</button>
        </div>
      </div>
    </div>
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
      document.getElementById('submitButton').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent form submission

        // Show SweetAlert confirmation popup for rejection
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to approve this permit.',
            icon: 'warning',
            input: 'textarea',
            inputPlaceholder: 'Enter approval note...',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'No, cancel!',
            preConfirm: (note) => {
                // If the user provides a note, save it in the hidden textarea field
                if (note) {
                    document.getElementById('approveNoteInput').value = note;
                }
                // Submit the rejection form after confirmation
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

      // Function to handle permit approval
      function approvePermit(permitId, type) {
        alert(`Permit ${permitId} (${type}) has been approved.`);
        document.getElementById('permitStatus').textContent = 'Approved';
        document.getElementById('permitStatus').classList.remove('bg-yellow-100', 'text-yellow-800');
        document.getElementById('permitStatus').classList.add('bg-green-100', 'text-green-800');
        document.getElementById('actionButtons').innerHTML = `
          <button onclick="window.location.href='{{route('index_approve')}}'" class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Approvals
          </button>
        `;
      }

      // Function to handle permit rejection
      function rejectPermit(permitId, type) {
        alert(`Permit ${permitId} (${type}) has been rejected.`);
        document.getElementById('permitStatus').textContent = 'Rejected';
        document.getElementById('permitStatus').classList.remove('bg-yellow-100', 'text-yellow-800');
        document.getElementById('permitStatus').classList.add('bg-red-100', 'text-red-800');
        document.getElementById('actionButtons').innerHTML = `
          <button onclick="window.location.href='{{route('index_approve')}}'" class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Approvals
          </button>
        `;
      }

      function markAsPending(permitId, type) {
        alert(`Permit ${permitId} (${type}) has been marked as pending.`);
        document.getElementById('permitStatus').textContent = 'Pending';
        document.getElementById('permitStatus').classList.remove('bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800');
        document.getElementById('permitStatus').classList.add('bg-yellow-100', 'text-yellow-800');
      }

      function printPermitDetails() {
        window.print();
      }

      function downloadPermitPDF() {
        alert('Downloading permit as PDF...');
      }

      function sendEmailNotification() {
        alert('Sending email notification...');
      }

      document.addEventListener('click', function(event) {
        const panel = document.getElementById('notificationsPanel');
        const button = document.querySelector('button[onclick="toggleNotifications()"]');
        if (!panel.contains(event.target) && !button.contains(event.target) && !panel.classList.contains('hidden')) {
          panel.classList.add('hidden');
        }
      });

      document.addEventListener('click', function(event) {
        const menu = document.getElementById('userMenu');
        const button = document.querySelector('button[onclick="toggleUserMenu()"]');
        if (!menu.contains(event.target) && !button.contains(event.target) && !menu.classList.contains('hidden')) {
          menu.classList.add('hidden');
        }
      });

      document.addEventListener('DOMContentLoaded', function() {
        // Dummy data bisa disesuaikan jika ingin dinamis
      });

      function openRejectModal() {
        document.getElementById('rejectModal').classList.remove('hidden');
      }
      function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
      }
      function confirmReject() {
        confirmAction = 'finalReject';
        document.getElementById('confirmModalTitle').textContent = 'Are you sure?';
        document.getElementById('confirmModalText').textContent = 'Are you sure you want to reject this permit?';
        document.getElementById('confirmModal').classList.remove('hidden');
      }

      let confirmAction = null;
    //   function openApproveConfirmModal() {
    //     confirmAction = 'approve';
    //     document.getElementById('confirmModalTitle').textContent = 'Are you sure?';
    //     document.getElementById('confirmModalText').textContent = 'Are you sure you want to approve this permit?';
    //     document.getElementById('confirmModal').classList.remove('hidden');
    //   }
      function openRejectConfirmModal() {
        confirmAction = 'reject';
        openRejectModal();
      }
      function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
      }
      function confirmModalYes() {
        closeConfirmModal();
        if (confirmAction === 'approve') {
          approvePermit('V001', 'vendor');
        } else if (confirmAction === 'reject') {
          openRejectModal();
        } else if (confirmAction === 'finalReject') {
          var status = document.getElementById('permitStatus');
          status.textContent = 'Rejected';
          status.classList.remove('bg-yellow-100', 'text-yellow-800', 'bg-green-100', 'text-green-800');
          status.classList.add('bg-red-100', 'text-red-800');
          var actionButtons = document.getElementById('actionButtons');
          if (actionButtons) {
            actionButtons.innerHTML = `
              <button onclick=\"window.location.href='{{route('index_approve')}}'\" class=\"w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition\">
                <i class=\"fas fa-arrow-left mr-2\"></i> Back to Approvals
              </button>
            `;
          }
          closeRejectModal();
        }
      }
    </script>

<script>
     document.getElementById('infoButton').addEventListener('click', function (e) {
     e.preventDefault(); // Prevent form submission

     // Show SweetAlert confirmation popup for infoion
     Swal.fire({
         title: 'Would you like to provide information on this permit??',
         text: 'Please provide a note for infoion (optional).',
         icon: 'info',
         input: 'textarea',
         inputPlaceholder: 'Enter information note...',
         showCancelButton: true,
         confirmButtonText: 'Yes, info it!',
         cancelButtonText: 'No, cancel!',
         preConfirm: (note) => {
             // If the user provides a note, save it in the hidden textarea field
             if (note) {
                 document.getElementById('infoNoteInput').value = note;
             }
             // Submit the infoion form after confirmation
             document.getElementById('infoForm').submit();
         }
     });
 });

</script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll('.view-pdf-btn');

        buttons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const filePath = btn.getAttribute('data-file');

                // Deteksi apakah filePath adalah URL Google Drive / http
                const isUrl = filePath.startsWith('http');

                // Jika link langsung (contoh Google Drive), langsung buka
                if (isUrl) {
                    window.open(filePath, '_blank');
                    return;
                }

                // Ambil ekstensi file dari path lokal
                const fileExtension = filePath.split('.').pop().toLowerCase();

                const baseUrlFile = "{{ route('preview-file', ['url' => '']) }}";

                let route = '';

                if (fileExtension === 'pdf') {
                    route = baseUrlFile + encodeURIComponent(filePath);
                }

                // Jika route ditemukan, buka
                if (route) {
                    window.open(route, '_blank');
                } else {
                    alert("Tipe file tidak didukung");
                }
            });
        });
    });
</script>
  </body>
</html>

@endsection
