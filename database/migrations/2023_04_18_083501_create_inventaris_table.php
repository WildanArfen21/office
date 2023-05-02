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
            $table->uuid('uuid',36)->primary();
            $table->foreignUuid('uuid_barang',36)->references('uuid')->on('barangs')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignUuid('uuid_lokasi',36)->references('uuid')->on('lokasis')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignUuid('uuid_pengadaan',36)->references('uuid')->on('pengadaans')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->string('kode_aset');
            $table->year('tahun_datang');
            $table->year('tahun_digunakan')->nullable();
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
