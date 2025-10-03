<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    // Relasi: 1 Lead punya banyak Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'nama',
        'kontak',
        'asal_leads',
        'alasan_pembelian',
        'status',
    ];
}
