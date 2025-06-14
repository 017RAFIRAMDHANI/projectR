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
            <h1 class="text-2xl font-bold mb-6 text-gray-900">Vendor Permit Request Form</h1>
            <form id="permitForm" class="space-y-6">
                <!-- Company Information -->
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
                </div>

                <!-- Location Information -->
                <div class="space-y-4">
                    <div>
                        <label for="workLocation" class="block text-sm font-medium text-gray-700 required">Location of Work</label>
                        <input type="text" id="workLocation" name="workLocation" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="buildingInfo" class="block text-sm font-medium text-gray-700 required">Building / Level / Room</label>
                        <input type="text" id="buildingInfo" name="buildingInfo" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="workDescription" class="block text-sm font-medium text-gray-700 required">Work Description (Mandatory)</label>
                        <textarea id="workDescription" name="workDescription" rows="3" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                    </div>
                </div>

                <!-- Worker Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">Worker Details</h2>
                    <!-- Worker 1 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="worker1Name" class="block text-sm font-medium text-gray-700 required">Worker 1 - Name</label>
                            <input type="text" id="worker1Name" name="worker1Name" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="worker1Id" class="block text-sm font-medium text-gray-700 required">Worker 1 - ID No/Permit No</label>
                            <input type="text" id="worker1Id" name="worker1Id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                    <!-- Worker 2 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="worker2Name" class="block text-sm font-medium text-gray-700">Worker 2 - Name</label>
                            <input type="text" id="worker2Name" name="worker2Name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="worker2Id" class="block text-sm font-medium text-gray-700">Worker 2 - ID No/Permit No</label>
                            <input type="text" id="worker2Id" name="worker2Id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                    <!-- Worker 3 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="worker3Name" class="block text-sm font-medium text-gray-700">Worker 3 - Name</label>
                            <input type="text" id="worker3Name" name="worker3Name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="worker3Id" class="block text-sm font-medium text-gray-700">Worker 3 - ID No/Permit No</label>
                            <input type="text" id="worker3Id" name="worker3Id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                    <!-- Worker 4 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="worker4Name" class="block text-sm font-medium text-gray-700">Worker 4 - Name</label>
                            <input type="text" id="worker4Name" name="worker4Name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="worker4Id" class="block text-sm font-medium text-gray-700">Worker 4 - ID No/Permit No</label>
                            <input type="text" id="worker4Id" name="worker4Id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                    <!-- Worker 5 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="worker5Name" class="block text-sm font-medium text-gray-700">Worker 5 - Name</label>
                            <input type="text" id="worker5Name" name="worker5Name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="worker5Id" class="block text-sm font-medium text-gray-700">Worker 5 - ID No/Permit No</label>
                            <input type="text" id="worker5Id" name="worker5Id"
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
                        <input type="text" id="protectionSystem" name="protectionSystem" placeholder="e.g., Smoke detector, Sprinkler"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
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
                    <button type="button" onclick="clearForm()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Clear Form
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function clearForm() {
            document.getElementById('permitForm').reset();
        }

        document.getElementById('permitForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically send the form data to your backend
            alert('Form submitted successfully!');
            // Optionally clear the form after submission
            clearForm();
        });
    </script>
</body>
</html>


@endsection
