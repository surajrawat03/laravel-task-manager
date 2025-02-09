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
        @forelse ($users as $user)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2">{{$user->name}}</td>
                <td class="border border-gray-300 px-4 py-2">{{$user->email}}</td>
                <td class="border border-gray-300 px-4 py-2">{{$user->role->name}}</td>
                <td class="border border-gray-300 px-4 py-2">{{$user->status ?: 'Active'}}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <a class="px-2 py-1 bg-blue-500 text-white rounded" href="{{ route('edit-user', ['id' => $user->id]) }}">Edit</a>
                    <a class="px-2 py-1 bg-red-500 text-white rounded" href="#">Delete</a>
                </td>
            </tr>
        @empty
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2 text-center" colspan="5">No Data Found</td>
            </tr>
        @endforelse
    </tbody>
  </table>