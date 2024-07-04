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
        Schema::create('genus', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('nama_genus');
            $table->text('deskripsi');
            $table->unsignedBigInteger('fk_id_famili');
            $table->foreign('fk_id_famili')->references('id')->on('familis')->onDelete('cascade');
            $table->string('photo_path', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genus');
    }
};
