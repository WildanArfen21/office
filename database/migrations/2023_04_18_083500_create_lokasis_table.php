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
        Schema::create('lokasis', function (Blueprint $table) {
            $table->uuid('uuid',36)->primary();
            $table->foreignUuid('uuid_departemen',36)->references('uuid')->on('departemens')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('lokasis');
    }
};
