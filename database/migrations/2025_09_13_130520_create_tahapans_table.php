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
        Schema::create('tahapans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('username');
            $table->string('username_updated')->nullable(); 
            $table->date('date');
            $table->string('shift');
            $table->string('nama_produk');
            $table->string('kode_produksi');
            $table->time('filling_mulai')->nullable();
            $table->time('filling_selesai')->nullable();
            $table->time('waktu_iqf')->nullable();
            $table->time('waktu_sealer')->nullable();
            $table->time('waktu_xray')->nullable();
            $table->time('waktu_sticker')->nullable();
            $table->time('waktu_shrink')->nullable();
            $table->time('waktu_packing')->nullable();
            $table->time('waktu_cs')->nullable();
            $table->longText('suhu_filling')->nullable();
            $table->string('suhu_masuk_iqf')->nullable();
            $table->string('suhu_keluar_iqf')->nullable();
            $table->string('suhu_sealer')->nullable();
            $table->string('suhu_xray')->nullable();
            $table->string('suhu_sticker')->nullable();
            $table->string('suhu_shrink')->nullable();
            $table->string('downtime')->nullable();
            $table->string('suhu_cs')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('catatan')->nullable();
            $table->string('nama_produksi')->nullable();
            $table->string('status_produksi')->nullable();
            $table->timestamp('tgl_update_produksi')->nullable();
            $table->string('nama_spv')->nullable();
            $table->string('status_spv')->nullable();
            $table->string('catatan_spv')->nullable();
            $table->timestamp('tgl_update_spv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahapans');
    }
};
