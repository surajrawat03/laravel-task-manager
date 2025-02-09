<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $defaultId = Role::where('name', 'employee')->first()->id;
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->roleId ? $request->roleId : $defaultId,
                'status' => $request->status ? $request->status : config('constant.projects.userStatus.active'),
            ]);

           event(new Registered($user));
           Auth::login($user);
            $roleName = $user->role->name;

            switch ($roleName) {
                case 'admin':
                    return redirect()->route('admin-dashboard');
                case 'manager':
                    return redirect()->route('manager-dashboard');
                default:
                    return redirect()->route('employee-dashboard'); // Fallback to employee dashboard
            }
        } catch (\Exception $e) {
            // Return an error response to the user
            return back()->withErrors(['error' => 'An error occurred while registering the user. Please try again.']);
        }
    }
}
