<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * AuthService - Service untuk menangani logic autentikasi
 * 
 * Service ini dibuat berdasarkan TDD approach untuk memisahkan
 * business logic dari controller/component
 */
class AuthService
{
    const MAX_LOGIN_ATTEMPTS = 5;
    const LOCKOUT_DURATION = 15; // minutes

    /**
     * Validate user credentials
     *
     * @param string $email
     * @param string $password
     * @return array
     */
    public function validateCredentials(string $email, string $password): array
    {
        try {
            // Format email
            $email = $this->formatEmail($email);

            // Validate email format
            if (!$this->isValidEmailFormat($email)) {
                return [
                    'valid' => false,
                    'user' => null,
                    'error' => 'Format email tidak valid.'
                ];
            }

            // Check if account is locked
            if ($this->isAccountLocked($email)) {
                $unlockTime = $this->getUnlockTime($email);
                return [
                    'valid' => false,
                    'user' => null,
                    'error' => "Akun terkunci. Coba lagi pada {$unlockTime->format('H:i')}."
                ];
            }

            // Find user by email
            $user = User::where('email', $email)->first();

            if (!$user) {
                $this->incrementLoginAttempts($email);
                return [
                    'valid' => false,
                    'user' => null,
                    'error' => 'Email tidak ditemukan.'
                ];
            }

            // Check password
            if (!Hash::check($password, $user->password)) {
                $this->incrementLoginAttempts($email);
                return [
                    'valid' => false,
                    'user' => null,
                    'error' => 'Password anda salah.'
                ];
            }

            // Reset login attempts on successful login
            $this->resetLoginAttempts($email);

            return [
                'valid' => true,
                'user' => $user,
                'error' => null
            ];

        } catch (\Exception $e) {
            return [
                'valid' => false,
                'user' => null,
                'error' => 'Terjadi kesalahan saat login. Silakan coba lagi.'
            ];
        }
    }

    /**
     * Format email (lowercase and trim)
     *
     * @param string $email
     * @return string
     */
    public function formatEmail(string $email): string
    {
        return strtolower(trim($email));
    }

    /**
     * Validate email format
     *
     * @param string $email
     * @return bool
     */
    public function isValidEmailFormat(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Check if password is strong enough
     *
     * @param string $password
     * @return bool
     */
    public function isStrongPassword(string $password): bool
    {
        // Minimum 6 characters
        return strlen($password) >= 6;
    }

    /**
     * Get login attempts for email
     *
     * @param string $email
     * @return int
     */
    public function getLoginAttempts(string $email): int
    {
        return Cache::get("login_attempts_{$email}", 0);
    }

    /**
     * Increment login attempts
     *
     * @param string $email
     * @return void
     */
    public function incrementLoginAttempts(string $email): void
    {
        $attempts = $this->getLoginAttempts($email) + 1;
        Cache::put("login_attempts_{$email}", $attempts, now()->addMinutes(static::LOCKOUT_DURATION));

        // Set lockout time if max attempts reached
        if ($attempts >= static::MAX_LOGIN_ATTEMPTS) {
            Cache::put("lockout_time_{$email}", now()->addMinutes(static::LOCKOUT_DURATION), now()->addMinutes(static::LOCKOUT_DURATION));
        }
    }

    /**
     * Reset login attempts
     *
     * @param string $email
     * @return void
     */
    public function resetLoginAttempts(string $email): void
    {
        Cache::forget("login_attempts_{$email}");
        Cache::forget("lockout_time_{$email}");
    }

    /**
     * Check if account is locked
     *
     * @param string $email
     * @return bool
     */
    public function isAccountLocked(string $email): bool
    {
        return $this->getLoginAttempts($email) >= static::MAX_LOGIN_ATTEMPTS &&
               Cache::has("lockout_time_{$email}");
    }

    /**
     * Get unlock time
     *
     * @param string $email
     * @return Carbon|null
     */
    public function getUnlockTime(string $email): ?Carbon
    {
        return Cache::get("lockout_time_{$email}");
    }

    /**
     * Create session data for user
     *
     * @param User $user
     * @return array
     */
    public function createSessionData(User $user): array
    {
        return [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'login_time' => now()->toISOString(),
        ];
    }

    /**
     * Logout user
     *
     * @return bool
     */
    public function logout(): bool
    {
        try {
            Auth::logout();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Attempt login with credentials
     *
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return array
     */
    public function attemptLogin(string $email, string $password, bool $remember = false): array
    {
        $validation = $this->validateCredentials($email, $password);

        if (!$validation['valid']) {
            return $validation;
        }

        // Attempt authentication with formatted email
        $credentials = [
            'email' => $this->formatEmail($email),
            'password' => $password
        ];

        if (Auth::attempt($credentials, $remember)) {
            return [
                'valid' => true,
                'user' => Auth::user(),
                'error' => null
            ];
        }

        return [
            'valid' => false,
            'user' => null,
            'error' => 'Gagal melakukan autentikasi.'
        ];
    }

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return Auth::check();
    }

    /**
     * Get current authenticated user
     *
     * @return User|null
     */
    public function getCurrentUser(): ?User
    {
        return Auth::user();
    }
}
