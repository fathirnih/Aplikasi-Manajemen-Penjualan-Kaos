<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'bahan', 'ukuran', 'customisasi', 'harga', 'quantity'];

    protected $casts = [
        'customisasi' => 'array', // agar JSON otomatis jadi array
    ];

    // Relasi ke order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
