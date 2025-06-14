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
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        <h1 class="text-2xl font-bold text-primary mb-6">My Permits</h1>
        <div class="bg-white rounded-lg shadow-sm overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="permitsTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="permitsBody">
                </tbody>
            </table>
        </div>

        <!-- Modal for permit details -->
        <div id="permitDetailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                <button onclick="closePermitDetail()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <h2 class="text-xl font-bold mb-4 text-primary">Permit Details</h2>
                <div id="permitDetailContent"></div>
                <div class="flex justify-end mt-4">
                    <button onclick="closePermitDetail()" class="px-4 py-2 bg-primary text-white rounded hover:bg-blue-700 transition">Close</button>
                </div>
            </div>
        </div>
    </main>
    <script>
    function renderPermits() {
        const permits = JSON.parse(localStorage.getItem('visitorPermits') || '[]');
        const tbody = document.getElementById('permitsBody');
        tbody.innerHTML = '';
        permits.forEach((p, i) => {
            const dateStr = (p.dateFrom && p.dateTo) ? `${p.dateFrom} - ${p.dateTo}` : (p.dateFrom || p.date || '-');
            const purposeStr = [];
            if (p.purposeVisitor) purposeStr.push('Visitor');
            if (p.purposeDelivery) purposeStr.push('Delivery');
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="px-4 py-3 text-sm text-gray-900">${i + 1}</td>
                <td class="px-4 py-3 text-sm text-gray-500">${p.company || '-'}</td>
                <td class="px-4 py-3 text-sm text-gray-500">${p.duration || '-'}</td>
                <td class="px-4 py-3 text-sm text-gray-500">${dateStr}</td>
                <td class="px-4 py-3 text-sm text-gray-500">${purposeStr.length ? purposeStr.join(', ') : (p.purpose || '-')}</td>
                <td class="px-4 py-3 text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${p.status === 'approved' ? 'bg-green-100 text-green-800' : p.status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'}">
                        ${p.status ? p.status.charAt(0).toUpperCase() + p.status.slice(1) : 'Pending'}
                    </span>
                </td>
                <td class="px-4 py-3 text-center">
                    <button class="text-primary hover:text-blue-700 font-semibold" onclick="showPermitDetail(${i})">View</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function showPermitDetail(idx) {
        const permits = JSON.parse(localStorage.getItem('visitorPermits') || '[]');
        const p = permits[idx];
        let html = `<table class='w-full'>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Company</td><td>${p.company || '-'}</td></tr>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Requested Duration</td><td>${p.duration || '-'}</td></tr>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Requested Date</td><td>${(p.dateFrom && p.dateTo) ? `${p.dateFrom} - ${p.dateTo}` : (p.dateFrom || p.date || '-')}</td></tr>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Purpose</td><td>${(p.purposeVisitor ? 'Visitor' : '') + (p.purposeDelivery ? ', Delivery' : '') || p.purpose || '-'}</td></tr>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Purpose Details</td><td>${p.purposeDetails || '-'}</td></tr>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Destination / Area</td><td>${p.destination || '-'}</td></tr>`;
        // Visitor List
        if (p.visitorList && Array.isArray(p.visitorList)) {
            html += `<tr><td class='font-semibold py-1 pr-2 align-top'>Visitor List</td><td><table class='w-full'>`;
            p.visitorList.forEach((v, idx) => {
                html += `<tr><td class='pr-2'>${idx+1}.</td><td>${v.name || '-'}</td><td>${v.idCard || '-'}</td></tr>`;
            });
            html += `</table></td></tr>`;
        }
        // Delivery List
        if (p.deliveryList && Array.isArray(p.deliveryList)) {
            html += `<tr><td class='font-semibold py-1 pr-2 align-top'>Delivery List</td><td><table class='w-full'>`;
            p.deliveryList.forEach((d, idx) => {
                html += `<tr><td class='pr-2'>${idx+1}.</td><td>${d.material || '-'}</td><td>${d.qty || '-'}</td></tr>`;
            });
            html += `</table></td></tr>`;
        }
        // PIC
        html += `<tr><td class='font-semibold py-1 pr-2'>Person in Charge</td><td>${p.pic || '-'}</td></tr>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Contact No</td><td>${p.contact || '-'}</td></tr>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Car Plate No</td><td>${p.carPlate || '-'}</td></tr>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Status</td><td>${p.status || '-'}</td></tr>`;
        html += `<tr><td class='font-semibold py-1 pr-2'>Created At</td><td>${p.createdAt ? new Date(p.createdAt).toLocaleString() : '-'}</td></tr>`;
        html += `</table>`;
        document.getElementById('permitDetailContent').innerHTML = html;
        document.getElementById('permitDetailModal').classList.remove('hidden');
    }
    function closePermitDetail() {
        document.getElementById('permitDetailModal').classList.add('hidden');
    }
    renderPermits();
    </script>
</body>
</html>


@endsection
