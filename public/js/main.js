// Navigation and Page Management
class PageManager {
    constructor() {
        this.pages = {
            'index': '/index.html',
            'login': '/login.html',
            'permits': '/permits.html',
            'database': '/database.html',
            'reports': '/reports.html',
            'profile': '/profile.html',
            'new-permit': '/new-permit.html'
        };

        this.currentPage = window.location.pathname.split('/').pop().replace('.html', '') || 'index';
        this.initializeNavigation();
        this.initializeCommonElements();
    }

    initializeNavigation() {
        // Add click handlers for navigation links
        document.querySelectorAll('a[href]').forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                if (href.includes('.html')) {
                    e.preventDefault();
                    this.navigateTo(href.replace('.html', ''));
                }
            });
        });

        // Initialize profile button navigation
        const profileBtn = document.querySelector('button[onclick*="profile"]');
        if (profileBtn) {
            profileBtn.onclick = (e) => {
                e.preventDefault();
                this.navigateTo('profile');
            };
        }
    }

    initializeCommonElements() {
        // Initialize notifications panel
        this.initializeNotifications();

        // Initialize modals
        this.initializeModals();

        // Initialize forms
        this.initializeForms();
    }

    initializeNotifications() {
        const notificationBtn = document.querySelector('.fa-bell').parentElement;
        const notificationsPanel = document.getElementById('notificationsPanel');

        if (notificationBtn && notificationsPanel) {
            notificationBtn.onclick = () => {
                notificationsPanel.classList.toggle('hidden');
            };

            // Close notifications when clicking outside
            document.addEventListener('click', (e) => {
                if (!notificationsPanel.contains(e.target) &&
                    !notificationBtn.contains(e.target)) {
                    notificationsPanel.classList.add('hidden');
                }
            });
        }
    }

    initializeModals() {
        // Database modal
        const databaseModal = document.getElementById('databaseModal');
        if (databaseModal) {
            const addDbBtn = document.querySelector('button[onclick*="toggleDatabaseForm"]');
            if (addDbBtn) {
                addDbBtn.onclick = () => this.toggleModal('databaseModal');
            }
        }

        // Schedule modal
        const scheduleModal = document.getElementById('scheduleModal');
        if (scheduleModal) {
            const addScheduleBtn = document.querySelector('button[onclick*="toggleScheduleForm"]');
            if (addScheduleBtn) {
                addScheduleBtn.onclick = () => this.toggleModal('scheduleModal');
            }
        }
    }

    initializeForms() {
        // Permit form
        const permitForm = document.getElementById('permitForm');
        if (permitForm) {
            permitForm.onsubmit = (e) => {
                e.preventDefault();
                alert('Permit application submitted successfully!');
                this.navigateTo('permits');
            };
        }

        // Add worker functionality for new permit
        const addWorkerBtn = document.querySelector('button[onclick*="addWorker"]');
        if (addWorkerBtn) {
            addWorkerBtn.onclick = this.addWorker;
        }
    }

    toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.toggle('hidden');
        }
    }

    addWorker() {
        const container = document.getElementById('workersContainer');
        if (container) {
            const workerDiv = document.createElement('div');
            workerDiv.className = 'flex items-center space-x-4';
            workerDiv.innerHTML = `
                <input type="text" placeholder="Worker Name" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                <input type="text" placeholder="Worker ID" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                <button type="button" class="text-red-600 hover:text-red-800">
                    <i class="fas fa-trash"></i>
                </button>
            `;

            // Add remove worker functionality
            const removeBtn = workerDiv.querySelector('button');
            removeBtn.onclick = () => workerDiv.remove();

            container.appendChild(workerDiv);
        }
    }

    navigateTo(page) {
        if (this.pages[page]) {
            window.location.href = this.pages[page];
        }
    }
}

// Initialize page manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.pageManager = new PageManager();
});

// Chart initialization for reports and database pages
window.initializeCharts = () => {
    // Reports page charts
    // const permitStatusChart = document.getElementById('permitStatusChart');
    // if (permitStatusChart && window.permitStatusLabels && window.permitStatusData && window.permitStatusColors) {
    //     new Chart(permitStatusChart.getContext('2d'), {
    //         type: 'pie',
    //         data: {
    //             labels: window.permitStatusLabels,
    //             datasets: [{
    //                 data: window.permitStatusData,
    //                 backgroundColor: window.permitStatusColors
    //             }]
    //         },
    //         options: {
    //             responsive: true,
    //             plugins: {
    //                 legend: { position: 'bottom' }
    //             }
    //         }
    //     });
    // }

    // const permitTrendChart = document.getElementById('permitTrendChart');
    // if (permitTrendChart && window.permitTrendLabels && window.permitTrendData) {
    //     new Chart(permitTrendChart.getContext('2d'), {
    //         type: 'line',
    //         data: {
    //             labels: window.permitTrendLabels,
    //             datasets: [{
    //                 label: 'Permit Requests',
    //                 data: window.permitTrendData,
    //                 borderColor: '#2563eb',
    //                 tension: 0.4
    //             }]
    //         },
    //         options: {
    //             responsive: true,
    //             plugins: { legend: { display: false } },
    //             scales: { y: { beginAtZero: true } }
    //         }
    //     });
    // }

    // Database page charts
    const storageChart = document.getElementById('storageChart');
    if (storageChart) {
        new Chart(storageChart.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Used', 'Available'],
                datasets: [{
                    data: [65, 35],
                    backgroundColor: ['#2563eb', '#e5e7eb']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    const healthChart = document.getElementById('healthChart');
    if (healthChart) {
        new Chart(healthChart.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Users DB', 'Permits DB', 'Logs DB'],
                datasets: [{
                    label: 'Response Time (ms)',
                    data: [150, 180, 120],
                    backgroundColor: '#2563eb'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    }
};

// Initialize charts when window loads
window.addEventListener('load', window.initializeCharts);
