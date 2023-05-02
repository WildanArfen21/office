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
        Schema::create('penempatan_mutasis', function (Blueprint $table) {
            $table->uuid('uuid',36)->primary();
            $table->foreignUuid('uuid_lokasi',36)->references('uuid')->on('lokasis')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignUuid('uuid_karyawan',36)->references('uuid')->on('karyawans')->onDelete('restrict')->onUpdate('restrict');
            $table->string('nomor');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->enum('jenis',['Penempatan','Mutasi']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatan_mutasis');
    }
};
