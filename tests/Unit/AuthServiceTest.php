<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * TDD Unit Test untuk AuthService
 * 
 * Ini adalah contoh pure unit test yang menguji business logic
 * tanpa bergantung pada framework atau UI
 */
class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    protected AuthService $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = new AuthService();
    }

    /**
     * Test: AuthService dapat memvalidasi kredensial yang benar
     */
    public function test_can_validate_correct_credentials()
    {
        // Arrange
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Act
        $result = $this->authService->validateCredentials('test@example.com', 'password123');

        // Assert
        $this->assertTrue($result['valid']);
        $this->assertEquals($user->id, $result['user']->id);
        $this->assertNull($result['error']);
    }

    /**
     * Test: AuthService menolak email yang tidak terdaftar
     */
    public function test_rejects_unregistered_email()
    {
        // Act
        $result = $this->authService->validateCredentials('nonexistent@example.com', 'password123');

        // Assert
        $this->assertFalse($result['valid']);
        $this->assertNull($result['user']);
        $this->assertEquals('Email tidak ditemukan.', $result['error']);
    }

    /**
     * Test: AuthService menolak password yang salah
     */
    public function test_rejects_incorrect_password()
    {
        // Arrange
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('correctpassword'),
        ]);

        // Act
        $result = $this->authService->validateCredentials('test@example.com', 'wrongpassword');

        // Assert
        $this->assertFalse($result['valid']);
        $this->assertNull($result['user']);
        $this->assertEquals('Password anda salah.', $result['error']);
    }

    /**
     * Test: AuthService dapat mengformat email
     */
    public function test_can_format_email()
    {
        // Act & Assert
        $this->assertEquals('test@example.com', $this->authService->formatEmail('test@example.com'));
        $this->assertEquals('test@example.com', $this->authService->formatEmail('TEST@EXAMPLE.COM'));
        $this->assertEquals('test@example.com', $this->authService->formatEmail('  test@example.com  '));
    }

    /**
     * Test: AuthService dapat memvalidasi format email
     */
    public function test_can_validate_email_format()
    {
        // Valid emails
        $this->assertTrue($this->authService->isValidEmailFormat('test@example.com'));
        $this->assertTrue($this->authService->isValidEmailFormat('user.name+tag@example.com'));
        $this->assertTrue($this->authService->isValidEmailFormat('user123@subdomain.example.org'));

        // Invalid emails
        $this->assertFalse($this->authService->isValidEmailFormat('invalid-email'));
        $this->assertFalse($this->authService->isValidEmailFormat('invalid@'));
        $this->assertFalse($this->authService->isValidEmailFormat('@invalid.com'));
        $this->assertFalse($this->authService->isValidEmailFormat(''));
    }

    /**
     * Test: AuthService dapat memvalidasi kekuatan password
     */
    public function test_can_validate_password_strength()
    {
        // Strong passwords
        $this->assertTrue($this->authService->isStrongPassword('password123'));
        $this->assertTrue($this->authService->isStrongPassword('MySecurePass1'));
        $this->assertTrue($this->authService->isStrongPassword('complex_password_2023'));

        // Weak passwords
        $this->assertFalse($this->authService->isStrongPassword('123'));
        $this->assertFalse($this->authService->isStrongPassword('abc'));
        $this->assertFalse($this->authService->isStrongPassword(''));
    }

    /**
     * Test: AuthService dapat menghitung attempt login
     */
    public function test_can_track_login_attempts()
    {
        $email = 'test@example.com';

        // Initial state
        $this->assertEquals(0, $this->authService->getLoginAttempts($email));

        // Increment attempts
        $this->authService->incrementLoginAttempts($email);
        $this->assertEquals(1, $this->authService->getLoginAttempts($email));

        $this->authService->incrementLoginAttempts($email);
        $this->assertEquals(2, $this->authService->getLoginAttempts($email));

        // Reset attempts
        $this->authService->resetLoginAttempts($email);
        $this->assertEquals(0, $this->authService->getLoginAttempts($email));
    }

    /**
     * Test: AuthService dapat mengecek apakah akun terkunci
     */
    public function test_can_check_account_lockout()
    {
        $email = 'test@example.com';

        // Account not locked initially
        $this->assertFalse($this->authService->isAccountLocked($email));

        // Lock account after max attempts
        for ($i = 0; $i < 5; $i++) {
            $this->authService->incrementLoginAttempts($email);
        }

        $this->assertTrue($this->authService->isAccountLocked($email));
    }

    /**
     * Test: AuthService mengembalikan waktu unlock yang benar
     */
    public function test_returns_correct_unlock_time()
    {
        $email = 'test@example.com';

        // Lock account
        for ($i = 0; $i < 5; $i++) {
            $this->authService->incrementLoginAttempts($email);
        }

        $unlockTime = $this->authService->getUnlockTime($email);
        $this->assertNotNull($unlockTime);
        $this->assertInstanceOf(\Carbon\Carbon::class, $unlockTime);
        $this->assertTrue($unlockTime->isFuture());
    }

    /**
     * Test: AuthService dapat membuat session data
     */
    public function test_can_create_session_data()
    {
        // Arrange
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Act
        $sessionData = $this->authService->createSessionData($user);

        // Assert
        $this->assertArrayHasKey('user_id', $sessionData);
        $this->assertArrayHasKey('user_name', $sessionData);
        $this->assertArrayHasKey('user_email', $sessionData);
        $this->assertArrayHasKey('login_time', $sessionData);
        
        $this->assertEquals($user->id, $sessionData['user_id']);
        $this->assertEquals('John Doe', $sessionData['user_name']);
        $this->assertEquals('john@example.com', $sessionData['user_email']);
    }

    /**
     * Test: AuthService dapat logout user
     */
    public function test_can_logout_user()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $result = $this->authService->logout();

        // Assert
        $this->assertTrue($result);
        $this->assertGuest();
    }

    /**
     * Test: AuthService menangani exception dengan benar
     */
    public function test_handles_exceptions_gracefully()
    {
        // Test dengan database error (simulasi)
        // Ini akan menguji error handling dalam AuthService
        
        // Act & Assert - seharusnya tidak throw exception
        $result = $this->authService->validateCredentials('', '');
        $this->assertFalse($result['valid']);
        $this->assertNotNull($result['error']);
    }
}
