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

// function handleUserTypeChange() {
//   const userType = document.getElementById('userType').value;
//   console.log(userType); // Debugging
//   const SecurityInfo = document.getElementById('SecurityInfo');
//   const FMInfo = document.getElementById('FMInfo');
//   const DHIInfo = document.getElementById('DHIInfo');
//   const additionalInfo = document.getElementById('additionalInfo');

//   // Reset semua form tambahan
//   SecurityInfo.classList.add('hidden');
//   FMInfo.classList.add('hidden');
//   DHIInfo.classList.add('hidden');

//   // Periksa tipe user dan tampilkan input relevan
//   if (userType === 'Security') {
//     console.log('Security selected');
//     additionalInfo.classList.remove('hidden');
//     SecurityInfo.classList.remove('hidden');
//   } else if (userType === 'FM') {
//     console.log('FM selected');
//     additionalInfo.classList.remove('hidden');
//     FMInfo.classList.remove('hidden');
//   } else if (userType === 'DHI') {
//     console.log('DHI selected');
//     additionalInfo.classList.remove('hidden');
//     DHIInfo.classList.remove('hidden');
//   } else {
//     additionalInfo.classList.add('hidden');
//   }
// }
</script>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm p-6">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Register User</h1>
    <form action="{{ route('regisuser.store') }}" id="registerForm" class="space-y-6" method="POST">
      @csrf
      <!-- Tipe User -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe User</label>
        <select
          id="userType"
          name="userType"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
          required
          onchange="handleUserTypeChange()"
        >
          <option value="">Select User Type</option>
          <option value="Security">Security</option>
          <option value="FM">Facility Handler (FM)</option>
          <option value="DHI">DHI</option>
        </select>
      </div>

      <!-- Informasi Dasar -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Full name</label>
          <input
            type="text"
            name="name"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            required
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
          <input
            type="email"
            name="email"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            required
          />
        </div>
      </div>

      <!-- Password -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
          <input
            type="password"
            name="password"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            required
            minlength="8"
          />
          <p class="mt-1 text-sm text-gray-500">Minimum 8 characters</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
          <input
            type="password"
            name="password_confirmation"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            required
          />
        </div>
      </div>

      <!-- Informasi Tambahan (Dinamis) -->
      <div id="additionalInfo" class="hidden">
        <div id="SecurityInfo" class="hidden space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan</label>
            <input
              type="text"
              name="item1"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
            <input
              type="text"
              name="item2"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
        </div>

        <div id="FMInfo" class="hidden space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor ID FM</label>
            <input
              type="text"
              name="item3"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Area Bertugas</label>
            <input
              type="text"
              name="item4"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
        </div>

        <div id="DHIInfo" class="hidden space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor ID DHI</label>
            <input
              type="text"
              name="item5"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
            <select
              name="item6"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            >
              <option value="">Pilih Departemen</option>
              <option value="it">IT</option>
              <option value="hr">HR</option>
              <option value="finance">Finance</option>
              <option value="operations">Operations</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Tombol Submit -->
      <div class="flex justify-end gap-3">
        <a
          href="{{route('dhi-dashboard')}}"
          class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50"
        >
          Back
        </a>
        <button
          type="submit"
          class="px-4 py-2 bg-primary text-white rounded-md text-sm hover:bg-blue-700"
        >
          Create Data
        </button>
      </div>
    </form>
  </div>
</main>
@endsection
