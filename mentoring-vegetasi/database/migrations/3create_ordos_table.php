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
        Schema::create('ordos', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('nama_ordo');
            $table->text('deskripsi');
            $table->unsignedBigInteger('fk_id_kelas');
            $table->foreign('fk_id_kelas')->references('id')->on('classes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordos');
    }
};
