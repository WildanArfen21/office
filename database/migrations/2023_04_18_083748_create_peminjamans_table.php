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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->uuid('uuid',36)->primary();
            $table->foreignUuid('uuid_karyawan',36)->references('uuid')->on('karyawans')->onUpdate('restrict')->onDelete('restrict')->nullable();
            $table->date('tgl_peminjaman'); 
            $table->date('tgl_akan_kembali');
            $table->enum('status',['Sedang Dipinjam','Sudah Dikembalikan']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
