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
    <script>
      // Function to toggle notifications panel
      function toggleNotifications() {
        const panel = document.getElementById('notificationsPanel');
        panel.classList.toggle('hidden');
      }

      // Function to toggle user menu
      function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
      }

      // Function to toggle task status
      function toggleTaskStatus(taskId) {
        const statusElement = document.getElementById(`task-status-${taskId}`);
        const currentStatus = statusElement.textContent.trim();

        if (currentStatus === 'Pending') {
          statusElement.textContent = 'In Progress';
          statusElement.classList.remove('bg-yellow-100', 'text-yellow-800');
          statusElement.classList.add('bg-blue-100', 'text-blue-800');
        } else if (currentStatus === 'In Progress') {
          statusElement.textContent = 'Completed';
          statusElement.classList.remove('bg-blue-100', 'text-blue-800');
          statusElement.classList.add('bg-green-100', 'text-green-800');
        } else {
          statusElement.textContent = 'Pending';
          statusElement.classList.remove('bg-green-100', 'text-green-800');
          statusElement.classList.add('bg-yellow-100', 'text-yellow-800');
        }
      }

      // Function to add new maintenance task
      function addNewTask() {
        const modal = document.getElementById('addTaskModal');
        modal.classList.remove('hidden');
      }

      // Function to close add task modal
      function closeAddTaskModal() {
        const modal = document.getElementById('addTaskModal');
        modal.classList.add('hidden');
      }

      // Function to submit new task
      function submitNewTask() {
        const title = document.getElementById('taskTitle').value;
        const description = document.getElementById('taskDescription').value;
        const location = document.getElementById('taskLocation').value;
        const dueDate = document.getElementById('taskDueDate').value;
        const priority = document.getElementById('taskPriority').value;

        if (!title || !description || !location || !dueDate || !priority) {
          alert('Please fill in all fields');
          return;
        }

        // In a real application, this would send data to the server
        // For now, we'll just close the modal
        closeAddTaskModal();

        // Reset form
        document.getElementById('taskForm').reset();

        // Show success message
        alert('New maintenance task added successfully!');
      }

      // Close notifications panel when clicking outside
      document.addEventListener('click', function(event) {
        const panel = document.getElementById('notificationsPanel');
        const button = document.querySelector('button[onclick="toggleNotifications()"]');

        if (!panel.contains(event.target) && !button.contains(event.target) && !panel.classList.contains('hidden')) {
          panel.classList.add('hidden');
        }
      });

      // Close user menu when clicking outside
      document.addEventListener('click', function(event) {
        const menu = document.getElementById('userMenu');
        const button = document.querySelector('button[onclick="toggleUserMenu()"]');

        if (!menu.contains(event.target) && !button.contains(event.target) && !menu.classList.contains('hidden')) {
          menu.classList.add('hidden');
        }
      });

      // Close modal when clicking outside
      document.addEventListener('click', function(event) {
        const modal = document.getElementById('addTaskModal');
        const modalContent = document.getElementById('modalContent');

        if (modalContent && !modalContent.contains(event.target) && !modal.classList.contains('hidden')) {
          modal.classList.add('hidden');
        }
      });
    </script>
  </head>
  <body class="bg-gray-50">


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Maintenance Tasks</h1>
        <button
          onclick="addNewTask()"
          class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition"
        >
          <i class="fas fa-plus mr-2"></i> Add New Task
        </button>
      </div>

      <!-- Filters -->
      <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="statusFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="all">All Status</option>
              <option value="pending">Pending</option>
              <option value="in-progress">In Progress</option>
              <option value="completed">Completed</option>
            </select>
          </div>
          <div>
            <label for="priorityFilter" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
            <select id="priorityFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="all">All Priorities</option>
              <option value="high">High</option>
              <option value="medium">Medium</option>
              <option value="low">Low</option>
            </select>
          </div>
          <div>
            <label for="searchFilter" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input
              type="text"
              id="searchFilter"
              placeholder="Search tasks..."
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
            >
          </div>
        </div>
      </div>

      <!-- Tasks Table -->
      <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Task 1 -->
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">Server Room Maintenance</div>
                <div class="text-sm text-gray-500">Regular maintenance of server equipment</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Server Room</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 2:00 PM</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">High</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span id="task-status-1" class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="toggleTaskStatus(1)" class="text-primary hover:text-blue-700 mr-3">
                  <i class="fas fa-sync-alt"></i> Update Status
                </button>
                <button class="text-gray-500 hover:text-gray-700">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
              </td>
            </tr>

            <!-- Task 2 -->
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">HVAC System Check</div>
                <div class="text-sm text-gray-500">Inspection of heating, ventilation, and air conditioning</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Entire Building</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tomorrow, 10:00 AM</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Medium</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span id="task-status-2" class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">In Progress</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="toggleTaskStatus(2)" class="text-primary hover:text-blue-700 mr-3">
                  <i class="fas fa-sync-alt"></i> Update Status
                </button>
                <button class="text-gray-500 hover:text-gray-700">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
              </td>
            </tr>

            <!-- Task 3 -->
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">Lighting System Repair</div>
                <div class="text-sm text-gray-500">Fix flickering lights in the main office area</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Main Office</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">April 20, 2024</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Low</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span id="task-status-3" class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Completed</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="toggleTaskStatus(3)" class="text-primary hover:text-blue-700 mr-3">
                  <i class="fas fa-sync-alt"></i> Update Status
                </button>
                <button class="text-gray-500 hover:text-gray-700">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
              </td>
            </tr>

            <!-- Task 4 -->
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">Fire Alarm System Test</div>
                <div class="text-sm text-gray-500">Monthly testing of fire alarm system</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Entire Building</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">April 25, 2024</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">High</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span id="task-status-4" class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="toggleTaskStatus(4)" class="text-primary hover:text-blue-700 mr-3">
                  <i class="fas fa-sync-alt"></i> Update Status
                </button>
                <button class="text-gray-500 hover:text-gray-700">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>

    <!-- Notifications Panel -->
    <div
      id="notificationsPanel"
      class="hidden fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg border border-gray-200"
    >
      <div class="p-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
      </div>
      <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">New Maintenance Request</p>
          <p class="text-sm text-gray-500">Server room requires immediate attention</p>
          <p class="text-xs text-gray-400 mt-1">Just now</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Task Status Updated</p>
          <p class="text-sm text-gray-500">HVAC System Check is now in progress</p>
          <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Task Completed</p>
          <p class="text-sm text-gray-500">Lighting System Repair has been completed</p>
          <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">New Task Assigned</p>
          <p class="text-sm text-gray-500">Fire Alarm System Test has been assigned to you</p>
          <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
        </div>
      </div>
    </div>

    <!-- Add Task Modal -->
    <div id="addTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div id="modalContent" class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-medium text-gray-900">Add New Maintenance Task</h3>
          <button onclick="closeAddTaskModal()" class="text-gray-400 hover:text-gray-500">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <form id="taskForm" class="space-y-4">
          <div>
            <label for="taskTitle" class="block text-sm font-medium text-gray-700">Task Title</label>
            <input type="text" id="taskTitle" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>

          <div>
            <label for="taskDescription" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="taskDescription" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"></textarea>
          </div>

          <div>
            <label for="taskLocation" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" id="taskLocation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="taskDueDate" class="block text-sm font-medium text-gray-700">Due Date</label>
              <input type="datetime-local" id="taskDueDate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
            </div>

            <div>
              <label for="taskPriority" class="block text-sm font-medium text-gray-700">Priority</label>
              <select id="taskPriority" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
              </select>
            </div>
          </div>
        </form>

        <div class="mt-6 flex justify-end space-x-3">
          <button onclick="closeAddTaskModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
            Cancel
          </button>
          <button onclick="submitNewTask()" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700">
            Add Task
          </button>
        </div>
      </div>
    </div>
  </body>
</html>

@endsection
