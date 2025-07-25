# Sistem Antrian dengan Estimasi Waktu Tunggu - Giliranku

## Overview

Sistem antrian Giliranku telah diupgrade dengan fitur estimasi waktu tunggu yang lebih akurat dan aturan antrian yang lebih realistis berdasarkan konsep "grup permainan".

## Fitur Baru

### 1. Atribut Baru untuk Wahana dan Restoran

#### Wahana (Attractions)
- **`players_per_round`**: Jumlah pemain yang bisa bermain dalam 1 ronde
- **`estimated_time_per_round`**: Estimasi waktu dalam menit untuk 1 ronde permainan

#### Restoran (Restaurants)
- **`players_per_round`**: Jumlah tamu yang bisa dilayani dalam 1 giliran
- **`estimated_time_per_round`**: Estimasi waktu dalam menit untuk 1 giliran makan

### 2. Perhitungan Estimasi Waktu Tunggu

**Formula:**
```
Grup Permainan yang harus menunggu = ceil(Posisi Antrian / Pemain per Grup Permainan)
Estimasi Waktu Tunggu = Grup Permainan yang harus menunggu × Waktu per Grup Permainan
```

**Contoh:**
- Wahana dengan `players_per_round = 4` dan `estimated_time_per_round = 10 menit`
- User berada di posisi antrian ke-9
- Grup Permainan yang harus menunggu = ceil(9/4) = 3 grup permainan
- Estimasi waktu tunggu = 3 × 10 = 30 menit

### 3. Aturan Antrian Multi-Lokasi

#### User Dapat Mengantri di Tempat Lain Jika:
- Estimasi antrian saat ini ≥ 2 grup permainan
- User memiliki waktu minimal 1 grup permainan untuk mengantri di tempat lain

#### User TIDAK Dapat Mengantri di Tempat Lain Jika:
- Antrian saat ini tinggal 1 grup permainan (user adalah giliran selanjutnya)
- User harus menunggu dan fokus pada antrian yang sedang berlangsung

### 4. Interface Staff untuk Queue Management

#### Tombol Panggil Antrian:
1. **Panggil 1 Orang**: Memanggil satu user individu
2. **Panggil 1 Grup Permainan**: Memanggil sejumlah user sesuai `players_per_round`

#### Informasi yang Ditampilkan:
- Jumlah pemain per grup permainan untuk wahana/restoran tersebut
- Total antrian menunggu
- Estimasi waktu tunggu untuk setiap posisi

### 5. Interface User

#### Informasi Antrian User:
- **Posisi Antrian**: Nomor urut dalam antrian
- **Estimasi Waktu Tunggu**: Berdasarkan perhitungan grup permainan
- **Status Antrian**: waiting/called/served/cancelled
- **Sisa Grup Permainan**: Berapa grup permainan lagi sebelum giliran user

#### Pembatasan Antrian:
- Alert jika user tidak bisa mengantri di tempat lain
- Pesan alasan kenapa tidak bisa mengantri
- Informasi antrian aktif di lokasi lain

## Konfigurasi Default

### Wahana:
- **Roller Coaster**: 20 pemain, 10 menit per ronde
- **Ferris Wheel**: 30 pemain, 15 menit per ronde  
- **Bumper Car**: 12 pemain, 8 menit per ronde
- **Default**: 4 pemain, 15 menit per ronde

### Restoran:
- **Fast Food**: 10 tamu, 15 menit per giliran
- **Fine Dining**: 4 tamu, 45 menit per giliran
- **Coffee Shop**: 8 tamu, 20 menit per giliran
- **Default**: 6 tamu, 30 menit per giliran

## Penggunaan

### Admin/Staff:
1. Buka halaman Edit Wahana/Restoran
2. Atur **Jumlah Pemain per Grup Permainan** dan **Waktu per Grup Permainan**
3. Gunakan tombol **Panggil 1 Grup Permainan** di Queue Management untuk efisiensi

### User:
1. Pilih wahana/restoran untuk mengantri
2. Lihat estimasi waktu tunggu sebelum bergabung
3. Sistem akan memperingatkan jika tidak bisa mengantri di tempat lain
4. Monitor status antrian melalui halaman profil/history

## API/Service Classes

### QueueValidationService
- `canUserQueue()`: Validasi apakah user bisa mengantri
- `getUserActiveQueues()`: Mendapatkan semua antrian aktif user
- `getEstimatedWaitTime()`: Menghitung estimasi waktu tunggu

### Model Methods
- `getEstimatedWaitingTime($position)`: Hitung waktu tunggu per posisi
- `canUserQueueElsewhere($position)`: Cek apakah bisa antri di tempat lain
- `getUserQueuePosition($userId)`: Dapatkan posisi antrian user

## Testing

Untuk menguji sistem:
1. Buat antrian dengan beberapa user di wahana yang sama
2. Coba buat antrian di wahana lain ketika masih ada 2+ grup permainan
3. Coba buat antrian di wahana lain ketika tinggal 1 grup permainan (harus ditolak)
4. Test tombol "Panggil 1 Grup Permainan" di staff dashboard

## Database Migration

Migration file: `2025_07_25_010625_add_queue_management_fields_to_attractions_and_restaurants_tables.php`

```sql
-- Tambah kolom baru
ALTER TABLE attractions ADD COLUMN players_per_round INTEGER DEFAULT 1;
ALTER TABLE attractions ADD COLUMN estimated_time_per_round INTEGER DEFAULT 10;
ALTER TABLE restaurants ADD COLUMN players_per_round INTEGER DEFAULT 1;
ALTER TABLE restaurants ADD COLUMN estimated_time_per_round INTEGER DEFAULT 30;
```

Seeder: `UpdateQueueManagementFieldsSeeder` untuk set nilai default berdasarkan jenis wahana/restoran.
