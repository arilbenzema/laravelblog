<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;



class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        $roles = Role::all();
        return view('profile.show', compact('user', 'roles'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['string', 'exists:roles,name'],
            'current_password' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // If user wants to change password, verify current password first
        if ($request->filled('current_password') || $request->filled('password')) {
            if (!$request->filled('current_password')) {
                return back()->withErrors(['current_password' => 'Current password is required to change password.']);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            if (!$request->filled('password')) {
                return back()->withErrors(['password' => 'New password is required.']);
            }
        }

        // Update user data
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Add password to update data if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Update user roles using spatie/laravel-permission
        if ($request->has('roles')) {
            // Sync user roles (remove all current roles and set the new ones)
            $user->syncRoles($request->input('roles', []));
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
