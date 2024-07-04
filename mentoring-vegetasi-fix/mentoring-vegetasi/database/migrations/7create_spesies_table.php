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
        Schema::create('spesies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('nama_spesies');
            $table->integer('tinggi');
            $table->integer('diameter');
            $table->string('warna_daun');
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->text('deskripsi');
            $table->unsignedBigInteger('fk_id_genus');
            $table->foreign('fk_id_genus')->references('id')->on('genus')->onDelete('cascade');
            $table->unsignedBigInteger('fk_id_wilayah');
            $table->foreign('fk_id_wilayah')->references('id')->on('wilayahs')->onDelete('cascade');
            $table->unsignedBigInteger('fk_id_vegetasi');
            $table->foreign('fk_id_vegetasi')->references('id')->on('vegetasis')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spesies');
    }
};
