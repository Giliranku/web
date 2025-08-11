<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Attraction;
use App\Models\UserAttraction;
use App\Models\User;
use Carbon\Carbon;

class AttractionModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_estimated_waiting_time_and_can_queue_elsewhere()
    {
        $attraction = Attraction::factory()->create([
            'players_per_round' => 5,
            'estimated_time_per_round' => 8,
        ]);

        $this->assertEquals(16, $attraction->getEstimatedWaitingTime(10));
        $this->assertTrue($attraction->canUserQueueElsewhere(10)); // ceil(10/5)=2 -> true
        $this->assertFalse($attraction->canUserQueueElsewhere(3));  // ceil(3/5)=1 -> false
    }

    public function test_get_user_queue_position_in_today_queue()
    {
        Carbon::setTestNow(Carbon::create(2025, 1, 15));

        $attraction = Attraction::factory()->create([
            'players_per_round' => 4,
            'estimated_time_per_round' => 6,
        ]);

        $u1 = User::factory()->create();
        $u2 = User::factory()->create();

        UserAttraction::create([
            'user_id' => $u1->id,
            'attraction_id' => $attraction->id,
            'queue_position' => 1,
            'reservation_date' => Carbon::today(),
            'status' => 'waiting',
        ]);

        UserAttraction::create([
            'user_id' => $u2->id,
            'attraction_id' => $attraction->id,
            'queue_position' => 2,
            'reservation_date' => Carbon::today(),
            'status' => 'waiting',
        ]);

        $this->assertEquals(1, $attraction->getUserQueuePosition($u1->id));
        $this->assertEquals(2, $attraction->getUserQueuePosition($u2->id));
    }
}
