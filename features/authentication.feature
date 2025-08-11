Feature: User Authentication and Session Management

Scenario: User logs in with valid credentials
Given a registered user with email "user@example.com" and password "secret123"
When the user submits the login form with valid credentials
Then the user should be redirected to the dashboard
And the user session should be created
And a success message should be displayed

Scenario: User fails to log in with invalid password
Given a registered user with email "user@example.com" and password "secret123"
When the user submits the login form with email "user@example.com" and password "wrongpass"
Then the user should remain on the login page
And an error message should be displayed
And the user session should not be created

Scenario: User logs out successfully
Given an authenticated user is on any protected page
When the user clicks the logout button
Then the user should be redirected to the login page
And the user session should be destroyed

Scenario: User requests password reset
Given a registered user with email "user@example.com"
When the user requests a password reset link
Then a password reset email should be sent to "user@example.com"
And a confirmation message should be displayed

Scenario: User resets password with valid token
Given a valid password reset token exists for "user@example.com"
When the user submits a new password "newSecret123"
Then the password should be updated
And the user should be able to log in with the new password

Scenario: Prevent access to protected routes without login
Given a guest user
When the user tries to access the dashboard
Then the user should be redirected to the login page

Scenario: Remember me keeps user logged in
Given a registered user with email "user@example.com" and password "secret123"
When the user logs in with "Remember me" checked
Then the user should stay logged in across sessions

Scenario: Lock account after multiple failed login attempts
Given a registered user with email "user@example.com"
When the user enters an invalid password 5 times
Then the account should be temporarily locked
And the user should see a lockout message

Scenario: Social login with Google succeeds
Given Google OAuth is configured
When the user signs in with Google and approves access
Then the user should be authenticated
And redirected to the dashboard

Scenario: Social login with Google fails
Given Google OAuth is configured
When the user cancels Google login
Then the user should be redirected to the login page
And an error message should be displayed
