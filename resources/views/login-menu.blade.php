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
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex-1 flex flex-col items-center justify-center py-12">
    <h1 class="text-3xl font-bold mb-4 text-center text-gray-900">Registration Portal</h1>
    <h2 class="text-xl font-semibold mb-8 text-center text-gray-700">Menu Utama</h2>
    <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-8 mb-8">
      <div class="flex flex-col space-y-4">
        <button onclick="window.location.href='visitor-dashboard.html'" class="w-44 h-24 bg-white border-2 border-primary text-primary text-lg font-semibold rounded-lg shadow hover:bg-primary hover:text-white transition">
          Visitor
        </button>
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSdhSPTn3Q1pTkROKJ-o-7rYS2gJfjj7BmNCgQ4yetspjgzb4w/viewform" target="_blank" class="w-44 text-center py-2 bg-primary text-white text-sm font-medium rounded hover:bg-blue-700 transition">
          Visitor Permit Request
        </a>
      </div>

      <div class="flex flex-col space-y-4">
        <button onclick="window.location.href='vendor-dashboard.html'" class="w-44 h-24 bg-white border-2 border-primary text-primary text-lg font-semibold rounded-lg shadow hover:bg-primary hover:text-white transition">
          Vendor
        </button>
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSf7To9MW5C3X1YOYgHa4nQnehBF6kTcRj6GHK9-_VXdJPZ7UQ/viewform" target="_blank" class="w-44 text-center py-2 bg-primary text-white text-sm font-medium rounded hover:bg-blue-700 transition">
          Vendor Permit Request
        </a>
      </div>
    </div>
    <button onclick="window.location.href='login.html'" class="flex items-center text-primary hover:underline mt-2 text-base font-medium">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      kembali
    </button>
  </main>
</body>
</html>


@endsection
