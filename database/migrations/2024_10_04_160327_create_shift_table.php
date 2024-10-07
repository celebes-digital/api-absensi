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
        Schema::create('shift', function (Blueprint $table) {
            $table->id('id_shift');
            $table->string('nama_shift', 50);
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->time('jam_istirahat_mulai');
            $table->time('jam_istirahat_selesai');
            $table->unsignedSmallInteger('toleransi_keterlambatan', false);
            $table->enum('status', ['Aktif', 'Arsip'])->default('Aktif');
            $table->string('warna', 7)->default('#07134f');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift');
    }
};
