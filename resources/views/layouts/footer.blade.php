<script>
    // Menampilkan notifikasi menggunakan SweetAlert2 dari session atau errors (sebelumnya ada di PHP)
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

@php
    use App\Models\Histori;

    // Ambil data histori dan urutkan berdasarkan 'created_at' secara descending
    $histori = Histori::orderBy('created_at', 'desc')->get();
@endphp

<script>
    // Menyisipkan data histori yang telah ada di Blade ke dalam JavaScript
    const historiData = @json($histori);

    // Fungsi untuk menghitung waktu yang berlalu
    function timeAgo(date) {
        const diff = new Date() - new Date(date); // Menghitung selisih waktu dalam milidetik

        const minute = 60 * 1000;
        const hour = 60 * minute;
        const day = 24 * hour;
        const month = 30 * day;
        const year = 365 * day;

        if (diff < minute) {
            return `${Math.floor(diff / 1000)} seconds ago`;
        } else if (diff < hour) {
            return `${Math.floor(diff / minute)} minute${Math.floor(diff / minute) > 1 ? 's' : ''} ago`;
        } else if (diff < day) {
            return `${Math.floor(diff / hour)} hour${Math.floor(diff / hour) > 1 ? 's' : ''} ago`;
        } else if (diff < month) {
            return `${Math.floor(diff / day)} day${Math.floor(diff / day) > 1 ? 's' : ''} ago`;
        } else if (diff < year) {
            return `${Math.floor(diff / month)} month${Math.floor(diff / month) > 1 ? 's' : ''} ago`;
        } else {
            return `${Math.floor(diff / year)} year${Math.floor(diff / year) > 1 ? 's' : ''} ago`;
        }
    }

    // Fungsi untuk menampilkan panel notifikasi
    function toggleNotifications() {
        const panel = document.getElementById('notificationsPanel');
        panel.classList.toggle('hidden');
    }

    // Fungsi untuk menampilkan menu pengguna
    function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
    }

    // Mengambil data histori dan menampilkannya di DOM setelah halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const historiContainer = document.getElementById('notificationsPanel').querySelector('.divide-y');
        historiContainer.innerHTML = '';  // Membersihkan data lama

        // Loop melalui data histori dan menambahkannya ke DOM
        historiData.forEach(item => {
            // Menghitung waktu yang berlalu untuk setiap item
            let timeAgoText = timeAgo(item.created_at);

            let itemElement = document.createElement('div');
            itemElement.classList.add('p-4', 'menu-item');

            let iconClass = '';
            let iconColor = '';
             let href = '';
            // Menentukan ikon dan warna berdasarkan tipe histori
            switch(item.type) {
                case 'Vendor':
                    iconClass = 'fas fa-user';
                    iconColor = 'bg-blue-100';
                 href = '/approvals';
                    break;
                case 'Visitor':
                    iconClass = 'fas fa-user';
                    iconColor = 'bg-green-100';
                    href = '/approvals';
                    break;
                case 'Vehicle':
                    iconClass = 'fas fa-car';
                    iconColor = 'bg-purple-100';
                        href = '/vehicle-list';
                    break;
                case 'Employee':
                    iconClass = 'fas fa-users';
                    iconColor = 'bg-yellow-50';
                    href = '/employee-data';
                    break;
                case 'Employee Safety':
                    iconClass = 'fas fa-clipboard-check';
                    iconColor = 'bg-red-50';
                    href = '/employee-safety-list';
                    break;
                case 'Employee Safety Freedoms':
                      iconClass = 'fas fa-clipboard-check';
                    iconColor = 'bg-red-50';
                    href = '/employee-safety-list';
                    break;
                case 'Employee Safety Violations':
                     iconClass = 'fas fa-exclamation-circle';
                    iconColor = 'bg-red-100';
                    href = '/employee-safety-list';
                    break;
                default:
                    iconClass = 'fas fa-exclamation-circle';
                    iconColor = 'bg-red-100';
            }

            itemElement.innerHTML = `
              <a href="${href}">
                <div class="flex items-start space-x-3">
                    <div class="p-2 rounded-full ${iconColor}">
                        <i class="${iconClass} text-${iconColor.split('-')[1]}-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">${item.judul || ''}</p>
                        <p class="text-sm text-gray-500">${item.text || ''}</p>
                        <p class="text-xs text-gray-400 mt-1">${timeAgoText}</p>
                    </div>
                </div></a>
            `;

            historiContainer.appendChild(itemElement);
        });
    });
</script>

<!-- Panel Notifikasi -->
<div id="notificationsPanel" class="hidden fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg border border-gray-200">
    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
        <button onclick="toggleNotifications()" class="text-gray-400 btn-hover">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
        <!-- Data histori akan ditampilkan di sini -->
    </div>
</div>
