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
        Schema::create('locaux', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('type'); // 'Salle', 'Conférence', 'Amphi'
            $table->integer('capacite');
            $table->string('status')->default('libre'); // 'libre' ou 'occupé'
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locaux');
    }
};
