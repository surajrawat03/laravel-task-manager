<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.showUser');
    }

    public function showUserTable(Request $request)
    {
        $query = User::query();

        foreach ($request->all() as $key => $value) {
            switch ($key) {
                case 'userEmail':
                    $query->where('email', 'like', '%' . $value . '%');
                    break;
                case 'userRole':
                    $query->whereHas('roles', function($q) use ($value) {
                        $q->where('role_user.role_id', $value);  // Filter by roleId
                    });
                    break;
                case 'userStatus':
                    $query->where('status', 'like', '%' . $value . '%');
                    break;
            }
        }

        $users = $query->with('role')->get();
        return view('admin.showUserTable', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.editUser', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.editUser', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore($id)],
            'status' => ['required', 'string'],
            'role_id' => ['required', 'integer'],
        ]);

        // Find the user by ID or fail with a 404 error
        $user = User::findOrFail($id);

        // Update the user with validated data
        $user->update($validatedData);

        return redirect()->route('admin-show-user')->with([
            'type' => 'success',
            'message' => 'User updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
