<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class UpdateTicketDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing tickets with detailed terms and usage
        $tickets = [
            [
                'name' => 'Konser Musim Panas',
                'terms_and_conditions' => 'Tiket tidak dapat diuangkan kembali. Tiket hanya berlaku untuk tanggal yang tertera. Wajib membawa identitas diri yang sah. Tidak diperkenankan membawa makanan dan minuman dari luar. Kapasitas terbatas, tiket berlaku sesuai urutan kedatangan. Parkir tidak termasuk dalam harga tiket.',
                'usage' => 'Tunjukkan tiket digital ini di pintu masuk atau tukarkan dengan tiket fisik di counter. Scan QR code untuk akses cepat. Tiket dapat digunakan mulai pukul 08:00 hingga 22:00. Untuk bantuan hubungi customer service di nomor yang tertera pada tiket.'
            ],
            [
                'name' => 'Pentas Teater Klasik',
                'terms_and_conditions' => 'Tiket berlaku satu kali masuk untuk pertunjukan yang dipilih. Tidak ada pengembalian uang setelah pembelian. Dilarang merekam atau memotret selama pertunjukan. Anak di bawah 5 tahun tidak diperkenankan masuk. Berpakaian sopan dan rapi. Datang minimal 30 menit sebelum pertunjukan dimulai.',
                'usage' => 'Datang ke venue 30 menit sebelum show dimulai. Tunjukkan tiket digital atau cetak tiket sebagai bukti pembelian. Ikuti petunjuk petugas untuk tempat duduk. Handphone harap dimatikan atau silent mode selama pertunjukan. Intermisi tersedia di tengah acara.'
            ]
        ];

        foreach ($tickets as $ticketData) {
            $ticket = Ticket::where('name', $ticketData['name'])->first();
            if ($ticket) {
                $ticket->update([
                    'terms_and_conditions' => $ticketData['terms_and_conditions'],
                    'usage' => $ticketData['usage']
                ]);
                $this->command->info("Updated: " . $ticketData['name']);
            }
        }
    }
}
