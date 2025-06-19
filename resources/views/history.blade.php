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
      .timeline-item {
        position: relative;
        padding-left: 2rem;
        padding-bottom: 2rem;
      }
      .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e5e7eb;
      }
      .timeline-item::after {
        content: '';
        position: absolute;
        left: -4px;
        top: 0;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #2563eb;
      }
      .timeline-item:last-child::before {
        height: 0;
      }
      .bullet-status {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
      }
      .bullet-status.green {
        background-color: #22c55e;
      }
      .bullet-status.yellow {
        background-color: #eab308;
      }
      .bullet-status.red {
        background-color: #ef4444;
      }
    </style>
  </head>
  <body class="bg-gray-50">

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="bg-white rounded-lg shadow-sm p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
          <div>
            <h1 class="text-2xl font-semibold text-gray-900">Employee History</h1>
            <p class="text-sm text-gray-500 mt-1" id="employeeInfo">Loading employee information...</p>
          </div>
          <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900">
            <i class="fas fa-arrow-left mr-2"></i>Back
          </button>
        </div>

        <!-- Timeline -->
        <div class="mt-8" id="historyTimeline">
          <!-- Timeline items will be dynamically added here -->
        </div>
      </div>
    </main>

    <script>
      // Get employee ID from URL
      const urlParams = new URLSearchParams(window.location.search);
      const employeeId = urlParams.get('id');

      // Sample employee data (replace with actual API call)
      const employeeData = {
        nik: 'DHI-2024-001',
        name: 'John Doe',
        company: 'Digital Hyperspace Indonesia',
        position: 'Software Engineer'
      };

      // Sample history data (replace with actual API call)
      const historyData = [
        {
          date: '2024-03-15',
          type: 'Safety Induction',
          status: 'Issued 1',
          description: 'Completed Level 1 Safety Training',
          category: 'Training',
          note: 'Initial safety training completed successfully',
          bulletColor: 'green'
        },
        {
          date: '2024-03-10',
          type: 'Safety Induction',
          status: 'Issued 2',
          description: 'Advanced Safety Training',
          category: 'Training',
          note: 'Advanced safety protocols and procedures training',
          bulletColor: 'yellow'
        },
        {
          date: '2024-03-05',
          type: 'Safety Induction',
          status: 'Issued 3',
          description: 'Specialized Safety Training',
          category: 'Training',
          note: 'Specialized equipment and hazardous materials handling training',
          bulletColor: 'red'
        },
        {
          date: '2024-03-01',
          type: 'Employment',
          status: 'Started',
          description: 'Joined Digital Hyperspace Indonesia',
          category: 'Employment',
          note: 'Initial employment and onboarding process completed',
          bulletColor: 'green'
        }
      ];

      // Update employee info
      document.getElementById('employeeInfo').textContent =
        `${employeeData.name} (${employeeData.nik}) - ${employeeData.position}`;

      // Render timeline
      const timeline = document.getElementById('historyTimeline');
      historyData.forEach(item => {
        const timelineItem = document.createElement('div');
        timelineItem.className = 'timeline-item';
        timelineItem.innerHTML = `
          <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex justify-between items-start">
              <div>
                <div class="flex items-center">
                  <span class="bullet-status ${item.bulletColor}"></span>
                  <h3 class="text-lg font-medium text-gray-900">${item.type}</h3>
                </div>
                <p class="text-sm text-gray-500 mt-1">${item.description}</p>
              </div>
              <span class="px-3 py-1 text-sm rounded-full ${
                item.status === 'Started' ? 'bg-green-100 text-green-800' :
                item.status === 'Issued 1' ? 'bg-blue-100 text-blue-800' :
                item.status === 'Issued 2' ? 'bg-yellow-100 text-yellow-800' :
                'bg-red-100 text-red-800'
              }">${item.status}</span>
            </div>
            <div class="mt-4">
              <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-md">
                ${item.note}
              </p>
            </div>
            <div class="mt-4 flex items-center text-sm text-gray-500">
              <i class="far fa-calendar mr-2"></i>
              ${new Date(item.date).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
              })}
              <span class="mx-2">•</span>
              <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">${item.category}</span>
            </div>
          </div>
        `;
        timeline.appendChild(timelineItem);
      });

      // Toggle functions
      function toggleNotifications() {
        // Implementation for notifications panel
      }

      function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
      }

      function logout() {
        // Implementation for logout
        window.location.href = 'login.html';
      }

      // Close menus when clicking outside
      document.addEventListener('click', function(event) {
        const userMenu = document.getElementById('userMenu');
        if (!event.target.closest('#userMenu') && !event.target.closest('button')) {
          userMenu.classList.add('hidden');
        }
      });
    </script>
  </body>
</html>

@endsection
