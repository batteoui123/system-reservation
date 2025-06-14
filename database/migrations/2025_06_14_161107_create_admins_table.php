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
        // Désactiver les contraintes pour éviter les erreurs de dépendance
        Schema::disableForeignKeyConstraints();

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utilisateur_id')->unique();
            $table->timestamps();
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->foreign('utilisateur_id')
                ->references('id')
                ->on('utilisateurs')
                ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
