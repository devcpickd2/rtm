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
        Schema::create('thawings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->date('date');
            $table->string('username');
            $table->string('username_updated')->nullable();
            $table->string('kondisi_ruangan');
            $table->string('jenis_produk');
            $table->string('jumlah');
            $table->string('kode_produksi');
            $table->string('kondisi_produk');
            $table->string('keterangan_kondisi')->nullable();
            $table->string('suhu_ruangan')->nullable();
            $table->time('mulai_thawing');
            $table->time('selesai_thawing');
            $table->string('kondisi_produk_setelah')->nullable();
            $table->string('keterangan_kondisi_setelah')->nullable();
            $table->string('jumlah_setelah')->nullable();
            $table->string('suhu_produk');
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thawings');
    }
};
