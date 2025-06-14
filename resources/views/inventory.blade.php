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

      // Function to add new inventory item
      function addNewItem() {
        const modal = document.getElementById('addItemModal');
        modal.classList.remove('hidden');
      }

      // Function to close add item modal
      function closeAddItemModal() {
        const modal = document.getElementById('addItemModal');
        modal.classList.add('hidden');
      }

      // Function to submit new item
      function submitNewItem() {
        const name = document.getElementById('itemName').value;
        const category = document.getElementById('itemCategory').value;
        const quantity = document.getElementById('itemQuantity').value;
        const location = document.getElementById('itemLocation').value;
        const status = document.getElementById('itemStatus').value;

        if (!name || !category || !quantity || !location || !status) {
          alert('Please fill in all fields');
          return;
        }

        // In a real application, this would send data to the server
        // For now, we'll just close the modal
        closeAddItemModal();

        // Reset form
        document.getElementById('itemForm').reset();

        // Show success message
        alert('New inventory item added successfully!');
      }

      // Function to view item details
      function viewItemDetails(itemId, data) {
        // Set the modal title
        document.getElementById('modalTitle').textContent = 'Item Details';

        // Set the item data in the table
        document.getElementById('itemName').textContent = data.name;
        document.getElementById('itemCategory').textContent = data.category;
        document.getElementById('itemQuantity').textContent = data.quantity;
        document.getElementById('itemLocation').textContent = data.location;
        document.getElementById('itemStatus').textContent = data.status;
        document.getElementById('itemLastUpdated').textContent = data.lastUpdated;

        // Show the modal
        document.getElementById('itemDetailsModal').classList.remove('hidden');
      }

      // Function to close the item details modal
      function closeItemDetailsModal() {
        document.getElementById('itemDetailsModal').classList.add('hidden');
      }

      // Function to update item status
      function updateItemStatus(itemId, newStatus) {
        const statusElement = document.getElementById(`item-status-${itemId}`);
        const currentStatus = statusElement.textContent.trim();

        if (currentStatus === 'In Stock') {
          statusElement.textContent = 'Low Stock';
          statusElement.classList.remove('bg-green-100', 'text-green-800');
          statusElement.classList.add('bg-yellow-100', 'text-yellow-800');
        } else if (currentStatus === 'Low Stock') {
          statusElement.textContent = 'Out of Stock';
          statusElement.classList.remove('bg-yellow-100', 'text-yellow-800');
          statusElement.classList.add('bg-red-100', 'text-red-800');
        } else {
          statusElement.textContent = 'In Stock';
          statusElement.classList.remove('bg-red-100', 'text-red-800');
          statusElement.classList.add('bg-green-100', 'text-green-800');
        }
      }

      // Function to filter inventory items
      function filterItems() {
        const categoryFilter = document.getElementById('categoryFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;
        const searchFilter = document.getElementById('searchFilter').value.toLowerCase();

        const items = document.querySelectorAll('.inventory-item');

        items.forEach(item => {
          const itemCategory = item.getAttribute('data-category');
          const itemStatus = item.querySelector('.item-status').textContent.trim().toLowerCase();
          const itemText = item.textContent.toLowerCase();

          const categoryMatch = categoryFilter === 'all' || itemCategory === categoryFilter;
          const statusMatch = statusFilter === 'all' || itemStatus === statusFilter;
          const searchMatch = searchFilter === '' || itemText.includes(searchFilter);

          if (categoryMatch && statusMatch && searchMatch) {
            item.classList.remove('hidden');
          } else {
            item.classList.add('hidden');
          }
        });
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
        const addItemModal = document.getElementById('addItemModal');
        const itemDetailsModal = document.getElementById('itemDetailsModal');
        const addItemContent = document.getElementById('addItemContent');
        const itemDetailsContent = document.getElementById('itemDetailsContent');

        if (addItemContent && !addItemContent.contains(event.target) && !addItemModal.classList.contains('hidden')) {
          addItemModal.classList.add('hidden');
        }

        if (itemDetailsContent && !itemDetailsContent.contains(event.target) && !itemDetailsModal.classList.contains('hidden')) {
          itemDetailsModal.classList.add('hidden');
        }
      });

      // Add event listeners for filters
      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('categoryFilter').addEventListener('change', filterItems);
        document.getElementById('statusFilter').addEventListener('change', filterItems);
        document.getElementById('searchFilter').addEventListener('input', filterItems);
      });
    </script>
  </head>
  <body class="bg-gray-50">


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Inventory Management</h1>
        <button
          onclick="addNewItem()"
          class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition"
        >
          <i class="fas fa-plus mr-2"></i> Add New Item
        </button>
      </div>

      <!-- Filters -->
      <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label for="categoryFilter" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select id="categoryFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="all">All Categories</option>
              <option value="office-supplies">Office Supplies</option>
              <option value="it-equipment">IT Equipment</option>
              <option value="furniture">Furniture</option>
              <option value="maintenance">Maintenance</option>
            </select>
          </div>
          <div>
            <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="statusFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="all">All Status</option>
              <option value="in-stock">In Stock</option>
              <option value="low-stock">Low Stock</option>
              <option value="out-of-stock">Out of Stock</option>
            </select>
          </div>
          <div>
            <label for="searchFilter" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input
              type="text"
              id="searchFilter"
              placeholder="Search inventory..."
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
            >
          </div>
        </div>
      </div>

      <!-- Inventory Table -->
      <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Name</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Item 1 -->
            <tr id="item-1" class="inventory-item" data-category="office-supplies">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Printer Paper (A4)</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Office Supplies</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 reams</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Storage Room A</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span id="item-status-1" class="item-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Low Stock</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="viewItemDetails(1, {
                  name: 'Printer Paper (A4)',
                  category: 'Office Supplies',
                  quantity: '15 reams',
                  location: 'Storage Room A',
                  status: 'Low Stock',
                  lastUpdated: 'April 15, 2024'
                })" class="text-primary hover:text-blue-700 mr-3">
                  <i class="fas fa-eye"></i> View
                </button>
                <button onclick="updateItemStatus(1)" class="text-gray-600 hover:text-gray-800">
                  <i class="fas fa-sync-alt"></i> Update Status
                </button>
              </td>
            </tr>

            <!-- Item 2 -->
            <tr id="item-2" class="inventory-item" data-category="it-equipment">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Network Cables</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">IT Equipment</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">50 pieces</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">IT Storage</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span id="item-status-2" class="item-status px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">In Stock</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="viewItemDetails(2, {
                  name: 'Network Cables',
                  category: 'IT Equipment',
                  quantity: '50 pieces',
                  location: 'IT Storage',
                  status: 'In Stock',
                  lastUpdated: 'April 10, 2024'
                })" class="text-primary hover:text-blue-700 mr-3">
                  <i class="fas fa-eye"></i> View
                </button>
                <button onclick="updateItemStatus(2)" class="text-gray-600 hover:text-gray-800">
                  <i class="fas fa-sync-alt"></i> Update Status
                </button>
              </td>
            </tr>

            <!-- Item 3 -->
            <tr id="item-3" class="inventory-item" data-category="furniture">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Office Chairs</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Furniture</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 units</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Warehouse B</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span id="item-status-3" class="item-status px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Out of Stock</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="viewItemDetails(3, {
                  name: 'Office Chairs',
                  category: 'Furniture',
                  quantity: '5 units',
                  location: 'Warehouse B',
                  status: 'Out of Stock',
                  lastUpdated: 'April 5, 2024'
                })" class="text-primary hover:text-blue-700 mr-3">
                  <i class="fas fa-eye"></i> View
                </button>
                <button onclick="updateItemStatus(3)" class="text-gray-600 hover:text-gray-800">
                  <i class="fas fa-sync-alt"></i> Update Status
                </button>
              </td>
            </tr>

            <!-- Item 4 -->
            <tr id="item-4" class="inventory-item" data-category="maintenance">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Light Bulbs</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Maintenance</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">30 pieces</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Maintenance Room</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span id="item-status-4" class="item-status px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">In Stock</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="viewItemDetails(4, {
                  name: 'Light Bulbs',
                  category: 'Maintenance',
                  quantity: '30 pieces',
                  location: 'Maintenance Room',
                  status: 'In Stock',
                  lastUpdated: 'April 12, 2024'
                })" class="text-primary hover:text-blue-700 mr-3">
                  <i class="fas fa-eye"></i> View
                </button>
                <button onclick="updateItemStatus(4)" class="text-gray-600 hover:text-gray-800">
                  <i class="fas fa-sync-alt"></i> Update Status
                </button>
              </td>
            </tr>

            <!-- Item 5 -->
            <tr id="item-5" class="inventory-item" data-category="it-equipment">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">USB Drives</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">IT Equipment</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 pieces</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">IT Storage</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span id="item-status-5" class="item-status px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Low Stock</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button onclick="viewItemDetails(5, {
                  name: 'USB Drives',
                  category: 'IT Equipment',
                  quantity: '10 pieces',
                  location: 'IT Storage',
                  status: 'Low Stock',
                  lastUpdated: 'April 14, 2024'
                })" class="text-primary hover:text-blue-700 mr-3">
                  <i class="fas fa-eye"></i> View
                </button>
                <button onclick="updateItemStatus(5)" class="text-gray-600 hover:text-gray-800">
                  <i class="fas fa-sync-alt"></i> Update Status
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
          <p class="text-sm font-medium text-gray-900">Low Stock Alert</p>
          <p class="text-sm text-gray-500">Printer Paper (A4) is running low</p>
          <p class="text-xs text-gray-400 mt-1">Just now</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Out of Stock Alert</p>
          <p class="text-sm text-gray-500">Office Chairs are out of stock</p>
          <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Inventory Updated</p>
          <p class="text-sm text-gray-500">New items added to inventory</p>
          <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Maintenance Request</p>
          <p class="text-sm text-gray-500">New maintenance task assigned</p>
          <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
        </div>
      </div>
    </div>

    <!-- Add Item Modal -->
    <div id="addItemModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div id="addItemContent" class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-medium text-gray-900">Add New Inventory Item</h3>
          <button onclick="closeAddItemModal()" class="text-gray-400 hover:text-gray-500">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <form id="itemForm" class="space-y-4">
          <div>
            <label for="itemName" class="block text-sm font-medium text-gray-700">Item Name</label>
            <input type="text" id="itemName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>

          <div>
            <label for="itemCategory" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="itemCategory" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="office-supplies">Office Supplies</option>
              <option value="it-equipment">IT Equipment</option>
              <option value="furniture">Furniture</option>
              <option value="maintenance">Maintenance</option>
            </select>
          </div>

          <div>
            <label for="itemQuantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="text" id="itemQuantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>

          <div>
            <label for="itemLocation" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" id="itemLocation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
          </div>

          <div>
            <label for="itemStatus" class="block text-sm font-medium text-gray-700">Status</label>
            <select id="itemStatus" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
              <option value="in-stock">In Stock</option>
              <option value="low-stock">Low Stock</option>
              <option value="out-of-stock">Out of Stock</option>
            </select>
          </div>
        </form>

        <div class="mt-6 flex justify-end space-x-3">
          <button onclick="closeAddItemModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
            Cancel
          </button>
          <button onclick="submitNewItem()" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700">
            Add Item
          </button>
        </div>
      </div>
    </div>

    <!-- Item Details Modal -->
    <div id="itemDetailsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div id="itemDetailsContent" class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
          <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Item Details</h3>
          <button onclick="closeItemDetailsModal()" class="text-gray-400 hover:text-gray-500">
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
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Item Name</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="itemName">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Category</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="itemCategory">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Quantity</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="itemQuantity">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Location</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="itemLocation">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Status</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="itemStatus">-</td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Last Updated</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="itemLastUpdated">-</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-6 flex justify-end">
          <button onclick="closeItemDetailsModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
            Close
          </button>
        </div>
      </div>
    </div>
  </body>
</html>

@endsection
