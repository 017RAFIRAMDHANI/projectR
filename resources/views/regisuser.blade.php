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


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Registrasi User Baru</h1>


<form action="{{ route('register') }}" id="registerForm" class="space-y-6" method="POST">
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
              <option value="">Pilih Tipe User</option>

              <option value="Client">Client</option>
              <option value="FM">Facility Handler (FM)</option>
              <option value="DHI">DHI Staff</option>
            </select>
          </div>

          <!-- Informasi Dasar -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
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
              <p class="mt-1 text-sm text-gray-500">Minimal 8 karakter</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
              <input
                type="password"
                name="password_confirmation"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                required
              />
            </div>
          </div>

          <!-- Informasi Tambahan -->
          <div id="additionalInfo" class="hidden">
            <!-- Client Info -->
            <div id="ClientInfo" class="hidden space-y-6">
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

            <!-- FM Info -->
            <div id="FMInfo" class="hidden space-y-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor ID FM</label>
                <input
                  type="text"
                  name="item1"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Area Bertugas</label>
                <input
                  type="text"
                  name="item2"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                />
              </div>
            </div>

            <!-- DHI Info -->
            <div id="DHIInfo" class="hidden space-y-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor ID DHI</label>
                <input
                  type="text"
                  name="item1"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                <select
                  name="item2"
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
              href="login.html"
              class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50"
            >
              Kembali
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

    <script>
      function handleUserTypeChange() {
        const userType = document.getElementById('userType').value;
        const additionalInfo = document.getElementById('additionalInfo');
        const ClientInfo = document.getElementById('ClientInfo');
        const FMInfo = document.getElementById('FMInfo');
        const DHIInfo = document.getElementById('DHIInfo');

        // Reset semua form tambahan
        ClientInfo.classList.add('hidden');
        FMInfo.classList.add('hidden');
        DHIInfo.classList.add('hidden');

        if (userType === 'Client') {
          additionalInfo.classList.remove('hidden');
          ClientInfo.classList.remove('hidden');
        } else if (userType === 'FM') {
          additionalInfo.classList.remove('hidden');
          FMInfo.classList.remove('hidden');
        } else if (userType === 'DHI') {
          additionalInfo.classList.remove('hidden');
          DHIInfo.classList.remove('hidden');
        } else {
          additionalInfo.classList.add('hidden');
        }
      }

      function handleSubmit(event) {
        event.preventDefault();

        const form = event.target;
        const password = form.password.value;
        const confirmPassword = form.confirmPassword.value;

        // Validasi password
        if (password !== confirmPassword) {
          alert('Password dan konfirmasi password tidak cocok!');
          return false;
        }

        // Validasi panjang password
        if (password.length < 8) {
          alert('Password minimal harus 8 karakter!');
          return false;
        }

        // Di sini Anda bisa menambahkan kode untuk mengirim data ke server
        // Contoh:
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        console.log('Data registrasi:', data);
        alert('Registrasi berhasil! Silakan login.');
        window.location.href = 'login.html';

        return false;
      }
    </script>
  </body>
</html>

@endsection
