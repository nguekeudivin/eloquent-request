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
        Schema::create('fonction_mutualistes', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('libelle'); // Libellé de la fonction
            $table->unsignedBigInteger('groupe_mutualiste_id'); // FK vers groupe_mutualistes

            $table->timestamps(); // created_at et updated_at

            // Champs d'audit (UUID si l'utilisateur a un UUID)
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition de l'unicité composite (libelle + groupe_mutualiste_id)
            // Une fonction est unique au sein d'un groupe donné
            $table->unique(['libelle', 'groupe_mutualiste_id'], 'fonction_groupe_unique');

            // Définition des clés étrangères
            $table->foreign('groupe_mutualiste_id')->references('id')->on('groupe_mutualistes')->onDelete('cascade');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('groupe_mutualiste_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonction_mutualistes');
    }
};
