<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- Fonts -->

    <script src="https://cdn.tailwindcss.com"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    {{-- <script src="{{asset('js/main.js')}}" defer></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     {{-- @vite('resources/js/app.js') --}}
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


        {{-- <nav class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <a href="/management-system/index.html" class="flex items-center">
              <img src="/gambar/digital-hyperspace-logo.png" alt="Logo" class="h-8">
            </a>
          </div>
          <div class="flex items-center space-x-4">
            <button
              class="relative p-1 rounded-full text-gray-400 hover:text-gray-500"

            >
              <span
                class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center"
                >3</span
              >
              <i class="fas fa-bell text-xl"></i>
            </button>
            <div class="relative">
              <button
              class="flex items-center space-x-2"
              onclick="toggleUserMenu()"
            >
              <img
                class="h-8 w-8 rounded-full"
                src="https://ui-avatars.com/api/?name=FH&background=2563eb&color=fff"
                alt="Profile"
              />
            </button>
              <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                 @guest
                            @if (Route::has('login'))


                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('login') }}">Login</a>

                            @endif


                            @else

  <a href="{{route('profile', Auth::user()->id )}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="/management-system/settings.html" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <a  class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit(); ">Logout</a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    @endguest
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav> --}}


      <nav class="bg-white shadow-sm sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <a href="/management-system/index.html" class="flex items-center space-x-3">
            <img src="/gambar/digital-hyperspace-logo.png" alt="Logo" class="h-8">
              <span class="text-lg font-semibold text-gray-800">

  @if (Auth::check())
                Dashboard   {{Auth::user()->role ?? ''}}
             </span>
                @endif
                
            </a>
          </div>
          <div class="flex items-center space-x-4">
            <button
              class="relative p-2 rounded-full text-gray-400 btn-hover"
              onclick="toggleNotifications()"
            >
              <span
                class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center"
                >3</span
              >
              <i class="fas fa-bell text-xl"></i>
            </button>
            <div class="relative">
              <button
                class="flex items-center space-x-2 p-2 rounded-full btn-hover"
                onclick="toggleUserMenu()"
              >
                <img
                  class="h-8 w-8 rounded-full ring-2 ring-primary ring-offset-2"
                  src="https://ui-avatars.com/api/?name=FH&background=2563eb&color=fff"
                  alt="Profile"
                />
              </button>
              <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-10 border border-gray-100">
                <div class="px-4 py-2 border-b border-gray-100">

                  <p class="text-sm font-medium text-gray-900">


        @if (Auth::check() && Auth::user()->role == "FM")
            Admin FM
        @elseif(Auth::check() && Auth::user()->role == "Client")
        Client
        @else
        @endif




                </p>
              <p class="text-xs text-gray-500">
    @if(Auth::check())
        {{ Auth::user()->email }}
    @endif
</p>

            </div>
            @guest
                      @if (Route::has('login'))


                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('login') }}">Login</a>

                            @endif


                            @else

                <a href="#" class="block px-4 py-2 text-sm text-gray-700 menu-item">
                  <i class="fas fa-user-circle mr-2"></i>Profile
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 menu-item">
                  <i class="fas fa-cog mr-2"></i>Settings
                </a>
                 <a  class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit(); ">  <i class="fas fa-sign-out-alt mr-2"></i>Logout</a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                @endguest
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
</body>
</html>

<main>
     @yield('content')

</main>


@include('layouts.footer')
