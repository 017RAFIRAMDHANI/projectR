<div wire:poll.10s>
    <!-- Table to display Vendor data from the local database -->
    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border border-gray-300">Company Name</th>
                <th class="px-4 py-2 border border-gray-300">Requestor Name</th>
                <th class="px-4 py-2 border border-gray-300">Location of Work</th>
                <th class="px-4 py-2 border border-gray-300">Phone Number</th>
                <th class="px-4 py-2 border border-gray-300">Email</th>
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>
            <!-- Loop through the vendors and display them in rows -->
            @foreach ($vendors as $vendor)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->company_name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->requestor_name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->location_of_work }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->phone_number }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $vendor->email }}</td>
                    <!-- Add more table data for other columns as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
