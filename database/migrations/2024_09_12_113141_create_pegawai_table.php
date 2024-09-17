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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->foreignId('id_user')->constrained(
                table: 'users', 
                column: 'id_user', 
                indexName: 'pegawai_id_user'
            )->onDelete('cascade');
            $table->string('nama_lengkap', 100);
            $table->string('nik', 16);
            $table->string('jk', 1);
            $table->date('tgl_lahir');
            $table->string('tempat_lahir', 100);
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu']);
            $table->enum('gol_darah', ['A', 'B', 'AB', 'O', 'A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-']);
            $table->string('pendidikan', 100);
            $table->string('kontak_darurat', 16);
            $table->date('mulai_kerja');
            $table->string('jabatan', 100);
            $table->string('rekening', 100);
            $table->string('alamat', 100);
            $table->string('no_telp', 16);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
