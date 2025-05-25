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
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Permit Management</h1>
            <button class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700 transition flex items-center">
                <i class="fas fa-plus mr-2"></i>
                New Permit
            </button>
        </div>

        <!-- Filters -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Rejected</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                    <input type="date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                    <input type="text" placeholder="Search company" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" placeholder="Search permits..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                </div>
            </div>
        </div>

        <!-- Permits Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requestor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#VMS-2025-0472</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Smith</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tech Solutions Inc.</td>
                        <td class="px-6 py-4 text-sm text-gray-500">Network maintenance</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-04-20</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-primary hover:text-blue-700" onclick="showPermitDetail('VMS-2025-0472', 'John Smith', 'Tech Solutions Inc.', 'Network maintenance', 'Pending', '2025-04-20')">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#VMS-2025-0471</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sarah Davis</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">DataCore Systems</td>
                        <td class="px-6 py-4 text-sm text-gray-500">Server upgrade</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-04-19</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-primary hover:text-blue-700" onclick="showPermitDetail('VMS-2025-0471', 'Sarah Davis', 'DataCore Systems', 'Server upgrade', 'Approved', '2025-04-19')">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                        <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</button>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">2</span> of <span class="font-medium">20</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</button>
                                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                                <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Permit Detail Modal -->
    <div id="permitDetailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
            <button onclick="closePermitDetail()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
            <h2 class="text-xl font-bold mb-4 text-primary">Permit Details</h2>
            <table class="w-full mb-4">
                <tr><td class="font-semibold py-1 pr-2">Permit ID</td><td id="modalPermitId"></td></tr>
                <tr><td class="font-semibold py-1 pr-2">Requestor</td><td id="modalRequestor"></td></tr>
                <tr><td class="font-semibold py-1 pr-2">Company</td><td id="modalCompany"></td></tr>
                <tr><td class="font-semibold py-1 pr-2">Purpose</td><td id="modalPurpose"></td></tr>
                <tr><td class="font-semibold py-1 pr-2">Status</td><td id="modalStatus"></td></tr>
                <tr><td class="font-semibold py-1 pr-2">Date</td><td id="modalDate"></td></tr>
            </table>
            <div class="flex justify-end">
                <button onclick="closePermitDetail()" class="px-4 py-2 bg-primary text-white rounded hover:bg-blue-700 transition">Close</button>
            </div>
        </div>
    </div>

    <script>
    function showPermitDetail(id, requestor, company, purpose, status, date) {
        document.getElementById('modalPermitId').textContent = id;
        document.getElementById('modalRequestor').textContent = requestor;
        document.getElementById('modalCompany').textContent = company;
        document.getElementById('modalPurpose').textContent = purpose;
        document.getElementById('modalStatus').textContent = status;
        document.getElementById('modalDate').textContent = date;
        document.getElementById('permitDetailModal').classList.remove('hidden');
    }
    function closePermitDetail() {
        document.getElementById('permitDetailModal').classList.add('hidden');
    }
    </script>
</body>
</html>

@endsection
