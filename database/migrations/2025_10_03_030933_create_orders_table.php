<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade'); // relasi ke leads
            $table->decimal('total_harga', 12, 2);
            $table->enum('status', ['menunggu pembayaran','diproses produksi','produksi selesai','dikirim','selesai'])
                  ->default('menunggu pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
