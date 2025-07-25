<?php

namespace App\Services;

use App\Models\Attraction;
use App\Models\Restaurant;
use App\Models\UserAttraction;
use App\Models\UserRestaurant;
use Carbon\Carbon;

class QueueValidationService
{
    /**
     * Cek apakah user bisa mengantri di wahana/restoran lain
     * berdasarkan antrian yang sudah ada
     */
    public function canUserQueue($userId, $targetType, $targetId, $date = null)
    {
        $date = $date ?? Carbon::today();
        
        // Cek antrian yang sudah ada di semua tempat
        $existingQueues = $this->getUserActiveQueues($userId, $date);
        
        foreach ($existingQueues as $queue) {
            // Jika user sudah mengantri di tempat yang sama, tidak boleh
            if ($queue['type'] === $targetType && $queue['location_id'] === $targetId) {
                return [
                    'can_queue' => false,
                    'reason' => 'Anda sudah mengantri di tempat ini.'
                ];
            }
            
            // Cek apakah user masih dalam 1 grup permainan (tidak bisa mengantri di tempat lain)
            if (!$queue['can_queue_elsewhere']) {
                return [
                    'can_queue' => false,
                    'reason' => 'Anda tidak dapat mengantri di tempat lain karena antrian Anda di ' . 
                               $queue['location_name'] . ' tinggal 1 grup permainan lagi.'
                ];
            }
        }
        
        return [
            'can_queue' => true,
            'reason' => null
        ];
    }
    
    /**
     * Mendapatkan semua antrian aktif user pada tanggal tertentu
     */
    public function getUserActiveQueues($userId, $date = null)
    {
        $date = $date ?? Carbon::today();
        $queues = [];
        
        // Antrian wahana
        $attractionQueues = UserAttraction::with('attraction')
            ->where('user_id', $userId)
            ->whereDate('queue_date', $date)
            ->where('status', 'waiting')
            ->get();
            
        foreach ($attractionQueues as $queue) {
            $attraction = $queue->attraction;
            $position = $queue->queue_position;
            $estimatedWaitTime = $attraction->getEstimatedWaitingTime($position);
            $canQueueElsewhere = $attraction->canUserQueueElsewhere($position);
            
            $queues[] = [
                'type' => 'attraction',
                'location_id' => $attraction->id,
                'location_name' => $attraction->name,
                'queue_position' => $position,
                'estimated_wait_time' => $estimatedWaitTime,
                'can_queue_elsewhere' => $canQueueElsewhere,
                'rounds_to_wait' => ceil($position / $attraction->players_per_round)
            ];
        }
        
        // Antrian restoran
        $restaurantQueues = UserRestaurant::with('restaurant')
            ->where('user_id', $userId)
            ->whereDate('queue_date', $date)
            ->where('status', 'waiting')
            ->get();
            
        foreach ($restaurantQueues as $queue) {
            $restaurant = $queue->restaurant;
            $position = $queue->queue_position;
            $estimatedWaitTime = $restaurant->getEstimatedWaitingTime($position);
            $canQueueElsewhere = $restaurant->canUserQueueElsewhere($position);
            
            $queues[] = [
                'type' => 'restaurant',
                'location_id' => $restaurant->id,
                'location_name' => $restaurant->name,
                'queue_position' => $position,
                'estimated_wait_time' => $estimatedWaitTime,
                'can_queue_elsewhere' => $canQueueElsewhere,
                'rounds_to_wait' => ceil($position / $restaurant->players_per_round)
            ];
        }
        
        return $queues;
    }
    
    /**
     * Mendapatkan estimasi waktu tunggu untuk posisi tertentu
     */
    public function getEstimatedWaitTime($type, $locationId, $position)
    {
        if ($type === 'attraction') {
            $location = Attraction::find($locationId);
        } else {
            $location = Restaurant::find($locationId);
        }
        
        if (!$location) {
            return 0;
        }
        
        return $location->getEstimatedWaitingTime($position);
    }
}
