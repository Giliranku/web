# Giliranku Theme Park - AI Agent Instructions

## Project Overview
Giliranku is a Laravel-based inclusive theme park management system with real-time queue management, e-commerce ticketing, and multi-role authentication. The system uses **Livewire 3** for reactive frontend components and **MySQL** for development.

## Design System & Color Palette
The project uses a modern, accessible color scheme:
- **Primary (Teal)**: `#4ABDAC` - Main brand color, used for primary actions and navigation
- **Secondary (Orange-Red)**: `#FC4A1A` - Accent color for highlights and call-to-action elements  
- **Warning (Yellow)**: `#F7B733` - Warning states and queue status indicators
- **Light**: `#FFFFFF` - Background and text contrast
- **Dark**: `#000000` - Primary text and dark elements
- **Typography**: 'Inclusive Sans' font family for accessibility and readability

## Architecture

### Core Domain Models
- **Users**: Customers who buy tickets and join queues
- **Staff**: Attraction/restaurant operators who manage queues  
- **Invoices**: Payment records with many-to-many ticket relationships via `invoice_tickets` pivot
- **Tickets**: Universal park entry passes (NOT attraction-specific)
- **UserAttraction/UserRestaurant**: Queue reservation records with `queue_position`, `status` (waiting/called/served/cancelled)

### Critical Business Logic
**Queue System**: Tickets are universal - one ticket grants access to ALL attractions/restaurants. Queue reservations are separate from ticket ownership and don't consume ticket quantities (only park entry does via `used_quantity`).

**Payment Flow**: Cart → Checkout → Invoice creation → Ticket attachment via pivot table → Redirect to invoice page

**Queue States**: `waiting` → `called` (by staff) → `served` (completed) or `cancelled`

## Livewire Component Guidelines

**Always check and make sure the there is only one root element in the Livewire component.**: multiple @push is allowed, but only one root element is allowed in the Livewire component. Often caused by missing closing tags or incorrect nesting of HTML elements.

**Use @push('scripts')** for adding scripts in Livewire components, and ensure they are loaded after the Livewire scripts.

**Use @push('styles')** for adding styles in Livewire components, and ensure they are loaded after the Livewire styles.

**Dark mode compatibility**: Ensure all components and styles are compatible with dark mode. Use CSS variables for colors to easily switch themes. Often caused by hardcoded colors in CSS files or inline styles. Classes like `bg-white`, ``, etc. should be replaced with CSS variables like `var(--bs-body-bg)` and `var(--bs-text-color)`.

**Preferred Javascript Libraries**: Use Alpine.js for interactivity, avoiding jQuery where possible. Use Livewire's built-in methods for DOM manipulation and event handling.

**Use Livewire's built-in methods for DOM manipulation and event handling**: Avoid using jQuery or other libraries for DOM manipulation. Use Livewire's `wire:click`, `wire:model`, and other directives for interactivity.

## Development Patterns

### File Organization
```
app/Livewire/
├── Pages/           # User-facing pages (full-screen layout)
├── Admin/           # Admin components (dashboard-admin layout)  
├── Staff/           # Staff queue management (dashboard-restaurant/attraction layouts)
└── Partial/         # Reusable components (ProductCard, DateSelector)
```

### Route Structure
- `/`: Public user routes (no auth required)
- `/admin/`: Super admin management (tickets, staff, attractions)
- `/staff/{type}/{action}`: Staff queue management by location
- Middleware: `auth` for user routes, session-based for admin/staff

### Livewire Component Patterns
```php
// Event-driven cart updates
#[On('cartUpdated')] 
public function refreshCart() { ... }

// Queue management with staff authorization
public function mount($restaurant = null, $attraction = null) {
    $staffId = session('staff_id');
    $this->location = Restaurant::where('id', $restaurant)
        ->where('staff_id', $staffId)->first();
}

// Queue position recalculation after status changes
private function recalculateQueuePositions() { ... }
```

### Database Conventions
- Use model scopes: `forDate()`, `orderByQueue()`, `waiting()`
- Pivot tables with timestamps: `withPivot('quantity', 'used_quantity')`
- Foreign keys properly constrained in migrations

## Key Commands

### Development
```bash
# Laravel dev server
php artisan serve

# Asset building  
npm run dev          # Development with hot reload
npm run build        # Production build

# Database
php artisan migrate --seed  # Fresh DB with test data
php artisan queue:work       # Process background jobs
```

### Testing
```bash
php artisan test                           # All tests
php artisan test --filter=LoginBehaviorTest  # BDD tests
php artisan test tests/Unit/AuthServiceTest   # TDD unit tests
```

## Testing Architecture
Dual testing approach:
- **BDD**: `LoginBehaviorTest.php` - Given/When/Then user behavior scenarios
- **TDD**: `AuthServiceTest.php` - Unit tests for service layer with Red/Green/Refactor

## Common Gotchas
1. **Queue vs Ticket Logic**: Queue reservations don't consume ticket quantities - they're unlimited reservations against universal tickets
2. **Staff Authorization**: Always verify `session('staff_id')` matches location ownership before queue operations
3. **Livewire Navigation**: Use `wire:navigate` for SPA-like behavior, avoid full page redirects where possible
4. **Database Seeders**: Run in order - User → Staff → Attractions/Restaurants → Tickets → Invoices → Queues

## Integration Points
- **Google OAuth**: Full social login implementation in `GoogleAuthController`
- **Trix Editor**: Rich text editing for news/content with image upload routes
- **Bootstrap 5**: Primary UI framework with custom CSS extensions (Specifically Bootstrap 5.3)
- **Vite**: Asset bundling for SCSS/JS with Laravel plugin

When modifying queue logic, always test with multiple users across different attractions to ensure position calculations remain accurate.


## Livewire Note
- Don't rely on DOMContentLoaded
It's common practice to place JavaScript inside a DOMContentLoaded event listener so that the code you want to run only executes after the page has fully loaded.

When using wire:navigate, DOMContentLoaded is only fired on the first page visit, not subsequent visits.

To run code on every page visit, swap every instance of DOMContentLoaded with livewire:navigated:

document.addEventListener('DOMContentLoaded', () => { 
document.addEventListener('livewire:navigated', () => { 
    // ...
})
Now, any code placed inside this listener will be run on the initial page visit, and also after Livewire has finished navigating to subsequent pages.

Listening to this event is useful for things like initializing third-party libraries.

- Dark Mode Support
[data-bs-theme="dark"] is used to apply dark mode styles in Bootstrap 5.3. Ensure all components and styles are compatible with dark mode by using CSS variables for colors. If the background color is set to white, the text color should be set to a dark color, and vice versa. Avoid hardcoded colors in CSS files or inline styles.

- Its common to use inline CSS styles. For dark mode support you can use 