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
        Schema::create('conversations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('sujet');
            $table->dateTime('date_creation');

            // Statut de la conversation
            $table->enum('statut', ['ouvert', 'fermé', 'archivé']);

            // Relation polymorphique vers l'entité associée à la conversation (ex: Réclamation, Adhesion)
            $table->uuidMorphs('conversationable'); // Ajoute conversationable_type (string) et conversationable_id (uuid)

            $table->timestamps();

            // Champs d'audit
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition des clés étrangères pour les champs d'audit
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('statut');
            $table->index('date_creation');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
