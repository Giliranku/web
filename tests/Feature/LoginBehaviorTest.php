<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Pages\LoginPage;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * BDD (Behavior-Driven Development) Test untuk Login Feature
 * 
 * Menggunakan pendekatan Given-When-Then untuk menggambarkan behavior
 * yang diharapkan dari sistem login
 */
class LoginBehaviorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Feature: User Authentication
     * As a visitor
     * I want to login to the system
     * So that I can access protected features
     */

    /** @test */
    public function user_can_successfully_login_with_valid_credentials()
    {
        // Given: Seorang user yang terdaftar di sistem
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('secure-password-123'),
            'name' => 'John Doe'
        ]);

        // When: User mencoba login dengan kredensial yang valid
        $response = Livewire::test(LoginPage::class)
            ->set('email', 'john@example.com')
            ->set('password', 'secure-password-123')
            ->call('login');

        // Then: User berhasil login dan diarahkan ke home page
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_sees_error_message_when_email_not_found()
    {
        // Given: Tidak ada user dengan email tersebut di sistem
        
        // When: User mencoba login dengan email yang tidak terdaftar
        $response = Livewire::test(LoginPage::class)
            ->set('email', 'nonexistent@example.com')
            ->set('password', 'some-password')
            ->call('login');

        // Then: User melihat pesan error "Email tidak ditemukan"
        $response->assertSet('error', 'Email tidak ditemukan.');
        $response->assertSet('password', ''); // Password direset
        $this->assertGuest();
    }

    /** @test */
    public function user_sees_error_message_when_password_is_incorrect()
    {
        // Given: Seorang user yang terdaftar di sistem
        $user = User::factory()->create([
            'email' => 'jane@example.com',
            'password' => bcrypt('correct-password'),
        ]);

        // When: User mencoba login dengan password yang salah
        $response = Livewire::test(LoginPage::class)
            ->set('email', 'jane@example.com')
            ->set('password', 'wrong-password')
            ->call('login');

        // Then: User melihat pesan error "Password anda salah"
        $response->assertSet('error', 'Password anda salah.');
        $response->assertSet('email', ''); // Email dan password direset
        $response->assertSet('password', '');
        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_with_empty_email()
    {
        // Given: User berada di halaman login
        
        // When: User mencoba login tanpa mengisi email
        $response = Livewire::test(LoginPage::class)
            ->set('email', '')
            ->set('password', 'some-password')
            ->call('login');

        // Then: Validasi error muncul untuk email
        $response->assertHasErrors(['email' => 'required']);
        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_with_invalid_email_format()
    {
        // Given: User berada di halaman login
        
        // When: User mencoba login dengan format email yang salah
        $response = Livewire::test(LoginPage::class)
            ->set('email', 'invalid-email-format')
            ->set('password', 'some-password')
            ->call('login');

        // Then: Validasi error muncul untuk format email
        $response->assertHasErrors(['email' => 'email']);
        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_with_empty_password()
    {
        // Given: User berada di halaman login
        
        // When: User mencoba login tanpa mengisi password
        $response = Livewire::test(LoginPage::class)
            ->set('email', 'user@example.com')
            ->set('password', '')
            ->call('login');

        // Then: Validasi error muncul untuk password
        $response->assertHasErrors(['password' => 'required']);
        $this->assertGuest();
    }

    /** @test */
    public function multiple_failed_login_attempts_scenario()
    {
        // Given: Seorang user yang terdaftar di sistem
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('correct-password'),
        ]);

        // When & Then: User melakukan beberapa percobaan login yang gagal
        
        // Percobaan 1: Email salah
        $response1 = Livewire::test(LoginPage::class)
            ->set('email', 'wrong@example.com')
            ->set('password', 'correct-password')
            ->call('login');
        $response1->assertSet('error', 'Email tidak ditemukan.');
        
        // Percobaan 2: Password salah
        $response2 = Livewire::test(LoginPage::class)
            ->set('email', 'test@example.com')
            ->set('password', 'wrong-password')
            ->call('login');
        $response2->assertSet('error', 'Password anda salah.');
        
        // Percobaan 3: Kredensial benar
        $response3 = Livewire::test(LoginPage::class)
            ->set('email', 'test@example.com')
            ->set('password', 'correct-password')
            ->call('login');
        $response3->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function login_form_validation_resets_properly()
    {
        // Given: User berada di halaman login dengan data yang sudah diisi
        $component = Livewire::test(LoginPage::class)
            ->set('email', 'test@example.com')
            ->set('password', 'some-password')
            ->set('error', 'Previous error message');

        // When: User mengisi form dengan data baru dan mengirim
        $component->set('email', 'new@example.com')
                  ->set('password', 'new-password')
                  ->call('login');

        // Then: Error sebelumnya hilang dan validasi baru muncul
        $component->assertSet('error', 'Email tidak ditemukan.');
    }
}
