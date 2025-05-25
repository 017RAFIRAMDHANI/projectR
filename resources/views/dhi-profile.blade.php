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
        // Function to determine user role and load appropriate profile data
        document.addEventListener('DOMContentLoaded', function() {
            // Get user role from localStorage or URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const userRole = urlParams.get('role') || localStorage.getItem('userRole') || 'DHI';

            // Set page title based on role
            document.title = `${userRole} Profile - Digital Hyperspace Indonesia`;

            // Update profile content based on role
            updateProfileContent(userRole);
        });

        function updateProfileContent(role) {
            // Update profile image
            const profileImage = document.getElementById('profileImage');
            profileImage.src = `https://ui-avatars.com/api/?name=${role}&size=128&background=2563eb&color=fff`;
            profileImage.alt = `${role} Profile`;

            // Update profile title
            const profileTitle = document.getElementById('profileTitle');
            profileTitle.textContent = role === 'FH' ? 'Facility Handler' : 'DHI Staff';

            // Update profile ID
            const profileId = document.getElementById('profileId');
            profileId.textContent = `ID: ${role}-2024-001`;

            // Update profile information based on role
            const profileData = getProfileData(role);

            // Update name
            document.getElementById('fullName').textContent = profileData.name;

            // Update email
            document.getElementById('email').textContent = profileData.email;

            // Update phone
            document.getElementById('phone').textContent = profileData.phone;

            // Update department
            document.getElementById('department').textContent = profileData.department;

            // Update position
            document.getElementById('position').textContent = profileData.position;

            // Update join date
            document.getElementById('joinDate').textContent = profileData.joinDate;

            // Update bio
            document.getElementById('bio').textContent = profileData.bio;

            // Update skills
            const skillsContainer = document.getElementById('skillsContainer');
            skillsContainer.innerHTML = '';
            profileData.skills.forEach(skill => {
                const skillElement = document.createElement('span');
                skillElement.className = 'px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs';
                skillElement.textContent = skill;
                skillsContainer.appendChild(skillElement);
            });

            // Update recent activity
            const activityContainer = document.getElementById('activityContainer');
            activityContainer.innerHTML = '';
            profileData.recentActivity.forEach(activity => {
                const activityElement = document.createElement('div');
                activityElement.className = 'flex items-start';

                const iconElement = document.createElement('div');
                iconElement.className = 'flex-shrink-0';

                const iconSpan = document.createElement('span');
                iconSpan.className = `inline-flex items-center justify-center h-8 w-8 rounded-full ${activity.iconBg}`;

                const icon = document.createElement('i');
                icon.className = `${activity.icon} ${activity.iconColor}`;
                iconSpan.appendChild(icon);
                iconElement.appendChild(iconSpan);

                const contentElement = document.createElement('div');
                contentElement.className = 'ml-4';

                const titleElement = document.createElement('p');
                titleElement.className = 'text-sm font-medium text-gray-900';
                titleElement.textContent = activity.title;

                const descriptionElement = document.createElement('p');
                descriptionElement.className = 'text-sm text-gray-500';
                descriptionElement.textContent = activity.description;

                const timeElement = document.createElement('p');
                timeElement.className = 'text-xs text-gray-400';
                timeElement.textContent = activity.time;

                contentElement.appendChild(titleElement);
                contentElement.appendChild(descriptionElement);
                contentElement.appendChild(timeElement);

                activityElement.appendChild(iconElement);
                activityElement.appendChild(contentElement);

                activityContainer.appendChild(activityElement);
            });
        }

        function getProfileData(role) {
            if (role === 'FH') {
                return {
                    name: 'John Doe',
                    email: 'john.doe@digitalhyperspace.com',
                    phone: '+62 812 3456 7890',
                    department: 'Facility Management',
                    position: 'Senior Facility Handler',
                    joinDate: 'January 15, 2023',
                    bio: 'Experienced facility handler with 5+ years of experience in managing office facilities, maintenance schedules, and ensuring smooth operations of all facility-related activities.',
                    skills: ['Facility Management', 'Maintenance', 'HVAC Systems', 'Security Protocols', 'Emergency Response'],
                    recentActivity: [
                        {
                            title: 'Approved maintenance permit',
                            description: 'Permit #DHI/PERMIT/2024/04/0003',
                            time: 'Today, 10:30 AM',
                            icon: 'fas fa-check',
                            iconBg: 'bg-green-100',
                            iconColor: 'text-green-600'
                        },
                        {
                            title: 'Marked permit as pending',
                            description: 'Permit #DHI/PERMIT/2024/04/0002',
                            time: 'Yesterday, 3:45 PM',
                            icon: 'fas fa-clock',
                            iconBg: 'bg-yellow-100',
                            iconColor: 'text-yellow-600'
                        },
                        {
                            title: 'Rejected installation permit',
                            description: 'Permit #DHI/PERMIT/2024/04/0001',
                            time: 'April 10, 2024, 11:20 AM',
                            icon: 'fas fa-times',
                            iconBg: 'bg-red-100',
                            iconColor: 'text-red-600'
                        }
                    ]
                };
            } else {
                return {
                    name: 'Jane Smith',
                    email: 'jane.smith@digitalhyperspace.com',
                    phone: '+62 812 3456 7891',
                    department: 'Digital Hyperspace Indonesia',
                    position: 'Permit Manager',
                    joinDate: 'March 1, 2022',
                    bio: 'Dedicated permit manager with expertise in overseeing facility access requests, ensuring compliance with security protocols, and managing the approval workflow for various facility-related permits.',
                    skills: ['Permit Management', 'Security Protocols', 'Risk Assessment', 'Compliance', 'Documentation'],
                    recentActivity: [
                        {
                            title: 'Approved urgent permit',
                            description: 'Permit #DHI/PERMIT/2024/04/0005',
                            time: 'Today, 9:15 AM',
                            icon: 'fas fa-check',
                            iconBg: 'bg-green-100',
                            iconColor: 'text-green-600'
                        },
                        {
                            title: 'Marked permit as pending',
                            description: 'Permit #DHI/PERMIT/2024/04/0004',
                            time: 'Yesterday, 4:30 PM',
                            icon: 'fas fa-clock',
                            iconBg: 'bg-yellow-100',
                            iconColor: 'text-yellow-600'
                        },
                        {
                            title: 'Rejected urgent permit',
                            description: 'Permit #DHI/PERMIT/2024/04/0003',
                            time: 'April 12, 2024, 2:45 PM',
                            icon: 'fas fa-times',
                            iconBg: 'bg-red-100',
                            iconColor: 'text-red-600'
                        }
                    ]
                };
            }
        }

        function toggleEditMode() {
            const viewMode = document.getElementById('viewMode');
            const editMode = document.getElementById('editMode');

            if (viewMode.classList.contains('hidden')) {
                // Switch to view mode
                viewMode.classList.remove('hidden');
                editMode.classList.add('hidden');
            } else {
                // Switch to edit mode
                viewMode.classList.add('hidden');
                editMode.classList.remove('hidden');
            }
        }

        function saveProfile() {
            // In a real application, this would save the profile data to a server
            alert('Profile saved successfully!');
            toggleEditMode();
        }
    </script>
</head>
<body class="bg-gray-50">


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex flex-col md:flex-row">
                <!-- Profile Image and Basic Info -->
                <div class="md:w-1/3 flex flex-col items-center p-6 border-b md:border-b-0 md:border-r border-gray-200">
                    <div class="relative">
                        <img id="profileImage" class="h-32 w-32 rounded-full" src="https://ui-avatars.com/api/?name=DHI&size=128&background=2563eb&color=fff" alt="Profile">
                        <button class="absolute bottom-0 right-0 bg-white rounded-full p-1 border border-gray-300 shadow-sm">
                            <i class="fas fa-camera text-gray-500"></i>
                        </button>
                    </div>
                    <h2 id="profileTitle" class="mt-4 text-xl font-semibold text-gray-900">DHI Staff</h2>
                    <p id="profileId" class="text-gray-500">ID: DHI-2024-001</p>
                    <div class="mt-4 flex space-x-2">
                        <button id="editButton" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700" onclick="toggleEditMode()">
                            <i class="fas fa-edit mr-2"></i>Edit Profile
                        </button>
                    </div>
                </div>

                <!-- Profile Details - View Mode -->
                <div id="viewMode" class="md:w-2/3 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Full Name</label>
                            <p id="fullName" class="mt-1 text-sm text-gray-900">Jane Smith</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p id="email" class="mt-1 text-sm text-gray-900">jane.smith@digitalhyperspace.com</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p id="phone" class="mt-1 text-sm text-gray-900">+62 812 3456 7891</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Department</label>
                            <p id="department" class="mt-1 text-sm text-gray-900">Digital Hyperspace Indonesia</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Position</label>
                            <p id="position" class="mt-1 text-sm text-gray-900">Permit Manager</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Join Date</label>
                            <p id="joinDate" class="mt-1 text-sm text-gray-900">March 1, 2022</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500">Bio</label>
                        <p id="bio" class="mt-1 text-sm text-gray-900">
                            Dedicated permit manager with expertise in overseeing facility access requests,
                            ensuring compliance with security protocols, and managing the approval workflow
                            for various facility-related permits.
                        </p>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-sm font-medium text-gray-500">Skills</h4>
                        <div id="skillsContainer" class="mt-2 flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Permit Management</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Security Protocols</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Risk Assessment</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Compliance</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Documentation</span>
                        </div>
                    </div>
                </div>

                <!-- Profile Details - Edit Mode -->
                <div id="editMode" class="md:w-2/3 p-6 hidden">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Profile Information</h3>

                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="editName" class="block text-sm font-medium text-gray-500">Full Name</label>
                                <input type="text" id="editName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" value="Jane Smith">
                            </div>
                            <div>
                                <label for="editEmail" class="block text-sm font-medium text-gray-500">Email</label>
                                <input type="email" id="editEmail" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" value="jane.smith@digitalhyperspace.com">
                            </div>
                            <div>
                                <label for="editPhone" class="block text-sm font-medium text-gray-500">Phone</label>
                                <input type="tel" id="editPhone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" value="+62 812 3456 7891">
                            </div>
                            <div>
                                <label for="editDepartment" class="block text-sm font-medium text-gray-500">Department</label>
                                <input type="text" id="editDepartment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" value="Digital Hyperspace Indonesia">
                            </div>
                            <div>
                                <label for="editPosition" class="block text-sm font-medium text-gray-500">Position</label>
                                <input type="text" id="editPosition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" value="Permit Manager">
                            </div>
                            <div>
                                <label for="editJoinDate" class="block text-sm font-medium text-gray-500">Join Date</label>
                                <input type="text" id="editJoinDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" value="March 1, 2022">
                            </div>
                        </div>

                        <div>
                            <label for="editBio" class="block text-sm font-medium text-gray-500">Bio</label>
                            <textarea id="editBio" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">Dedicated permit manager with expertise in overseeing facility access requests, ensuring compliance with security protocols, and managing the approval workflow for various facility-related permits.</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Skills</label>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <div class="flex items-center">
                                    <input type="checkbox" id="skill1" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded" checked>
                                    <label for="skill1" class="ml-2 text-sm text-gray-700">Permit Management</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="skill2" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded" checked>
                                    <label for="skill2" class="ml-2 text-sm text-gray-700">Security Protocols</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="skill3" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded" checked>
                                    <label for="skill3" class="ml-2 text-sm text-gray-700">Risk Assessment</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="skill4" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded" checked>
                                    <label for="skill4" class="ml-2 text-sm text-gray-700">Compliance</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="skill5" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded" checked>
                                    <label for="skill5" class="ml-2 text-sm text-gray-700">Documentation</label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50" onclick="toggleEditMode()">Cancel</button>
                            <button type="button" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700" onclick="saveProfile()">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Activity Section -->
            <div class="mt-8 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                <div id="activityContainer" class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-green-100">
                                <i class="fas fa-check text-green-600"></i>
                            </span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Approved urgent permit</p>
                            <p class="text-sm text-gray-500">Permit #DHI/PERMIT/2024/04/0005</p>
                            <p class="text-xs text-gray-400">Today, 9:15 AM</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-yellow-100">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Marked permit as pending</p>
                            <p class="text-sm text-gray-500">Permit #DHI/PERMIT/2024/04/0004</p>
                            <p class="text-xs text-gray-400">Yesterday, 4:30 PM</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-red-100">
                                <i class="fas fa-times text-red-600"></i>
                            </span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Rejected urgent permit</p>
                            <p class="text-sm text-gray-500">Permit #DHI/PERMIT/2024/04/0003</p>
                            <p class="text-xs text-gray-400">April 12, 2024, 2:45 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Notifications Panel -->
    <div id="notificationsPanel" class="hidden fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
        </div>
        <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
            <div class="p-4 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-900">New urgent permit request</p>
                <p class="text-sm text-gray-500">Requires immediate attention</p>
                <p class="text-xs text-gray-400 mt-1">Just now</p>
            </div>
            <div class="p-4 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-900">FM approved permit</p>
                <p class="text-sm text-gray-500">Permit #DHI/PERMIT/2024/04/0002</p>
                <p class="text-xs text-gray-400 mt-1">30 minutes ago</p>
            </div>
            <div class="p-4 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-900">System update</p>
                <p class="text-sm text-gray-500">New features added to permit management</p>
                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
            </div>
        </div>
    </div>
</body>
</html>


@endsection
