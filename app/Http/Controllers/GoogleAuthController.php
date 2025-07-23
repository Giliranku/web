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
        try {
            // Clear any existing session data to prevent conflicts
            session()->forget(['_token', 'state']);
            
            return Socialite::driver('google')
                ->with(['prompt' => 'select_account'])
                ->redirect();
        } catch (\Exception $e) {
            \Log::error('Google OAuth Redirect Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Tidak dapat terhubung ke Google. Silakan coba lagi.');
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            // Check for error parameters from Google
            if ($request->has('error')) {
                \Log::warning('Google OAuth Error: ' . $request->get('error'));
                return redirect('/login')->with('error', 'Login dengan Google dibatalkan.');
            }

            // Check for missing code parameter
            if (!$request->has('code')) {
                \Log::warning('Google OAuth: Missing authorization code');
                return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
            }

            // Retrieve user from Google with timeout handling
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            if (!$googleUser || !$googleUser->email) {
                \Log::error('Google OAuth: Failed to retrieve user data or missing email');
                return redirect('/login')->with('error', 'Gagal mendapatkan informasi dari Google. Silakan coba lagi.');
            }
            
            // Check if user already exists with this Google ID
            $user = User::where('google_id', $googleUser->id)->first();
            
            if ($user) {
                // User exists, login
                Auth::login($user, true); // Remember user
                session()->regenerate(); // Regenerate session for security
                
                // Clear any leftover Google OAuth session data
                session()->forget(['state', '_token']);
                
                return redirect()->intended('/');
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
                
                Auth::login($existingUser, true); // Remember user
                session()->regenerate(); // Regenerate session for security
                
                // Clear any leftover Google OAuth session data
                session()->forget(['state', '_token']);
                
                return redirect()->intended('/');
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
            
            Auth::login($newUser, true); // Remember user
            session()->regenerate(); // Regenerate session for security
            
            // Clear any leftover Google OAuth session data
            session()->forget(['state', '_token']);
            
            return redirect()->intended('/');
            
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            \Log::error('Google OAuth Invalid State Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Sesi login telah berakhir. Silakan coba login lagi.');
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            \Log::error('Google OAuth Network Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Koneksi ke Google gagal. Periksa koneksi internet dan coba lagi.');
        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            
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
