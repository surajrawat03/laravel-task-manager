<x-app-layout>
    <div class="p-4">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
          <thead class="bg-gray-200">
            <tr>
              <th class="border border-gray-300 px-4 py-2">Name</th>
              <th class="border border-gray-300 px-4 py-2">Email</th>
              <th class="border border-gray-300 px-4 py-2">Role</th>
              <th class="border border-gray-300 px-4 py-2">Status</th>
              <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-100">
              <td class="border border-gray-300 px-4 py-2">John Doe</td>
              <td class="border border-gray-300 px-4 py-2">john@example.com</td>
              <td class="border border-gray-300 px-4 py-2">Admin</td>
              <td class="border border-gray-300 px-4 py-2">Active</td>
              <td class="border border-gray-300 px-4 py-2">
                <button class="px-2 py-1 bg-blue-500 text-white rounded">Edit</button>
                <button class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
</x-app-layout>