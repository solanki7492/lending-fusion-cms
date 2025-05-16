<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Termsheet;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::latest()->paginate(10);
        if (auth()->user()->role_id === User::ROLE_SALES) {
            return redirect()->route('termsheet');
        }
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

    public function dashboard()
    {
        $auth = auth()->user();

        if ($auth->role_id === User::ROLE_ADMIN) {
            $termsheets = Termsheet::groupBy('user_id')
                ->selectRaw('user_id, COUNT(*) as termsheet_count')
                ->with('user')
                ->paginate(10);
                
            return view('dashboard', compact('termsheets'));
        }

        return redirect()->route('termsheet');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the user data
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $request['password'] = Hash::make($request['password']);
        } else {
            $request->request->remove('password');
        }
        $user->update($request->all());

        // Redirect back to the profile page with a success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

}
