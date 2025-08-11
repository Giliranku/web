<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\QueueValidationService;
use App\Models\User;
use App\Models\Attraction;
use App\Models\Restaurant;
use App\Models\UserAttraction;
use App\Models\UserRestaurant;
use Carbon\Carbon;

class QueueValidationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected QueueValidationService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new QueueValidationService();
        Carbon::setTestNow(Carbon::create(2025, 1, 15, 10));
    }

    public function test_can_user_queue_blocks_same_location()
    {
        $user = User::factory()->create();
        $attraction = Attraction::factory()->create([
            'players_per_round' => 10,
            'estimated_time_per_round' => 5,
        ]);

        UserAttraction::create([
            'user_id' => $user->id,
            'attraction_id' => $attraction->id,
            'queue_position' => 5,
            'reservation_date' => Carbon::today(),
            'status' => 'waiting',
        ]);

        $res = $this->service->canUserQueue($user->id, 'attraction', $attraction->id);
        $this->assertFalse($res['can_queue']);
        $this->assertStringContainsString('sudah mengantri', $res['reason']);
    }

    public function test_get_estimated_wait_time_from_location()
    {
        $attraction = Attraction::factory()->create([
            'players_per_round' => 4,
            'estimated_time_per_round' => 7,
        ]);

        $minutes = $this->service->getEstimatedWaitTime('attraction', $attraction->id, 9);
        $this->assertEquals(21, $minutes); // ceil(9/4)=3 rounds * 7
    }
}
