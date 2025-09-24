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
        Schema::create('retains', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('username');
            $table->string('username_updated')->nullable(); 
            $table->date('date');
            $table->string('plant');
            $table->string('sample_type');
            $table->longText('sample_storage')->nullable();
            $table->string('description');
            $table->string('production_code');
            $table->date('best_before');
            $table->double('quantity')->nullable();
            $table->string('remarks')->nullable();
            $table->string('note')->nullable();
            $table->string('nama_warehouse')->nullable();
            $table->string('status_warehouse')->nullable();
            $table->timestamp('tgl_update_warehouse')->nullable();
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
        Schema::dropIfExists('retains');
    }
};
