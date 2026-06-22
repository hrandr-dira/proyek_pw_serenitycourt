<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangan';

    protected $fillable = [
        'jenis',
        'nama',
        'deskripsi',
        'fasilitas',
        'harga_per_jam',
        'foto',
        'status',
        'jam_buka',
        'jam_tutup',
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}
