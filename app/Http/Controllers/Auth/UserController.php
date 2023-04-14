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
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', Rules\Password::defaults()],
        ]);

        User::create([
            'organizer_id' => 2,
            'password' => Hash::make($request->password),
            ...$request->except(['password', 'confirm_password']),
        ]);

        return redirect()->route('profile.index')->with('success', 'Utilisateur creer !');
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
            if ($ticket->used == 1) {
                return back()->with('error', 'Ce tickets a deja ete utiliser !');
            } else {
                $ticket->update(['used' => 1]);
                return back()->with('success', 'Ticket validé avec succes !');
            }
        } else {
            return back()->with('error', 'Tickets invalide !');
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
