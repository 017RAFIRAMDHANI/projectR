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


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Stats and Quick Actions Section -->
        <div class="lg:col-span-2 space-y-8">
          <!-- Stats Grid -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Pending Permits</h3>
              <p class="mt-2 text-3xl font-semibold text-primary">3</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Approved Permits</h3>
              <p class="mt-2 text-3xl font-semibold text-green-600">12</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Active Requests</h3>
              <p class="mt-2 text-3xl font-semibold text-blue-600">2</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-gray-500 text-sm font-medium">Total Submissions</h3>
              <p class="mt-2 text-3xl font-semibold text-purple-600">20</p>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <button
                onclick="window.location.href='new-permit.html'"
                class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition"
              >
                <i class="fas fa-file-alt text-primary text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">New Spesial Permit</span>
              </button>
              <button
                onclick="window.location.href='permits.html'"
                class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition"
              >
                <i class="fas fa-check-circle text-green-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">My Permits</span>
              </button>
              <button
                onclick="window.location.href='database.html'"
                class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition"
              >
                <i class="fas fa-database text-purple-600 text-xl mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Database</span>
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
              <a href="permits.html" class="text-sm text-primary hover:text-blue-700">View All</a>
            </div>
            <div class="space-y-6">
              <!-- Permit Status Distribution -->
              <div class="grid grid-cols-4 gap-4">
                <div class="text-center">
                  <div class="text-2xl font-semibold text-primary">3</div>
                  <div class="text-sm text-gray-500">Pending</div>
                </div>
                <div class="text-center">
                  <div class="text-2xl font-semibold text-green-600">12</div>
                  <div class="text-sm text-gray-500">Approved</div>
                </div>
                <div class="text-center">
                  <div class="text-2xl font-semibold text-red-600">1</div>
                  <div class="text-sm text-gray-500">Rejected</div>
                </div>
                <div class="text-center">
                  <div class="text-2xl font-semibold text-orange-600">2</div>
                  <div class="text-sm text-gray-500">On Hold</div>
                </div>
              </div>

              <!-- Recent Permits -->
              <div>
                <h3 class="text-sm font-medium text-gray-700 mb-3">Recent Permit Requests</h3>
                <div class="space-y-3">
                  <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                      <p class="text-sm font-medium text-gray-900">Server Room Access - Vendor A</p>
                      <p class="text-xs text-gray-500">PT Vendor A</p>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Pending</span>
                  </div>
                  <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                      <p class="text-sm font-medium text-gray-900">Equipment Delivery - Vendor B</p>
                      <p class="text-xs text-gray-500">PT Vendor B</p>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Approved</span>
                  </div>
                  <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                      <p class="text-sm font-medium text-gray-900">Maintenance Visit - Vendor C</p>
                      <p class="text-xs text-gray-500">PT Vendor C</p>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">On Hold</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="lg:col-span-1">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h2>
            <div class="space-y-4">
              <div class="flex items-start space-x-4">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Vendor+A&background=2563eb&color=fff" alt="Vendor A" />
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Vendor A submitted a new permit request</p>
                  <p class="text-sm text-gray-500">2 minutes ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Vendor+B&background=2563eb&color=fff" alt="Vendor B" />
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Vendor B delivered equipment</p>
                  <p class="text-sm text-gray-500">1 hour ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Vendor+C&background=2563eb&color=fff" alt="Vendor C" />
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Vendor C completed maintenance</p>
                  <p class="text-sm text-gray-500">3 hours ago</p>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Vendor+D&background=2563eb&color=fff" alt="Vendor D" />
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">Vendor D updated permit request</p>
                  <p class="text-sm text-gray-500">5 hours ago</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Notifications Panel -->
    <div
      id="notificationsPanel"
      class="hidden fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg border border-gray-200"
    >
      <div class="p-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
      </div>
      <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">New Permit Request</p>
          <p class="text-sm text-gray-500">Vendor A submitted a new permit request</p>
          <p class="text-xs text-gray-400 mt-1">Just now</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Equipment Delivered</p>
          <p class="text-sm text-gray-500">Vendor B delivered equipment</p>
          <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Maintenance Completed</p>
          <p class="text-sm text-gray-500">Vendor C completed maintenance</p>
          <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
        </div>
      </div>
    </div>
  </body>
</html>


@endsection
