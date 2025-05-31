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
      <div class="p-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
      </div>
      <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">New Visitor Permit Request</p>
          <p class="text-sm text-gray-500">John Smith - Client Meeting</p>
          <p class="text-xs text-gray-400 mt-1">Just now</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">New Vendor Permit Request</p>
          <p class="text-sm text-gray-500">Tech Solutions Inc. - Server Maintenance</p>
          <p class="text-xs text-gray-400 mt-1">30 minutes ago</p>
        </div>
        <div class="p-4 hover:bg-gray-50">
          <p class="text-sm font-medium text-gray-900">Maintenance Request</p>
          <p class="text-sm text-gray-500">Server room requires immediate attention</p>
          <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
        </div>
      </div>
    </div>
