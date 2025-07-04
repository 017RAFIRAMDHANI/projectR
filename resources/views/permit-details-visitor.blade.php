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
   <div class="flex items-center">
    <a href='{{route('index_approve')}}' class="mr-4 text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left text-xl"></i>
          </a>
          <h1 class="text-2xl font-bold text-gray-900">Permit Visitor Detail</h1>
        </div>
        </div>
        <div class="flex space-x-3">
          <a href="{{route('pdf_manual_visitor',$dataVisitor->id_visitor)}}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
            <i class="fas fa-print mr-2"></i> Print
          </a>


          <a href="{{route('pdf_visitor',$dataVisitor->id_visitor)}}"  name="submit" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
            <i class="fas fa-file-pdf mr-2"></i> Download PDF
          </a>
        </div>
      </div>

      <!-- Permit Header -->
      <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
          <div>
            <h2 class="text-xl font-semibold text-gray-900" id="permitNumber">{{$dataVisitor->permit_number ?? '-'}}</h2>
            <p class="text-sm text-gray-500 mt-1">Submitted on <span id="submittedDate">{{$dataVisitor->created_at ?? ''}}</span></p>
          </div>

   <div class="mt-4 md:mt-0 flex space-x-3">
        <span id="permitStatus"
    class="px-3 py-1 text-sm font-medium rounded-full
    @if($dataVisitor->status == 'Approved')
        bg-green-100 text-green-800
    @elseif($dataVisitor->status == 'Rejected')
        bg-red-100 text-red-800
    @else
        bg-yellow-100 text-yellow-800
    @endif">
    {{ $dataVisitor->status ?? '' }}
</span>


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
                <p class="text-base text-gray-900" id="applicantCompany"> {{ $dataVisitor->company_name ?? '' }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Requested Duration</p>
                <p class="text-base text-gray-900" id="requestedDuration">{{ $duration ?? ''}} Day</p>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
              <div>
                <p class="text-sm font-medium text-gray-500">Requested Date From</p>
                <p class="text-base text-gray-900" id="requestedDateFrom">  {{ $dataVisitor->request_date_from ?? '' }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Requested Date To</p>
                <p class="text-base text-gray-900" id="requestedDateTo">  {{ $dataVisitor->request_date_to ?? '' }}</p>
              </div>
            </div>
            <div class="flex items-center space-x-4 mb-2">
              <span class="text-sm font-medium text-gray-500">Purpose: {{ $dataVisitor->purpose_visit ?? '' }}</span>
              <span class="text-base text-gray-900" id="purpose"></span>
              <span class="text-base text-gray-900" id="purposeDelivery"></span>
              <span class="text-base text-gray-900" id="noId"></span>
            </div>
            <div class="mb-2">
              <p class="text-sm font-medium text-gray-500">Purpose Details</p>
              <p class="text-base text-gray-900" id="purposeDetails">{{ $dataVisitor->purpose_detail ?? '' }}</p>
            </div>
            <div class="mb-2">
              <p class="text-sm font-medium text-gray-500">Destination / Area</p>
              <p class="text-base text-gray-900" id="destinationArea">{{ $dataVisitor->specific_location ?? '' }}</p>
            </div>
            <div class="mb-2">
    <p class="text-sm font-medium text-gray-500">ID Card Foto</p>
    <p class="text-base text-gray-900" id="mosFileName">
        <button class="view-pdf-btn" type="button" data-file="{{ Str::startsWith($dataVisitor->upload_id_card_foto, 'http') ? $dataVisitor->upload_id_card_foto : asset('storage/' . $dataVisitor->upload_id_card_foto) }}"
>
    LIHAT FILE
</button>

    </p>
</div>
          </div>

          <!-- If Visitor -->
<div class="bg-white p-6 rounded-lg shadow-sm mt-6">
    <h3 class="text-lg font-medium text-gray-900 mb-2 flex items-center">
        <i class="fas fa-users mr-2 text-primary"></i> If Visitor: Full Name & ID Card No
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @php
            $counter = 1;
        @endphp

        @for ($i = 1; $i <= 30; $i++)
            @php
                $visitorName = 'name_' . $i;
                $visitorId = 'id_card_' . $i;
            @endphp

            @if(!empty($dataVisitor->$visitorName) && !empty($dataVisitor->$visitorId))
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1">Full Name ({{ $counter }})</p>
                    <div class="space-y-1" id="visitorNames">{{ $dataVisitor->$visitorName }}</div>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1">ID Card ({{ $counter }})</p>
                    <div class="space-y-1" id="visitorIds">{{ $dataVisitor->$visitorId }}</div>
                </div>
                @php
                    $counter++; // Increment counter untuk data yang ditampilkan
                @endphp
            @endif
        @endfor
    </div>
</div>

          <!-- If Delivery -->
       <div class="bg-white p-6 rounded-lg shadow-sm mt-6">
    <h3 class="text-lg font-medium text-gray-900 mb-2 flex items-center">
        <i class="fas fa-box mr-2 text-primary"></i> If Delivery: Details Materials & Quantity
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @php
            $counter = 1; // Inisialisasi counter untuk nomor urut
        @endphp

        @for ($i = 1; $i <= 30; $i++)
            @php
                $material = 'material_' . $i;
                $quantity = 'quantity_' . $i;
            @endphp

            @if(!empty($dataVisitor->$material) && !empty($dataVisitor->$quantity))
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1">Materials ({{ $counter }})</p>
                    <div class="space-y-1" id="deliveryMaterials">{{ $dataVisitor->$material }}</div>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1">Qty ({{ $counter }})</p>
                    <div class="space-y-1" id="deliveryQty">{{ $dataVisitor->$quantity }}</div>
                </div>
                @php
                    $counter++; // Increment counter untuk data yang ditampilkan
                @endphp
            @endif
        @endfor
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
                <p class="text-sm text-gray-900" id="picName">{{ $dataVisitor->pic_name ??''}}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Contact No</p>
                <p class="text-sm text-gray-900" id="picContact">{{ $dataVisitor->pic_contact ??''}}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Car Plate No (if any)</p>
                <p class="text-sm text-gray-900" id="picCarPlate">{{ $dataVisitor->car_plate_no ??''}} ({{ $dataVisitor->vehicle_type??''}})</p>
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
              @foreach ($dataVisitorHistori as $item)

                <div class="flex items-start space-x-4 py-2 border-b border-gray-200">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{$item->judul ?? ''}}</p>
                        <p class="text-sm text-gray-500">{{$item->text ?? ''}}</p>
                        <p class="text-xs text-gray-400">{{$item->created_at ?? ''}}</p>
                    </div>
                </div>
                @endforeach
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
<form action="{{ route('visitor.info') }}" method="POST" id="infoForm">
    @csrf
    <input type="hidden" name="id_visitor" value="{{ $dataVisitor->id_visitor }}">
    <input type="hidden" name="visitor" value="{{ $dataVisitor->visitor }}">
    <textarea name="infoted" id="infoNoteInput" style="display:none;"></textarea>
    <button
        type="button"
        id="infoButton"
        class="mt-2 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition mb-2"
    >
        <i class="fas fa-info-circle mr-2"></i> Request for more information
    </button>
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
{{-- <script>
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
</script> --}}
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
