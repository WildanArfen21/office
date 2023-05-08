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
        Schema::create('pengadaans', function (Blueprint $table) {
            $table->uuid('uuid',36)->primary();
            $table->foreignUuid('uuid_supplier',36)->references('uuid')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('uuid_jenis_pengadaan',36)->references('uuid')->on('jenis_pengadaans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nomor_pengadaan');
            $table->date('tanggal_pengadaan');
            $table->string('keterangan')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaans');
    }
};
