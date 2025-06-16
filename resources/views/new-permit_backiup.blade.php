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
  <!-- Navbar -->

  <!-- Main Content -->
  <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 flex-1 py-12 w-full">
    <div class="bg-white shadow rounded-lg p-6">
      <div class="border-b border-gray-200 pb-4 mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Permit Request Form</h1>
        <p class="mt-1 text-sm text-gray-500">Fill in the details below to submit a new permit request.</p>
      </div>

        <!-- Permit Type Selector -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Permit Type</label>
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

        <!-- Common Fields -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 required">Company Name</label>
            <input type="text" name="companyName" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
          </div>
        </div>

        <!-- Visitor/Delivery Section -->
        <div id="visitorSection">
          <!-- Destination Email -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Destination Email</label>
            <input type="email" name="destinationEmail" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" placeholder="example@email.com">
          </div>
          <!-- Requested Duration -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Requested Duration</label>
            <input type="text" name="requestedDuration" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="e.g. 1 Day">
          </div>
          <!-- Requested Date From -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Requested Date From</label>
            <input type="date" name="requestedDateFrom" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="dd/mm/yyyy">
          </div>
          <!-- Requested Date To -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Requested Date To</label>
            <input type="date" name="requestedDateTo" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="dd/mm/yyyy">
          </div>
          <!-- Purpose (Radio) -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required mb-2">Purpose</label>
            <div class="flex space-x-6">
              <label class="inline-flex items-center">
                <input type="radio" name="purposeRadio" value="Visitor" required class="text-primary focus:ring-primary">
                <span class="ml-2">Visitor</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="purposeRadio" value="Delivery" required class="text-primary focus:ring-primary">
                <span class="ml-2">Delivery</span>
              </label>
            </div>
          </div>
          <!-- Purpose Details (Paragraph) -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Purpose Details</label>
            <textarea name="purposeDetails" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Describe the purpose (optional)"></textarea>
          </div>
          <!-- Destination / Area -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Destination / Area</label>
            <input type="text" name="destinationArea" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>
          <!-- Full Name & ID Card 1 (required), 2-10 (optional) -->
          <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Visitor Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Full Name 1 <span class="text-red-500">*</span></label>
                <input type="text" name="visitorName1" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Full Name 1">
                <label class="block text-xs font-medium text-gray-500 mb-1 mt-3">Full Name 2-10</label>
                <input type="text" name="visitorName2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 2 (optional)">
                <input type="text" name="visitorName3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 3 (optional)">
                <input type="text" name="visitorName4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 4 (optional)">
                <input type="text" name="visitorName5" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 5 (optional)">
                <input type="text" name="visitorName6" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 6 (optional)">
                <input type="text" name="visitorName7" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 7 (optional)">
                <input type="text" name="visitorName8" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 8 (optional)">
                <input type="text" name="visitorName9" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 9 (optional)">
                <input type="text" name="visitorName10" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Full Name 10 (optional)">
              </div>
              <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">ID Card 1 <span class="text-red-500">*</span></label>
                <input type="text" name="visitorId1" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="ID Card 1">
                <label class="block text-xs font-medium text-gray-500 mb-1 mt-3">ID Card 2-10</label>
                <input type="text" name="visitorId2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 2 (optional)">
                <input type="text" name="visitorId3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 3 (optional)">
                <input type="text" name="visitorId4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 4 (optional)">
                <input type="text" name="visitorId5" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 5 (optional)">
                <input type="text" name="visitorId6" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 6 (optional)">
                <input type="text" name="visitorId7" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 7 (optional)">
                <input type="text" name="visitorId8" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 8 (optional)">
                <input type="text" name="visitorId9" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 9 (optional)">
                <input type="text" name="visitorId10" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="ID Card 10 (optional)">
              </div>
            </div>
          </div>
          <!-- Material Details & Quantity (Paragraph) -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Material Details</label>
            <textarea name="materialDetails" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Material details (optional)"></textarea>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Material Quantity</label>
            <textarea name="materialQuantity" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Material quantity (optional)"></textarea>
          </div>
          <!-- PIC Name (required), Contact Number & Car Plate No (optional), Type Choice -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">PIC Name</label>
            <input type="text" name="picName" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Contact Number</label>
            <input type="text" name="picContact" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Car Plate No</label>
            <input type="text" name="picCarPlate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Vehicle Type</label>
            <div class="flex space-x-6">
              <label class="inline-flex items-center">
                <input type="radio" name="vehicleType" value="Car" class="text-primary focus:ring-primary">
                <span class="ml-2">Car</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="vehicleType" value="Motorcycle" class="text-primary focus:ring-primary">
                <span class="ml-2">Motorcycle</span>
              </label>
            </div>
          </div>
        </div>
        <!-- Vendor Section -->
           <form id="permitForm" class="space-y-8" method="POST" action="{{route('vendor.store')}}" enctype="multipart/form-data">
            @csrf
        <div id="vendorSection" style="display:none;">
          <!-- Destination Email -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Destination Email</label>
            <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" placeholder="example@email.com">
          </div>
      <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Validity Date From</label>
            <input type="date" name="validity_date_from" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="dd/mm/yyyy">
        </div>
        <!-- Validity Date To -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Validity Date To </label>
            <input type="date" name="validity_date_to" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="dd/mm/yyyy">
        </div>
        <!-- Validity Time From -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Validity Time From</label>
            <input type="time" name="validity_time_from" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="hh:mm">
        </div>
        <!-- Validity Time To -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Validity Time To </label>
            <input type="time" name="validity_time_to" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="hh:mm">
        </div>
           <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Company Name</label>
            <input type="text" name="company_name" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
        </div>
        <!-- Requestor Name -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Requestor Name</label>
            <input type="text" name="requestor_name" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
        </div>
        <!-- Company Contact -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Company Contact</label>
            <input type="text" name="company_contact" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
        </div>
        <!-- Hand phone -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Hand phone</label>
            <input type="text" name="phone_number" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
        </div>
        <!-- Location of Work -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Location of Work</label>
            <input type="text" name="location_of_work" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
        </div>
         <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Building / Level / Room</label>
            <input type="text" name="building_level_room" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
        </div>
        <!-- Purpose -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Purpose</label>
            <input type="text" name="purpose" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
        </div>
        <!-- Purpose Details -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Purpose Details</label>
            <textarea name="purpose_details" rows="2" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Additional explanation"></textarea>
        </div>
        <!-- Total No. of Workers at EZSVS site -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Total No. of Workers at EZSVS site</label>
            <input type="text" name="total_worker" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
        </div>
          <!-- 15-34. Full Name 1-10 -->
           <div class="mb-4">
            <label class="block text-xs font-medium text-gray-500 mb-1">Full Name 1<span class="text-red-500">*</span></label>
            <input type="text" name="worker1_name" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Full Name 1">
            <label class="block text-xs font-medium text-gray-500 mb-1 mt-3">Full Name 2-10</label>
            <input type="text" name="worker2_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 2 (optional)">
            <input type="text" name="worker3_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 3 (optional)">
            <input type="text" name="worker4_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 4 (optional)">
            <input type="text" name="worker5_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 5 (optional)">
            <input type="text" name="worker6_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 6 (optional)">
            <input type="text" name="worker7_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 7 (optional)">
            <input type="text" name="worker8_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 8 (optional)">
            <input type="text" name="worker9_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Full Name 9 (optional)">
            <input type="text" name="worker10_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Full Name 10 (optional)">
        </div>
        <!-- ID Card 1-10 -->
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-500 mb-1">ID Card 1 <span class="text-red-500">*</span></label>
            <input type="text" name="worker1_id_card" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="ID Card 1">
            <label class="block text-xs font-medium text-gray-500 mb-1 mt-3">ID Card 2-10 </label>
            <input type="text" name="worker2_id_card" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 2 (optional)">
            <input type="text" name="worker3_id_card" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 3 (optional)">
            <input type="text" name="worker4_id_card" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 4 (optional)">
            <input type="text" name="worker5_id_card" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 5 (optional)">
            <input type="text" name="worker6_id_card" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 6 (optional)">
            <input type="text" name="worker7_id_card" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 7 (optional)">
            <input type="text" name="worker8_id_card" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 8 (optional)">
            <input type="text" name="worker9_id_card" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="ID Card 9 (optional)">
            <input type="text" name="worker10_id_card" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="ID Card 10 (optional)">
        </div>
        <!-- Birthdate 1-10 -->
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-500 mb-1">Birthdate 1<span class="text-red-500">*</span></label>
            <input type="date" name="worker1_birthdate" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Birthdate 1">
            <label class="block text-xs font-medium text-gray-500 mb-1 mt-3">Birthdate 2-10</label>
            <input type="date" name="worker2_birthdate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Birthdate 2 (optional)">
            <input type="date" name="worker3_birthdate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Birthdate 3 (optional)">
            <input type="date" name="worker4_birthdate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Birthdate 4 (optional)">
            <input type="date" name="worker5_birthdate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Birthdate 5 (optional)">
            <input type="date" name="worker6_birthdate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Birthdate 6 (optional)">
            <input type="date" name="worker7_birthdate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Birthdate 7 (optional)">
            <input type="date" name="worker8_birthdate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Birthdate 8 (optional)">
            <input type="date" name="worker9_birthdate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary mb-1" placeholder="Birthdate 9 (optional)">
            <input type="date" name="worker10_birthdate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Birthdate 10 (optional)">
        </div>
          <!-- 55. Does work generate dust? -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Does work generate dust?</label>
            <div class="flex space-x-6">
                <label class="inline-flex items-center">
                    <input type="radio" name="generate_dust" value="Yes" required class="text-primary focus:ring-primary">
                    <span class="ml-2">Yes</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="generate_dust" value="No" required class="text-primary focus:ring-primary">
                    <span class="ml-2">No</span>
                </label>
            </div>
        </div>
          <!-- 56. If Yes, state cause (of dust) -->
            <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">If Yes, state cause (of dust)</label>
            <textarea name="state_cause" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="State cause (optional)"></textarea>
        </div>
          <!-- 57. Method to contain dust / SD -->
    <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Method to contain dust</label>
            <textarea name="method" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Method to contain dust (optional)"></textarea>
          </div>
          <!-- 58. Any Fire Protection System affected? -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Any Fire Protection System affected? </label>
            <div class="flex space-x-6">
              <label class="inline-flex items-center">
                <input type="radio" name="any_fire" value="Yes" required class="text-primary focus:ring-primary">
                <span class="ml-2">Yes</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="any_fire" value="No" required class="text-primary focus:ring-primary">
                <span class="ml-2">No</span>
              </label>
            </div>
          </div>
          <!-- 59. Isolation of -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Isolation of</label>
            <div class="flex flex-wrap gap-4">
            <label class="inline-flex items-center">
    <input type="checkbox" name="isolation_of[]" value="Fire Panel" class="text-primary focus:ring-primary">
    <span class="ml-2">Fire Panel</span>
</label>

<label class="inline-flex items-center">
    <input type="checkbox" name="isolation_of[]" value="Smoke Detector" class="text-primary focus:ring-primary">
    <span class="ml-2">Smoke Detector</span>
</label>

<label class="inline-flex items-center">
    <input type="checkbox" name="isolation_of[]" value="Sprinkler" class="text-primary focus:ring-primary">
    <span class="ml-2">Sprinkler</span>
</label>

<label class="inline-flex items-center">
    <input type="checkbox" name="isolation_of[]" value="ASDS" class="text-primary focus:ring-primary">
    <span class="ml-2">ASDS</span>
</label>

            </div>
          </div>
          <!-- 60. Isolated by Name -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Isolated by Name </label>
            <input type="text" name="isolation_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>
          <!-- 61. Isolated Date/Time -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Isolated Date/Time </label>
            <input type="datetime-local" name="isolation_date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>
          <!-- 62. Method of Statement (MOS) -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Method of Statement (MOS)</label>
            <input type="file" name="file_mos" accept=".pdf,.doc,.docx" class="block w-full text-base text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:text-base file:font-medium file:bg-primary file:text-white hover:file:bg-primary/90">
            <p class="mt-2 text-base text-gray-500">Upload MOS document (PDF, DOC, or DOCX format)</p>
          </div>
          <!-- 63. Urgency -->
          {{-- <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Urgency</label>
            <div class="flex space-x-6">
              <label class="inline-flex items-center">
                <input type="radio" name="urgency" value="Urgent" required class="text-primary focus:ring-primary">
                <span class="ml-2">Urgent</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="urgency" value="Normal" required class="text-primary focus:ring-primary">
                <span class="ml-2">Normal</span>
              </label>
            </div>
          </div> --}}
          <!-- 64. Car Plate No -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Car Plate No</label>
            <input type="text" name="number_plate" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>
          <!-- 65. Type Choice -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Vehicle Type</label>
            <div class="flex space-x-6">
              <label class="inline-flex items-center">
                <input type="radio" name="vehicle_types" value="Car" class="text-primary focus:ring-primary">
                <span class="ml-2">Car</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="vehicle_types" value="Motorcycle" class="text-primary focus:ring-primary">
                <span class="ml-2">Motorcycle</span>
              </label>
            </div>
          </div>
               <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 required">Urgency</label>
            <div class="flex space-x-6">
              <label class="inline-flex items-center">
                <input type="radio" name="mode" value="Urgent" required class="text-primary focus:ring-primary">
                <span class="ml-2">Urgent</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="mode" value="Normal" required class="text-primary focus:ring-primary">
                <span class="ml-2">Normal</span>
              </label>
            </div>
          </div>
        </div>
        <div class="flex justify-end space-x-4 mt-8">
          <a href="{{route('fm-dashboard')}}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Kembali</a>
          <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Clear Form</button>
          <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Submit</button>
        </div>
      </form>
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
          <input type="text" name="worker${count}Name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 required">Worker ${count} - ID No/Permit No</label>
          <input type="text" name="worker${count}Id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
        </div>
      </div>`;
      container.insertAdjacentHTML('beforeend', html);
    }
    // Set default
    selectPermitType('visitor');
  </script>
</body>
</html>

@endsection
