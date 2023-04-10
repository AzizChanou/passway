<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'phone' => 'required|string|max:12',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'organizer_name' => 'required|string|max:25',
            'organizer_phone' => 'required|string|max:12',
            'organizer_address' => 'required|string|max:255',
            'organizer_email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('organizers', 'email')->where(function ($query) use ($request) {
                    return $query->where('email', $request->organizer_email);
                }),
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = null;

        DB::transaction(function () use ($request, &$user) {
            $organizer = Organizer::create([
                'name' => $request->organizer_name,
                'phone' => $request->organizer_phone,
                'address' => $request->organizer_address,
                'email' => $request->organizer_email,
            ]);

            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'role' => 'admin',
                'organizer_id' => $organizer->id,
                'password' => Hash::make($request->password),
            ]);
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Compte creer avec succes !');
    }
}
