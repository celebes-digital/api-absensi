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
        Schema::create('payroll', function (Blueprint $table) {
            $table->id('id_payroll');
            $table->foreignId('id_pegawai')->constrained(
                table: 'pegawai',
                indexName: 'payroll_id_pegawai',
                column: 'id_pegawai'
            );
            $table->date('periode');
            $table->integer('potongan');
            $table->integer('total_pembayaran');
            $table->date('tanggal_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll');
    }
};
