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
        Schema::create('pengemasans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('username');
            $table->string('username_updated')->nullable(); 
            $table->date('date');
            $table->string('shift');
            $table->time('pukul');
            $table->string('nama_produk'); 
            $table->string('kode_produksi');
            $table->longText('tray_checking')->nullable();
            $table->longText('box_checking')->nullable();
            $table->string('keterangan_checking')->nullable();
            $table->date('date_packing')->nullable();
            $table->string('shift_packing')->nullable();
            $table->time('pukul_packing');
            $table->longText('tray_packing')->nullable();
            $table->longText('box_packing')->nullable();
            $table->string('keterangan_packing')->nullable();
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
        Schema::dropIfExists('pengemasans');
    }
};
