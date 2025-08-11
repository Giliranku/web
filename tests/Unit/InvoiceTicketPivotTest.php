<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Invoice;
use App\Models\Ticket;

class InvoiceTicketPivotTest extends TestCase
{
    use RefreshDatabase;

    public function test_attach_tickets_with_quantities_to_invoice()
    {
        $invoice = Invoice::create([
            'user_id' => 1,
            'total_amount' => 250000,
            'status' => 'paid',
        ]);

        $ticketA = Ticket::create([
            'name' => 'Regular',
            'price' => 50000,
            'ticket_type' => 'regular',
            'fast_pass_price_multiplier' => 1,
        ]);

        $ticketB = Ticket::create([
            'name' => 'Fast Pass',
            'price' => 100000,
            'ticket_type' => 'fast_pass',
            'fast_pass_price_multiplier' => 1.5,
        ]);

        $invoice->tickets()->attach($ticketA->id, ['quantity' => 2, 'used_quantity' => 0]);
        $invoice->tickets()->attach($ticketB->id, ['quantity' => 1, 'used_quantity' => 0]);

        $this->assertCount(2, $invoice->tickets);
        $this->assertEquals(2, $invoice->tickets()->where('ticket_id', $ticketA->id)->first()->pivot->quantity);
        $this->assertEquals(1, $invoice->tickets()->where('ticket_id', $ticketB->id)->first()->pivot->quantity);
    }
}
