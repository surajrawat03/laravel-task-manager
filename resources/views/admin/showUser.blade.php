<x-app-layout>
    <!-- Display Success Message -->
    <div id="filter-section" class="p-4 bg-grey shadow rounded-lg">
        <form id="filterUser" type="post">
            <div class="flex flex-wrap items-center gap-4">
                <!-- Search by Name or Email -->
                <div class="flex-grow">
                    <input 
                        id="search" 
                        type="text" 
                        placeholder="Search by name or email" 
                        name="userEmail"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <!-- Filter by Role -->
                <div class="flex-grow">
                    <select 
                        id="role" 
                        name="userRole"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All Roles</option>
                        <option value="1">Admin</option>
                        <option value="2">Manager</option>
                        <option value="3">User</option>
                    </select>
                </div>

                <!-- Filter by Status -->
                <div class="flex-grow">
                    <select 
                        name="userStatus"
                        id="status" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Apply Filters Button -->
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300" 
                    id="applyFilters"
                >
                    Apply Filters
                </button>

                <!-- Clear Filters Button -->
                <button 
                    type="submit" 
                    class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition duration-300" 
                    id="clearFilters"
                >
                    Clear Filters
                </button>

                <!-- Add User Button -->
                <button 
                    id="addUserButton" 
                    class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition duration-300"
                >
                    Add User
                </button>
            </div>
        </form>
    </div>

    <!-- User Table Wrapper -->
    <div class="p-4" id="user-table-wrapper">
        <!-- User table will be dynamically loaded here -->
    </div>

    <!-- Script Section -->
    <x-slot name="script">
        <script>
            // Apply Filters Button Event Listener
            document.getElementById('applyFilters').addEventListener('click', function(e) {
                e.preventDefault();
                const formData = new FormData(document.getElementById('filterUser'));
                let data = filterNonEmptyValues(Object.fromEntries(formData));
                getUserTable(data);
            });

            // Clear Filters Button Event Listener
            document.getElementById('clearFilters').addEventListener('click', function(e) {
                e.preventDefault();
                clearFilter('filterUser');
            });

            // Add User Button Event Listener
            document.getElementById('addUserButton').addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = '/admin/createUser'; // Redirect to the "Add User" page
            });

            // Function to Fetch User Table
            function getUserTable(data = {'firstName': 'test'}) {
                axios.post('showUserTable', data).then(response => {
                    document.getElementById('user-table-wrapper').innerHTML = response.data;
                }).catch(error => {
                    console.error('Error:', error);
                    document.getElementById('user-table-wrapper').innerHTML = 'Error fetching data. Check console for details.';
                });
            }

            // Initial Load of User Table
            getUserTable();

            // Helper Function to Filter Non-Empty Values
            function filterNonEmptyValues(obj) {
                return Object.fromEntries(Object.entries(obj).filter(([_, v]) => v != null && v !== ''));
            }

            // Helper Function to Clear Filters
            function clearFilter(formId) {
                const form = document.getElementById(formId);
                form.reset();
                getUserTable(); // Reload the user table with default filters
            }
        </script>
    </x-slot>
</x-app-layout>