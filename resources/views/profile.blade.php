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
<body class="bg-gray-50">
    <!-- Navbar -->

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a   href="{{route('fm-dashboard')}}" class="flex items-center text-primary hover:underline text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Profile Settings</h1>
            <p class="mt-2 text-sm text-gray-600">Manage your account settings and preferences</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex flex-col md:flex-row">
                <!-- Profile Image and Basic Info -->
                <div class="md:w-1/3 flex flex-col items-center p-6 border-b md:border-b-0 md:border-r border-gray-200">
                    <div class="relative">
                        <img class="h-32 w-32 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&size=128&background=2563eb&color=fff" alt="Profile picture">
                        <button class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-sm border border-gray-200">
                            <i class="fas fa-camera text-gray-600"></i>
                        </button>
                    </div>
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">John Doe</h2>
                    <p class="text-gray-500">System Administrator</p>
                </div>

                <!-- Profile Details -->
                <div class="md:w-2/3 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="John Doe">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="john.doe@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="tel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="+1 234 567 8900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Department</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="IT Department">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Position</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="System Administrator">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Digital Signature</label>
                                <div class="mt-1">
                                    <button type="button" onclick="toggleSignatureModal()" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700">
                                        <i class="fas fa-signature mr-2"></i>
                                        Upload Signature
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Signature Modal -->
    <div id="signatureModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Upload Digital Signature</h3>
                    <button onclick="toggleSignatureModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                        </div>
                    </div>
            <div class="p-6">
                <div class="mb-4 p-4 bg-blue-50 rounded-md">
                    <p class="text-sm text-blue-800">
                        <i class="fas fa-info-circle mr-2"></i>
                        Please ensure your signature is on a white background for better quality and clarity.
                    </p>
                </div>
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload Signature</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-blue-700 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="toggleSignatureModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700">
                            Save Signature
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function toggleNotifications() {
            const panel = document.getElementById('notificationsPanel');
            panel.classList.toggle('hidden');
        }

        function toggleSignatureModal() {
            const modal = document.getElementById('signatureModal');
            modal.classList.toggle('hidden');
        }

        function toggleUserMenu() {
            const userMenu = document.getElementById('userMenu');
            userMenu.classList.toggle('hidden');
        }


    </script>
</body>
</html>

@endsection
