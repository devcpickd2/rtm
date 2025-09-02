<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institusis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->date('date');
            $table->string('username');
            $table->string('username_updated')->nullable();
            $table->string('shift');
            $table->string('jenis_produk');
            $table->string('kode_produksi');
            $table->float('waktu_proses');
            $table->string('lokasi');
            $table->float('suhu_sebelum');
            $table->float('suhu_sesudah');
            $table->string('sensori')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('catatan')->nullable();
            $table->string('nama_produksi')->nullable();
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institusis');
    }
};
