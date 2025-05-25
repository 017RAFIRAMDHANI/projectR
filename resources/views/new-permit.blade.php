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
<body class="bg-gray-50 min-h-screen flex flex-col">
   

    <!-- Main Content -->
    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 flex-1 py-12">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="border-b border-gray-200 pb-4 mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Vendor Permit Request Form</h1>
                <p class="mt-1 text-sm text-gray-500">Fill in the details below to submit a new permit request.</p>
            </div>
            <form id="permitForm" class="space-y-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <div>
                        <label for="companyName" class="block text-sm font-medium text-gray-700 required">Company Name</label>
                        <input type="text" id="companyName" name="companyName" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="requestorName" class="block text-sm font-medium text-gray-700 required">Requestor Name</label>
                        <input type="text" id="requestorName" name="requestorName" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="requestorEmail" class="block text-sm font-medium text-gray-700 required">Email</label>
                        <input type="email" id="requestorEmail" name="requestorEmail" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="requestorPhone" class="block text-sm font-medium text-gray-700 required">Phone Number</label>
                        <input type="tel" id="requestorPhone" name="requestorPhone" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                </div>

                <!-- Work Information -->
                <div class="space-y-4">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 required">Location</label>
                        <input type="text" id="location" name="location" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="buildingInfo" class="block text-sm font-medium text-gray-700 required">Building / Level / Room</label>
                        <input type="text" id="buildingInfo" name="buildingInfo" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="purpose" class="block text-sm font-medium text-gray-700 required">Purpose of Work</label>
                        <textarea id="purpose" name="purpose" rows="3" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="startDate" class="block text-sm font-medium text-gray-700 required">Start Date</label>
                            <input type="date" id="startDate" name="startDate" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="endDate" class="block text-sm font-medium text-gray-700 required">End Date</label>
                            <input type="date" id="endDate" name="endDate" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 required">Does work generate dust?</label>
                        <div class="mt-2 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="generatesDust" value="yes" required class="text-primary focus:ring-primary">
                                <span class="ml-2">Yes</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="generatesDust" value="no" required class="text-primary focus:ring-primary">
                                <span class="ml-2">No</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="protectionSystem" class="block text-sm font-medium text-gray-700">Protection System Affected</label>
                        <input type="text" id="protectionSystem" name="protectionSystem"
                            placeholder="e.g., Smoke detector, Sprinkler"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="mosFile" class="block text-sm font-medium text-gray-700 required">Method of Statement (MOS)</label>
                        <div class="mt-1 flex items-center">
                            <input type="file" id="mosFile" name="mosFile" accept=".pdf,.doc,.docx" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-blue-700">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Upload MOS document (PDF, DOC, or DOCX format)</p>
                    </div>
                </div>

                <!-- Worker Details -->
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">Worker Details</h2>
                    <div id="workerDetails">
                        <!-- Worker 1 (Required) -->
                        <div class="worker-entry grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 required">Worker 1 - Name</label>
                                <input type="text" name="worker1Name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 required">Worker 1 - ID No/Permit No</label>
                                <input type="text" name="worker1Id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                        <!-- Additional Workers -->
                        <div id="additionalWorkers"></div>
                        <!-- Add Worker Button -->
                        <button type="button" onclick="addWorker()" class="mt-2 text-sm text-primary hover:text-blue-700">
                            + Add another worker
                        </button>
                    </div>
                </div>

                <!-- Urgency -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 required">Urgency</label>
                        <div class="mt-2 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="urgency" value="urgent" required class="text-primary focus:ring-primary">
                                <span class="ml-2">Urgent</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="urgency" value="normal" required class="text-primary focus:ring-primary">
                                <span class="ml-2">Normal</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit and Clear Buttons -->
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="clearForm()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Clear Form
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        let workerCount = 1;

        function addWorker() {
            if (workerCount >= 5) {
                alert('Maximum 5 workers allowed');
                return;
            }

            workerCount++;
            const workerHtml = `
                <div class="worker-entry grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Worker ${workerCount} - Name</label>
                        <input type="text" name="worker${workerCount}Name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Worker ${workerCount} - ID No/Permit No</label>
                        <input type="text" name="worker${workerCount}Id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                </div>
            `;
            document.getElementById('additionalWorkers').insertAdjacentHTML('beforeend', workerHtml);
        }

        function clearForm() {
            document.getElementById('permitForm').reset();
            document.getElementById('additionalWorkers').innerHTML = '';
            workerCount = 1;
        }

        document.getElementById('permitForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Create permit object
            const permit = {
                permitId: generatePermitId(),
                type: 'vendor',
                companyName: document.getElementById('companyName').value,
                requestorName: document.getElementById('requestorName').value,
                requestorEmail: document.getElementById('requestorEmail').value,
                requestorPhone: document.getElementById('requestorPhone').value,
                location: document.getElementById('location').value,
                buildingInfo: document.getElementById('buildingInfo').value,
                purpose: document.getElementById('purpose').value,
                startDate: document.getElementById('startDate').value,
                endDate: document.getElementById('endDate').value,
                generatesDust: document.querySelector('input[name="generatesDust"]:checked').value,
                protectionSystem: document.getElementById('protectionSystem').value,
                mosFileName: document.getElementById('mosFile').files[0]?.name || '',
                urgency: document.querySelector('input[name="urgency"]:checked').value,
                status: 'pending',
                createdAt: new Date().toISOString(),
                workers: []
            };

            // Add workers
            for (let i = 1; i <= workerCount; i++) {
                const name = document.querySelector(`input[name="worker${i}Name"]`)?.value;
                const id = document.querySelector(`input[name="worker${i}Id"]`)?.value;
                if (name && id) {
                    permit.workers.push({ name, id });
                }
            }

            // Save to localStorage
            const permits = JSON.parse(localStorage.getItem('permits') || '[]');
            permits.push(permit);
            localStorage.setItem('permits', JSON.stringify(permits));

            // Show success message
            alert('Permit request submitted successfully!');

            // Clear form
            clearForm();
        });

        function generatePermitId() {
            const date = new Date();
            const year = date.getFullYear().toString().substr(-2);
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            return `VD-${year}${month}-${random}`;
        }
    </script>
</body>
</html>
@endsection
