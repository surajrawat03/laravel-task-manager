<x-app-layout>
    <div class="flex p-6 items-center justify-center min-h-screen bg-gray-100">
        <form method="POST" action="{{ route('update-user',  ['id' => $user->id]) }}" class="w-full max-w-lg sm:max-w-xl lg:max-w-3xl bg-white p-6 sm:p-8 rounded-lg shadow-md">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="hidden" name="id" value="{{ $user->id }}" />
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
            </div>

            <!-- Status -->
            <div class="mt-4">
                <x-label for="status" :value="__('Status')" />
                <select name="status" id="status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @foreach (config('constant.projects.userStatus') as $status)
                        <option value="{{$status}}" {{ $user->status == $status ? 'selected' : '' }}>{{$status}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-label for="role" :value="__('Role')" />
                <select name="role_id" id="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role->id == $role->id ? 'selected' : '' }}>
                            {{ \Illuminate\Support\Str::ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-between mt-6 gap-4">
                <x-button>
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>