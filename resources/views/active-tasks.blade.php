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

      // Function to view task details
      function viewTaskDetails(taskId, data) {
        // Set the modal title
        document.getElementById('modalTitle').textContent = 'Task Details';

        // Set the task data in the table
        document.getElementById('taskTitle').textContent = data.title;
        document.getElementById('taskDescription').textContent = data.description;
        document.getElementById('taskLocation').textContent = data.location;
        document.getElementById('taskDueDate').textContent = data.dueDate;
        document.getElementById('taskPriority').textContent = data.priority;
        document.getElementById('taskStatus').textContent = data.status;
        document.getElementById('taskAssignedTo').textContent = data.assignedTo;
        document.getElementById('taskCreatedDate').textContent = data.createdDate;

        // Show the modal
        document.getElementById('taskDetailsModal').classList.remove('hidden');
      }

      // Function to close the task details modal
      function closeTaskDetailsModal() {
        document.getElementById('taskDetailsModal').classList.add('hidden');
      }

      // Function to filter tasks
      function filterTasks() {
        const statusFilter = document.getElementById('statusFilter').value;
        const priorityFilter = document.getElementById('priorityFilter').value;
        const searchFilter = document.getElementById('searchFilter').value.toLowerCase();

        const tasks = document.querySelectorAll('.task-item');

        tasks.forEach(task => {
          const taskStatus = task.querySelector('.task-status').textContent.trim().toLowerCase();
          const taskPriority = task.querySelector('.task-priority').textContent.trim().toLowerCase();
          const taskText = task.textContent.toLowerCase();

          const statusMatch = statusFilter === 'all' || taskStatus === statusFilter;
          const priorityMatch = priorityFilter === 'all' || taskPriority === priorityFilter;
          const searchMatch = searchFilter === '' || taskText.includes(searchFilter);

          if (statusMatch && priorityMatch && searchMatch) {
            task.classList.remove('hidden');
          } else {
            task.classList.add('hidden');
          }
        });
      }

      // Function to sort tasks
      function sortTasks() {
        const sortBy = document.getElementById('sortBy').value;
        const taskList = document.getElementById('taskList');
        const tasks = Array.from(taskList.children);

        tasks.sort((a, b) => {
          if (sortBy === 'dueDate') {
            const dateA = new Date(a.getAttribute('data-due-date'));
            const dateB = new Date(b.getAttribute('data-due-date'));
            return dateA - dateB;
          } else if (sortBy === 'priority') {
            const priorityOrder = { 'high': 0, 'medium': 1, 'low': 2 };
            const priorityA = a.querySelector('.task-priority').textContent.trim().toLowerCase();
            const priorityB = b.querySelector('.task-priority').textContent.trim().toLowerCase();
            return priorityOrder[priorityA] - priorityOrder[priorityB];
          } else if (sortBy === 'status') {
            const statusOrder = { 'pending': 0, 'in progress': 1, 'completed': 2 };
            const statusA = a.querySelector('.task-status').textContent.trim().toLowerCase();
            const statusB = b.querySelector('.task-status').textContent.trim().toLowerCase();
            return statusOrder[statusA] - statusOrder[statusB];
          }
          return 0;
        });

        // Clear and re-append sorted tasks
        taskList.innerHTML = '';
        tasks.forEach(task => taskList.appendChild(task));
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
        const modal = document.getElementById('taskDetailsModal');
        const modalContent = document.getElementById('modalContent');

        if (modalContent && !modalContent.contains(event.target) && !modal.classList.contains('hidden')) {
          modal.classList.add('hidden');
        }
      });

      // Add event listeners for filters and sorting
      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('statusFilter').addEventListener('change', filterTasks);
        document.getElementById('priorityFilter').addEventListener('change', filterTasks);
        document.getElementById('searchFilter').addEventListener('input', filterTasks);
        document.getElementById('sortBy').addEventListener('change', sortTasks);
      });
    </script>
  </head>
  <body class="bg-gray-50">

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Active Tasks</h1>
        <div class="flex space-x-3">
          <a
            href="maintenance.html"
            class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition"
          >
            <i class="fas fa-tools mr-2"></i> Maintenance Tasks
          </a>
          <a
            href="approvals.html"
            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
          >
            <i class="fas fa-check-circle mr-2"></i> Approvals
          </a>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-gray-500 text-sm font-medium">Total Tasks</h3>
          <p class="mt-2 text-3xl font-semibold text-gray-900">12</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-gray-500 text-sm font-medium">Pending</h3>
          <p class="mt-2 text-3xl font-semibold text-yellow-600">5</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-gray-500 text-sm font-medium">In Progress</h3>
          <p class="mt-2 text-3xl font-semibold text-blue-600">4</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-gray-500 text-sm font-medium">Completed</h3>
          <p class="mt-2 text-3xl font-semibold text-green-600">3</p>
        </div>
      </div>

      <!-- Filters and Sorting -->
      <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <div>
            <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="statusFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="all">All Status</option>
              <option value="pending">Pending</option>
              <option value="in progress">In Progress</option>
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
          <div>
            <label for="sortBy" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
            <select id="sortBy" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="dueDate">Due Date</option>
              <option value="priority">Priority</option>
              <option value="status">Status</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Tasks List -->
      <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody id="taskList" class="bg-white divide-y divide-gray-200">
              <!-- Task 1 -->
              <tr id="task-1" class="task-item" data-due-date="2024-04-18T14:00:00">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">Server Room Maintenance</div>
                  <div class="text-sm text-gray-500">Regular maintenance of server equipment</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Server Room</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 2:00 PM</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="task-priority px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">High</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span id="task-status-1" class="task-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Doe</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button onclick="viewTaskDetails(1, {
                    title: 'Server Room Maintenance',
                    description: 'Regular maintenance of server equipment',
                    location: 'Server Room',
                    dueDate: 'Today, 2:00 PM',
                    priority: 'High',
                    status: 'Pending',
                    assignedTo: 'John Doe',
                    createdDate: 'April 15, 2024'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="toggleTaskStatus(1)" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-sync-alt"></i> Update Status
                  </button>
                </td>
              </tr>

              <!-- Task 2 -->
              <tr id="task-2" class="task-item" data-due-date="2024-04-19T10:00:00">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">HVAC System Check</div>
                  <div class="text-sm text-gray-500">Inspection of heating, ventilation, and air conditioning</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Entire Building</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tomorrow, 10:00 AM</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="task-priority px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Medium</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span id="task-status-2" class="task-status px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">In Progress</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jane Smith</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button onclick="viewTaskDetails(2, {
                    title: 'HVAC System Check',
                    description: 'Inspection of heating, ventilation, and air conditioning',
                    location: 'Entire Building',
                    dueDate: 'Tomorrow, 10:00 AM',
                    priority: 'Medium',
                    status: 'In Progress',
                    assignedTo: 'Jane Smith',
                    createdDate: 'April 16, 2024'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="toggleTaskStatus(2)" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-sync-alt"></i> Update Status
                  </button>
                </td>
              </tr>

              <!-- Task 3 -->
              <tr id="task-3" class="task-item" data-due-date="2024-04-20T09:00:00">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">Lighting System Repair</div>
                  <div class="text-sm text-gray-500">Fix flickering lights in the main office area</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Main Office</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">April 20, 2024</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="task-priority px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Low</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span id="task-status-3" class="task-status px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Completed</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Mike Johnson</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button onclick="viewTaskDetails(3, {
                    title: 'Lighting System Repair',
                    description: 'Fix flickering lights in the main office area',
                    location: 'Main Office',
                    dueDate: 'April 20, 2024',
                    priority: 'Low',
                    status: 'Completed',
                    assignedTo: 'Mike Johnson',
                    createdDate: 'April 17, 2024'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="toggleTaskStatus(3)" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-sync-alt"></i> Update Status
                  </button>
                </td>
              </tr>

              <!-- Task 4 -->
              <tr id="task-4" class="task-item" data-due-date="2024-04-25T14:00:00">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">Fire Alarm System Test</div>
                  <div class="text-sm text-gray-500">Monthly testing of fire alarm system</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Entire Building</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">April 25, 2024</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="task-priority px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">High</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span id="task-status-4" class="task-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sarah Williams</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button onclick="viewTaskDetails(4, {
                    title: 'Fire Alarm System Test',
                    description: 'Monthly testing of fire alarm system',
                    location: 'Entire Building',
                    dueDate: 'April 25, 2024',
                    priority: 'High',
                    status: 'Pending',
                    assignedTo: 'Sarah Williams',
                    createdDate: 'April 18, 2024'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="toggleTaskStatus(4)" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-sync-alt"></i> Update Status
                  </button>
                </td>
              </tr>

              <!-- Task 5 -->
              <tr id="task-5" class="task-item" data-due-date="2024-04-22T11:00:00">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">Security Camera Maintenance</div>
                  <div class="text-sm text-gray-500">Check and update security camera system</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Security Room</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">April 22, 2024</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="task-priority px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Medium</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span id="task-status-5" class="task-status px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">In Progress</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">David Brown</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button onclick="viewTaskDetails(5, {
                    title: 'Security Camera Maintenance',
                    description: 'Check and update security camera system',
                    location: 'Security Room',
                    dueDate: 'April 22, 2024',
                    priority: 'Medium',
                    status: 'In Progress',
                    assignedTo: 'David Brown',
                    createdDate: 'April 19, 2024'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="toggleTaskStatus(5)" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-sync-alt"></i> Update Status
                  </button>
                </td>
              </tr>

              <!-- Task 6 -->
              <tr id="task-6" class="task-item" data-due-date="2024-04-23T15:00:00">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">Elevator Maintenance</div>
                  <div class="text-sm text-gray-500">Regular maintenance of elevator systems</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">All Elevators</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">April 23, 2024</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="task-priority px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">High</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span id="task-status-6" class="task-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Emily Davis</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button onclick="viewTaskDetails(6, {
                    title: 'Elevator Maintenance',
                    description: 'Regular maintenance of elevator systems',
                    location: 'All Elevators',
                    dueDate: 'April 23, 2024',
                    priority: 'High',
                    status: 'Pending',
                    assignedTo: 'Emily Davis',
                    createdDate: 'April 20, 2024'
                  })" class="text-primary hover:text-blue-700 mr-3">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="toggleTaskStatus(6)" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-sync-alt"></i> Update Status
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
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
          <p class="text-sm font-medium text-gray-900">Task Status Updated</p>
          <p class="text-sm text-gray-500">HVAC System Check is now in progress</p>
          <p class="text-xs text-gray-400 mt-1">Just now</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">New Task Assigned</p>
          <p class="text-sm text-gray-500">Elevator Maintenance has been assigned to you</p>
          <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Task Completed</p>
          <p class="text-sm text-gray-500">Lighting System Repair has been completed</p>
          <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
        </div>
      </div>
    </div>

    <!-- Task Details Modal -->
    <div id="taskDetailsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div id="modalContent" class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
          <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Task Details</h3>
          <button onclick="closeTaskDetailsModal()" class="text-gray-400 hover:text-gray-500">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Field</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Task Title</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="taskTitle">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Description</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="taskDescription">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Location</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="taskLocation">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Due Date</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="taskDueDate">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Priority</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="taskPriority">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Status</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="taskStatus">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Assigned To</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="taskAssignedTo">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Created Date</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="taskCreatedDate">-</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-6 flex justify-end">
          <button onclick="closeTaskDetailsModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
            Close
          </button>
        </div>
      </div>
    </div>
  </body>
</html>


@endsection
