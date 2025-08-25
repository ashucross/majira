<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;

class GoogleController extends Controller
{
    // Redirect user to Google login automatically
    public function redirectToGoogle()
    {
        // return Socialite::driver('google')->redirect();
        $options = [];
        // if (session()->has('google_logged_once')) {
        //     $options['prompt'] = 'none'; // silent login
        // }

        return Socialite::driver('google')
            ->with($options)
            ->redirect();
    }

    public function redirectToGoogleSilent()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'none'])
            ->redirect();
    }

    // Handle callback after Google login
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
             Session::put('google_logged_once', true);
             // Check if user exists
             $user = User::where('email', $googleUser->getEmail())->first();
             
             if ($user) {
                 // Login existing user
                 Auth::login($user);
                 Session::put('user', $user);
            } else {
                // Register new user
                $user = User::create([
                    'name'     => $googleUser->getName(),
                    'email'    => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(16)), // random password
                ]);

                Auth::login($user);
            }

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Google login failed!']);
        }
    }
}
