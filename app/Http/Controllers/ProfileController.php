<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        return Inertia::render('Admin/Index', [
            'users' => auth()->user()->role !== 'root' ? auth()->user()->organizer->users->load('organizer') : User::all()->load('organizer')
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    /**
     * Display the user's profile form.
     */
    public function edit($id): Response
    {
        return Inertia::render('Admin/Edit', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
            'picture' => 'nullable|image|max:2048'
        ]);

        $user->update([
            ...$request->except(['password', 'confirm_password']),
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        return Redirect::route('profile.index');
    }

    /**
     * Delete the user's account.
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return Redirect::route('profile.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
