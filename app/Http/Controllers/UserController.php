<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::latest()->paginate(10);

        // Return the view with the users data
        return view('user.list', compact('users'));
    }
    public function create()
    {
        // Fetch all roles from the database
        $roles = Role::all();

        // Return the view with the roles data
        return view('user.create', compact('roles'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);
        // Hash the password
        $request['password'] = Hash::make($request['password']);
        // Create a new user
        User::create($request->all());

        // Redirect back to the users list with a success message
        return redirect()->route('users')->with('success', 'User created successfully.');
    }
    public function edit(User $user)
    {   
        $roles = Role::all();
        // Return the view with the user data
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        // Update the user data
        $user->update($request->all());

        // Redirect back to the users list with a success message
        return redirect()->route('users')->with('success', 'User updated successfully.');
    }

    public function delete(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect back to the users list with a success message
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }

}
