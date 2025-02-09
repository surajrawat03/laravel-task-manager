<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.showUser');
    }

    /**
     * Display a filtered list of users in a table.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function showUserTable(Request $request)
    {
        $query = User::query();

        foreach ($request->all() as $key => $value) {
            switch ($key) {
                case 'userEmail':
                    $query->where('email', 'like', '%' . $value . '%');
                    break;
                case 'userRole':
                    $query->where('role_id', '=' , $value);
                    break;
                case 'userStatus':
                    $query->where('status', '=', $value );
                    break;
            }
        }

        $users = $query->with('role')->get();
        return view('admin.showUserTable', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.createUser', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        user::create($request->validated());
        return  redirect()->route('admin-show-user')->with(['type' => 'success','message' => 'User created successfully']);
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
     * @return \Illuminate\View\View
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
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        // $validatedData = $request->validate();

        // Find the user by ID or fail with a 404 error
        $user = User::findOrFail($id);

        // Update the user with validated data
        $user->update($request->validated());

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
