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
        Schema::create('jadwal_pegawai', function (Blueprint $table) {
            $table->foreignId('id_pegawai')->constrained(
                'pegawai',
                'id_pegawai',
                'jadwal_pegawai_id_pegawai'
            )->onDelete('cascade');
            $table->foreignId('id_jadwal')->constrained(
                'jadwal',
                'id_jadwal',
                'jadwal_pegawai_id_jadwal'
            )->onDelete('cascade');

            $table->primary(['id_pegawai', 'id_jadwal']);
            $table->unique(['id_pegawai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_jadwal_pegawai');
    }
};
