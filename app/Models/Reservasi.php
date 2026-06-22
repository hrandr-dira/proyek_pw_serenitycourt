<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'durasi',
        'total_harga',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
