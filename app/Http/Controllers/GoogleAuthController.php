<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists with this Google ID
            $user = User::where('google_id', $googleUser->id)->first();
            
            if ($user) {
                // User exists, login
                Auth::login($user);
                return redirect()->intended('/userprofile');
            }
            
            // Check if user exists with this email
            $existingUser = User::where('email', $googleUser->email)->first();
            
            if ($existingUser) {
                // Link Google account to existing user
                $updateData = ['google_id' => $googleUser->id];
                
                // Only update avatar if user doesn't have one or if it's still a Google avatar
                if (!$existingUser->avatar || str_contains($existingUser->avatar, 'googleusercontent.com')) {
                    $updateData['avatar'] = $googleUser->avatar;
                }
                
                $existingUser->update($updateData);
                
                Auth::login($existingUser);
                return redirect()->intended('/userprofile');
            }
            
            // Create new user
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'number' => $this->generateUniqueNumber(),
                'email_verified_at' => now(),
            ]);
            
            Auth::login($newUser);
            return redirect()->intended('/userprofile');
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }
    
    private function generateUniqueNumber()
    {
        do {
            $number = '08' . str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (User::where('number', $number)->exists());
        
        return $number;
    }
}
