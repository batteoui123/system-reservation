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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('heure_debut');
            $table->time('heure_fin');

            $table->enum('statut', ['en attente', 'accepte', 'refuse','termine'])->default('en attente');
            $table->string('motif_refus')->nullable();
            $table->text('motif_reservation')->nullable();
            $table->string('message_annulation')->nullable();
            $table->unsignedBigInteger('etudiant_id');
            $table->unsignedBigInteger('local_id');
            $table->timestamps();

            $table->foreign('etudiant_id')->references('id')->on('etudiants')->onDelete('cascade');
            $table->foreign('local_id')->references('id')->on('locaux')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
