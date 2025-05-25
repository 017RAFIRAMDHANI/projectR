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
    <script src="js/email-service.js" defer></script>

</head>
<body class="bg-gray-50">


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Permit Management</h1>
                <div class="flex space-x-4">
                    <div class="relative">
                        <select id="statusFilter" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary rounded-md">
                            <option value="all">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="relative">
                        <select id="priorityFilter" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary rounded-md">
                            <option value="all">All Priorities</option>
                            <option value="urgent">Urgent</option>
                            <option value="normal">Normal</option>
                        </select>
                    </div>
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search permits..."
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary rounded-md">
                    </div>
                </div>
            </div>

            <!-- Permits Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit Number</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="permitsTableBody" class="bg-white divide-y divide-gray-200">
                        <!-- Permit rows will be inserted here by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-12">
                <i class="fas fa-file-alt text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">No permits found</h3>
                <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
            </div>
        </div>
    </main>

    <!-- Permit Details Modal -->
    <div id="permitModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Permit Details</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="px-6 py-4" id="modalContent">
                <!-- Content will be inserted here by JavaScript -->
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-4">
                <button onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Cancel
                </button>
                <div id="modalActions" class="flex space-x-4">
                    <!-- Action buttons will be inserted here by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load permits from localStorage
        function loadPermits() {
            const permits = JSON.parse(localStorage.getItem('permits') || '[]');
            const tableBody = document.getElementById('permitsTableBody');
            const emptyState = document.getElementById('emptyState');
            const statusFilter = document.getElementById('statusFilter').value;
            const priorityFilter = document.getElementById('priorityFilter').value;
            const searchInput = document.getElementById('searchInput').value.toLowerCase();

            // Clear table
            tableBody.innerHTML = '';

            // Filter permits
            let filteredPermits = permits;

            if (statusFilter !== 'all') {
                filteredPermits = filteredPermits.filter(permit => permit.status === statusFilter);
            }

            if (priorityFilter !== 'all') {
                filteredPermits = filteredPermits.filter(permit => permit.priority === priorityFilter);
            }

            if (searchInput) {
                filteredPermits = filteredPermits.filter(permit =>
                    permit.permitNumber.toLowerCase().includes(searchInput) ||
                    permit.permitType.toLowerCase().includes(searchInput) ||
                    permit.location.toLowerCase().includes(searchInput)
                );
            }

            // Sort permits by date (newest first)
            filteredPermits.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));

            // Show empty state if no permits
            if (filteredPermits.length === 0) {
                tableBody.classList.add('hidden');
                emptyState.classList.remove('hidden');
                return;
            }

            // Show table and hide empty state
            tableBody.classList.remove('hidden');
            emptyState.classList.add('hidden');

            // Add permit rows
            filteredPermits.forEach(permit => {
                const row = document.createElement('tr');

                // Format date
                const startDate = new Date(permit.startDateTime);
                const formattedDate = `${startDate.toLocaleDateString()} ${startDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}`;

                // Priority badge
                let priorityBadge = '';
                if (permit.priority === 'urgent') {
                    priorityBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Urgent</span>';
                } else {
                    priorityBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Normal</span>';
                }

                // Status badge
                let statusBadge = '';
                if (permit.status === 'pending') {
                    statusBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>';
                } else if (permit.status === 'approved') {
                    statusBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Approved</span>';
                } else if (permit.status === 'rejected') {
                    statusBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Rejected</span>';
                }

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${permit.permitNumber}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${permit.permitType}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${permit.location}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedDate}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${priorityBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${statusBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button onclick="viewPermit('${permit.permitNumber}')" class="text-primary hover:text-blue-700">
                            View
                        </button>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        }

        // View permit details
        function viewPermit(permitNumber) {
            const permits = JSON.parse(localStorage.getItem('permits') || '[]');
            const permit = permits.find(p => p.permitNumber === permitNumber);

            if (!permit) return;

            // Format dates
            const startDate = new Date(permit.startDateTime);
            const endDate = new Date(permit.endDateTime);
            const formattedStartDate = `${startDate.toLocaleDateString()} ${startDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}`;
            const formattedEndDate = `${endDate.toLocaleDateString()} ${endDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}`;

            // Priority badge
            let priorityBadge = '';
            if (permit.priority === 'urgent') {
                priorityBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Urgent</span>';
            } else {
                priorityBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Normal</span>';
            }

            // Status badge
            let statusBadge = '';
            if (permit.status === 'pending') {
                statusBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>';
            } else if (permit.status === 'approved') {
                statusBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Approved</span>';
            } else if (permit.status === 'rejected') {
                statusBadge = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Rejected</span>';
            }

            // Set modal content
            document.getElementById('modalTitle').textContent = `Permit: ${permit.permitNumber}`;

            document.getElementById('modalContent').innerHTML = `
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Permit Number</p>
                            <p class="mt-1 text-sm text-gray-900">${permit.permitNumber}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Priority</p>
                            <p class="mt-1">${priorityBadge}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <p class="mt-1">${statusBadge}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Type</p>
                            <p class="mt-1 text-sm text-gray-900">${permit.permitType}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Location</p>
                            <p class="mt-1 text-sm text-gray-900">${permit.location}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Start Date & Time</p>
                            <p class="mt-1 text-sm text-gray-900">${formattedStartDate}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">End Date & Time</p>
                            <p class="mt-1 text-sm text-gray-900">${formattedEndDate}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Applicant</p>
                            <p class="mt-1 text-sm text-gray-900">${permit.applicantName}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="mt-1 text-sm text-gray-900">${permit.applicantEmail}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Description</p>
                        <p class="mt-1 text-sm text-gray-900">${permit.description}</p>
                    </div>
                    ${permit.reviewedBy ? `
                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-sm font-medium text-gray-500">DHI Review</p>
                        <p class="mt-1 text-sm text-gray-900">Reviewed by: ${permit.reviewedBy}</p>
                        <p class="text-sm text-gray-500">Reviewed at: ${new Date(permit.reviewedAt).toLocaleString()}</p>
                    </div>
                    ` : ''}
                    ${permit.fmReviewedBy ? `
                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-sm font-medium text-gray-500">FM Review</p>
                        <p class="mt-1 text-sm text-gray-900">Reviewed by: ${permit.fmReviewedBy}</p>
                        <p class="text-sm text-gray-500">Reviewed at: ${new Date(permit.fmReviewedAt).toLocaleString()}</p>
                    </div>
                    ` : ''}
                </div>
            `;

            // Set action buttons based on status
            const modalActions = document.getElementById('modalActions');
            modalActions.innerHTML = '';

            if (permit.status === 'pending') {
                // For urgent permits, show a special message
                if (permit.priority === 'urgent') {
                    modalActions.innerHTML = `
                        <span class="text-sm text-red-600 font-medium">Urgent Permit - Requires Immediate Attention</span>
                        <button onclick="updatePermitStatus('${permit.permitNumber}', 'approved')" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                            Approve
                        </button>
                        <button onclick="updatePermitStatus('${permit.permitNumber}', 'rejected')" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            Reject
                        </button>
                    `;
                } else {
                    modalActions.innerHTML = `
                        <button onclick="updatePermitStatus('${permit.permitNumber}', 'approved')" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                            Approve
                        </button>
                        <button onclick="updatePermitStatus('${permit.permitNumber}', 'rejected')" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            Reject
                        </button>
                    `;
                }
            } else {
                modalActions.innerHTML = `
                    <button onclick="updatePermitStatus('${permit.permitNumber}', 'pending')" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700">
                        Mark as Pending
                    </button>
                `;
            }

            // Show modal
            document.getElementById('permitModal').classList.remove('hidden');
        }

        // Update permit status
        async function updatePermitStatus(permitNumber, newStatus) {
            const permits = JSON.parse(localStorage.getItem('permits') || '[]');
            const permitIndex = permits.findIndex(p => p.permitNumber === permitNumber);

            if (permitIndex === -1) return;

            // Update status
            permits[permitIndex].status = newStatus;

            // Add approval/rejection details
            if (newStatus === 'approved' || newStatus === 'rejected') {
                permits[permitIndex].reviewedBy = 'DHI Staff';
                permits[permitIndex].reviewedAt = new Date().toISOString();

                // Send email to applicant
                if (newStatus === 'approved') {
                    await EmailService.notifyApplicantApproval(permits[permitIndex]);
                } else {
                    await EmailService.notifyApplicantRejection(permits[permitIndex]);
                }

                // Send email to FM about DHI's decision
                await EmailService.notifyFMOfDHIDecision(permits[permitIndex]);
            }

            // Save to localStorage
            localStorage.setItem('permits', JSON.stringify(permits));

            // Close modal and reload permits
            closeModal();
            loadPermits();

            // Show success message
            const statusText = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
            alert(`Permit has been ${statusText.toLowerCase()} successfully!`);
        }

        // Close modal
        function closeModal() {
            document.getElementById('permitModal').classList.add('hidden');
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            loadPermits();

            // Filter change
            document.getElementById('statusFilter').addEventListener('change', loadPermits);
            document.getElementById('priorityFilter').addEventListener('change', loadPermits);

            // Search input
            document.getElementById('searchInput').addEventListener('input', loadPermits);
        });
    </script>
</body>
</html>


@endsection
