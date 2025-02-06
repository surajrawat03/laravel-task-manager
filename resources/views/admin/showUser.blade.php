

<x-app-layout>
     <!-- Display Success Message -->
    <div id="filter-section" class="p-4 bg-white shadow rounded-lg">
        <form id="filterUser" type="post">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search by Name or Email -->
                <div>
                <label for="search" class="block text-gray-700 font-medium mb-2">Search</label>
                <input 
                    id="search" 
                    type="text" 
                    placeholder="Search by name or email" 
                    name="userEmail"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                </div>
                <!-- Filter by Role -->
                <div>
                <label for="role" class="block text-gray-700 font-medium mb-2">Role</label>
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
                <div>
                <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
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
            </div>
        
            <!-- Apply Filters Button -->
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300" id="applyFilters">Apply Filters</button>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300" id="clearFilters">Clear Filters</button>
            </div>
        </form>
    </div>

    <div class="p-4" id="user-table-wrapper">
        
    </div>
    <x-slot name="script">
        <script>
            document.getElementById('applyFilters').addEventListener('click', function(e) {
                event.preventDefault();
                const formData = new FormData(document.getElementById('filterUser'));
                let data = filterNonEmptyValues(Object.fromEntries(formData));
                getUserTable(data);
            });

            document.getElementById('clearFilters').addEventListener('click', function(e) {
                event.preventDefault();
                clearFilter('filterUser');
            });
            
            function getUserTable (data = {'firstName': 'test'}) {
                axios.post('showUserTable', data).then(response => {
                    document.getElementById('user-table-wrapper').innerHTML = response.data;
                }).catch(error => {
                    console.error('Error:', error);
                    document.getElementById('user-table-wrapper').innerHTML = 'Error fetching data. Check console for details.';
                });
            };
            getUserTable();
        </script>
    </x-slot>
</x-app-layout>