<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Ticket;

class TicketModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_fast_pass_and_effective_price()
    {
        $regular = Ticket::create([
            'name' => 'Regular',
            'price' => 100000,
            'ticket_type' => 'regular',
            'fast_pass_price_multiplier' => 1.50,
        ]);

        $fast = Ticket::create([
            'name' => 'Fast Pass',
            'price' => 100000,
            'ticket_type' => 'fast_pass',
            'fast_pass_price_multiplier' => 1.50,
        ]);

        $this->assertFalse($regular->isFastPass());
        $this->assertEquals(100000, $regular->effective_price);

        $this->assertTrue($fast->isFastPass());
        $this->assertEquals(150000.0, (float) $fast->effective_price);
    }

    public function test_get_image_url_fallback_when_logo_missing()
    {
        $ticket = Ticket::create([
            'name' => 'No Image',
            'price' => 50000,
            'ticket_type' => 'regular',
            'fast_pass_price_multiplier' => 1.00,
            'logo' => null,
        ]);

        $this->assertStringContainsString('img/default-placeholder.svg', $ticket->image_url);
        $this->assertSame($ticket->getLogoUrl(), $ticket->image_url);
    }
}
