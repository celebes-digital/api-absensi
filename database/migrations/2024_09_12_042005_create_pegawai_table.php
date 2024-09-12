<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('id_user')->nullable()->unique();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('set null');
            $table->string('nama', 100);
            $table->enum('kelamin', ['l', 'p']);
            $table->date('tgl_lahir')->nullable();
            $table->string('no_telp', 16);
            $table->string('no_telp_darurat', 16);
            $table->date('tgl_registrasi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('alamat');
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
