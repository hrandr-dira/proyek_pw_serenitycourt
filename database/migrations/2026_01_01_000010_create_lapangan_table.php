<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lapangan', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['futsal', 'badminton', 'basket']);
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->text('fasilitas')->nullable();
            $table->decimal('harga_per_jam', 10, 2);
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->time('jam_buka')->default('08:00:00');
            $table->time('jam_tutup')->default('22:00:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapangan');
    }
};
