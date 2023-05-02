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
        Schema::create('peminjaman_details', function (Blueprint $table) {
            $table->uuid('uuid',36);
            $table->foreignUuid('uuid_peminjaman',36)->references('uuid')->on('peminjamans')->onUpdate('restrict')->onDelete('restrict')->nullable();
            $table->foreignUuid('uuid_inventaris',36)->references('uuid')->on('inventaris')->onUpdate('restrict')->onDelete('restrict')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_details');
    }
};
