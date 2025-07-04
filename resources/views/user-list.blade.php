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
      .btn-hover {
        transition: background-color 0.2s ease;
      }
      .btn-hover:hover {
        background-color: rgba(0, 0, 0, 0.05);
      }
      .btn-hover:active {
        background-color: rgba(0, 0, 0, 0.1);
      }
      .menu-item {
        transition: background-color 0.2s ease;
      }
      .menu-item:hover {
        background-color: rgba(0, 0, 0, 0.05);
      }
      .menu-item:active {
        background-color: rgba(0, 0, 0, 0.1);
      }
      .action-btn {
        padding: 4px 8px;
        border-radius: 4px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 28px;
        margin: 0 2px;
      }
      .action-btn:hover {
        transform: translateY(-1px);
      }
      .action-btn.edit {
        background-color: rgba(37, 99, 235, 0.1);
        color: #2563eb;
      }
      .action-btn.edit:hover {
        background-color: rgba(37, 99, 235, 0.2);
      }
      .action-btn.view {
        background-color: rgba(107, 114, 128, 0.1);
        color: #4b5563;
      }
      .action-btn.view:hover {
        background-color: rgba(107, 114, 128, 0.2);
      }
      .action-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 4px;
      }
      .modal {
        display: none;
        position: fixed;
        z-index: 50;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
      }
      .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 1.5rem;
        border-radius: 0.5rem;
        width: 90%;
        max-width: 32rem;
        position: relative;
      }
      .close {
        position: absolute;
        right: 1rem;
        top: 1rem;
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
        color: #6B7280;
      }
      .close:hover {
        color: #374151;
      }
      /* Custom scrollbar styles */
      .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #CBD5E0 #EDF2F7;
      }
      .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
      }
      .custom-scrollbar::-webkit-scrollbar-track {
        background: #EDF2F7;
        border-radius: 4px;
      }
      .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #CBD5E0;
        border-radius: 4px;
      }
      .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #A0AEC0;
      }
      /* Table container styles */
      .table-container {
        overflow: visible;
      }
      /* Fixed header styles */
      .table-header {
        position: sticky;
        top: 0;
        background-color: #F9FAFB;
        z-index: 10;
      }
      /* Left tab styles */
      .left-tab {
        position: sticky;
        top: 80px; /* Navbar height + some spacing */
        width: 200px;
        background-color: #F9FAFB;
        border-right: 1px solid #E5E7EB;
        height: fit-content;
        z-index: 20;
      }
      .left-tab-item {
        padding: 12px 16px;
        cursor: pointer;
        border-left: 3px solid transparent;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
      .left-tab-item:hover {
        background-color: #F3F4F6;
      }
      .left-tab-item.active {
        background-color: #EFF6FF;
        border-left-color: #2563EB;
        color: #2563EB;
      }
      .left-tab-item i {
        width: 20px;
        text-align: center;
      }
      .tab-content {
        display: none;
      }
      .tab-content.active {
        display: block;
      }
      /* Pagination styles */
      .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
        padding: 1rem;
        background-color: white;
        border-top: 1px solid #E5E7EB;
      }
      .pagination button {
        padding: 0.5rem 1rem;
        border: 1px solid #E5E7EB;
        border-radius: 0.375rem;
        background-color: white;
        color: #374151;
        font-size: 0.875rem;
        transition: all 0.2s;
      }
      .pagination button:hover:not(:disabled) {
        background-color: #F3F4F6;
      }
      .pagination button:disabled {
        opacity: 0.5;
      }
      .table-row-hover { transition: background-color 0.2s ease; }
      .table-row-hover:hover { background-color: rgba(0, 0, 0, 0.02); }
    </style>
  </head>
  <body class="bg-gray-50">

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="mb-6">
        <a href="{{route('dhi-dashboard')}}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
          <i class="fas fa-arrow-left mr-2"></i>
          Back to Dashboard
        </a>
      </div>
      <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-3">
          <h1 class="text-2xl font-semibold text-gray-900">User List</h1>
        </div>
        <div class="mb-3 flex flex-wrap gap-4 bg-white p-2 rounded-lg shadow-sm">
          <div class="flex-1 min-w-[200px]">
            <label for="roleFilter" class="block text-sm font-semibold text-gray-700 mb-1">Role</label>
            <select id="roleFilter" class="w-full px-4 py-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
              <option value="all">All Roles</option>
              <option value="dhi">DHI</option>
              <option value="fm">FM</option>
              <option value="client">Security</option>
            </select>
          </div>
          <div class="flex-1 min-w-[200px]">
            <label for="searchFilter" class="block text-sm font-semibold text-gray-700 mb-1">Search</label>
            <input type="text" id="searchFilter" placeholder="Search users..." class="w-full px-4 py-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" />
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
             @foreach ($dataUser as $item)
    <tr class="table-row-hover">
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->email }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->role }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <div class="flex items-center space-x-3"> <!-- Using flex and space-x-3 for spacing between buttons -->
                <a class="text-primary hover:text-blue-700 inline-flex items-center gap-1" title="Edit user permission" href="{{route('permision-user',$item->id)}}">
                    <i class="fas fa-edit"></i>
                    Edit user permission
                </a>

                <button class="text-yellow-600 hover:text-yellow-700 inline-flex items-center gap-1" title="Preview" onclick="previewUser(0)">
                    <i class="fas fa-eye"></i>
                    Preview
                </button>

                <form action="{{ route('delete-user', $item->id) }}" method="post" id="deleteForm-{{ $item->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="text-red-600 hover:text-red-700 inline-flex items-center gap-1" title="Delete" onclick="confirmDelete({{ $item->id }})">
                        <i class="fas fa-trash"></i>
                        Delete
                    </button>
                </form>
            </div>
        </td>
    </tr>
@endforeach


            </tbody>
          </table>
        </div>
        <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
          <div class="flex-1 flex justify-between sm:hidden">
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</a>
            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</a>
          </div>
          <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium">1</span>
                to
                <span class="font-medium">2</span>
                of
                <span class="font-medium">2</span>
                users
              </p>
            </div>
            <div>
              <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" aria-label="Previous">
                  <span><i class="fas fa-chevron-left"></i></span>
                </a>
                <a href="#" aria-current="page" class="z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</a>
                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">3</a>
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" aria-label="Next">
                  <span><i class="fas fa-chevron-right"></i></span>
                </a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Tambahkan modal preview user di akhir body -->
    <div id="userPreviewModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <button onclick="closeUserPreview()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h2 class="text-xl font-semibold mb-4">User Preview</h2>
        <div id="userPreviewContent">
          <!-- Konten user akan diisi via JS -->
        </div>
      </div>
    </div>
    <script>
    const users = [
      { name: 'John Doe', email: 'john.doe@example.com', role: 'DHI' },
      { name: 'Jane Smith', email: 'jane.smith@example.com', role: 'FM' },
      { name: 'Michael Lee', email: 'michael.lee@client.com', role: 'CLIENT' },
      { name: 'Sarah Connor', email: 'sarah.connor@dhi.com', role: 'DHI' },
      { name: 'David Kim', email: 'david.kim@fm.com', role: 'FM' },
      { name: 'Emily Clark', email: 'emily.clark@client.com', role: 'CLIENT' },
      { name: 'Olivia Brown', email: 'olivia.brown@dhi.com', role: 'DHI' },
      { name: 'William Turner', email: 'william.turner@fm.com', role: 'FM' },
      { name: 'Sophia Wilson', email: 'sophia.wilson@client.com', role: 'CLIENT' },
      { name: 'Liam Martinez', email: 'liam.martinez@dhi.com', role: 'DHI' },
    ];
    function previewUser(idx) {
      const user = users[idx];
      document.getElementById('userPreviewContent').innerHTML = `
        <div class='mb-2'><strong>Name:</strong> ${user.name}</div>
        <div class='mb-2'><strong>Email:</strong> ${user.email}</div>
        <div class='mb-2'><strong>Role:</strong> ${user.role}</div>
      `;
      document.getElementById('userPreviewModal').classList.remove('hidden');
    }
    function closeUserPreview() {
      document.getElementById('userPreviewModal').classList.add('hidden');
    }
    </script>
  </body>
</html>

<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika ya, submit form untuk menghapus user
                document.getElementById('deleteForm-' + userId).submit();
            }
        });
    }
</script>
@endsection
