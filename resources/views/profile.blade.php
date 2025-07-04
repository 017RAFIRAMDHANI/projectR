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
                <button onclick="window.location.href='{{route('/')}}'" class="flex items-center text-primary hover:underline text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Dashboard
                </button>
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
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">{{$dataUser->name}}</h2>
                    <p class="text-gray-500">{{$dataUser->role}}</p>
                </div>

                <!-- Profile Details -->
                <div class="md:w-2/3 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>
                    <form class="space-y-6" method="POST" action="{{route('edit_profile',$dataUser->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{$dataUser->name}}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{$dataUser->email}}" readonly>
                            </div>


                            <!-- <div>
                                <label class="block text-sm font-medium text-gray-700">Department</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="IT Department">
                            </div> -->
                            <!-- <div>
                                <label class="block text-sm font-medium text-gray-700">Department</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="IT Department">
                            </div> -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Position</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" readonly value="{{$dataUser->role}}">
                            </div>
                               <div>
                                <label class="block text-sm font-medium text-gray-700">Company</label>
                                <input type="company" name="company" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{$dataUser->company}}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" readonly value="{{$dataUser->role}}">
                            </div>
                            <div>
                              <label class="flex flex-col w-full h-48 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 rounded-lg relative">
    <div class="flex flex-col items-center justify-center h-full">
        <img  id="idCardPreview"
             src="{{ $dataUser->file_card ? asset('storage/'.$dataUser->file_card) : '' }}"
             alt=""
             class="w-full h-full object-contain p-4 {{ $dataUser->file_card ? '' : 'hidden' }}">
    </div>
<span id="fileUploadedIcon" class="absolute top-0 right-0 hidden text-green-500 text-3xl">
    <i class="fas fa-check-circle"></i>
</span>

    <input type="file" name="file_card" id="idCardInput" class="opacity-0" accept=".png,.jpg,.jpeg,.pdf" />
</label>

<p class="mt-2 text-sm text-gray-500">Please upload a clear photo of your ID Card or Passport</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
<script>
const idCardInput = document.getElementById('idCardInput');
const idCardPreview = document.getElementById('idCardPreview');
const fileUploadedIcon = document.getElementById('fileUploadedIcon');

idCardInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                idCardPreview.src = e.target.result;
                idCardPreview.classList.remove('hidden');
                fileUploadedIcon.classList.remove('hidden'); // baru muncul ceklis saat user upload file baru
            }
            reader.readAsDataURL(file);
        } else {
            idCardPreview.classList.add('hidden');
            fileUploadedIcon.classList.add('hidden');
            alert('Please upload an image file (PNG, JPG, or JPEG)');
        }
    }
});

</script>


</body>
</html>

@endsection
