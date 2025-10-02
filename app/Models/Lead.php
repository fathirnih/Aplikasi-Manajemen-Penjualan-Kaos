<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'nama', 'kontak', 'asal_leads', 'alasan_pembelian', 'status'
    ];
}
