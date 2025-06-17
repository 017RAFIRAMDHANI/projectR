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
  <style>
    .permit-type-btn {
      @apply px-6 py-3 rounded-lg font-semibold text-base transition-all duration-200 shadow border;
    }
    .permit-type-btn.visitor.selected {
      @apply bg-blue-600 text-white border-blue-600 shadow-md;
    }
    .permit-type-btn.visitor:not(.selected) {
      @apply bg-blue-100 text-blue-700 border-blue-200 hover:bg-blue-200;
    }
    .permit-type-btn.vendor.selected {
      @apply bg-green-600 text-white border-green-600 shadow-md;
    }
    .permit-type-btn.vendor:not(.selected) {
      @apply bg-green-100 text-green-700 border-green-200 hover:bg-green-200;
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

  <!-- Main Content -->
  <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 flex-1 py-12 w-full">
    <div class="mb-8">
      <div class="flex items-center mb-4">
        <button onclick="window.location.href='dashboard.html'" class="flex items-center text-primary hover:underline text-base font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Dashboard
        </button>
      </div>
      <h1 class="text-2xl font-semibold text-gray-800 mb-2">Permit Request Form</h1>
      <p class="text-sm text-gray-500">Fill in the details below to submit a new permit request.</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
      <div id="permitForm" class="space-y-8">
        <!-- Permit Type Selector -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-3">Permit Type</label>
          <div class="flex space-x-4">
            <button type="button" id="btnVisitor" onclick="selectPermitType('visitor')"
              class="px-6 py-3 rounded-lg font-semibold text-base transition-all duration-200 shadow border flex items-center gap-2 bg-blue-600 text-white border-blue-600 shadow-md"
            ><i id="iconVisitor" class="fa-solid fa-check hidden"></i>Visitor</button>
            <button type="button" id="btnVendor" onclick="selectPermitType('vendor')"
              class="px-6 py-3 rounded-lg font-semibold text-base transition-all duration-200 shadow border flex items-center gap-2 bg-blue-100 text-blue-700 border-blue-200 hover:bg-blue-200"
            ><i id="iconVendor" class="fa-solid fa-check hidden"></i>Vendor</button>
          </div>
          <input type="hidden" id="permitType" name="permitType" value="visitor">
        </div>

        <!-- Visitor Section -->
        <div id="visitorSection" style="display:none;">
            <form action="{{route('visitor.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <!-- General Info -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Visitor Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Destination Email</label>
                        <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="example@email.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Purpose</label>
                        <select name="purpose_visit" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">Select Purpose</option>
                            <option value="Visitor">Visitor</option>
                            <option value="Delivery">Delivery</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Requested Date From</label>
                        <input type="date" name="request_date_from" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
          <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Requested Date To</label>
                        <input type="date" name="request_date_to" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Purpose Details</label>
                        <textarea name="purpose_detail" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
                    </div>
                      <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Urgency</label>
                <select name="mode" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="Normal">Normal</option>
                    <option value="Urgent">Urgent</option>
                </select>
              </div>
          </div>
        </div>

            <!-- Destination -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Destination</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Building</label>
                        <select id="buildingSelect" name="building" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" onchange="updateLevelOptions()">
                            <option value="">Select Building</option>
                            <option value="Admin Building">Admin Building</option>
                            <option value="DC Building">DC Building</option>
                            <option value="External Areas">External Areas</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                <select id="vendorLevelSelect" name="level" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                  <option value="">Select Level</option>
                  <option value="Level 1">Level 1</option>
                  <option value="Level 2">Level 2</option>
                  <option value="Level 3">Level 3</option>
                  <option value="Level 4 (Admin Building Only)">Level 4 (Admin Building Only)</option>
                  <option value="Level 5 (DC Building Only)">Level 5 (DC Building Only)</option>
                  <option value="N/A (For External Areas)">N/A (For External Areas)</option>
                </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Specific Location / Room</label>
                        <input type="text" name="specific_location" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="e.g., Server Room A-01, Genset Area, Main Corridor">
                    </div>
          </div>
          </div>

            <!-- Visitor Details -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Visitor Details</h3>
          <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Number of Visitors</label>
                    <select id="visitorCount" name="numberOfVisitors" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Select Number of Visitors</option>
                        <option value="0">0 (No Visitors, e.g., for Delivery only)</option>
                        <option value="1">1 Visitor</option>
                        <option value="2">2 Visitors</option>
                        <option value="3">3 Visitors</option>
                        <option value="4">4 Visitors</option>
                        <option value="5">5 Visitors</option>
                        <option value="6">6 Visitors</option>
                        <option value="7">7 Visitors</option>
                        <option value="8">8 Visitors</option>
                        <option value="9">9 Visitors</option>
                        <option value="10">10 Visitors</option>
                        <option value="11">11 Visitors</option>
                        <option value="12">12 Visitors</option>
                        <option value="13">13 Visitors</option>
                        <option value="14">14 Visitors</option>
                        <option value="15">15 Visitors</option>
                        <option value="16">16 Visitors</option>
                        <option value="17">17 Visitors</option>
                        <option value="18">18 Visitors</option>
                        <option value="19">19 Visitors</option>
                        <option value="20">20 Visitors</option>
                        <option value="21">21 Visitors</option>
                        <option value="22">22 Visitors</option>
                        <option value="23">23 Visitors</option>
                        <option value="24">24 Visitors</option>
                        <option value="25">25 Visitors</option>
                        <option value="26">26 Visitors</option>
                        <option value="27">27 Visitors</option>
                        <option value="28">28 Visitors</option>
                        <option value="29">29 Visitors</option>
                        <option value="30">30 Visitors</option>
                    </select>
          </div>
                <div id="visitorFields" class="space-y-4">
                    <!-- Visitor fields will be dynamically added here -->
          </div>
            </div>

            <!-- PIC & Vehicle Info -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">PIC & Vehicle Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">PIC Name</label>
                        <input type="text" name="pic_name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
          </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                        <input type="tel" name="pic_contact" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
          </div>
              <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Car Plate No</label>
                        <input type="text" name="car_plate_no" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
              </div>
              <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Type</label>
                        <select name="vehicle_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">Select Vehicle Type</option>
                            <option value="Car">Car</option>
                            <option value="Motorcycle">Motorcycle</option>
                        </select>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Upload ID Card(s) File (Optional)</label>
              <input type="file" name="upload_id_card_foto" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
              <p class="mt-1 text-sm text-gray-500">You can upload a single file containing scans of all workers' ID cards (KTP).</p>
        </div>
          </div>

            <!-- Delivery Information -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Delivery Information (Optional)</h3>
                <p class="text-sm text-gray-600 mb-4">Fill this section if the purpose is 'Delivery' or if visitors are bringing materials.</p>
          <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Number of Materials</label>
                    <select id="materialCount" name="numberOfMaterials" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Select Number of Materials</option>
                        <option value="0">0 (No Materials)</option>
                        <option value="1">1 Material</option>
                        <option value="2">2 Materials</option>
                        <option value="3">3 Materials</option>
                        <option value="4">4 Materials</option>
                        <option value="5">5 Materials</option>
                        <option value="6">6 Materials</option>
                        <option value="7">7 Materials</option>
                        <option value="8">8 Materials</option>
                        <option value="9">9 Materials</option>
                        <option value="10">10 Materials</option>
                        <option value="11">11 Materials</option>
                        <option value="12">12 Materials</option>
                        <option value="13">13 Materials</option>
                        <option value="14">14 Materials</option>
                        <option value="15">15 Materials</option>
                        <option value="16">16 Materials</option>
                        <option value="17">17 Materials</option>
                        <option value="18">18 Materials</option>
                        <option value="19">19 Materials</option>
                        <option value="20">20 Materials</option>
                        <option value="21">21 Materials</option>
                        <option value="22">22 Materials</option>
                        <option value="23">23 Materials</option>
                        <option value="24">24 Materials</option>
                        <option value="25">25 Materials</option>
                        <option value="26">26 Materials</option>
                        <option value="27">27 Materials</option>
                        <option value="28">28 Materials</option>
                        <option value="29">29 Materials</option>
                        <option value="30">30 Materials</option>
                    </select>
          </div>
                <div id="materialFields" class="space-y-4">
                    <!-- Material fields will be dynamically added here -->
            </div>
          </div>
            <div class="flex justify-end space-x-4 mt-8">
          <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Clear Form</button>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Submit Permit
            </button>
            </form>
  </div>
        </div>

        <!-- Vendor Section -->
        <div id="vendorSection" style="display:none;">
            <form action="{{route('vendor.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
          <!-- Vendor Information -->
          <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Vendor Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
               <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                <input type="text" name="company_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Building</label>
                <select id="vendorBuildingSelect" name="building" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" onchange="updateVendorLevelOptions()">
                  <option value="">Select Building</option>
                  <option value="Admin Building">Admin Building</option>
                  <option value="DC Building">DC Building</option>
                  <option value="External Areas">External Areas</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                <select id="vendorLevelSelect" name="level" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                  <option value="">Select Level</option>
                  <option value="Level 1">Level 1</option>
                  <option value="Level 2">Level 2</option>
                  <option value="Level 3">Level 3</option>
                  <option value="Level 4 (Admin Building Only)">Level 4 (Admin Building Only)</option>
                  <option value="Level 5 (DC Building Only)">Level 5 (DC Building Only)</option>
                  <option value="N/A (For External Areas)">N/A (For External Areas)</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Urgency</label>
                <select name="mode" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="Normal">Normal</option>
                    <option value="Urgent">Urgent</option>
                </select>
              </div>
               <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company Contact</label>
                <input type="text" name="company_contact" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Requestor Name</label>
                <input type="text" name="requestor_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input type="tel" name="phone_number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>
          </div>
          </div>

          <!-- Validity Period -->
          <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Validity Period</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Validity Date From</label>
                <input type="date" name="validity_date_from" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Validity Date To</label>
                <input type="date" name="validity_date_to" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>
          </div>
          </div>

          <!-- Work Description -->
          <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Work Description</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="work_description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
            </div>
            </div>
          </div>


          <!-- Work Location -->
          <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Work Location</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Location of Work</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
          </div> -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Building</label>
                <select name="building" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                  <option value="">Select Building</option>
                  <option value="Admin Building">Admin Building</option>
                  <option value="DC Building">DC Building</option>
                  <option value="External">External</option>
                </select>
          </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                <select name="level" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                  <option value="">Select Level</option>
                  <option value="Level 1">Level 1</option>
                  <option value="Level 2">Level 2</option>
                  <option value="Level 3">Level 3</option>
                  <option value="Level 4 (Admin Building Only)">Level 4 (Admin Building Only)</option>
                  <option value="Level 5 (DC Building Only)">Level 5 (DC Building Only)</option>
                  <option value="N/A (For External Areas)">N/A (For External Areas)</option>
                </select>
          </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Specific Location / Room</label>
                <input name="specific_location" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="e.g., Server Room A-01, Genset Area, Main Corridor" required>
          </div>
          </div>
          </div>

          <!-- Worker Details -->
          <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Worker Details</h3>
          <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">Number of Workers</label>
              <select id="workerCount" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                <option value="">Select Number of Workers</option>
                <option value="1">1 Worker</option>
                <option value="2">2 Workers</option>
                <option value="3">3 Workers</option>
                <option value="4">4 Workers</option>
                <option value="5">5 Workers</option>
                <option value="6">6 Workers</option>
                <option value="7">7 Workers</option>
                <option value="8">8 Workers</option>
                <option value="9">9 Workers</option>
                <option value="10">10 Workers</option>
                <option value="11">11 Workers</option>
                <option value="12">12 Workers</option>
                <option value="13">13 Workers</option>
                <option value="14">14 Workers</option>
                <option value="15">15 Workers</option>
                <option value="16">16 Workers</option>
                <option value="17">17 Workers</option>
                <option value="18">18 Workers</option>
                <option value="19">19 Workers</option>
                <option value="20">20 Workers</option>
                <option value="21">21 Workers</option>
                <option value="22">22 Workers</option>
                <option value="23">23 Workers</option>
                <option value="24">24 Workers</option>
                <option value="25">25 Workers</option>
                <option value="26">26 Workers</option>
                <option value="27">27 Workers</option>
                <option value="28">28 Workers</option>
                <option value="29">29 Workers</option>
                <option value="30">30 Workers</option>
              </select>
          </div>
            <div id="workerFields" class="space-y-4">
              <!-- Worker fields will be dynamically added here -->
          </div>
          </div>

          <!-- Safety Checklist -->
          <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Safety Checklist</h3>
            <div class="space-y-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Does work generate dust?</label>
                <div class="flex space-x-4">
              <label class="inline-flex items-center">
                    <input type="radio" name="generate_dust" value="Yes" class="form-radio" required>
                <span class="ml-2">Yes</span>
              </label>
              <label class="inline-flex items-center">
                    <input type="radio" name="generate_dust" value="No" class="form-radio" required>
                <span class="ml-2">No</span>
              </label>
            </div>
          </div>
              <div id="dustDetails" class="hidden">
          <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Cause of dust</label>
                  <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" rows="2"></textarea>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Method to contain dust</label>
                  <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" rows="2"></textarea>
          </div>
          </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Any Fire Protection System affected?</label>
                <div class="flex space-x-4">
              <label class="inline-flex items-center">
                    <input type="radio" name="fire_system" value="Yes" class="form-radio" required>
                <span class="ml-2">Yes</span>
              </label>
              <label class="inline-flex items-center">
                    <input type="radio" name="fire_system" value="No" class="form-radio" required>
                <span class="ml-2">No</span>
              </label>
            </div>
          </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Isolation of</label>
                <div class="space-y-2">
              <label class="inline-flex items-center">
                    <input type="checkbox" name="isolation_of[]" value="Fire Panel" class="form-checkbox">
                <span class="ml-2">Fire Panel</span>
              </label>
              <label class="inline-flex items-center">
                    <input type="checkbox" name="isolation_of[]" value="Smoke Detector" class="form-checkbox">
                <span class="ml-2">Smoke Detector</span>
              </label>
              <label class="inline-flex items-center">
                    <input type="checkbox" name="isolation_of[]" value="Sprinkler" class="form-checkbox">
                <span class="ml-2">Sprinkler</span>
              </label>
              <label class="inline-flex items-center">
                    <input type="checkbox" name="isolation_of[]" value="ASDS" class="form-checkbox">
                <span class="ml-2">ASDS</span>
              </label>
            </div>
          </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Isolated by Name</label>
                  <input type="text" name="isolation_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Isolated Date/Time</label>
                  <input type="datetime-local" name="isolation_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
              </div>
            </div>
          </div>

          <!-- Vehicle Information -->
          <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Vehicle Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Car Plate No.</label>
                <input type="text" name="number_plate" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
          </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Type</label>
                <select name="vehicle_types" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                  <option value="">Select Vehicle Type</option>
                  <option value="Car">Car</option>
                  <option value="Motorcycle">Motorcycle</option>
                </select>
          </div>
            </div>
          </div>

          <!-- Attachments -->
          <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Attachments</h3>
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload MOS File (Optional)</label>
                <input type="file" name="file_mos" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                <p class="mt-1 text-sm text-gray-500">Method of Statement, Work Permit, or other supporting documents.</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload ID Card(s) File (Optional)</label>
                <input type="file" name="up_id_card_foto" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                <p class="mt-1 text-sm text-gray-500">You can upload a single file containing scans of all workers' ID cards (KTP).</p>


            </div>
            </div>
          </div>




        <div class="flex justify-end space-x-4 mt-8">
          <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Clear Form</button>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Submit Permit
            </button>
            </form>
  </div>
        </div>
      </div>
  </main>
  <script>
    function selectPermitType(type) {
      document.getElementById('permitType').value = type;
      const btnVisitor = document.getElementById('btnVisitor');
      const btnVendor = document.getElementById('btnVendor');
      const iconVisitor = document.getElementById('iconVisitor');
      const iconVendor = document.getElementById('iconVendor');
      if (type === 'visitor') {
        btnVisitor.className = 'px-6 py-3 rounded-lg font-semibold text-base transition-all duration-200 shadow border flex items-center gap-2 bg-blue-600 text-white border-blue-600 shadow-md';
        btnVendor.className = 'px-6 py-3 rounded-lg font-semibold text-base transition-all duration-200 shadow border flex items-center gap-2 bg-blue-100 text-blue-700 border-blue-200 hover:bg-blue-200';
        iconVisitor.classList.remove('hidden');
        iconVendor.classList.add('hidden');
      } else {
        btnVisitor.className = 'px-6 py-3 rounded-lg font-semibold text-base transition-all duration-200 shadow border flex items-center gap-2 bg-blue-100 text-blue-700 border-blue-200 hover:bg-blue-200';
        btnVendor.className = 'px-6 py-3 rounded-lg font-semibold text-base transition-all duration-200 shadow border flex items-center gap-2 bg-blue-600 text-white border-blue-600 shadow-md';
        iconVisitor.classList.add('hidden');
        iconVendor.classList.remove('hidden');
      }
      document.getElementById('visitorSection').style.display = (type === 'visitor') ? '' : 'none';
      document.getElementById('vendorSection').style.display = (type === 'vendor') ? '' : 'none';
    }
    function addWorker() {
      var container = document.getElementById('additionalWorkers');
      var count = container.querySelectorAll('.worker-entry').length + 2;
      if (count > 5) {
        alert('Maximum 5 workers allowed');
        return;
      }
      var html = `<div class="worker-entry grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 required">Worker ${count} - Name</label>
          <input type="text" name="worker${count}_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 required">Worker ${count} - ID No/Permit No</label>
          <input type="text" name="worker${count}_id_card" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
        </div>
      </div>`;
      container.insertAdjacentHTML('beforeend', html);
    }
    // Set default
    selectPermitType('visitor');
  </script>
  <script>
   document.addEventListener('DOMContentLoaded', function() {
  const MAX_WORKERS = 30;
  const workerCountSelect = document.getElementById('workerCount');
  const workerFieldsContainer = document.getElementById('workerFields');

  // Function to create worker fields
  function createWorkerFields(count) {
    workerFieldsContainer.innerHTML = ''; // Clear existing fields

    for (let i = 1; i <= count; i++) {
      const workerSection = document.createElement('div');
      workerSection.className = 'bg-gray-50 p-4 rounded-lg';
      workerSection.innerHTML = `
        <h4 class="text-md font-medium text-gray-700 mb-3">Worker ${i}</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name ${i}</label>
            <!-- Changed the name attribute to match workerX_name -->
            <input type="text" name="worker${i}_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">ID Card ${i}</label>
            <!-- Changed the name attribute to match workerX_id_card -->
            <input type="text" name="worker${i}_id_card" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
          </div>
        </div>
      `;
      workerFieldsContainer.appendChild(workerSection);
    }
  }

      // Event listener for worker count change
      workerCountSelect.addEventListener('change', function() {
        const selectedCount = parseInt(this.value);
        if (selectedCount > 0 && selectedCount <= MAX_WORKERS) {
          createWorkerFields(selectedCount);
        } else {
          workerFieldsContainer.innerHTML = '';
        }
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const MAX_VISITORS = 30;
      const MAX_MATERIALS = 30;
      const visitorCountSelect = document.getElementById('visitorCount');
      const materialCountSelect = document.getElementById('materialCount');
      const visitorFieldsContainer = document.getElementById('visitorFields');
      const materialFieldsContainer = document.getElementById('materialFields');

      // Function to create visitor fields
      function createVisitorFields(count) {
        visitorFieldsContainer.innerHTML = ''; // Clear existing fields

        for (let i = 1; i <= count; i++) {
          const visitorSection = document.createElement('div');
          visitorSection.className = 'bg-gray-50 p-4 rounded-lg';
          visitorSection.innerHTML = `
            <h4 class="text-md font-medium text-gray-700 mb-3">Visitor ${i}</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name ${i}</label>
                <input type="text" name="name_${i}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ID Card ${i}</label>
                <input type="text" name="id_card_${i}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
              </div>
            </div>
          `;
          visitorFieldsContainer.appendChild(visitorSection);
        }
      }

      // Function to create material fields
      function createMaterialFields(count) {
        materialFieldsContainer.innerHTML = ''; // Clear existing fields

        for (let i = 1; i <= count; i++) {
          const materialSection = document.createElement('div');
          materialSection.className = 'bg-gray-50 p-4 rounded-lg';
          materialSection.innerHTML = `
            <h4 class="text-md font-medium text-gray-700 mb-3">Material ${i}</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Material Name</label>
                <input type="text" name="material_${i}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                <input type="text" name="quantity_${i}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
              </div>
            </div>
          `;
          materialFieldsContainer.appendChild(materialSection);
        }
      }

      // Event listener for visitor count change
      visitorCountSelect.addEventListener('change', function() {
        const selectedCount = parseInt(this.value);
        if (selectedCount > 0 && selectedCount <= MAX_VISITORS) {
          createVisitorFields(selectedCount);
        } else {
          visitorFieldsContainer.innerHTML = '';
        }
      });

      // Event listener for material count change
      materialCountSelect.addEventListener('change', function() {
        const selectedCount = parseInt(this.value);
        if (selectedCount > 0 && selectedCount <= MAX_MATERIALS) {
          createMaterialFields(selectedCount);
        } else {
          materialFieldsContainer.innerHTML = '';
        }
      });
    });
  </script>
  <script>
    function updateLevelOptions() {
      const buildingSelect = document.getElementById('buildingSelect');
      const levelSelect = document.getElementById('levelSelect');
      const selectedBuilding = buildingSelect.value;

      // Clear existing options except the first one
      levelSelect.innerHTML = '<option value="">Select Level</option>';

      if (selectedBuilding === 'Admin Building') {
        const adminLevels = [
          'Level 1',
          'Level 2',
          'Level 3',
          'Level 4 (Admin Building Only)'
        ];
        adminLevels.forEach(level => {
          const option = document.createElement('option');
          option.value = level;
          option.textContent = level;
          levelSelect.appendChild(option);
        });
      } else if (selectedBuilding === 'DC Building') {
        const dcLevels = [
          'Level 1',
          'Level 2',
          'Level 3',
          'Level 4',
          'Level 5 (DC Building Only)'
        ];
        dcLevels.forEach(level => {
          const option = document.createElement('option');
          option.value = level;
          option.textContent = level;
          levelSelect.appendChild(option);
        });
      } else if (selectedBuilding === 'External Areas') {
        const option = document.createElement('option');
        option.value = 'N/A (For External Areas)';
        option.textContent = 'N/A (For External Areas)';
        levelSelect.appendChild(option);
      }
    }

    // Initialize level options when page loads
    document.addEventListener('DOMContentLoaded', function() {
      const buildingSelect = document.getElementById('buildingSelect');
      if (buildingSelect.value) {
        updateLevelOptions();
      }
    });
  </script>
  <script>
    function updateVendorLevelOptions() {
      const buildingSelect = document.getElementById('vendorBuildingSelect');
      const levelSelect = document.getElementById('vendorLevelSelect');
      const selectedBuilding = buildingSelect.value;

      // Clear existing options except the first one
      levelSelect.innerHTML = '<option value="">Select Level</option>';

      if (selectedBuilding === 'Admin Building') {
        const adminLevels = [
          'Level 1',
          'Level 2',
          'Level 3',
          'Level 4 (Admin Building Only)'
        ];
        adminLevels.forEach(level => {
          const option = document.createElement('option');
          option.value = level;
          option.textContent = level;
          levelSelect.appendChild(option);
        });
      } else if (selectedBuilding === 'DC Building') {
        const dcLevels = [
          'Level 1',
          'Level 2',
          'Level 3',
          'Level 4',
          'Level 5 (DC Building Only)'
        ];
        dcLevels.forEach(level => {
          const option = document.createElement('option');
          option.value = level;
          option.textContent = level;
          levelSelect.appendChild(option);
        });
      } else if (selectedBuilding === 'External Areas') {
        const option = document.createElement('option');
        option.value = 'N/A (For External Areas)';
        option.textContent = 'N/A (For External Areas)';
        levelSelect.appendChild(option);
      }
    }

    // Initialize level options when page loads
    document.addEventListener('DOMContentLoaded', function() {
      const buildingSelect = document.getElementById('buildingSelect');
      const vendorBuildingSelect = document.getElementById('vendorBuildingSelect');

      if (buildingSelect.value) {
        updateLevelOptions();
      }
      if (vendorBuildingSelect.value) {
        updateVendorLevelOptions();
      }
    });
  </script>
</body>
</html>


@endsection
