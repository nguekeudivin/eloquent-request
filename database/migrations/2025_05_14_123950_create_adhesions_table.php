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
        Schema::create('adhesions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Clé primaire UUID

            // FK vers mutualistes (qui partagent l'ID de users)
            $table->uuid('mutualiste_id');
            // FK vers contrats (UUID) - Corrigé de integer
            $table->uuid('contrat_id');

            $table->date('date_debut'); // Date de début de l'adhésion
            $table->date('date_fin')->nullable(); // Date de fin (si résilié/expiré)

            // Statut de l'adhésion (actif, résilié, expiré, suspendu, inactif)
            $table->enum('statut', ['ACTIF','RESILIE',"EXPIRE","SUSPENDU","INACTIF"]);

            $table->string('reference_externe')->nullable(); // Référence externe optionnelle
            $table->text('motif_resiliation')->nullable(); // Motif si résilié

            $table->timestamps(); // created_at et updated_at

            // Champs d'audit
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition des clés étrangères
            $table->foreign('mutualiste_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('cascade');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('mutualiste_id');
            $table->index('contrat_id');
            $table->index('statut');
            $table->index('date_debut');
            $table->index('date_fin');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adhesions');
    }
};
