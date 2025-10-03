<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // relasi ke orders
            $table->enum('bahan', ['cotton','combed','premium']);
            $table->enum('ukuran', ['S','M','L','XL','XXL']);
            $table->json('customisasi')->nullable(); // sablon, bordir, packaging, logo
            $table->decimal('harga', 12, 2);
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
