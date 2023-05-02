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
        Schema::create('penempatan_mutasi_details', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->foreignUuid('uuid_penempatan_mutasi',36)->references('uuid')->on('penempatan_mutasis')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignUuid('uuid_inventaris',36)->references('uuid')->on('inventaris')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatan_mutasi_details');
    }
};
