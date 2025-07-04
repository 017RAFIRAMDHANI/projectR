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
    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        <h1 class="text-2xl font-bold text-primary mb-6">Visitor Request Form</h1>
        <form class="bg-white p-6 rounded-lg shadow space-y-8">
            <!-- To be filled by requester -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">To be filled by requester</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                        <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Requested Duration</label>
                        <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="e.g. 1 Day" required />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Requested Date From</label>
                        <input type="date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Requested Date To</label>
                        <input type="date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required />
                    </div>
                </div>
                <div class="flex items-center space-x-4 mb-2">
                    <label class="block text-sm font-medium text-gray-700">Purpose:</label>
                    <label class="inline-flex items-center"><input type="checkbox" class="form-checkbox" name="purposeVisitor" /> <span class="ml-1">Visitor</span></label>
                    <label class="inline-flex items-center"><input type="checkbox" class="form-checkbox" name="purposeDelivery" /> <span class="ml-1">Delivery</span></label>
                    <input type="text" class="ml-2 border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary w-32" placeholder="No/ID" />
                </div>
                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Purpose Details</label>
                    <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required />
                </div>
                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Destination / Area</label>
                    <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required />
                </div>
            </div>

            <!-- If Visitor -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">If Visitor: Full Name & ID Card No</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Full Name</label>
                        <div class="space-y-1">
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="1." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="2." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="3." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="4." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="5." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="6." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="7." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="8." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="9." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="10." />
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">ID Card</label>
                        <div class="space-y-1">
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="1." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="2." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="3." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="4." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="5." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="6." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="7." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="8." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="9." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="10." />
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
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="1." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="2." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="3." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="4." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="5." />
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Qty</label>
                        <div class="space-y-1">
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="1." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="2." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="3." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="4." />
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="5." />
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
                        <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact No</label>
                        <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Car Plate No (if any)</label>
                        <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                    </div>
                </div>
            </div>

            <!-- Approval Section (for DHI/FM) -->
            <div class="border-t pt-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">To be filled by DHI/FM Team</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" class="w-full border-gray-200 bg-gray-100 rounded-md shadow-sm text-gray-400 cursor-not-allowed" disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Approved by</label>
                        <input type="text" class="w-full border-gray-200 bg-gray-100 rounded-md shadow-sm text-gray-400 cursor-not-allowed" placeholder="To be filled by FH" readonly disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sign</label>
                        <div class="border border-gray-200 rounded bg-gray-100 flex flex-col items-center p-2">
                            <canvas id="signatureCanvas" width="250" height="80" class="border-2 border-gray-200 rounded bg-gray-100 cursor-not-allowed"></canvas>
                            <button type="button" onclick="clearSignature()" class="mt-2 px-3 py-1 bg-gray-200 text-gray-400 rounded cursor-not-allowed" disabled>Clear</button>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-2">
                    <label class="block text-sm font-medium text-gray-700">Visitor Badge Color Assigned:</label>
                    <label class="inline-flex items-center"><input type="radio" name="badgeColor" value="yellow" class="form-radio" disabled /> <span class="ml-1 text-gray-400">Yellow</span></label>
                    <label class="inline-flex items-center"><input type="radio" name="badgeColor" value="red" class="form-radio" disabled /> <span class="ml-1 text-gray-400">Red</span></label>
                    <label class="inline-flex items-center"><input type="radio" name="badgeColor" value="green" class="form-radio" disabled /> <span class="ml-1 text-gray-400">Green</span></label>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded hover:bg-blue-700 transition">Submit Permit</button>
            </div>
        </form>
    </main>
    <script>
    // Signature pad logic
    const canvas = document.getElementById('signatureCanvas');
    const ctx = canvas.getContext('2d');
    let drawing = false;
    let lastX = 0;
    let lastY = 0;

    canvas.addEventListener('mousedown', (e) => {
        drawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
    });
    canvas.addEventListener('mousemove', (e) => {
        if (!drawing) return;
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.strokeStyle = '#222';
        ctx.lineWidth = 2;
        ctx.stroke();
        [lastX, lastY] = [e.offsetX, e.offsetY];
    });
    canvas.addEventListener('mouseup', () => drawing = false);
    canvas.addEventListener('mouseout', () => drawing = false);

    // Touch support
    canvas.addEventListener('touchstart', function(e) {
        e.preventDefault();
        drawing = true;
        const rect = canvas.getBoundingClientRect();
        lastX = e.touches[0].clientX - rect.left;
        lastY = e.touches[0].clientY - rect.top;
    });
    canvas.addEventListener('touchmove', function(e) {
        e.preventDefault();
        if (!drawing) return;
        const rect = canvas.getBoundingClientRect();
        const x = e.touches[0].clientX - rect.left;
        const y = e.touches[0].clientY - rect.top;
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.strokeStyle = '#222';
        ctx.lineWidth = 2;
        ctx.stroke();
        lastX = x;
        lastY = y;
    });
    canvas.addEventListener('touchend', function(e) { drawing = false; });
    canvas.addEventListener('touchcancel', function(e) { drawing = false; });

    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
    </script>
</body>
</html>


@endsection
