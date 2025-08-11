Feature: Cart and Checkout Flow

Scenario: Add ticket to cart from product listing
Given a guest user is on the tickets page
When the user adds a ticket to the cart
Then the cart icon count should increase
And the cart subtotal should reflect the ticket price

Scenario: Increase quantity in cart
Given a user has a ticket in the cart
When the user increases the quantity to 3
Then the cart should show quantity 3 for the ticket
And the subtotal should be recalculated

Scenario: Remove item from cart
Given a user has items in the cart
When the user removes one item
Then the item should no longer appear in the cart
And the subtotal should be updated

Scenario: Prevent checkout with empty cart
Given an empty cart
When the user clicks the checkout button
Then an error message should be displayed
And the user should remain on the cart page

Scenario: Prefill contact data for authenticated user
Given an authenticated user with profile data
When the user opens the checkout page
Then the name email and phone fields should be prefilled

Scenario: Validate contact information on checkout
Given a user is on the checkout page
When the user submits the form with missing email
Then the system should show a validation error for email

Scenario: Create invoice and attach tickets on payment confirmation
Given a user has valid cart items
When the user completes checkout successfully
Then an invoice should be created
And tickets should be attached to the invoice via pivot
And the user should be redirected to the invoice page

Scenario: Clear cart after successful payment
Given a user completes a successful payment
When the payment is confirmed
Then the cart should be emptied
And a success message should be shown

Scenario: Do not consume ticket quantities on queue reservations
Given a user with valid tickets
When the user later joins any attraction queue
Then the ticket quantities should remain unchanged
And only park entry used_quantity is affected on entry
