<div wire:poll.10s>
    <!-- Your table or content to display the Google Sheets data -->
    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <tbody>
            @foreach ($values as $row)
                <tr class="hover:bg-gray-100">
                    @foreach ($row as $column)
                        <td class="px-4 py-2 border border-gray-300">{{ $column }}</td>
                    @endforeach
                </tr>
            @endforeach
            hi
        </tbody>
    </table>
</div>
