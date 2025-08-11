Feature: E-commerce Ticketing and Product UI

Scenario: Ticket card displays with correct z-index above date selector
Given date selector and product cards are on the page
When the user opens the date selector
Then the dropdown should appear above the cards without flicker

Scenario: Product card adds item to cart with Livewire
Given a product card is visible
When the user clicks Add to Cart
Then a cartUpdated event should be emitted
And the cart summary should update

Scenario: Date selection persists when navigating with wire:navigate
Given a user has selected a date
When the user navigates to another page via wire:navigate and returns
Then the selected date should remain persisted
