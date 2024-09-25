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
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id('id_kehadiran');
            $table->foreignId('id_pegawai')->constrained(
                table       : 'pegawai',
                indexName   : 'kehadiran_id_pegawai',
                column      : 'id_pegawai'
            );
            $table->string('kode_kehadiran', 6)->nullable();
            $table->date('tgl_kehadiran');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->enum('status', ['Hadir', 'Tidak hadir', 'Terlambat', 'Izin']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
