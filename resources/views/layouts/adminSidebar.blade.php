<div class="h-full flex flex-col">
    <h3 class="text-center text-lg font-bold py-4 border-b border-gray-700">Admin Panel</h3>
    <nav class="mt-4 flex-grow">
        <a href="{{route('admin-dashboard')}}" class="block py-2.5 px-4 {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Dashboard</a>
        <a href="{{route('admin-show-user')}}" class="block py-2.5 px-4 {{ request()->routeIs('user.*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Users</a>
        <a href="" class="block py-2.5 px-4 {{ request()->routeIs('tasks.*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Tasks</a>
        <div class="block py-2.5 px-4 rounded hover:bg-gray-700 hover:text-white cursor-pointer" 
             onclick="document.getElementById('logOutForm').submit()">
            Logout
        </div>
        <form method="POST" action="{{ route('logout') }}" id="logOutForm" class="hidden">
            @csrf
        </form>
    </nav>
</div>