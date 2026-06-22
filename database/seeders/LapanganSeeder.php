<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lapangan = [
            [
                'jenis'       => 'futsal',
                'nama'        => 'Lapangan Futsal A',
                'deskripsi'   => 'Lapangan futsal standar FIFA dengan rumput sintetis premium. Dilengkapi sistem pencahayaan LED yang terang untuk bermain malam hari.',
                'fasilitas'   => 'Rumput Sintetis, Lampu LED, Ruang Ganti, Kamar Mandi, Parkir',
                'harga_per_jam' => 150000,
                'foto'        => null,
                'status'      => 'aktif',
                'jam_buka'    => '08:00:00',
                'jam_tutup'   => '23:00:00',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'jenis'       => 'futsal',
                'nama'        => 'Lapangan Futsal B',
                'deskripsi'   => 'Lapangan futsal indoor dengan lantai vinyl anti-slip. Cocok untuk turnamen dan latihan intensif.',
                'fasilitas'   => 'Lantai Vinyl, AC, Tribun Penonton, Ruang Ganti, Parkir',
                'harga_per_jam' => 175000,
                'foto'        => null,
                'status'      => 'aktif',
                'jam_buka'    => '08:00:00',
                'jam_tutup'   => '23:00:00',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'jenis'       => 'badminton',
                'nama'        => 'Lapangan Badminton 1',
                'deskripsi'   => 'Lapangan badminton dengan lantai kayu parket berkualitas tinggi. Memenuhi standar BWF untuk pertandingan resmi.',
                'fasilitas'   => 'Lantai Parket, Lampu Standar BWF, Ruang Ganti, Loker, Kafetaria',
                'harga_per_jam' => 60000,
                'foto'        => null,
                'status'      => 'aktif',
                'jam_buka'    => '07:00:00',
                'jam_tutup'   => '22:00:00',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'jenis'       => 'badminton',
                'nama'        => 'Lapangan Badminton 2',
                'deskripsi'   => 'Lapangan badminton indoor yang nyaman dengan ventilasi udara yang baik. Tersedia untuk booking per jam.',
                'fasilitas'   => 'Lantai Karet, Pendingin Udara, Ruang Ganti, Parkir',
                'harga_per_jam' => 55000,
                'foto'        => null,
                'status'      => 'aktif',
                'jam_buka'    => '07:00:00',
                'jam_tutup'   => '22:00:00',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'jenis'       => 'basket',
                'nama'        => 'Lapangan Basket Utama',
                'deskripsi'   => 'Lapangan basket full-court dengan papan fiber glass standar NBA. Lantai kayu premium dengan garis lapangan yang jelas.',
                'fasilitas'   => 'Lantai Kayu, Papan Fiber Glass, Scoreboard Digital, Tribun, Parkir Luas',
                'harga_per_jam' => 200000,
                'foto'        => null,
                'status'      => 'aktif',
                'jam_buka'    => '08:00:00',
                'jam_tutup'   => '22:00:00',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'jenis'       => 'basket',
                'nama'        => 'Lapangan Basket 3on3',
                'deskripsi'   => 'Lapangan basket half-court khusus untuk permainan 3 lawan 3. Tersedia di area outdoor dengan atap pelindung hujan.',
                'fasilitas'   => 'Atap Pelindung, Papan Akrilik, Lampu LED, Parkir',
                'harga_per_jam' => 100000,
                'foto'        => null,
                'status'      => 'aktif',
                'jam_buka'    => '08:00:00',
                'jam_tutup'   => '22:00:00',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        DB::table('lapangan')->insert($lapangan);

        $this->command->info('✅ Data lapangan berhasil ditambahkan (6 lapangan)');
    }
}
