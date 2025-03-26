<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->organizer->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = new User([
            ...$request->except(['password', 'confirm_password']),
            'organizer_id' => $user_id,
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        return redirect()->route('profile.index')->with('flash.success', 'Utilisateur creer !');
    }

    /**
     * Display the specified resource.
     */
    public function scanIndex()
    {
        return Inertia::render('Admin/ScanQR');
    }

    /**
     * Display the specified resource.
     */
    public function scan(Request $request)
    {
        $ticket = Ticket::where('code', $request->code)->first();

        if ($ticket) {
            if ($ticket->used === 1) {
                return Inertia::render('Admin/ScanQR', [
                    'is_used' => true
                ]);
            } else {
                $ticket->update(['used' => 1]);
                return Inertia::render('Admin/ScanQR', [
                    'is_used' => false
                ]);
            }
        } else {
            return Inertia::render('Admin/ScanQR', [
                'exist' => false
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
