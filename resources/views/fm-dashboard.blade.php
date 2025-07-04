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
    <style>
      .welcome-banner {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
      }
      .stat-card {
        position: relative;
        overflow: hidden;
      }
      .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1));
        pointer-events: none;
      }
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
    </style>
  </head>
  <body class="bg-gray-50">

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Stats and Quick Actions Section -->
        <div class="lg:col-span-2 space-y-8">
          <!-- Welcome Message -->
          <div class="welcome-banner rounded-lg shadow-sm p-6 text-white">
            <h1 class="text-2xl font-bold mb-2">Welcome, {{Auth::user()->name ?? ''}}</h1>
            <p class="text-white/80">Here's today's activity summary</p>
          </div>

          <!-- Stats Grid -->
         {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Employees</h3>
                  <p class="mt-2 text-3xl font-bold text-primary">{{$jmlEmploye ?? ''}}</p>
                </div>
                <div class="p-3 rounded-full bg-blue-50">
                  <i class="fas fa-users text-primary text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+{{$jmlEmployeT}} for today</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Employees</h3>
                  <p class="mt-2 text-3xl font-bold text-primary">{{$jmlEmploye ?? ''}}</p>
                </div>
                <div class="p-3 rounded-full bg-blue-50">
                  <i class="fas fa-users text-primary text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+{{$jmlEmployeT}} for today</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Total Vehicles</h3>
                  <p class="mt-2 text-3xl font-bold text-green-600">{{$jmlVehicle ?? ''}}</p>
                </div>
                <div class="p-3 rounded-full bg-green-50">
                  <i class="fas fa-car text-green-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+{{$jmlVehicleT}} for today</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Active Permits Today</h3>
                  <p class="mt-2 text-3xl font-bold text-yellow-600">{{$dataAktifPermit ?? ''}}</p>
                </div>
                <div class="p-3 rounded-full bg-yellow-50">
                  <i class="fas fa-clipboard-list text-yellow-600 text-xl"></i>
                </div>
              </div>
              <p class="mt-2 text-xs text-gray-500">+{{$dataAktifPermitT}} for today</p>
            </div>
            <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-gray-500 text-sm font-medium">Expiring Safety Induction (30 Days)</h3>
                  <p class="mt-2 text-3xl font-bold text-red-600">{{$safetiCount ?? ''}}</p>
                </div>
                <div class="p-3 rounded-full bg-red-50">
                  <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
              </div>
              <div class="mt-1 flex justify-between items-center">
                <p class="text-xs text-gray-500">expired in 30 days</p>
                <a href="analytics.html" class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-medium text-red-600 hover:text-red-700 transition-colors hidden">
                  <i class="fas fa-chart-line mr-0.5 text-[10px]"></i>
                  Check
                </a>
              </div>
            </div>
          </div> --}}



          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
  <!-- Card 1 -->
  <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
    <div class="flex flex-col items-start"> <!-- Changed from 'items-center' to 'items-start' -->
      <h3 class="text-gray-500 text-sm font-medium">Active Permits
Today</h3>
      <div class="flex items-center space-x-2 mt-2">
        <p class="text-3xl font-bold text-primary">{{$dataTodayPermits ?? ''}}</p>
       <i class="fas fa-clipboard-list text-blue-600 text-xl"></i>
      </div>
      {{-- <p class="mt-2 text-xs text-gray-500">+{{$jmlEmployeT}} for today</p> --}}
    </div>
  </div>

  <!-- Card 2 -->
  <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
    <div class="flex flex-col items-start"> <!-- Changed from 'items-center' to 'items-start' -->
      <h3 class="text-gray-500 text-sm font-medium">Active Visitor
Today</h3>
      <div class="flex items-center space-x-2 mt-2">
        <p class="text-3xl font-bold text-purple-600 ">{{$dataTodayPermitv ?? ''}}</p>
        <i class="fas fa-users  text-purple-600 text-xl"></i>
      </div>
      {{-- <p class="mt-2 text-xs text-gray-500">+{{$jmlEmployeT}} for today</p> --}}
    </div>
  </div>

  <!-- Card 3 -->
  <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
    <div class="flex flex-col items-start"> <!-- Changed from 'items-center' to 'items-start' -->
      <h3 class="text-gray-500 text-sm font-medium">Expected Permits
Next Week</h3>
      <div class="flex items-center space-x-2 mt-2">
        <p class="text-3xl font-bold text-green-600">{{$totalExceptedPermits ?? ''}}</p>
        <i class="fas fa-calendar text-green-600 text-xl"></i>
      </div>
      {{-- <p class="mt-2 text-xs text-gray-500">+{{$jmlVehicleT}} for today</p> --}}
    </div>
  </div>

  <!-- Card 4 -->
  <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
    <div class="flex flex-col items-start"> <!-- Changed from 'items-center' to 'items-start' -->
      <h3 class="text-gray-500 text-sm font-medium">Expected Visitor
Next Week</h3>
      <div class="flex items-center space-x-2 mt-2">
        <p class="text-3xl font-bold text-yellow-600">{{$dataExpectedPermitsNextWeekVisitor ?? ''}}</p>
        <i class="fas fa-user text-yellow-600 text-xl"></i>
      </div>
      {{-- <p class="mt-2 text-xs text-gray-500">+{{$dataAktifPermitT}} for today</p> --}}
    </div>
  </div>

  <!-- Card 5 -->
  <div class="stat-card bg-white p-6 rounded-lg shadow-sm">
    <div class="flex flex-col items-start"> <!-- Changed from 'items-center' to 'items-start' -->
      <h3 class="text-gray-500 text-sm font-medium">Pending Permit
Approval</h3>
      <div class="flex items-center space-x-2 mt-2">
        <p class="text-3xl font-bold text-red-600">{{$totalPending ?? ''}}</p>
        <i class="fas fa-clock text-red-600 text-xl"></i>
      </div>
      <div class="mt-1 flex justify-between items-center">
        {{-- <p class="text-xs text-gray-500">expired in 30 days</p> --}}
      </div>
    </div>
  </div>
</div>


          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">



                @if(Auth::user()->access_newspecial_create == 1)
              <button
                onclick="window.location.href='{{route('vendor_create')}}'"
                class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition"
              >
                <i class="fas fa-star text-primary text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">New Special</span>
              </button>
        @endif
              <button
                onclick="window.location.href='{{route('index_approve')}}'"
                class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition"
              >
                <i class="fas fa-check-circle text-green-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Approval</span>
              </button>
   @if (Auth::user()->access_visvin_view == 1)
                      <button
                onclick="window.location.href='{{route('permit-data')}}'"
                class="flex flex-col items-center justify-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition"
              >
                <i class="fas fa-users text-orange-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Visitor & Work</span>
              </button>
@endif
   @if (Auth::user()->access_vehicle_view == 1)
              <button
                onclick="window.location.href='{{route('vehicle-list')}}'"
                class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition"
              >
                <i class="fas fa-car text-purple-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Vehicle Data</span>
              </button>
              @endif
                 @if (Auth::user()->access_report_view == 1)
              <button
                onclick="window.location.href='{{route('employee-data')}}'"
                class="flex flex-col items-center justify-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition"
              >
                <i class="fas fa-users text-yellow-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Employee Data</span>
              </button>
              @endif
                 @if (Auth::user()->access_safety_view == 1)
              <button
                onclick="window.location.href='{{route('employee-safety-list')}}'"
                class="flex flex-col items-center justify-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition"
              >
                <i class="fas fa-clipboard-check text-red-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Safety Induction</span>
              </button>
              @endif
                 @if (Auth::user()->access_report_view == 1)
              <button
                onclick="window.location.href='{{route('reports')}}'"
                class="flex flex-col items-center justify-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition"
              >
                <i class="fas fa-chart-bar text-indigo-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Reports</span>
              </button>
              @endif
            </div>
          </div>

          <!-- Permit Requests Section -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-medium text-gray-900">Permit Requests</h2>
              <div class="flex space-x-2">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                  Vendor: <span id="visitorPermitCount">{{$dataVendor->count() ?? ''}}</span>
                </span>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                  Visitor: <span id="vendorPermitCount">{{$dataVisitor->count() ?? ''}}</span>
                </span>
              </div>
            </div>


            <!-- Vendor Permit Requests -->
            <div>
              <h3 class="text-md font-medium text-gray-700 mb-3">Vendor Permits</h3>
              <div class="space-y-4">
                <!-- Vendor Permit 1 -->
                @foreach ($dataVendor as $item)


                <div id="permit-VD001" class="vendor-permit flex items-center justify-between p-4 @if($item->mode == "Urgent") bg-red-50 @else bg-gray-50 @endif rounded-lg border-l-4 @if($item->mode == "Urgent") border-red-500 @else border-blue-500 @endif relative overflow-hidden">
                  <div class="absolute top-0 right-0 w-24 h-24 @if($item->mode == "Urgent") bg-red-100 @else bg-gray-100 @endif opacity-20 transform rotate-45 translate-x-12 -translate-y-12"></div>
                  <div>

                    <p class="text-xs text-gray-500">Vendor: {{$item->company_name}}</p>
                    <p class="text-xs text-gray-500">Purpose: {{$item->work_description}}</p>
                    <p class="text-xs text-gray-500">Date: {{$item->validity_date_from}} - {{$item->validity_date_to}}</p>
                </div>
                <div class="flex space-x-2">
                      <div class="flex items-center space-x-2">
                        @if($item->mode == "Urgent")
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full flex items-center">
                              <i class="fas fa-exclamation-circle mr-1 animate-pulse"></i>
                              Urgent
                            </span>@endif
                          </div>
                    <a href="{{route('vendor_view',$item->id_vendor)}}" class="px-3 py-1 @if($item->mode == "Urgent") bg-red-100 text-red-800 @else  bg-blue-100 text-blue-800 @endif rounded-md text-xs font-medium hover:bg-red-200 transition-colors">
                      View Details
                    </a>
                  </div>
                </div>
   @endforeach
                <!-- Vendor Permit 2 -->

              </div>
            </div>
<br>
  <div>
              <h3 class="text-md font-medium text-gray-700 mb-3">Visitor Permits</h3>
              <div class="space-y-4">
                <!-- visitor Permit 1 -->
                @foreach ($dataVisitor as $item)


                <div id="permit-VD001" class="visitor-permit flex items-center justify-between p-4  bg-gray-50  rounded-lg border-l-4  border-purple-500  relative overflow-hidden">
                  <div class="absolute top-0 right-0 w-24 h-24  bg-gray-100  opacity-20 transform rotate-45 translate-x-12 -translate-y-12"></div>
                  <div>

                    <p class="text-xs text-gray-500">Visitor: {{$item->company_name}}</p>
                    <p class="text-xs text-gray-500">Purpose: {{$item->purpose_detail}}</p>
                    <p class="text-xs text-gray-500">Date: {{$item->request_date_from}} - {{$item->request_date_to}}</p>
                </div>
                <div class="flex space-x-2">
                      <div class="flex items-center space-x-2">
                        @if($item->mode == "Urgent")
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full flex items-center">
                              <i class="fas fa-exclamation-circle mr-1 animate-pulse"></i>
                              Urgent
                            </span>@endif
                          </div>
                    <a href="{{route('visitor_view',$item->id_visitor)}}" class="px-3 py-1   bg-purple-100 text-purple-800  rounded-md text-xs font-medium hover:bg-red-200 transition-colors">
                      View Details
                    </a>
                  </div>
                </div>
   @endforeach
                <!-- Vendor Permit 2 -->

              </div>
            </div>

          </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-8">
          <!-- Recent Activities -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Recent Activities</h2>
            <div class="space-y-4">
           <!-- Recent Activities -->

    <div class="space-y-4" id="recentActivitiesContainer">
        <!-- Data akan diisi oleh JavaScript -->
    </div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menyisipkan data histori dari Blade ke JavaScript
        const dataAktifitas = @json($dataAktifitas);

        // Menampilkan data histori ke dalam container
        const container = document.getElementById('recentActivitiesContainer');
        container.innerHTML = '';  // Bersihkan isi sebelumnya

        dataAktifitas.forEach(item => {
            // Tentukan ikon dan warna berdasarkan item.type
            let iconClass = '';
            let bgColor = '';
            let textColor = '';
            switch(item.type) {
               case 'Vendor':
                    iconClass = 'fas fa-user';
                    iconColor = 'bg-blue-100';
                    textColor = 'text-blue-600';
                    break;
                case 'Visitor':
                    iconClass = 'fas fa-user';
                    iconColor = 'bg-green-100';
                       textColor = 'text-green-600';
                    break;
                case 'Vehicle':
                    iconClass = 'fas fa-car';
                    iconColor = 'bg-purple-100';
                       textColor = 'text-purple-600';
                    break;
                case 'Employee':
                    iconClass = 'fas fa-users';
                    iconColor = 'bg-yellow-50';
                       textColor = 'text-yellow-600';
                    break;
                case 'Employee Safety':
                    iconClass = 'fas fa-clipboard-check';
                    iconColor = 'bg-red-50';
                       textColor = 'text-red-600';
                    break;
                case 'Employee Safety Freedoms':
                      iconClass = 'fas fa-clipboard-check';
                    iconColor = 'bg-red-50';
                       textColor = 'text-red-600';
                    break;
                default:
                    iconClass = 'fas fa-exclamation-circle';
                    bgColor = 'bg-red-100';
                    textColor = 'text-red-600';
            }

            // Membuat elemen baru untuk menampilkan aktivitas
            const itemElement = document.createElement('div');
            itemElement.classList.add('flex', 'items-start', 'space-x-3');

            itemElement.innerHTML = `
                <div class="p-2 rounded-full ${bgColor}">
                    <i class="${iconClass} ${textColor}"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">${item.judul}</p>
                    <p class="text-xs text-gray-500">${item.text}</p>
                    <p class="text-xs text-gray-400 mt-1">${new Date(item.created_at).toLocaleString()}</p>  <!-- Waktu diformat dengan JavaScript -->
                </div>
            `;

            container.appendChild(itemElement);
        });
    });
</script>


            </div>
          </div>

          <!-- Quick Tips -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Tips</h2>
            <div class="space-y-3">
              <div class="flex items-start space-x-3">
                <i class="fas fa-lightbulb text-yellow-500 mt-1"></i>
                <p class="text-sm text-gray-600">Use Quick Actions for quick access to frequently used features</p>
              </div>
              <div class="flex items-start space-x-3">
                <i class="fas fa-bell text-primary mt-1"></i>
                <p class="text-sm text-gray-600">Check notifications for latest updates</p>
              </div>
              <div class="flex items-start space-x-3">
                <i class="fas fa-chart-line text-green-500 mt-1"></i>
                <p class="text-sm text-gray-600">View statistics for activity monitoring</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>



    <!-- Permit Details Modal -->
    <div id="permitDetailsModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
      <div id="modalContent" class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4">
        <div class="p-6">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Permit Details</h3>
            <button onclick="closePermitDetailsModal()" class="text-gray-400 btn-hover">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="space-y-4">
            <div>
              <h4 class="text-sm font-medium text-gray-500">Permit Number</h4>
              <p class="mt-1 text-sm text-gray-900">DHI/PERMIT/2024/04/0001</p>
            </div>
            <div>
              <h4 class="text-sm font-medium text-gray-500">Visitor Information</h4>
              <p class="mt-1 text-sm text-gray-900">John Smith</p>
              <p class="text-sm text-gray-500">john.smith@example.com</p>
              <p class="text-sm text-gray-500">+1 234 567 8900</p>
            </div>
            <div>
              <h4 class="text-sm font-medium text-gray-500">Visit Details</h4>
              <p class="mt-1 text-sm text-gray-900">Client Meeting</p>
              <p class="text-sm text-gray-500">Date: Today, 2:00 PM - 4:00 PM</p>
              <p class="text-sm text-gray-500">Location: Conference Room A</p>
            </div>
            <div>
              <h4 class="text-sm font-medium text-gray-500">Additional Notes</h4>
              <p class="mt-1 text-sm text-gray-900">Meeting with the marketing team to discuss the new campaign.</p>
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-3">
            <button onclick="closePermitDetailsModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium btn-hover">
              Close
            </button>
            <button onclick="approvePermit('V001', 'visitor')" class="px-4 py-2 bg-green-600 text-white rounded-md text-sm font-medium btn-hover">
              Approve
            </button>
            <button onclick="rejectPermit('V001', 'visitor')" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-medium btn-hover">
              Reject
            </button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

@endsection
