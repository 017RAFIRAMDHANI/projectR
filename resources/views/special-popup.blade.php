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
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }
    .modal.show {
      opacity: 1;
    }
    .modal-content {
      position: relative;
      background-color: white;
      margin: 5% auto;
      padding: 2rem;
      border-radius: 1rem;
      width: 90%;
      max-width: 600px;
      max-height: 85vh;
      overflow-y: auto;
      transform: translateY(-20px);
      transition: transform 0.3s ease-in-out;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .modal.show .modal-content {
      transform: translateY(0);
    }
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .form-input {
      @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary;
      transition: all 0.2s ease;
    }
    .form-input:focus {
      @apply ring-2 ring-primary ring-opacity-50;
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
  <!-- Navbar -->


  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex-1 flex flex-col items-center justify-center py-12">
    <div class="text-center mb-12">
      <h1 class="text-4xl font-bold mb-4 text-gray-900">Special Access Portal</h1>
      <p class="text-lg text-gray-600">Select the type of access you need</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 max-w-4xl w-full">
      <!-- Visitor Card -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
        <div class="p-8">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto">
            <i class="fas fa-user-tie text-2xl text-primary"></i>
          </div>
          <h3 class="text-xl font-semibold text-center mb-4">Visitor Access</h3>
          <p class="text-gray-600 text-center mb-6">For temporary visitors requiring special access to our facilities</p>
          <button onclick="showVisitorForm()" class="w-full py-3 bg-primary text-white rounded-lg font-medium hover:bg-blue-700 transition duration-300">
            Request Access
          </button>
        </div>
      </div>

      <!-- Vendor Card -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
        <div class="p-8">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
            <i class="fas fa-building text-2xl text-green-600"></i>
          </div>
          <h3 class="text-xl font-semibold text-center mb-4">Vendor Access</h3>
          <p class="text-gray-600 text-center mb-6">For registered vendors providing services to our facilities</p>
          <button onclick="window.location.href='{{route('vendor_create')}}'" class="w-full py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition duration-300">
            Request Access
          </button>
        </div>
      </div>
    </div>

    <button onclick="window.location.href='{{route('fm-dashboard')}}'" class="flex items-center text-primary hover:underline mt-12 text-base font-medium">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Dashboard
    </button>
  </main>

  <!-- Visitor Form Modal -->
  <div id="visitorModal" class="modal">
    <div class="modal-content">
      <div class="flex justify-between items-center mb-6">
        <div>
          <h3 class="text-2xl font-semibold text-gray-900">Visitor Special Access</h3>
          <p class="text-sm text-gray-500 mt-1">Please fill in the details below</p>
        </div>
        <button onclick="closeVisitorModal()" class="text-gray-400 hover:text-gray-500 transition">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <form id="visitorForm" class="space-y-6">
        <!-- To be filled by requester -->
        <div>
          <h2 class="text-lg font-semibold text-gray-700 mb-2">To be filled by requester</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
              <input type="text" class="form-input" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Requested Duration</label>
              <input type="text" class="form-input" placeholder="e.g. 1 Day" required />
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Requested Date From</label>
              <input type="date" class="form-input" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Requested Date To</label>
              <input type="date" class="form-input" required />
            </div>
          </div>
          <div class="flex items-center space-x-4 mb-2">
            <label class="block text-sm font-medium text-gray-700">Purpose:</label>
            <label class="inline-flex items-center"><input type="checkbox" class="form-checkbox" name="purposeVisitor" /> <span class="ml-1">Visitor</span></label>
            <label class="inline-flex items-center"><input type="checkbox" class="form-checkbox" name="purposeDelivery" /> <span class="ml-1">Delivery</span></label>
            <input type="text" class="ml-2 form-input w-32" placeholder="No/ID" />
          </div>
          <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Purpose Details</label>
            <input type="text" class="form-input" required />
          </div>
          <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Destination / Area</label>
            <input type="text" class="form-input" required />
          </div>
        </div>

        <!-- If Visitor -->
        <div>
          <h2 class="text-lg font-semibold text-gray-700 mb-2">If Visitor: Full Name & ID Card No</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-medium text-gray-500 mb-1">Full Name</label>
              <div class="space-y-1">
                <input type="text" class="form-input" placeholder="1." />
                <input type="text" class="form-input" placeholder="2." />
                <input type="text" class="form-input" placeholder="3." />
                <input type="text" class="form-input" placeholder="4." />
                <input type="text" class="form-input" placeholder="5." />
              </div>
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-500 mb-1">ID Card</label>
              <div class="space-y-1">
                <input type="text" class="form-input" placeholder="1." />
                <input type="text" class="form-input" placeholder="2." />
                <input type="text" class="form-input" placeholder="3." />
                <input type="text" class="form-input" placeholder="4." />
                <input type="text" class="form-input" placeholder="5." />
              </div>
            </div>
          </div>
        </div>

        <!-- If Delivery -->
        <div>
          <h2 class="text-lg font-semibold text-gray-700 mb-2">If Delivery: Details Materials & Quantity</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-medium text-gray-500 mb-1">Materials</label>
              <div class="space-y-1">
                <input type="text" class="form-input" placeholder="1." />
                <input type="text" class="form-input" placeholder="2." />
                <input type="text" class="form-input" placeholder="3." />
                <input type="text" class="form-input" placeholder="4." />
                <input type="text" class="form-input" placeholder="5." />
              </div>
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-500 mb-1">Qty</label>
              <div class="space-y-1">
                <input type="text" class="form-input" placeholder="1." />
                <input type="text" class="form-input" placeholder="2." />
                <input type="text" class="form-input" placeholder="3." />
                <input type="text" class="form-input" placeholder="4." />
                <input type="text" class="form-input" placeholder="5." />
              </div>
            </div>
          </div>
        </div>

        <!-- Person in Charge -->
        <div>
          <h2 class="text-lg font-semibold text-gray-700 mb-2">Person in Charge from GC / Owner</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
              <input type="text" class="form-input" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Contact No</label>
              <input type="text" class="form-input" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Car Plate No (if any)</label>
              <input type="text" class="form-input" />
            </div>
          </div>
        </div>

        <!-- Visitor Form Buttons -->
        <div class="flex justify-end space-x-4 pt-6 border-t mt-6">
          <button type="button" onclick="closeVisitorModal()" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition">
            Cancel
          </button>
          <button type="button" onclick="editVisitorForm()" class="px-6 py-2.5 bg-secondary text-white rounded-lg font-medium hover:bg-gray-600 transition">
            Edit
          </button>
          <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg font-medium hover:bg-blue-700 transition">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Vendor Form Modal -->
  <div id="vendorModal" class="modal">
    <div class="modal-content">
      <div class="flex justify-between items-center mb-6">
        <div>
          <h3 class="text-2xl font-semibold text-gray-900">Vendor Special Access</h3>
          <p class="text-sm text-gray-500 mt-1">Please fill in the details below</p>
        </div>
        <button onclick="closeVendorModal()" class="text-gray-400 hover:text-gray-500 transition">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <form id="vendorForm" class="space-y-6">
        <!-- Basic Information -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 required">Company Name</label>
            <input type="text" class="form-input" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 required">Requestor Name</label>
            <input type="text" class="form-input" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 required">Email</label>
            <input type="email" class="form-input" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 required">Phone Number</label>
            <input type="tel" class="form-input" required>
          </div>
        </div>

        <!-- Work Information -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 required">Location</label>
            <input type="text" class="form-input" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 required">Building / Level / Room</label>
            <input type="text" class="form-input" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 required">Purpose of Work</label>
            <textarea class="form-input" rows="3" required></textarea>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 required">Start Date</label>
              <input type="date" class="form-input" required>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 required">End Date</label>
              <input type="date" class="form-input" required>
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
            <label class="block text-sm font-medium text-gray-700">Protection System Affected</label>
            <input type="text" class="form-input" placeholder="e.g., Smoke detector, Sprinkler">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 required">Method of Statement (MOS)</label>
            <div class="mt-1 flex items-center">
              <input type="file" accept=".pdf,.doc,.docx" required
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
                <input type="text" class="form-input" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 required">Worker 1 - ID No/Permit No</label>
                <input type="text" class="form-input" required>
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

        <!-- Vendor Form Buttons -->
        <div class="flex justify-end space-x-4 pt-6 border-t mt-6">
          <button type="button" onclick="closeVendorModal()" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition">
            Cancel
          </button>
          <button type="button" onclick="editVendorForm()" class="px-6 py-2.5 bg-secondary text-white rounded-lg font-medium hover:bg-gray-600 transition">
            Edit
          </button>
          <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg font-medium hover:bg-blue-700 transition">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function showVisitorForm() {
      const modal = document.getElementById('visitorModal');
      modal.style.display = 'block';
      setTimeout(() => modal.classList.add('show'), 10);
    }

    function closeVisitorModal() {
      const modal = document.getElementById('visitorModal');
      modal.classList.remove('show');
      setTimeout(() => modal.style.display = 'none', 300);
    }

    function showVendorForm() {
      const modal = document.getElementById('vendorModal');
      modal.style.display = 'block';
      setTimeout(() => modal.classList.add('show'), 10);
    }

    function closeVendorModal() {
      const modal = document.getElementById('vendorModal');
      modal.classList.remove('show');
      setTimeout(() => modal.style.display = 'none', 300);
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      const visitorModal = document.getElementById('visitorModal');
      const vendorModal = document.getElementById('vendorModal');
      if (event.target == visitorModal) {
        closeVisitorModal();
      }
      if (event.target == vendorModal) {
        closeVendorModal();
      }
    }

    function editVisitorForm() {
      // Enable all form inputs
      const form = document.getElementById('visitorForm');
      const inputs = form.querySelectorAll('input, textarea');
      inputs.forEach(input => {
        input.disabled = false;
      });
    }

    function editVendorForm() {
      // Enable all form inputs
      const form = document.getElementById('vendorForm');
      const inputs = form.querySelectorAll('input, textarea');
      inputs.forEach(input => {
        input.disabled = false;
      });
    }

    // Handle form submissions
    document.getElementById('visitorForm').addEventListener('submit', function(e) {
      e.preventDefault();
      // Disable all form inputs after submission
      const inputs = this.querySelectorAll('input, textarea');
      inputs.forEach(input => {
        input.disabled = true;
      });
      // Add your form submission logic here
      alert('Visitor request submitted successfully!');
      closeVisitorModal();
    });

    document.getElementById('vendorForm').addEventListener('submit', function(e) {
      e.preventDefault();
      // Disable all form inputs after submission
      const inputs = this.querySelectorAll('input, textarea');
      inputs.forEach(input => {
        input.disabled = true;
      });
      // Add your form submission logic here
      alert('Vendor request submitted successfully!');
      closeVendorModal();
    });
  </script>
</body>
</html>

@endsection
