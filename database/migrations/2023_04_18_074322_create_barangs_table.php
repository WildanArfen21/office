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
        Schema::create('barangs', function (Blueprint $table) {
            $table->uuid('uuid',36)->primary();
            $table->foreignUuid('uuid_kategori',36)->references('uuid')->on('kategoris')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignUuid('uuid_merk',36)->references('uuid')->on('merks')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignUuid('uuid_satuan',36)->references('uuid')->on('satuans')->onDelete('restrict')->onUpdate('restrict');
            $table->string('kode')->unique();
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
