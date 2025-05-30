@extends('layouts.app')

@section('content')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            html: "{{ nl2br(session('success')) }}",  // Convert \n to <br>
            confirmButtonText: 'OK'
        });
    @elseif(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: "{{ nl2br(session('error')) }}",  // Convert \n to <br>
            confirmButtonText: 'Try Again'
        });
    @endif

    @if($errors->any())
        let errorMessages = "";
        @foreach($errors->all() as $error)
            errorMessages += "{{ $error }}<br>";  // Use <br> for new lines
        @endforeach
        Swal.fire({
            icon: 'error',
            title: 'Validation Errors',
            html: errorMessages,  // Display with HTML for line breaks
            confirmButtonText: 'Close'
        });
    @endif
</script>


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
            <form id="permitForm" class="space-y-6" method="POST" action="{{route('vendor.store')}}" enctype="multipart/form-data">
                @csrf
                <!-- Basic Information -->
                <div class="space-y-4">
                    <div>
                        <label for="companyName" class="block text-sm font-medium text-gray-700 ">Company Name</label>
                        <input type="text" id="companyName" name="company_name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="requestorName" class="block text-sm font-medium text-gray-700 ">Requestor Name</label>
                        <input type="text" id="requestorName" name="requestor_name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="requestorEmail" class="block text-sm font-medium text-gray-700 ">Email</label>
                        <input type="email" id="requestorEmail" name="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="requestorPhone" class="block text-sm font-medium text-gray-700 ">Phone Number</label>
                        <input type="tel" id="requestorPhone" name="phone_number"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                </div>

                <!-- Work Information -->
                <div class="space-y-4">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 ">Location</label>
                        <input type="text" id="location" name="location_of_work"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="buildingInfo" class="block text-sm font-medium text-gray-700 ">Building / Level / Room</label>
                        <input type="text" id="buildingInfo" name="building_level_room"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="purpose" class="block text-sm font-medium text-gray-700 ">Purpose of Work</label>
                        <textarea id="purpose" name="work_description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="startDate" class="block text-sm font-medium text-gray-700 ">Start Date</label>
                            <input type="date" id="startDate" name="start_date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="endDate" class="block text-sm font-medium text-gray-700 ">End Date</label>
                            <input type="date" id="endDate" name="end_date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 ">Does work generate dust?</label>
                        <div class="mt-2 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="generate_dust" value="Yes"  class="text-primary focus:ring-primary">
                                <span class="ml-2">Yes</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="generate_dust" value="No"  class="text-primary focus:ring-primary">
                                <span class="ml-2">No</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="protectionSystem" class="block text-sm font-medium text-gray-700">Protection System Affected</label>
                        <input type="text" id="protectionSystem" name="protection_system"
                            placeholder="e.g., Smoke detector, Sprinkler"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="mosFile" class="block text-sm font-medium text-gray-700 ">Method of Statement (MOS)</label>
                        <div class="mt-1 flex items-center">
                            <input type="file" id="mosFile" name="file_mos" accept=".pdf,.doc,.docx"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-blue-700">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Upload MOS document (PDF, DOC, or DOCX format)</p>
                    </div>
                </div>

                <!-- Worker Details -->
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">Worker Details</h2>
                    <div id="workerDetails">
                        <!-- Worker 1 () -->
                        <div class="worker-entry grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 1 - Name</label>
                                <input type="text" name="worker1_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 1 - ID No/Permit No</label>
                                <input type="text" name="worker1_id_nopermit"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                        <!-- Worker 2 -->
                        <div class="worker-entry grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 2 - Name</label>
                                <input type="text" name="worker2_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 2 - ID No/Permit No</label>
                                <input type="text" name="worker2_id_nopermit"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                        <!-- Worker 3 -->
                        <div class="worker-entry grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 3 - Name</label>
                                <input type="text" name="worker3_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 3 - ID No/Permit No</label>
                                <input type="text" name="worker3_id_nopermit"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                        <!-- Worker 4 -->
                        <div class="worker-entry grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 4 - Name</label>
                                <input type="text" name="worker4_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 4 - ID No/Permit No</label>
                                <input type="text" name="worker4_id_nopermit"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                        <!-- Worker 5 -->
                        <div class="worker-entry grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 5 - Name</label>
                                <input type="text" name="worker5_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Worker 5 - ID No/Permit No</label>
                                <input type="text" name="worker5_id_nopermit"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Urgency -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 ">Urgency</label>
                        <div class="mt-2 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="mode" value="Urgent"  class="text-primary focus:ring-primary">
                                <span class="ml-2">Urgent</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="mode" value="Normal"  class="text-primary focus:ring-primary">
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



</body>
</html>
@endsection
