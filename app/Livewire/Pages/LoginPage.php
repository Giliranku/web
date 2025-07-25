<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class LoginPage extends Component
{
    public $email;
    public $password;
    public $error;

    protected AuthService $authService;

    public function boot(AuthService $authService)
    {
        $this->authService = $authService;
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
    ];

    public function login()
    {
        $this->validate();

        // Clear previous error
        $this->error = null;

        // Use AuthService for authentication
        $result = $this->authService->attemptLogin($this->email, $this->password);

        if ($result['valid']) {
            // Login successful - redirect to intended page
            return redirect()->intended('/');
        } else {
            // Login failed - show error and reset fields
            $this->error = $result['error'];
            $this->resetLoginFields();
        }
    }

    /**
     * Reset login fields for security
     */
    private function resetLoginFields()
    {
        if ($this->error === 'Email tidak ditemukan.') {
            // For email not found, reset password only (keep email for user convenience)
            $this->reset(['password']);
        } elseif ($this->error === 'Password anda salah.') {
            // For wrong password, reset both email and password for security
            $this->reset(['email', 'password']);
        } else {
            // For other errors, reset password only
            $this->reset(['password']);
        }
    }

    /**
     * Clear error when user starts typing
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
        // Clear error when user starts editing
        if (in_array($propertyName, ['email', 'password'])) {
            $this->error = null;
        }
    }

    public function render()
    {
        return view('livewire.pages.login-page')->layout('components.layouts.full-screen');
    }
}
