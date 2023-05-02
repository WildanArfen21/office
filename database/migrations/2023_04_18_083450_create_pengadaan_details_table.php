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
        Schema::create('pengadaan_details', function (Blueprint $table) {
            $table->uuid('uuid',36);
            $table->foreignUuid('uuid_pengadaan',36)->references('uuid')->on('pengadaans')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignUuid('uuid_barang',36)->references('uuid')->on('barangs')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaan_details');
    }
};
