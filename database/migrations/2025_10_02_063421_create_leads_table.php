<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('leads', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('kontak'); // WA / Email / HP
        $table->string('asal_leads')->nullable(); // iklan, teman, toko offline
        $table->text('alasan_pembelian')->nullable();
        $table->enum('status', ['baru', 'follow-up', 'closing', 'gagal'])->default('baru');
        $table->timestamps();
    });
}

};
