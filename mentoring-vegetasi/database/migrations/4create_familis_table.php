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
        Schema::create('familis', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('nama_famili');
            $table->text('deskripsi');
            $table->unsignedBigInteger('fk_id_ordo');
            $table->foreign('fk_id_ordo')->references('id')->on('ordos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('familis');
    }
};
