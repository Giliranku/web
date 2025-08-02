<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportTicket;
use App\Models\Staff;

class SupportTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = Staff::where('role', '!=', 'admin')->get();
        $adminStaff = Staff::where('role', 'admin')->first();

        if ($staff->count() === 0) {
            echo "No staff found. Please run StaffSeeder first.\n";
            return;
        }

        $sampleTickets = [
            [
                'subject' => 'Masalah sistem antrian tidak berfungsi',
                'description' => 'Sistem antrian di wahana DoAndFun mengalami error saat menambahkan pengunjung baru. Sistem tidak merespon ketika tombol "Tambah ke Antrian" diklik.',
                'priority' => 'high',
                'status' => 'open'
            ],
            [
                'subject' => 'Printer tidak bisa mencetak tiket',
                'description' => 'Printer di counter restoran KFC mengalami masalah. Tidak bisa mencetak tiket antrian untuk pengunjung. Sudah dicoba restart tapi masih bermasalah.',
                'priority' => 'medium',
                'status' => 'in_progress',
                'admin_response' => 'Sedang mengecek masalah printer. Tim teknis akan datang dalam 30 menit.',
                'responded_at' => now()->subHours(2),
                'responded_by' => $adminStaff?->id
            ],
            [
                'subject' => 'Akun login staff bermasalah',
                'description' => 'Tidak bisa login ke sistem dashboard staff. Muncul pesan error "Invalid credentials" padahal password sudah benar.',
                'priority' => 'high',
                'status' => 'resolved',
                'admin_response' => 'Masalah sudah diperbaiki. Password telah direset. Silakan login dengan password baru yang sudah dikirim via email.',
                'responded_at' => now()->subDays(1),
                'responded_by' => $adminStaff?->id
            ],
            [
                'subject' => 'Permintaan tambahan kursi roda',
                'description' => 'Di area restoran McDonald\'s perlu penambahan kursi roda untuk pengunjung berkebutuhan khusus. Saat ini hanya ada 2 kursi roda dan sering kekurangan.',
                'priority' => 'low',
                'status' => 'open'
            ],
            [
                'subject' => 'Sistem pembayaran mengalami gangguan',
                'description' => 'Mesin EDC di counter tiket sering mengalami timeout saat proses pembayaran. Pengunjung mengeluh karena harus mengulang pembayaran beberapa kali.',
                'priority' => 'high',
                'status' => 'open'
            ],
            [
                'subject' => 'Fasilitas toilet rusak',
                'description' => 'Toilet di area wahana SpinReverse mengalami kerusakan pada flush. Sudah dilaporkan ke cleaning service tapi belum diperbaiki.',
                'priority' => 'medium',
                'status' => 'resolved',
                'admin_response' => 'Toilet sudah diperbaiki oleh tim maintenance. Terima kasih atas laporannya.',
                'responded_at' => now()->subHours(6),
                'responded_by' => $adminStaff?->id
            ]
        ];

        foreach ($sampleTickets as $index => $ticketData) {
            $randomStaff = $staff->random();
            
            SupportTicket::create([
                'ticket_number' => SupportTicket::generateTicketNumber(),
                'staff_id' => $randomStaff->id,
                'subject' => $ticketData['subject'],
                'description' => $ticketData['description'],
                'priority' => $ticketData['priority'],
                'status' => $ticketData['status'],
                'admin_response' => $ticketData['admin_response'] ?? null,
                'responded_at' => $ticketData['responded_at'] ?? null,
                'responded_by' => $ticketData['responded_by'] ?? null,
                'created_at' => now()->subDays(rand(0, 7))
            ]);
        }

        echo "Created " . count($sampleTickets) . " sample support tickets\n";
    }
}
