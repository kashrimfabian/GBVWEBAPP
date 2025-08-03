<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return Inertia::render('Users/Index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia::render('Users/Create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'role_id'  => 'required|exists:roles,role_id',
        ]);

        $defaultPassword = 'GBVWEBAPP';

        User::create([
            'name'                 => $validated['name'],
            'email'                => $validated['email'],
            'password'             => Hash::make($defaultPassword),
            'role_id'              => $validated['role_id'],
            'status'               => true, // default active
            'must_change_password' => true, // force change on first login
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function toggleStatus(User $user)
    {
        $user->update([
            'status' => !$user->status
        ]);

        return back()->with('success', 'User status updated successfully.');
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);

        $defaultPassword = 'GBVWEBAPP';

        $user->update([
            'password'             => Hash::make($defaultPassword),
            'must_change_password' => true // force them to change it again
        ]);

        return back()->with('success', 'Password has been reset to the default.');
    }
}
