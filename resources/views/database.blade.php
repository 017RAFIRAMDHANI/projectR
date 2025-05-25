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
            <h1 class="text-2xl font-bold text-gray-900">Database Overview</h1>
            <p class="mt-2 text-sm text-gray-600">View and manage system databases</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-md bg-blue-100">
                        <i class="fas fa-database text-primary"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-500">Total Databases</h2>
                        <p class="text-2xl font-semibold text-gray-900">5</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-md bg-green-100">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-500">Active</h2>
                        <p class="text-2xl font-semibold text-gray-900">4</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-md bg-yellow-100">
                        <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-500">Warnings</h2>
                        <p class="text-2xl font-semibold text-gray-900">2</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-md bg-red-100">
                        <i class="fas fa-times-circle text-red-600"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-500">Issues</h2>
                        <p class="text-2xl font-semibold text-gray-900">1</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database List and Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Database List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-medium text-gray-900">Database List</h2>
                            <button class="text-sm text-primary hover:text-blue-700" onclick="toggleDatabaseForm()">
                                <i class="fas fa-plus mr-2"></i>Add Database
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Size</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Users DB</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PostgreSQL</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2.5 GB</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-primary hover:text-blue-700 mr-3">View</button>
                                        <button class="text-red-600 hover:text-red-800">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Permits DB</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">MySQL</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1.8 GB</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-primary hover:text-blue-700 mr-3">View</button>
                                        <button class="text-red-600 hover:text-red-800">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Storage Usage</h2>
                    <canvas id="storageChart"></canvas>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 mt-8">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Database Health</h2>
                    <canvas id="healthChart"></canvas>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Database Modal -->
    <div id="databaseModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Add New Database</h3>
            </div>
            <form class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Database Name</label>
                        <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Database Type</label>
                        <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                            <option>PostgreSQL</option>
                            <option>MySQL</option>
                            <option>MongoDB</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="toggleDatabaseForm()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700">
                        Add Database
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
                <p class="text-sm font-medium text-gray-900">Database backup completed</p>
                <p class="text-sm text-gray-500">Daily backup of Users DB completed successfully</p>
                <p class="text-xs text-gray-400 mt-1">5 minutes ago</p>
            </div>
            <div class="p-4 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-900">Storage warning</p>
                <p class="text-sm text-gray-500">Permits DB is approaching storage limit</p>
                <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
            </div>
        </div>
    </div>
</body>
</html>


@endsection
