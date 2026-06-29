<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin account
        DB::table('users')->insert([
            'name'           => 'Administrator',
            'email'          => 'admin@serenitycourt.com',
            'password'       => Hash::make('admin123'),
            'nomor_telepon'  => '081234567890',
            'role'           => 'admin',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Demo customer account
        DB::table('users')->insert([
            'name'           => 'Customer Demo',
            'email'          => 'customer@demo.com',
            'password'       => Hash::make('customer123'),
            'nomor_telepon'  => '089876543210',
            'role'           => 'customer',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        $this->command->info('✅ User default berhasil ditambahkan:');
        $this->command->info('   Admin    → admin@serenitycourt.com / admin123');
        $this->command->info('   Customer → customer@demo.com / customer123');
    }
}
