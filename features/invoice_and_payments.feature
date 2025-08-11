Feature: Invoice Creation and Payments

Scenario: Invoice created after successful checkout
Given a user has completed the checkout with valid details
When the payment is confirmed
Then an invoice record should be created with total amount
And the user should be redirected to the invoice detail page

Scenario: Attach tickets to invoice via pivot
Given an invoice exists
When tickets are purchased in quantities
Then the invoice should have related tickets via invoice_tickets pivot
And each pivot should store quantity and used_quantity fields

Scenario: Payment failure shows error and preserves cart
Given a user attempts payment with an invalid method
When the payment gateway returns an error
Then the cart should remain intact
And an error message should be displayed

Scenario: Viewing invoice list shows latest first
Given a user has multiple invoices
When the user opens the invoices page
Then invoices should be sorted by created_at desc
