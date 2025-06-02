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

</head>
<body class="bg-gray-50">


<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Permit Management</h1>
            <a href="{{route('vendor_create')}}" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700 transition flex items-center">
                <i class="fas fa-plus mr-2"></i>
                New Permit
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="statusApproval" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <option value="">All Status</option>
                      <option value="Pending">Pending</option>
                      <option value="Approved">Approved</option>
                         <option value="Reject">Reject</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                    <input type="date" id="EndDate"  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                    <input type="text" placeholder="Search company" value="{{ $searchCompany ?? '' }}"  id="searchCompany" name="searchCompany"  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <form   method="GET">
                 <input type="text" name="searchData" id="searchData" value="{{ $search ?? null }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
</form>
                </div>
            </div>
        </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
     <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> No. Permit</th>

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requestor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Building/Room</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Work Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number Plate</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle Types</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 1 Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 1 ID No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 2 Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 2 ID No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 3 Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 3 ID No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 4 Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 4 ID No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 5 Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker 5 ID No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Generate Dust</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Protection System</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File MOS</th>

                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Approval DHI</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Approval FH</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mode</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="TablesData">

          @foreach ($vendors as  $vendor)
                <tr>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $vendor->permit_number ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->company_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->requestor_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->location_of_work }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->building_level_room }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->work_description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->phone_number }}</td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->start_date }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->end_date }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->number_plate }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->vehicle_types }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker1_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker1_id_nopermit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker2_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker2_id_nopermit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker3_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker3_id_nopermit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker4_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker4_id_nopermit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker5_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->worker5_id_nopermit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->generate_dust }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->protection_system }}</td>


<td class="px-6 py-4 whitespace-nowrap">


  <button class="view-pdf-btn" type="button" data-file="{{ Str::startsWith($vendor->file_mos, 'http') ? $vendor->file_mos : asset('storage/' . $vendor->file_mos) }}"
>
    LIHAT FILE
</button>



</td>


<td id="status-approval-{{ $vendor->primary_number }}" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
       {{ $vendor->status == 'Approved' ? 'bg-green-100 text-green-800' :
           ($vendor->status == 'Reject' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
        {{ $vendor->status ?? 'Pending' }}
    </span>
</td>
<td >
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
        {{ $vendor->status_approval_DHI == 'Approved' ? 'bg-green-100 text-green-800' :
           ($vendor->status_approval_DHI == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
        {{ $vendor->status_approval_DHI ?? 'Pending'}}
    </span>
</td>


<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
        {{ $vendor->status_approval_FH == 'Approved' ? 'bg-green-100 text-green-800' :
           ($vendor->status_approval_FH == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
        {{ $vendor->status_approval_FH ?? 'Pending'}}
    </span>
</td>



                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vendor->mode }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class=" mx-2 text-primary hover:text-blue-700" >View</button>

@php
    $isDisabled = in_array($vendor->status, ['Approved', 'Reject']);
@endphp

<button
    id="approve-btn-{{ $vendor->primary_number }}"
    onclick="approvePermit('{{ $vendor->primary_number }}')"
    class="approve-btn bg-green-600 hover:bg-green-700 text-white font-semibold px-3 py-1 rounded transition
        {{ $isDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
    {{ $isDisabled ? 'disabled title=Tindakan sudah dilakukan' : '' }}>
    <i class="fas fa-check mr-1"></i> Approve
</button>

<button
    id="reject-btn-{{ $vendor->primary_number }}"
    onclick="rejectPermit('{{ $vendor->primary_number }}')"
    class="reject-btn bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded transition
        {{ $isDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
    {{ $isDisabled ? 'disabled title=Tindakan sudah dilakukan' : '' }}>
    <i class="fas fa-times mr-1"></i> Reject
</button>


</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>


            <div>
                <div style="padding: 10px" id="pagination">
                    <!-- Pagination Links -->
                    {{-- {{ $vendors->links('pagination::tailwind') }} --}}
                </div>



</div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function(){
        // For general search (searching across all columns)
        $("#searchData").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#TablesData tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

            // Hide pagination when filtering
            $("#pagination").hide();
        });

        // For company search (searching only in the company column)
        $("#searchCompany").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#TablesData tr").filter(function() {
                // Only toggle the row if the company column contains the search term
                var companyName = $(this).find('td').eq(1).text().toLowerCase();  // Assuming company_name is in the second column (index 1)
                $(this).toggle(companyName.indexOf(value) > -1);
            });

            // Hide pagination when filtering
            $("#pagination").hide();
        });
    });

</script>
<script>
    $(document).ready(function(){
        // For Status filter (Status Approval DHI)
        $("#statusApproval").on("change", function() {
            var value = $(this).val();  // Get the selected value (Pending, Approved, or Rejected)

            console.log("Selected Value: " + value); // Log the selected filter value

            // Loop through each row and filter based on the status
            $("#TablesData tr").filter(function() {
                // Find the correct index for the status column in the table (27th column = index 26)
                var statusText = $(this).find('td').eq(25).text().trim();  // Adjusted to eq(26)

                console.log("Row Status Text: " + statusText); // Log the status value in each row

                // If "All Status" is selected (empty value), show all rows
                if (value === "") {
                    $(this).show();
                } else {
                    // Compare the status value as string
                    $(this).toggle(statusText === value);  // Compare string to string
                }
            });

            // Hide pagination while filtering
            $("#pagination").hide();
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Check column indices by logging the table contents
        $("#TablesData tr").each(function(rowIndex, row) {
            $(row).find("td").each(function(colIndex, cell) {
                console.log("Row " + rowIndex + ", Column " + colIndex + ": " + $(cell).text().trim());
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        // For End Date filter
        $("#EndDate").on("input", function() {
            var selectedDate = $(this).val();  // Get the selected date in format yyyy-mm-dd
            console.log("Selected End Date: ", selectedDate);  // Log the selected date

            if (selectedDate === "") {
                // Jika dikosongkan (Clear), tampilkan semua baris
                $("#TablesData tr").show();
                $("#pagination").show();
                return;
            }
            // Loop through each row and filter based on the end_date
            $("#TablesData tr").filter(function() {
                var endDateText = $(this).find('td').eq(9).text().trim();  // Assuming 'end_date' is in the 11th column (index 10)

                // Log the end date in each row for debugging
                console.log("Row End Date: " + endDateText);

                // Compare the selected date with the row's end_date
                $(this).toggle(endDateText === selectedDate);  // Show only rows that match the selected date
            });

            // Hide pagination while filtering
            $("#pagination").hide();
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
<script>
function disableButtons(permitNumber) {
    const approveBtn = document.getElementById('approve-btn-' + permitNumber);
    const rejectBtn = document.getElementById('reject-btn-' + permitNumber);

    [approveBtn, rejectBtn].forEach(btn => {
        if (btn) {
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            btn.title = 'Tindakan sudah dilakukan';
        }
    });
}

function approvePermit(permitNumber) {
    $.ajax({
        url: "{{ route('vendors.approve') }}",
        type: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            primary_number: permitNumber
        },
        success: function (response) {
            if (response.success) {
                $('#status-approval-' + permitNumber).html(
                    `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>`
                );
                disableButtons(permitNumber);
            }
        }
    });
}

function rejectPermit(permitNumber) {
    $.ajax({
        url: "{{ route('vendors.reject') }}",
        type: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            primary_number: permitNumber
        },
        success: function (response) {
            if (response.success) {
                $('#status-approval-' + permitNumber).html(
                    `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Reject</span>`
                );
                disableButtons(permitNumber);
            }
        }
    });
}

</script>


{{--
<script>
  $(document).ready(function(){
    var debounceTimeout;

    // Ketika pengguna mengetik di kolom pencarian
    $("#searchData").on("keyup", function() {
      var searchValue = $(this).val(); // Ambil nilai pencarian

      // Hapus timeout sebelumnya jika masih ada
      clearTimeout(debounceTimeout);

      // Set timeout untuk menunggu sebelum memulai pencarian
      debounceTimeout = setTimeout(function() {
        if (searchValue.length > 0) {
          $.ajax({
            url: '{{ route('vendor.search') }}', // Mengarahkan ke route pencarian
            method: 'GET',
            data: {
              searchData: searchValue // Kirimkan kata kunci pencarian
            },
            success: function(response) {
              // Jika ada hasil pencarian, update tabel dengan data yang sesuai
              var tableRows = '';
              response.forEach(function(vendor, index) {
                tableRows += `
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${index + 1}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${vendor.permit_number}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.company_name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.requestor_name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.location_of_work}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.building_level_room}</td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.work_description}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.email}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.phone_number}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.permit_number}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.start_date}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.end_date}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.number_plate}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.vehicle_types}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker1_name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker1_id_nopermit}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker2_name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker2_id_nopermit}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker3_name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker3_id_nopermit}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker4_name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker4_id_nopermit}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker5_name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.worker5_id_nopermit}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.generate_dust}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.protection_system}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.file_mos}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.status_approval_DHI ? 'Approved' : 'Pending'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.status_approval_FH ? 'Approved' : 'Pending'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${vendor.mode}</td>
                  </tr>
                `;
              });

              // Update tabel dengan hasil pencarian
              $('#TablesData').html(tableRows);

              // Menyembunyikan pagination ketika ada pencarian
              $('#paginationLinks').hide();
            }
          });
        } else {

             location.reload();
                  $('#paginationLinks').show();
        }
      }, 100); // Tunggu 500ms setelah pengguna berhenti mengetik
    });
  });
</script> --}}


    </main>

    <!-- Permit Detail Modal -->




</body>
</html>

@endsection
