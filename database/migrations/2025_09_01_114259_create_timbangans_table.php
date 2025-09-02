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
        Schema::create('timbangans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->date('date');
            $table->string('username');
            $table->string('username_updated')->nullable();
            $table->string('shift');
            $table->string('kode_timbangan');
            $table->string('standar');
            $table->float('waktu_tera');
            $table->string('hasil_tera');
            $table->string('tindakan_perbaikan')->nullable();
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
        Schema::dropIfExists('timbangans');
    }
};
