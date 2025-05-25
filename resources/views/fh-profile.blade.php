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
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex flex-col md:flex-row">
                <!-- Profile Image and Basic Info -->
                <div class="md:w-1/3 flex flex-col items-center p-6 border-b md:border-b-0 md:border-r border-gray-200">
                    <div class="relative">
                        <img class="h-32 w-32 rounded-full" src="https://ui-avatars.com/api/?name=FH&size=128&background=2563eb&color=fff" alt="Profile">
                        <button class="absolute bottom-0 right-0 bg-white rounded-full p-1 border border-gray-300 shadow-sm">
                            <i class="fas fa-camera text-gray-500"></i>
                        </button>
                    </div>
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">Facility Handler</h2>
                    <p class="text-gray-500">ID: FH-2024-001</p>
                    <div class="mt-4 flex space-x-2">
                        <button class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700">
                            <i class="fas fa-edit mr-2"></i>Edit Profile
                        </button>
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="md:w-2/3 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Full Name</label>
                            <p class="mt-1 text-sm text-gray-900">John Doe</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm text-gray-900">john.doe@digitalhyperspace.com</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p class="mt-1 text-sm text-gray-900">+62 812 3456 7890</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Department</label>
                            <p class="mt-1 text-sm text-gray-900">Facility Management</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Position</label>
                            <p class="mt-1 text-sm text-gray-900">Senior Facility Handler</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Join Date</label>
                            <p class="mt-1 text-sm text-gray-900">January 15, 2023</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500">Bio</label>
                        <p class="mt-1 text-sm text-gray-900">
                            Experienced facility handler with 5+ years of experience in managing office facilities,
                            maintenance schedules, and ensuring smooth operations of all facility-related activities.
                        </p>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-sm font-medium text-gray-500">Skills</h4>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Facility Management</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Maintenance</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">HVAC Systems</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Security Protocols</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Emergency Response</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Section -->
            <div class="mt-8 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-green-100">
                                <i class="fas fa-check text-green-600"></i>
                            </span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Approved maintenance permit</p>
                            <p class="text-sm text-gray-500">Permit #DHI/PERMIT/2024/04/0003</p>
                            <p class="text-xs text-gray-400">Today, 10:30 AM</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-yellow-100">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Marked permit as pending</p>
                            <p class="text-sm text-gray-500">Permit #DHI/PERMIT/2024/04/0002</p>
                            <p class="text-xs text-gray-400">Yesterday, 3:45 PM</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-red-100">
                                <i class="fas fa-times text-red-600"></i>
                            </span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Rejected installation permit</p>
                            <p class="text-sm text-gray-500">Permit #DHI/PERMIT/2024/04/0001</p>
                            <p class="text-xs text-gray-400">April 10, 2024, 11:20 AM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Notifications Panel -->
    <div id="notificationsPanel" class="hidden fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
        </div>
        <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
            <div class="p-4 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-900">New permit request</p>
                <p class="text-sm text-gray-500">A new permit requires your review</p>
                <p class="text-xs text-gray-400 mt-1">Just now</p>
            </div>
            <div class="p-4 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-900">Maintenance reminder</p>
                <p class="text-sm text-gray-500">HVAC system maintenance due tomorrow</p>
                <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
            </div>
        </div>
    </div>
</body>
</html>


@endsection
