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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('uuid_barang')->references('uuid')->on('barangs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('uuid_lokasi')->references('uuid')->on('lokasis')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignUuid('uuid_pengadaan')->references('uuid')->on('pengadaans')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('kode_aset');
            $table->year('tahun_datang',10);
            $table->string('tahun_digunakan',10)->nullable();
            $table->string('nomor_seri')->nullable();
            $table->string('masa_habis_kalibrasi')->nullable();
            $table->string('no_sertifikat_kalibrasi')->nullable();
            $table->string('pembuat_sertifikat')->nullable();
            $table->string('asal_barang')->nullable();
            $table->integer('harga_barang');
            $table->text('keterangan')->nullable();
            $table->enum('status',['Ditempatkan','Dipinjam','Tersedia']);
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
