<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'bahan',
        'ukuran',
        'qty',
        'sablon',
        'bordir',
        'packaging',
        'logo_tambahan',
        'total_harga',
        'status',
    ];

    // Relasi ke Lead
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    // Relasi ke order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
