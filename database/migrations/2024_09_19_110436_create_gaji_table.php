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
        Schema::create('gaji', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->foreignId('id_pegawai')->constrained(
                table       : 'pegawai',
                indexName   : 'gaji_id_pegawai',
                column      : 'id_pegawai'
            );
            $table->unsignedInteger('gaji_pokok');
            $table->unsignedInteger('tunjangan');
            $table->string('rekening', 20)->nullable();
            $table->string('nama_bank', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
