  <script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            html: "{{ nl2br(session('success')) }}",  // Convert \n to <br>
            confirmButtonText: 'OK'
        });
    @elseif(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: "{{ nl2br(session('error')) }}",  // Convert \n to <br>
            confirmButtonText: 'Try Again'
        });
    @endif

    @if($errors->any())
        let errorMessages = "";
        @foreach($errors->all() as $error)
            errorMessages += "{{ $error }}<br>";  // Use <br> for new lines
        @endforeach
        Swal.fire({
            icon: 'error',
            title: 'Validation Errors',
            html: errorMessages,  // Display with HTML for line breaks
            confirmButtonText: 'Close'
        });
    @endif
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


      // Function to print permit details
      function printPermitDetails() {
        window.print();
      }

      // Function to download permit as PDF
      function downloadPermitPDF() {
        alert('Downloading permit as PDF...');
        // In a real application, this would generate and download a PDF
      }

      // Function to send email notification
      function sendEmailNotification() {
        alert('Sending email notification...');
        // In a real application, this would send an email
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

       document.addEventListener('DOMContentLoaded', function() {
        // In a real application, this would fetch data from a server
        // For this example, we'll use sample data
        const urlParams = new URLSearchParams(window.location.search);
        const permitId = urlParams.get('id') || 'V001';
        const permitType = urlParams.get('type') || 'visitor';


      });
</script>
  <div
      id="notificationsPanel"
      class="hidden fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg border border-gray-200"
    >
      <div class="p-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
        <button onclick="toggleNotifications()" class="text-gray-400 btn-hover">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-red-100">
              <i class="fas fa-exclamation-circle text-red-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Maintenance Alert</p>
              <p class="text-sm text-gray-500">Fire alarm system maintenance due today</p>
              <p class="text-xs text-gray-400 mt-1">5 minutes ago</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-yellow-100">
              <i class="fas fa-user-clock text-yellow-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">New Permit Request</p>
              <p class="text-sm text-gray-500">Visitor permit from John Smith</p>
              <p class="text-xs text-gray-400 mt-1">15 minutes ago</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-green-100">
              <i class="fas fa-check-circle text-green-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Task Completed</p>
              <p class="text-sm text-gray-500">Generator maintenance completed</p>
              <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
            </div>
          </div>
        </div>
        <div class="p-4 menu-item">
          <div class="flex items-start space-x-3">
            <div class="p-2 rounded-full bg-blue-100">
              <i class="fas fa-truck text-blue-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900">Vendor Delivery</p>
              <p class="text-sm text-gray-500">Office supplies delivery scheduled</p>
              <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
            </div>
          </div>
        </div>
      </div>
    </div>
