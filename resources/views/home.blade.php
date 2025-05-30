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
  <body class="bg-gray-50">


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Stats and Quick Actions Section -->
        <div class="lg:col-span-2 space-y-8">
          <!-- Stats Grid -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Pending Permits</h3>
              <p class="mt-2 text-3xl font-semibold text-primary">12</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">
                Approved Permits
              </h3>
              <p class="mt-2 text-3xl font-semibold text-green-600">45</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Active Visitors</h3>
              <p class="mt-2 text-3xl font-semibold text-blue-600">8</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Total Databases</h3>
              <p class="mt-2 text-3xl font-semibold text-purple-600">5</p>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">
              Quick Actions
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <button
                onclick="window.location.href='{{route('vendor_create')}}'"
                class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition"
              >
                <i
                  class="fas fa-file-alt text-primary text-xl mb-2"
                ></i>
                <span class="text-sm font-medium text-gray-700"
                  >New Spesial Permit</span
                >
              </button>
              <button
                onclick="window.location.href='permits.html'"
                class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition"
              >
                <i class="fas fa-check-circle text-green-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700"
                  >My Permits</span
                >
              </button>
              <button
                onclick="window.location.href='database.html'"
                class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition"
              >
                <i class="fas fa-database text-purple-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700"
                  >View Database</span
                >
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

          <!-- Permit Statistics -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-medium text-gray-900">Permit Overview</h2>
              <a
                href="permits.html"
                class="text-sm text-primary hover:text-blue-700"
                >View All</a
              >
            </div>
            <div class="space-y-6">
              <!-- Permit Status Distribution -->
              <div class="grid grid-cols-4 gap-4">
                <div class="text-center">
                  <div class="text-2xl font-semibold text-primary">12</div>
                  <div class="text-sm text-gray-500">Pending</div>
                </div>
                <div class="text-center">
                  <div class="text-2xl font-semibold text-green-600">45</div>
                  <div class="text-sm text-gray-500">Approved</div>
                </div>
                <div class="text-center">
                  <div class="text-2xl font-semibold text-red-600">3</div>
                  <div class="text-sm text-gray-500">Rejected</div>
                </div>
                <div class="text-center">
                  <div class="text-2xl font-semibold text-orange-600">5</div>
                  <div class="text-sm text-gray-500">On Hold</div>
                </div>
              </div>

              <!-- Recent Permits -->
              <div>
                <h3 class="text-sm font-medium text-gray-700 mb-3">
                  Recent Permit Requests
                </h3>
                <div class="space-y-3">
                  <div
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg"
                  >
                    <div>
                      <p class="text-sm font-medium text-gray-900">
                        Server Room Access - John Smith
                      </p>
                      <p class="text-xs text-gray-500">Tech Solutions Inc.</p>
                    </div>
                    <span
                      class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800"
                      >Pending</span
                    >
                  </div>
                  <div
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg"
                  >
                    <div>
                      <p class="text-sm font-medium text-gray-900">
                        Network Maintenance - Sarah Davis
                      </p>
                      <p class="text-xs text-gray-500">
                        Network Solutions Ltd.
                      </p>
                    </div>
                    <span
                      class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800"
                      >Approved</span
                    >
                  </div>
                  <div
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg"
                  >
                    <div>
                      <p class="text-sm font-medium text-gray-900">
                        Equipment Installation - Mike Johnson
                      </p>
                      <p class="text-xs text-gray-500">Hardware Systems Co.</p>
                    </div>
                    <span
                      class="px-2 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800"
                      >On Hold</span
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



        <!-- Recent Activity Section -->
        <div class="lg:col-span-1">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">
              Recent Activity
            </h2>
            <div class="space-y-4">
              <div class="flex items-start space-x-4">
                <img
                  class="h-10 w-10 rounded-full"
                  src="https://ui-avatars.com/api/?name=John+Doe&background=2563eb&color=fff"
                  alt="John Doe"
                />
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">
                    John Doe submitted a new permit request
                  </p>
                  <p class="text-sm text-gray-500">2 minutes ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <img
                  class="h-10 w-10 rounded-full"
                  src="https://ui-avatars.com/api/?name=Sarah+Davis&background=2563eb&color=fff"
                  alt="Sarah Davis"
                />
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">
                    Sarah Davis approved maintenance request #2025-0471
                  </p>
                  <p class="text-sm text-gray-500">1 hour ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <img
                  class="h-10 w-10 rounded-full"
                  src="https://ui-avatars.com/api/?name=Mike+Johnson&background=2563eb&color=fff"
                  alt="Mike Johnson"
                />
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">
                    Mike Johnson updated database schema
                  </p>
                  <p class="text-sm text-gray-500">3 hours ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <img
                  class="h-10 w-10 rounded-full"
                  src="https://ui-avatars.com/api/?name=Emily+Brown&background=2563eb&color=fff"
                  alt="Emily Brown"
                />
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">
                    Emily Brown generated monthly report
                  </p>
                  <p class="text-sm text-gray-500">5 hours ago</p>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </main>

 @livewire('vendor-list')
     @livewireScripts
   @include('layouts.footer')
@endsection
