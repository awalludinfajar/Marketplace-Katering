<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => 'required|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->user_type);

        if ($request->user_type === 'merchant') {
            $request->validate([
                'merchant_name' => 'required|string|max:255',
                'alamat_merchant' => 'required|string',
                'kota_merchant' => 'required|string',
                'telp_merchant' => 'required',
                'description' => 'nullable|string'
            ]);

            $user->merchantProfile()->create([
                'user_id' => $user->id,
                'nama' => $request->merchant_name,
                'alamat' => $request->alamat_merchant,
                'kota' => $request->kota_merchant,
                'no_telpon' => $request->telp_merchant,
                'decription' => $request->description
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
