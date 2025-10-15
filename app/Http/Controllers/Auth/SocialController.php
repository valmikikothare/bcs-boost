<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle the Facebook callback after authentication
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->registerOrLoginUser($user);
        return redirect()->route('home'); // Redirect to home page after login or registration
    }

    // Redirect the user to the Instagram authentication page
    public function redirectToInstagram()
    {
        return Socialite::driver('instagram')->redirect();
    }

    // Handle the Instagram callback after authentication
    public function handleInstagramCallback()
    {
        $user = Socialite::driver('instagram')->user();
        $this->registerOrLoginUser($user);
        return redirect()->route('home'); // Redirect to home page after login or registration
    }

    // Redirect the user to the Google authentication page
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle the Google callback after authentication
    public function handleGoogleCallback()
    {
      
        $user = Socialite::driver('google')->user();
    
        $this->registerOrLoginUser($user);
        return redirect()->route('home'); // Redirect to home page after login or registration
    }

    // Helper method to handle user registration or login based on social media data
    protected function registerOrLoginUser($user)
    {
        // Check if the user exists based on the email
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // If the user already exists, log in the user
            auth()->login($existingUser, true);
        } else {
            // If the user does not exist, create a new user
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => null, // Since this is a social media login, we don't need a password
            ]);

            auth()->login($newUser, true);
        }
    }
}
