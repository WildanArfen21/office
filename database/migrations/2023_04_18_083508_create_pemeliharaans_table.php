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
        Schema::create('pemeliharaans', function (Blueprint $table) {
            $table->uuid('uuid',36);
            $table->foreignUuid('uuid_inventaris',36)->references('uuid')->on('inventaris')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignUuid('uuid_karyawan',36)->references('uuid')->on('karyawans')->onDelete('restrict')->onUpdate('restrict');
            $table->string('nomor_pemeliharaan');
            $table->date('tanggal');
            $table->integer('biaya');
            $table->text('keterangan')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeliharaans');
    }
};
