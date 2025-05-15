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
        Schema::create('reclamations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference')->unique();
            $table->uuid('mutualiste_id');

            $table->dateTime('date_soumission');
            $table->string('sujet');
            $table->text('description');

            // Modifier les valeurs de l'ENUM en majuscules, avec espaces et sans accents
            $table->enum('statut', ['SOUMISE', 'EN COURS', 'RESOLUE', 'FERMEE', 'ESCALADEE']);
            $table->dateTime('date_mise_a_jour_statut');

            $table->uuid('soumise_par_utilisateur_id');
            $table->uuid('assignee_a_admin_id')->nullable();

            $table->timestamps();

            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            $table->foreign('mutualiste_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('soumise_par_utilisateur_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('assignee_a_admin_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            $table->index('reference');
            $table->index('mutualiste_id');
            $table->index('statut');
            $table->index('date_soumission');
            $table->index('soumise_par_utilisateur_id');
            $table->index('assignee_a_admin_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamations');
    }
};
