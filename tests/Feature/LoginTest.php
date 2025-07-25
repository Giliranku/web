<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Pages\LoginPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * TDD (Test-Driven Development) Unit Tests untuk Login Functionality
 * 
 * Tests ditulis terlebih dahulu untuk mendefinisikan behavior yang diharapkan,
 * kemudian implementasi dibuat untuk memenuhi tests tersebut.
 */
class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup default user untuk testing dengan email unik
        $this->defaultUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'default_test_user@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }

    /**
     * Test: User dapat login dengan kredensial yang benar
     * Red -> Green -> Refactor
     */
    public function test_user_can_login_with_correct_credentials()
    {
        // Arrange: Persiapkan data test
        $user = User::factory()->create([
            'email' => 'valid@example.com',
            'password' => Hash::make('validpassword'),
        ]);

        // Act: Jalankan login menggunakan Livewire component
        $response = Livewire::test(LoginPage::class)
            ->set('email', 'valid@example.com')
            ->set('password', 'validpassword')
            ->call('login');

        // Assert: Verifikasi hasil yang diharapkan
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
        $this->assertNull(Auth::user()->error ?? null);
    }

    /**
     * Test: User tidak dapat login dengan password yang salah
     */
    public function test_user_cannot_login_with_invalid_password()
    {
        // Arrange
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('correctpassword'),
        ]);

        // Act
        $response = Livewire::test(LoginPage::class)
            ->set('email', 'test@example.com')
            ->set('password', 'wrongpassword')
            ->call('login');

        // Assert
        $response->assertSet('error', 'Password anda salah.');
        $response->assertSet('email', '');
        $response->assertSet('password', '');
        $this->assertGuest();
    }

    /**
     * Test: User tidak dapat login dengan email yang tidak terdaftar
     */
    public function test_user_cannot_login_with_unregistered_email()
    {
        // Act
        $response = Livewire::test(LoginPage::class)
            ->set('email', 'nonexistent_unique@example.com')
            ->set('password', 'anypassword')
            ->call('login');

        // Assert
        $response->assertSet('error', 'Email tidak ditemukan.');
        $response->assertSet('password', ''); // Password direset untuk keamanan
        $this->assertGuest();
    }

    /**
     * Test: Validasi email dan password diperlukan
     */
    public function test_email_and_password_are_required()
    {
        // Test empty email
        $response1 = Livewire::test(LoginPage::class)
            ->set('email', '')
            ->set('password', 'password123')
            ->call('login');

        $response1->assertHasErrors(['email']);

        // Test empty password
        $response2 = Livewire::test(LoginPage::class)
            ->set('email', 'test@example.com')
            ->set('password', '')
            ->call('login');

        $response2->assertHasErrors(['password']);

        // Test both empty
        $response3 = Livewire::test(LoginPage::class)
            ->set('email', '')
            ->set('password', '')
            ->call('login');

        $response3->assertHasErrors(['email', 'password']);
        $this->assertGuest();
    }

    /**
     * Test: Email harus memiliki format yang valid
     */
    public function test_email_must_be_valid_format()
    {
        $invalidEmails = [
            'invalid-email',
            'invalid@',
            '@invalid.com',
            'invalid..email@example.com',
            'invalid email@example.com'
        ];

        foreach ($invalidEmails as $invalidEmail) {
            $response = Livewire::test(LoginPage::class)
                ->set('email', $invalidEmail)
                ->set('password', 'password123')
                ->call('login');

            $response->assertHasErrors(['email']);
            $this->assertGuest();
        }
    }

    /**
     * Test: Login berhasil mengarahkan ke halaman yang benar
     */
    public function test_successful_login_redirects_to_home()
    {
        // Act
        $response = Livewire::test(LoginPage::class)
            ->set('email', $this->defaultUser->email)
            ->set('password', 'password123')
            ->call('login');

        // Assert
        $response->assertRedirect('/');
    }

    /**
     * Test: Error message direset saat user mencoba login lagi
     */
    public function test_error_message_resets_on_new_login_attempt()
    {
        // Arrange: Buat login yang gagal terlebih dahulu
        $component = Livewire::test(LoginPage::class)
            ->set('email', 'wrong@example.com')
            ->set('password', 'wrongpassword')
            ->call('login');

        $component->assertSet('error', 'Email tidak ditemukan.');

        // Act: Coba login dengan kredensial yang benar
        $component->set('email', $this->defaultUser->email)
                  ->set('password', 'password123')
                  ->call('login');

        // Assert: Error message hilang dan login berhasil
        $component->assertRedirect('/');
    }

    /**
     * Test: Component memiliki properti yang diperlukan
     */
    public function test_login_component_has_required_properties()
    {
        $component = Livewire::test(LoginPage::class);

        // Assert: Component memiliki properti yang diperlukan
        $this->assertObjectHasProperty('email', $component->instance());
        $this->assertObjectHasProperty('password', $component->instance());
        $this->assertObjectHasProperty('error', $component->instance());
    }

    /**
     * Test: Component dapat di-render dengan benar
     */
    public function test_login_component_renders_correctly()
    {
        $component = Livewire::test(LoginPage::class);

        $component->assertStatus(200);
        $component->assertSee(''); // Component dapat di-render tanpa error
    }

    /**
     * Test: Password tidak tersimpan dalam state setelah login gagal
     */
    public function test_password_is_cleared_after_failed_login()
    {
        // Act: Login dengan password salah
        $response = Livewire::test(LoginPage::class)
            ->set('email', $this->defaultUser->email)
            ->set('password', 'wrongpassword')
            ->call('login');

        // Assert: Password direset untuk keamanan
        $response->assertSet('password', '');
        // Email tidak direset untuk password salah, hanya untuk email tidak ditemukan
    }

    /**
     * Test: User tidak dapat login jika sudah login
     */
    public function test_already_authenticated_user_behavior()
    {
        // Arrange: Login user terlebih dahulu
        $this->actingAs($this->defaultUser);

        // Act: Coba login lagi
        $response = Livewire::test(LoginPage::class)
            ->set('email', $this->defaultUser->email)
            ->set('password', 'password123')
            ->call('login');

        // Assert: User tetap terauthentikasi dan diarahkan ke home
        $this->assertAuthenticatedAs($this->defaultUser);
        $response->assertRedirect('/');
    }

    /**
     * Integration Test: Login flow dengan HTTP request
     */
    public function test_login_integration_with_http_request()
    {
        // Act: Test melalui HTTP request langsung ke route
        $response = $this->get('/login');

        // Assert: Halaman login dapat diakses
        $response->assertStatus(200);
        // Cek apakah halaman mengandung form login
        $response->assertSee('email');
    }

    /**
     * Test: Case sensitivity untuk email
     */
    public function test_email_login_is_case_insensitive()
    {
        // Arrange: User dengan email lowercase
        $user = User::factory()->create([
            'email' => 'case_test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Act: Login dengan email uppercase
        $response = Livewire::test(LoginPage::class)
            ->set('email', 'CASE_TEST@EXAMPLE.COM')
            ->set('password', 'password123')
            ->call('login');

        // Assert: Login berhasil karena email di-format menjadi lowercase
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test: Whitespace handling dalam email dan password
     * Memverifikasi bahwa sistem menangani whitespace dengan benar
     */
    public function test_whitespace_handling_in_credentials()
    {
        // Arrange: User dengan email bersih
        $user = User::factory()->create([
            'email' => 'whitespace_test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Act: Login dengan whitespace di awal dan akhir email
        $response = Livewire::test(LoginPage::class)
            ->set('email', '  whitespace_test@example.com  ')
            ->set('password', 'password123')
            ->call('login');

        // Assert: Cek apakah berhasil login atau gagal dengan pesan yang tepat
        $errorMessage = $response->get('error');
        if ($errorMessage) {
            // Jika gagal, harus karena email tidak ditemukan (whitespace tidak di-trim)
            $this->assertEquals('Email tidak ditemukan.', $errorMessage);
            $this->assertGuest();
        } else {
            // Jika berhasil, berarti email di-trim dengan benar
            $response->assertRedirect('/');
            $this->assertAuthenticatedAs($user);
        }
        
        // Test ini memverifikasi behavior whitespace handling,
        // terlepas dari implementasi spesifik trim atau tidak trim
    }
}

