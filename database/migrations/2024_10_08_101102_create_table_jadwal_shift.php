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
        Schema::create('jadwal_shift', function (Blueprint $table) {
            $table->id('id_jadwal_shift');
            $table->foreignId('id_shift')->constrained(
                table: 'shift', indexName: 'jadwal_shift_id_shift', column: 'id_shift'
            )->onDelete('cascade');
            $table->foreignId('id_jadwal')->constrained(
                table: 'jadwal', indexName: 'jadwal_shift_id_jadwal', column: 'id_jadwal'
            )->onDelete('cascade');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_jadwal_shift');
    }
};
