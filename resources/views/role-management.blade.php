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
    </script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->

    <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

      <div class="mb-4">
                <a href="{{route('/')}}" class="inline-flex items-center text-gray-600 hover:text-primary transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Back to Dashboard</span>
                </a>
            </div>
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Left Column - Role List -->
    <div class="lg:col-span-4 space-y-6">
      <!-- User List -->
      <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-lg font-medium text-gray-900">Users</h2>
        </div>
        <div class="space-y-4">
          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex justify-between items-center">
              <div>
                <h3 class="text-md font-medium text-gray-900">{{Auth::user()->name ?? ' '}}</h3>
                <p class="text-sm text-gray-500">{{Auth::user()->email ?? ' '}}</p>
              </div>
              <p class="form-select text-sm border-gray-300 rounded-md">
               {{Auth::user()->role ?? ' '}}

              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Role List -->
      <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-lg font-medium text-gray-900">Roles</h2>
        </div>
        <div class="space-y-4">
          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex justify-between items-center">
              <div>
                <h3 class="text-md font-medium text-gray-900">DHI</h3>
                <p class="text-sm text-gray-500">Full access to all features and settings</p>
              </div>
            </div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex justify-between items-center">
              <div>
                <h3 class="text-md font-medium text-gray-900">FM</h3>
                <p class="text-sm text-gray-500">Access to employee data and approvals</p>
              </div>
            </div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex justify-between items-center">
              <div>
                <h3 class="text-md font-medium text-gray-900">Client</h3>
                <p class="text-sm text-gray-500">Basic access to personal data and requests</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column - Permissions -->
    <div class="lg:col-span-8">
      <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-lg font-medium text-gray-900">Permissions</h2>
          <form id="regisForm" action="{{route('regisuser.update',$dataUser->id)}}" method="POST">
             @csrf
    @method('PUT')

            <input type="hidden" name="id" value="{{$dataUser->id}}">
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Save Changes
          </button>
        </div>
        <div id="permissionsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Static Permissions for all Roles -->

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex items-center mb-3">
              <i class="fas fa-home text-primary mr-2"></i>
              <h3 class="text-md font-medium text-gray-700">New Special</h3>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_newspecial_view" class="form-checkbox h-4 w-4 text-primary" disabled>
                <span class="text-sm text-gray-600">View</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_newspecial_create" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_newspecial_create == 1) checked @endif>
                <span class="text-sm text-gray-600">Create</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_newspecial_edit" class="form-checkbox h-4 w-4 text-primary" disabled>
                <span class="text-sm text-gray-600">Update</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_newspecial_delete" class="form-checkbox h-4 w-4 text-primary" disabled>
                <span class="text-sm text-gray-600">Delete</span>
              </label>
            </div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex items-center mb-3">
              <i class="fas fa-users text-primary mr-2"></i>
              <h3 class="text-md font-medium text-gray-700">Employee Data</h3>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_employe_view" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_employe_view == 1) checked @endif>
                <span class="text-sm text-gray-600">View</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_employe_create" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_employe_create == 1) checked @endif>
                <span class="text-sm text-gray-600">Create</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_employe_edit" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_employe_edit == 1) checked @endif>
                <span class="text-sm text-gray-600">Update</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_employe_delete" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_employe_delete == 1) checked @endif>
                <span class="text-sm text-gray-600">Delete</span>
              </label>
            </div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex items-center mb-3">
              <i class="fas fa-check-circle text-primary mr-2"></i>
              <h3 class="text-md font-medium text-gray-700">Approvals</h3>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_approvals_view" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_approvals_view == 1) checked @endif>
                <span class="text-sm text-gray-600">View</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_approvals_create" class="form-checkbox h-4 w-4 text-primary" disabled>
                <span class="text-sm text-gray-600">Create</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_approvals_edit" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_approvals_edit == 1) checked @endif>
                <span class="text-sm text-gray-600">Update</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_approvals_delete" class="form-checkbox h-4 w-4 text-primary" disabled>
                <span class="text-sm text-gray-600">Delete</span>
              </label>
            </div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex items-center mb-3">
              <i class="fas fa-user-plus text-primary mr-2"></i>
              <h3 class="text-md font-medium text-gray-700">Visitor & Vendor</h3>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_visvin_view" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_visvin_view == 1) checked @endif>
                <span class="text-sm text-gray-600">View</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_visvin_create" class="form-checkbox h-4 w-4 text-primary" disabled>
                <span class="text-sm text-gray-600">Create</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_visvin_edit" class="form-checkbox h-4 w-4 text-primary" disabled>
                <span class="text-sm text-gray-600">Update</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_visvin_delete" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_visvin_delete == 1) checked @endif>
                <span class="text-sm text-gray-600">Delete</span>
              </label>
            </div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex items-center mb-3">
              <i class="fas fa-car text-primary mr-2"></i>
              <h3 class="text-md font-medium text-gray-700">Vehicle List</h3>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_vehicle_view" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_vehicle_view == 1) checked @endif>
                <span class="text-sm text-gray-600">View</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_vehicle_create" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_vehicle_create == 1) checked @endif>
                <span class="text-sm text-gray-600">Create</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_vehicle_edit" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_vehicle_edit == 1) checked @endif>
                <span class="text-sm text-gray-600">Update</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_vehicle_delete" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_vehicle_delete == 1) checked @endif>
                <span class="text-sm text-gray-600">Delete</span>
              </label>
            </div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex items-center mb-3">
              <i class="fas fa-clipboard-check text-primary mr-2"></i>
              <h3 class="text-md font-medium text-gray-700">Safety Induction</h3>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_safety_view" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_safety_view == 1) checked @endif>
                <span class="text-sm text-gray-600">View</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_safety_create" class="form-checkbox h-4 w-4 text-primary" disabled>
                <span class="text-sm text-gray-600">Create</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_safety_edit" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_safety_edit == 1) checked @endif>
                <span class="text-sm text-gray-600">Update</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_safety_delete" class="form-checkbox h-4 w-4 text-primary" disabled>
                <span class="text-sm text-gray-600">Delete</span>
              </label>
            </div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex items-center mb-3">
              <i class="fas fa-chart-bar text-primary mr-2"></i>
              <h3 class="text-md font-medium text-gray-700">Reports</h3>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_report_view" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_report_view == 1) checked @endif>
                <span class="text-sm text-gray-600">View</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_report_create" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_report_create == 1) checked @endif>
                <span class="text-sm text-gray-600">Create</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_report_edit" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_report_edit == 1) checked @endif>
                <span class="text-sm text-gray-600">Update</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_report_delete" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_report_delete == 1) checked @endif>
                <span class="text-sm text-gray-600">Delete</span>
              </label>
            </div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex items-center mb-3">
              <i class="fas fa-user-shield text-primary mr-2"></i>
              <h3 class="text-md font-medium text-gray-700">Role Management</h3>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_role_view" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_role_view == 1) checked @endif>
                <span class="text-sm text-gray-600">View</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_role_create" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_role_create == 1) checked @endif>
                <span class="text-sm text-gray-600">Create</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_role_edit" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_role_edit == 1) checked @endif>
                <span class="text-sm text-gray-600">Update</span>
              </label>
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="access_role_delete" class="form-checkbox h-4 w-4 text-primary" @if($dataUser->access_role_delete == 1) checked @endif>
                <span class="text-sm text-gray-600">Delete</span>
              </label>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>

</form>
    <script>
      // Function to save permissions
      function savePermissions() {
        const checkboxes = document.querySelectorAll('#permissionsContainer input[type="checkbox"]');
        const permissions = {};

        checkboxes.forEach(checkbox => {
          const menuName = checkbox.closest('.bg-gray-50').querySelector('h3').textContent;
          const permission = checkbox.nextElementSibling.textContent.toLowerCase();
          if (!permissions[menuName]) {
            permissions[menuName] = [];
          }
          if (checkbox.checked) {
            permissions[menuName].push(permission);
          }
        });

        console.log('Saving permissions:', permissions);
        alert('Permissions saved successfully!');
      }
    </script>
</body>
</html>
<script>
  // Ambil elemen form dan tombol
  const form = document.getElementById('regisForm');
  const submitButton = form.querySelector('button[type="submit"]');

  // Event listener untuk tombol submit
  submitButton.addEventListener('click', function(event) {
    event.preventDefault();  // Mencegah form submit langsung

    // Menampilkan SweetAlert konfirmasi
    Swal.fire({
      title: 'Are you sure?',
      text: "You are about to save changes!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, save it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        // Jika konfirmasi di-click, submit form
        form.submit();
      }
    });
  });
</script>
@endsection
