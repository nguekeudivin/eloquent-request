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
        Schema::create('ayant_droits', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Clé primaire UUID
            $table->unsignedBigInteger('type_ayant_droit_id'); // FK vers type_ayant_droits
            $table->uuid('mutualiste_id'); // FK vers mutualistes (qui partagent l'ID de users)

            $table->string('nom'); // Nom de famille
            $table->string('prenom'); // Prénom(s)
            $table->date('date_naissance'); // Date de naissance
            $table->enum('sexe', ['MASCULIN', 'FEMININ']); // Sexe

            $table->boolean('est_actif')->default(true); // Champ pour la désactivation

            $table->timestamps(); // created_at et updated_at

            // Champs d'audit (UUID si l'utilisateur a un UUID)
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition des clés étrangères
            // type_ayant_droit_id FK (RESTRICT est souvent plus sûr pour les tables lookup)
            $table->foreign('type_ayant_droit_id')->references('id')->on('type_ayant_droits')->onDelete('restrict');
            // mutualiste_id FK (vers la table 'users' car mutualistes partagent l'ID user)
            $table->foreign('mutualiste_id')->references('id')->on('users')->onDelete('cascade');
            // Champs d'audit FK
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('type_ayant_droit_id');
            $table->index('mutualiste_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
            $table->index('date_naissance');
            $table->index('est_actif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayant_droits');
    }
};
