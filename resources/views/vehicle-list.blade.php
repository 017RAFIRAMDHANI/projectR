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
      .table-row-hover {
        transition: background-color 0.2s ease;
      }
      .table-row-hover:hover {
        background-color: rgba(0, 0, 0, 0.02);
      }
      .action-btn {
        transition: all 0.2s ease;
      }
      .action-btn:hover {
        transform: scale(1.1);
      }
      .pagination-btn {
        transition: all 0.2s ease;
      }
      .pagination-btn:hover {
        background-color: rgba(0, 0, 0, 0.05);
      }
      .pagination-btn:active {
        background-color: rgba(0, 0, 0, 0.1);
      }
    </style>
  </head>
  <body class="bg-gray-50">



    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Back Button -->
      <div class="mb-6">
        <a href="{{route('/')}}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
          <i class="fas fa-arrow-left mr-2"></i>
          Back to Dashboard
        </a>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6">
        <!-- Back Button and Page Title -->
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-semibold text-gray-900">Vehicle List</h1>
           @if(Auth::user()->access_vehicle_create == 1)
          <button onclick="openModal()" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Add Vehicle
          </button>
@endif
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 flex flex-wrap gap-4">
          <div class="flex-1 min-w-[200px]">
            <input
              type="text"
              placeholder="Search vehicle..."
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
          <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="">All Types</option>
            <option value="car">Car</option>
            <option value="motorcycle">Motorcycle</option>
          </select>
          <div class="flex gap-2">
            <input
              type="date"
              placeholder="From Date"
              class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
            <input
              type="date"
              placeholder="To Date"
              class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
        </div>

        <!-- Vehicle List Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">License Plate</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                      @if(Auth::user()->access_vehicle_view == 1 || Auth::user()->access_vehicle_edit == 1 || Auth::user()->access_vehicle_create == 1)
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
             @endif
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Sample Vehicle Row -->

              @foreach ($dataVehicle as $item)


              <tr class="table-row-hover">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->number_plate}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->type}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->name}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->company}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->date_from}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->date_to}}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                 <span class="px-2 py-1 text-xs font-medium rounded-full
    {{ $item->status == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
    {{ ucfirst($item->status) }}
</span>

                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <div class="flex space-x-2">
                       @if(Auth::user()->access_vehicle_edit == 1)
              <button onclick="editVehicle({{$item->id_vehicle}}, '{{$item->number_plate}}', '{{$item->type}}', '{{$item->name}}', '{{$item->company}}', '{{$item->date_from}}', '{{$item->date_to}}', '{{$item->status}}')" class="text-yellow-600 hover:text-yellow-900" title="Edit">
    <i class="fas fa-edit"></i>
</button>

                    @endif
     @if(Auth::user()->access_vehicle_view == 1)
                  <button onclick="viewVehicleDetails('{{$item->id_vehicle}}', '{{$item->number_plate}}', '{{$item->type}}', '{{$item->name}}', '{{$item->company}}', '{{$item->date_from}}', '{{$item->date_to}}', '{{$item->status}}')" class="text-blue-600 hover:text-blue-900" title="View Details">
          <i class="fas fa-eye"></i>
        </button>
        @endif
@if(Auth::user()->access_vehicle_delete == 1)
    <form id="deleteForm{{$item->id_vehicle}}" action="{{route('vehicle-delete')}}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="id_vehicle" value="{{$item->id_vehicle}}">
    </form>
    <button class="text-red-600 hover:text-red-700" title="Delete" onclick="confirmDelete({{ $item->id_vehicle }})">
        <i class="fas fa-trash"></i>
    </button>
@endif

                  </div>
                </td>
              </tr>
                   @endforeach
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
          <div class="flex flex-1 justify-between sm:hidden">
            <button class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
              Previous
            </button>
            <button class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
              Next
            </button>
          </div>
          <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> entries
              </p>
            </div>
            <div>
              <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <button class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 pagination-btn">
                  <span class="sr-only">Previous</span>
                  <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button aria-current="page" class="relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary pagination-btn">
                  1
                </button>
                <button class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 pagination-btn">
                  2
                </button>
                <button class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 pagination-btn">
                  <span class="sr-only">Next</span>
                  <i class="fas fa-chevron-right text-sm"></i>
                </button>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Add/Edit Vehicle Modal -->
    <div id="vehicleModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Add New Vehicle</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <form id="vehicleForm" action="{{route('vehicle-store')}}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">License Plate</label>
                <input type="text" name="number_plate" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                <select name="type" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option value="">Select Type</option>
                  <option value="Car">Car</option>
                  <option value="Motorcycle">Motorcycle</option>
                </select>
              </div>
            </div>
 <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Name</label>
              <input name="name" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Company</label>
              <input name="company" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
            </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Request Date</label>
                <input name="date_from" type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Expiry Date</label>
                <input name="date_to" type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Status</label>
              <select name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                <option disabled value="">Pilih Status...</option>
                <option selected value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>

            <div class="flex justify-end gap-3">
              <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                Cancel
              </button>
              <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Detail Vehicle Modal -->
  <!-- Detail Vehicle Modal -->
<div id="detailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
  <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-900">Vehicle Details</h3>
        <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">License Plate</label>
            <p class="mt-1 text-sm text-gray-900" id="detailPlate">B 1234 ABC</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Vehicle Type</label>
            <p class="mt-1 text-sm text-gray-900" id="detailType">Car</p>
          </div>
        </div>
         <div class="grid grid-cols-2 gap-4">
    <div>
          <label class="block text-sm font-medium text-gray-700">Name</label>
          <p class="mt-1 text-sm text-gray-900" id="detailName">Renaldi</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Company</label>
          <p class="mt-1 text-sm text-gray-900" id="detailCompany">PT. Example Visitor</p>
        </div>
        </div>


        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Request Date</label>
            <p class="mt-1 text-sm text-gray-900" id="detailRequestDate">2024-03-20</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Expiry Date</label>
            <p class="mt-1 text-sm text-gray-900" id="detailExpiryDate">2024-03-21</p>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Status</label>
          <p class="mt-1 text-sm text-gray-900" id="detailStatus">Active</p>
        </div>
      </div>
    </div>
  </div>
</div>


    <!-- Edit Vehicle Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Edit Vehicle</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <form id="editForm" action="{{route('vehicle-update')}}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <input type="hidden" id="editVehicleId" name="id_vehicle">

              <div>
                <label class="block text-sm font-medium text-gray-700">License Plate</label>
                <input type="text" id="editPlate" name="number_plate" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                <select name="type" id="editType" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option disabled value="">Select Type</option>
                  <option value="Car">Car</option>
                  <option value="Motorcycle">Motorcycle</option>
                </select>
              </div>
            </div>
             <div class="grid grid-cols-2 gap-4">
 <div>
              <label class="block text-sm font-medium text-gray-700">Name</label>
              <input name="name" type="text"  id="editName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Company</label>
              <input type="text" name="company" id="editCompany" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
            </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Request Date</label>
                <input type="date" name="date_from" id="editRequestDate" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Expiry Date</label>
                <input type="date" name="date_to" id="editExpiryDate" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Status</label>
              <select name="status" id="editStatus" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>

            <div class="flex justify-end gap-3">
              <button type="button" onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                Cancel
              </button>
              <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700">
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
<script>
    function confirmDelete(id) {
    // Menampilkan SweetAlert2 konfirmasi
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika user mengkonfirmasi, submit form yang sudah disembunyikan
            document.getElementById('deleteForm' + id).submit();
        }
    });
}

</script>
    <script>
      function
      openModal() {
        document.getElementById('vehicleModal').classList.remove('hidden');
      }

      function closeModal() {
        document.getElementById('vehicleModal').classList.add('hidden');
      }

    function viewVehicleDetails(id, number_plate, type,name,company, date_from, date_to, status) {
  // Mengisi data ke modal detail
  document.getElementById('detailPlate').textContent = number_plate;
  document.getElementById('detailType').textContent = type;
  document.getElementById('detailCompany').textContent = company;
  document.getElementById('detailName').textContent = name;
  document.getElementById('detailRequestDate').textContent = date_from;
  document.getElementById('detailExpiryDate').textContent = date_to;
  document.getElementById('detailStatus').textContent = status;

  // Menampilkan modal
  document.getElementById('detailModal').classList.remove('hidden');
}


      function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
      }

  function editVehicle(id_vehicle, number_plate, type, name,company, date_from, date_to, status) {
    // Mengisi data ke form edit modal
    console.log('Edit button clicked');
console.log(number_plate, type, company, date_from, date_to, status);
    document.getElementById('editPlate').value = number_plate;
    document.getElementById('editType').value = type;
    document.getElementById('editCompany').value = company;
    document.getElementById('editName').value = name;
    document.getElementById('editRequestDate').value = date_from;
    document.getElementById('editExpiryDate').value = date_to;
    document.getElementById('editStatus').value = status;

    // Menyimpan id kendaraan di form
    document.getElementById('editVehicleId').value = id_vehicle;

    // Menampilkan modal edit
    document.getElementById('editModal').classList.remove('hidden');
}

      function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
      }

      // Event listener untuk form

      // Close modals when clicking outside
      document.addEventListener('click', function(event) {
        const vehicleModal = document.getElementById('vehicleModal');
        const detailModal = document.getElementById('detailModal');
        const editModal = document.getElementById('editModal');

        if (event.target === vehicleModal) {
          closeModal();
        }
        if (event.target === detailModal) {
          closeDetailModal();
        }
        if (event.target === editModal) {
          closeEditModal();
        }
      });

      // Notification functions
      function toggleNotifications() {
        const panel = document.getElementById('notificationsPanel');
        panel.classList.toggle('hidden');
        // Close profile menu if open
        document.getElementById('userMenu').classList.add('hidden');
      }

      // Profile menu functions
      function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
        // Close notifications if open
        document.getElementById('notificationsPanel').classList.add('hidden');
      }

      // Close dropdowns when clicking outside
      document.addEventListener('click', function(event) {
        const notificationsPanel = document.getElementById('notificationsPanel');
        const userMenu = document.getElementById('userMenu');

        if (!event.target.closest('#notificationsPanel') && !event.target.closest('button[onclick="toggleNotifications()"]')) {
          notificationsPanel.classList.add('hidden');
        }

        if (!event.target.closest('#userMenu') && !event.target.closest('button[onclick="toggleUserMenu()"]')) {
          userMenu.classList.add('hidden');
        }
      });

      function logout() {
        localStorage.clear();
        sessionStorage.clear();
        window.location.href = 'login.html';
      }
    </script>
  </body>
</html>


@endsection
