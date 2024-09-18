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
        Schema::create('shift_kerja', function (Blueprint $table) {
            $table->id('id_shift_kerja');
            $table->foreignId('id_pegawai')->constrained(
                table       : 'pegawai',
                indexName   : 'shift_kerja_id_pegawai',
                column      : 'id_pegawai'
            );
            $table->string('hari', 10);
            $table->time('jam_masuk');
            $table->time('jam_keluar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_kerja');
    }
};
