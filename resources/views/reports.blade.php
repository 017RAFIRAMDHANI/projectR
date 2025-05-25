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
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Reports & Analytics</h1>
            <p class="mt-2 text-sm text-gray-600">View and generate system reports</p>
        </div>

        <!-- Report Filters -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Report Type</label>
                    <select class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <option>Permit Activity</option>
                        <option>User Activity</option>
                        <option>System Performance</option>
                        <option>Security Audit</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                    <select class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 3 months</option>
                        <option>Custom range</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Format</label>
                    <select class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <option>PDF</option>
                        <option>Excel</option>
                        <option>CSV</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        Generate Report
                    </button>
                </div>
            </div>
        </div>

        <!-- Analytics Dashboard -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Permit Status Chart -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Permit Status Distribution</h2>
                <canvas id="permitStatusChart"></canvas>
            </div>

            <!-- Permit Trend Chart -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Permit Requests Trend</h2>
                <canvas id="permitTrendChart"></canvas>
            </div>

            <!-- Recent Reports -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Recent Reports</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Monthly Permit Activity Report</h3>
                            <p class="text-sm text-gray-500">Generated on April 15, 2025</p>
                        </div>
                        <button class="text-primary hover:text-blue-700">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">System Performance Analysis</h3>
                            <p class="text-sm text-gray-500">Generated on April 14, 2025</p>
                        </div>
                        <button class="text-primary hover:text-blue-700">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Security Audit Log</h3>
                            <p class="text-sm text-gray-500">Generated on April 13, 2025</p>
                        </div>
                        <button class="text-primary hover:text-blue-700">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Report Schedule -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">Scheduled Reports</h2>
                        <button class="text-sm text-primary hover:text-blue-700" onclick="toggleScheduleForm()">
                            <i class="fas fa-plus mr-2"></i>Add Schedule
                        </button>
                    </div>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Daily Activity Summary</h3>
                                <p class="text-sm text-gray-500">Every day at 23:00</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Weekly Performance Report</h3>
                                <p class="text-sm text-gray-500">Every Monday at 09:00</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Schedule Form Modal -->
    <div id="scheduleModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Schedule New Report</h3>
            </div>
            <form class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Report Name</label>
                        <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Report Type</label>
                        <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                            <option>Daily Activity Summary</option>
                            <option>Weekly Performance Report</option>
                            <option>Monthly Analytics</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Schedule</label>
                        <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                            <option>Daily</option>
                            <option>Weekly</option>
                            <option>Monthly</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Time</label>
                        <input type="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="toggleScheduleForm()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700">
                        Schedule Report
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notifications Panel -->
    <div id="notificationsPanel" class="hidden fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
        </div>
        <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
            <div class="p-4 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-900">Report generated</p>
                <p class="text-sm text-gray-500">Monthly activity report is ready for download</p>
                <p class="text-xs text-gray-400 mt-1">Just now</p>
            </div>
            <div class="p-4 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-900">Schedule updated</p>
                <p class="text-sm text-gray-500">Weekly report schedule has been modified</p>
                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
            </div>
        </div>
    </div>
</body>
</html>


@endsection
