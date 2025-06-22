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
    </style>
  </head>
  <body class="bg-gray-50">
    <!-- Navbar -->

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
        <!-- Page Title and Add Button -->
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-semibold text-gray-900">Employee Data</h1>
                   @if(Auth::user()->access_employe_create == 1)
          <button onclick="addNewEmployee()" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Add Employee
          </button>
          @endif
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 flex flex-wrap gap-4 bg-white p-4 rounded-lg shadow-sm">
          <div class="flex-1 min-w-[200px]">
            <label for="typeFilter" class="block text-sm font-semibold text-gray-700 mb-1">Permit Type</label>
            <select id="typeFilter" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
              <option value="all">All Types</option>
              <option value="visitor">Visitor</option>
              <option value="vendor">Vendor</option>
              <option value="employee">Employee</option>
            </select>
          </div>
          <div class="flex-1 min-w-[200px]">
            <label for="statusFilter" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
            <select id="statusFilter" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
              <option value="all">All Status</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
          <div class="flex-1 min-w-[200px]">
            <label for="searchFilter" class="block text-sm font-semibold text-gray-700 mb-1">Search</label>
            <input
              type="text"
              id="searchFilter"
              placeholder="Search employees..."
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
        </div>

        <!-- Employee List Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Card</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Sample Employee Row -->
              @foreach ($dataEmploye as $item)


              <tr class="table-row-hover">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->name}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->company_name}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->position}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->type}}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                     @if(Auth::user()->access_employe_view == 1)
            <button onclick="window.open('{{ asset('storage/'.$item->file_card) }}', '_blank')" class="text-primary hover:text-blue-700">
    <i class="fas fa-id-card mr-1"></i> View ID Card
</button>

                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                 <span class="px-2 py-1 text-xs font-medium rounded-full
    @if($item->status == 'Active') bg-green-100 text-green-800
    @elseif($item->status == 'Inactive') bg-red-100 text-red-800
    @endif">
    {{$item->status}}
</span>

                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                     @if(Auth::user()->access_employe_edit== 1)
            <button class="text-primary hover:text-blue-700 mr-3" title="Edit"
      onclick="editEmployee({{ $item->id_employe }}, '{{ $item->name }}', '{{ $item->company_name }}', '{{ $item->position }}', '{{ $item->type }}', '{{ $item->status }}', '{{ $item->file_card }}')">
      <i class="fas fa-edit"></i>
    </button>

                  @endif
                   @if(Auth::user()->access_employe_view == 1)
               <button onclick="previewEmployee({{ $item->id_employe }}, '{{ $item->name }}', '{{ $item->company_name }}', '{{ $item->position }}', '{{ $item->type }}', '{{ $item->status }}', '{{ $item->file_card }}')" class="text-yellow-600 hover:text-yellow-700 mr-3" title="View Details">
    <i class="fas fa-eye"></i>
</button>
                  @endif
                   @if(Auth::user()->access_employe_delete == 1)
                  <button class="text-red-600 hover:text-red-700" title="Delete">
                    <i class="fas fa-trash"></i>
                  </button>
                  @endif
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
                <button class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                  <span class="sr-only">Previous</span>
                  <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button aria-current="page" class="relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                  1
                </button>
                <button class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                  2
                </button>
                <button class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                  <span class="sr-only">Next</span>
                  <i class="fas fa-chevron-right text-sm"></i>
                </button>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Add Employee Modal -->
    <div id="addEmployeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Add Employee</h2>
          <button onclick="closeAddEmployeeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
        </div>
        <form id="addEmployeeForm" action="{{route('employee-store')}}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Full Name</label>
              <input type="text" id="addFullName" name="name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Company</label>
              <input type="text" id="addCompany" name="company_name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Position</label>
              <input type="text" id="addPosition" name="position" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Type</label>
              <input type="text" value="Employee" name="type" class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100" readonly />
            </div>
            <div>
          <div>
  <label class="block text-sm font-medium text-gray-700">ID Card / Passport</label>
  <div class="mt-1">
    <div class="flex items-center justify-center w-full">
      <label class="flex flex-col w-full h-48 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 rounded-lg relative">
        <div class="flex flex-col items-center justify-center h-full">
          <img id="idCardPreview" src="" alt="" class="hidden w-full h-full object-contain p-4">
          <div id="uploadIcon" class="flex flex-col items-center justify-center p-6">
            <i class="fas fa-id-card text-gray-400 text-4xl mb-4"></i>
            <p class="text-base text-gray-600 font-medium mb-2">Click to upload ID Card or Passport</p>
            <p class="text-sm text-gray-500">PNG, JPG, or PDF (max. 10MB)</p>
          </div>
          <span id="fileUploadedIcon" class="absolute top-0 right-0 hidden text-green-500 text-4xl">
            <i class="fas fa-check-circle"></i>
          </span>
        </div>
        <input type="file" name="file_card" id="idCardInput" class="opacity-0" accept=".png,.jpg,.jpeg,.pdf" />
      </label>
    </div>
  </div>
  <p class="mt-2 text-sm text-gray-500">Please upload a clear photo of your ID Card or Passport</p>
</div>


            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Status</label>
              <select id="addStatus" name="status" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" onclick="closeAddEmployeeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-blue-600">
              Add Employee
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit Employee Modal -->
  <!-- Edit Employee Modal -->
<!-- Edit Employee Modal -->
<!-- Edit Employee Modal -->
<!-- Edit Employee Modal -->
<div id="editEmployeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl mx-4">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Edit Employee</h2>
      <button onclick="closeEditEmployeeModal()" class="text-gray-400 hover:text-gray-600">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <form id="editEmployeeForm" action="{{route('employee-update')}}" method="POST" class="space-y-4" enctype="multipart/form-data">
      @csrf


      <!-- Hidden Employee ID Field -->
      <input type="hidden" id="employeeId" name="id_employe">

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Full Name</label>
          <input type="text" id="editFullName" name="name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Company</label>
          <input type="text" id="editCompany" name="company_name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Position</label>
          <input type="text" id="editPosition" name="position" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Type</label>
          <input type="text" id="editType" name="type" class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100" readonly />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">ID Card / Passport</label>
          <div class="mt-1">
            <div class="flex items-center justify-center w-full">
              <label class="flex flex-col w-full h-48 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 rounded-lg relative">
                <!-- Preview image -->
                <img id="editIdCardPreview" src="{{ asset('storage/'.$item->file_card) }}" alt="" class="hidden w-full h-full object-contain p-4">

                <!-- Upload icon and file input -->
                <div id="editUploadIcon" class="flex flex-col items-center justify-center p-6">
                  <i class="text-gray-400 text-4xl mb-4"></i>

                </div>

                <!-- File uploaded icon -->
                <span id="editFileUploadedIcon" class="absolute top-0 right-0 hidden text-green-500 text-4xl">
                  <i class="fas fa-check-circle"></i>
                </span>

                <!-- File input -->
                <input type="file" name="file_card" id="editIdCardInput" class="opacity-0" accept=".png,.jpg,.jpeg,.pdf" />
              </label>
            </div>
          </div>
          <p class="mt-2 text-sm text-gray-500">Please upload a clear photo of your ID Card or Passport</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Status</label>
          <select id="editStatus" name="status" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
        </div>
      </div>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeEditEmployeeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
          Cancel
        </button>
        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-blue-600">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div><!-- Edit Employee Modal -->
<div id="editEmployeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl mx-4">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Edit Employee</h2>
      <button onclick="closeEditEmployeeModal()" class="text-gray-400 hover:text-gray-600">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <form id="editEmployeeForm" action="" method="POST" class="space-y-4" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Hidden Employee ID Field -->
      <input type="hidden" id="employeeId" name="employeeId">

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Full Name</label>
          <input type="text" id="editFullName" name="name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Company</label>
          <input type="text" id="editCompany" name="company_name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Position</label>
          <input type="text" id="editPosition" name="position" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Type</label>
          <input type="text" id="editType" name="type" class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100" readonly />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">ID Card / Passport</label>
          <div class="mt-1">
            <div class="flex items-center justify-center w-full">
              <label class="flex flex-col w-full h-48 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 rounded-lg relative">
                <!-- Preview image -->

                <!-- File input -->
                <input type="file"  name="file_card" id="editIdCardInput" class="opacity-0" accept=".png,.jpg,.jpeg,.pdf" />
              </label>
            </div>
          </div>
          <p class="mt-2 text-sm text-gray-500">Please upload a clear photo of your ID Card or Passport</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Status</label>
          <select id="editStatus" name="status" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
        </div>
      </div>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeEditEmployeeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
          Cancel
        </button>
        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-blue-600">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>



    <!-- Preview Employee Modal -->
   <div id="previewEmployeeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Employee Details</h2>
            <button onclick="closePreviewEmployeeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
        </div>
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <p id="previewFullName" class="mt-1 text-sm text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Company</label>
                    <p id="previewCompany" class="mt-1 text-sm text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Position</label>
                    <p id="previewPosition" class="mt-1 text-sm text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <p id="previewType" class="mt-1 text-sm text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">ID Card / Passport</label>
                    <div class="mt-1">
                      <button onclick="window.open('{{ asset('storage/'.$item->file_card) }}', '_blank')" class="text-primary hover:text-blue-700">
    <i class="fas fa-id-card mr-1"></i> View ID Card
</button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <p id="previewStatus" class="mt-1 text-sm text-gray-900"></p>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- ID Card Preview Modal -->

<div id="idCardPreviewModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl mx-4">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">ID Card / Passport Preview</h2>
      <button onclick="closeIdCardPreview()" class="text-gray-400 hover:text-gray-600">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="flex justify-center">
      <!-- Image preview area -->
  <img id="idCardPreviewImage" src="{{ asset('storage/'.$item->file_card) }}" alt="ID Card Preview"  >
  </div>
  </div>
</div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
        <div class="text-center">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Confirmation</h3>
          <p id="confirmationMessage" class="text-sm text-gray-500 mb-6"></p>
          <div class="flex justify-center space-x-4">
            <button id="confirmNoBtn" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button id="confirmYesBtn" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-blue-600">
              Confirm
            </button>
        </div>
        </div>
      </div>
    </div>

    <!-- KTP Preview Modal -->
    <div id="ktpPreviewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
      <div class="bg-white rounded-lg p-4 max-w-2xl w-full mx-4">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-gray-900">KTP Photo Preview</h3>
          <button onclick="closeKTPPreview()" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="relative">
          <img
            id="ktpPreviewLarge"
            src=""
            alt="KTP Photo Preview"
            class="w-full h-auto rounded-lg"
          />
        </div>
      </div>
    </div>

<script>
    function previewEmployee(id, name, company, position, type, status, fileCard) {
    // Populate modal fields with employee data
    document.getElementById('previewFullName').innerText = name;
    document.getElementById('previewCompany').innerText = company;
    document.getElementById('previewPosition').innerText = position;
    document.getElementById('previewType').innerText = type;
    document.getElementById('previewStatus').innerText = status;

    // Open the modal
    document.getElementById('previewEmployeeModal').classList.remove('hidden');
}
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



      // Add event listeners for filters
      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('typeFilter').addEventListener('change', filterEmployees);
        document.getElementById('statusFilter').addEventListener('change', filterEmployees);
        document.getElementById('searchFilter').addEventListener('input', filterEmployees);
      });

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

      // Modal open/close functions
      function openAddEmployeeModal() {
        document.getElementById('addEmployeeModal').classList.remove('hidden');
      }
      function closeAddEmployeeModal() {
        document.getElementById('addEmployeeModal').classList.add('hidden');
        document.getElementById('addEmployeeForm').reset();
      }
    // Function to open the edit modal and fill the form with data
// Function to open the edit modal and fill the form with data
function editEmployee(id, name, company, position, type, status, fileCardPath) {
  // Populate the modal fields with the employee data
  document.getElementById('editFullName').value = name;
  document.getElementById('editCompany').value = company;
  document.getElementById('editPosition').value = position;
  document.getElementById('editType').value = type;
  document.getElementById('editStatus').value = status;

  // Set the existing file card image if available
  if (fileCardPath) {
    const editIdCardPreview = document.getElementById('editIdCardPreview');
    editIdCardPreview.src = `/storage/${fileCardPath}`; // Path to the existing image
    editIdCardPreview.classList.remove('hidden'); // Show the image
  }

  // Add the employee ID to the hidden input field in the form
  document.getElementById('employeeId').value = id;

  // Open the modal by removing the 'hidden' class
  document.getElementById('editEmployeeModal').classList.remove('hidden');
}

// Function to handle file upload and update the preview
document.getElementById('editIdCardInput').addEventListener('change', function (e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      // Show the uploaded image as preview
      const editIdCardPreview = document.getElementById('editIdCardPreview');
      editIdCardPreview.src = e.target.result;
      editIdCardPreview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
  }
});

// Function to close the edit modal
function closeEditEmployeeModal() {
  document.getElementById('editEmployeeModal').classList.add('hidden');
console.log("Modal editEmployeeModal muncul");

}


  // Here, you can send this data to the server or use it to update your database.



      function closeEditEmployeeModal() {
        document.getElementById('editEmployeeModal').classList.add('hidden');
        document.getElementById('editEmployeeForm').reset();
        // Reset ID card preview
        editIdCardPreview.classList.add('hidden');
        editUploadIcon.classList.remove('hidden');
      }

      function closePreviewEmployeeModal() {
        document.getElementById('previewEmployeeModal').classList.add('hidden');
      }



      // Confirmation modal logic
      let confirmAction = null;
      function showConfirmation(message, onYes) {
        document.getElementById('confirmationMessage').textContent = message;
        document.getElementById('confirmationModal').classList.remove('hidden');
        confirmAction = onYes;
      }
      document.getElementById('confirmYesBtn').onclick = function() {
        document.getElementById('confirmationModal').classList.add('hidden');
        if (typeof confirmAction === 'function') confirmAction();
      };
      document.getElementById('confirmNoBtn').onclick = function() {
        document.getElementById('confirmationModal').classList.add('hidden');
        confirmAction = null;
      };

      // Add Employee with confirmation


      // Edit Employee with confirmation


      // Delete Employee with confirmation

      // Open Add Employee Modal from button
      document.querySelector('button[onclick="addNewEmployee()"],button[onclick="openAddEmployeeModal()"]')?.addEventListener('click', openAddEmployeeModal);
      // Replace the old function with the new one
      window.addNewEmployee = openAddEmployeeModal;

      // Initial render
      renderEmployeesTable();

      // ID Card Preview
      const idCardInput = document.getElementById('idCardInput');
      const idCardPreview = document.getElementById('idCardPreview');
      const uploadIcon = document.getElementById('uploadIcon');

      idCardInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function(e) {
              idCardPreview.src = e.target.result;
              idCardPreview.classList.remove('hidden');
              uploadIcon.classList.add('hidden');
            }
          reader.readAsDataURL(file);
          } else {
            idCardPreview.classList.add('hidden');
            uploadIcon.classList.remove('hidden');
            alert('Please upload an image file (PNG, JPG, or JPEG)');
      }
        }
      });

      // Edit ID Card Preview
      const editIdCardInput = document.getElementById('editIdCardInput');
      const editIdCardPreview = document.getElementById('editIdCardPreview');
      const editUploadIcon = document.getElementById('editUploadIcon');

      editIdCardInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function(e) {
              editIdCardPreview.src = e.target.result;
              editIdCardPreview.classList.remove('hidden');
              editUploadIcon.classList.add('hidden');
            }
          reader.readAsDataURL(file);
          } else {
            editIdCardPreview.classList.add('hidden');
            editUploadIcon.classList.remove('hidden');
            alert('Please upload an image file (PNG, JPG, or JPEG)');
      }
        }
      });



      function closeIdCardPreview() {
        document.getElementById('idCardPreviewModal').classList.add('hidden');
      }


// Function to close the preview modal
function closePreviewEmployeeModal() {
  document.getElementById('previewEmployeeModal').classList.add('hidden');
}

    </script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
  const idCardInput = document.getElementById('idCardInput');
  const idCardPreview = document.getElementById('idCardPreview');
  const uploadIcon = document.getElementById('uploadIcon');
  const fileUploadedIcon = document.getElementById('fileUploadedIcon');

  idCardInput.addEventListener('change', function(e) {
    const file = e.target.files[0];

    // If a file is selected
    if (file) {
      if (file.type.startsWith('image/')) {  // Check if file is an image
        const reader = new FileReader();
        reader.onload = function(e) {
          idCardPreview.src = e.target.result;  // Display image
          idCardPreview.classList.remove('hidden');
          uploadIcon.classList.add('hidden');  // Hide upload icon
          fileUploadedIcon.classList.remove('hidden');  // Show the green checkmark icon
        };
        reader.readAsDataURL(file);  // Read the file and show it as a preview
      } else {
        // Reset if the file isn't an image
        alert('Please upload an image file (PNG, JPG, or JPEG)');
        idCardPreview.classList.add('hidden');
        uploadIcon.classList.remove('hidden');
        fileUploadedIcon.classList.add('hidden');
      }
    }
  });
});

</script>
<script>
function previewIdCard(idCardPath) {
  // Get the preview modal and the image element
  const idCardPreviewImage = document.getElementById('idCardPreviewImage');
  const idCardPreviewModal = document.getElementById('idCardPreviewModal');

  // Set the image source to the ID card path
  idCardPreviewImage.src = `/storage/${idCardPath}`;

  // Show the modal
  idCardPreviewModal.classList.remove('hidden');
}

// Function to close the ID Card preview modal
function closeIdCardPreview() {
  document.getElementById('idCardPreviewModal').classList.add('hidden');
}

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
  const idCardInput = document.getElementById('editIdCardInput');
  const idCardPreview = document.getElementById('editIdCardPreview');
  const uploadIcon = document.getElementById('editUploadIcon');
  const fileUploadedIcon = document.getElementById('editFileUploadedIcon');

  // Handle file change event
  idCardInput.addEventListener('change', function(e) {
    const file = e.target.files[0];

    // If a file is selected
    if (file) {
      if (file.type.startsWith('image/')) {  // Check if file is an image
        const reader = new FileReader();
        reader.onload = function(e) {
          // Display image preview
          idCardPreview.src = e.target.result;
          idCardPreview.classList.remove('hidden');  // Show preview
          uploadIcon.classList.add('hidden');  // Hide upload icon
          fileUploadedIcon.classList.remove('hidden');  // Show file uploaded icon
        };
        reader.readAsDataURL(file);  // Read the file and show it as a preview
      } else {
        // If not an image, show alert and reset the preview
        alert('Please upload an image file (PNG, JPG, or JPEG)');
        idCardPreview.classList.add('hidden');
        uploadIcon.classList.remove('hidden');
        fileUploadedIcon.classList.add('hidden');
      }
    }
  });
});

</script>
  </body>
</html>


@endsection
