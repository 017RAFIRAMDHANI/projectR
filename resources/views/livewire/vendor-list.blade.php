<div wire:poll.1s>
    <!-- Table to display Vendor data from the local database -->
    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
            <tr>
                <!-- Add all column headers -->
                <th class="px-4 py-2 border border-gray-300">Company Name</th>
                <th class="px-4 py-2 border border-gray-300">Requestor Name</th>
                <th class="px-4 py-2 border border-gray-300">Location of Work</th>
                <th class="px-4 py-2 border border-gray-300">Building Level Room</th>
                <th class="px-4 py-2 border border-gray-300">Work Description</th>
                <th class="px-4 py-2 border border-gray-300">Email</th>
                <th class="px-4 py-2 border border-gray-300">Phone Number</th>
                <th class="px-4 py-2 border border-gray-300">Permit Number</th>
                <th class="px-4 py-2 border border-gray-300">Start Date</th>
                <th class="px-4 py-2 border border-gray-300">End Date</th>
                <th class="px-4 py-2 border border-gray-300">Number Plate</th>
                <th class="px-4 py-2 border border-gray-300">Vehicle Types</th>
                <th class="px-4 py-2 border border-gray-300">Worker 1 Name</th>
                <th class="px-4 py-2 border border-gray-300">Worker 1 ID No</th>
                <th class="px-4 py-2 border border-gray-300">Worker 2 Name</th>
                <th class="px-4 py-2 border border-gray-300">Worker 2 ID No</th>
                <th class="px-4 py-2 border border-gray-300">Worker 3 Name</th>
                <th class="px-4 py-2 border border-gray-300">Worker 3 ID No</th>
                <th class="px-4 py-2 border border-gray-300">Worker 4 Name</th>
                <th class="px-4 py-2 border border-gray-300">Worker 4 ID No</th>
                <th class="px-4 py-2 border border-gray-300">Worker 5 Name</th>
                <th class="px-4 py-2 border border-gray-300">Worker 5 ID No</th>
                <th class="px-4 py-2 border border-gray-300">Generate Dust</th>
                <th class="px-4 py-2 border border-gray-300">Protection System</th>
                <th class="px-4 py-2 border border-gray-300">File MOS</th>
                <th class="px-4 py-2 border border-gray-300">Status Approval DHI</th>
                <th class="px-4 py-2 border border-gray-300">Status Approval FH</th>
                <th class="px-4 py-2 border border-gray-300">Mode</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through the vendors and display them in rows -->
            @foreach ($vendors as $vendor)
                <tr class="hover:bg-gray-100">
                    <!-- Display all vendor columns -->
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->company_name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->requestor_name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->location_of_work }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->building_level_room }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->work_description }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->email }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->phone_number }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->permit_number }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->start_date }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->end_date }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->number_plate }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->vehicle_types }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker1_name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker1_id_nopermit }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker2_name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker2_id_nopermit }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker3_name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker3_id_nopermit }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker4_name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker4_id_nopermit }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker5_name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->worker5_id_nopermit }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->generate_dust }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->protection_system }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->file_mos }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->status_approval_DHI }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->status_approval_FH }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->mode }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
