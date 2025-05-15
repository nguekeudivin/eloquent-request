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
        Schema::create('prise_en_charges', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference')->unique(); // Référence unique de la demande
            $table->date('date_soins_facture'); // Date des soins ou de la facture

            $table->uuid('mutualiste_id'); // FK vers mutualistes (users)
            $table->uuid('ayant_droit_id')->nullable(); // FK vers ayant_droits (Nullable)
            $table->unsignedBigInteger('prestation_id'); // FK vers prestations (INT)
            $table->uuid('adhesion_id'); // FK vers adhesions (UUID)

            $table->decimal('montant_facture', 10, 2); // Montant total de la facture
            $table->decimal('montant_pris_en_charge', 10, 2)->nullable(); // Montant calculé pris en charge (Nullable initialement)

            $table->dateTime('date_soumission'); // Date et heure de soumission
            $table->dateTime('date_mise_a_jour_statut'); // Date et heure du dernier changement de statut

            // Statut de la demande
            $table->enum('statut', ['SOUMISE', 'EN COURS', 'VALIDEE', 'REMBOURSEE', 'REFUSEE', 'ANNULEE']);

            $table->text('description')->nullable(); // Description ou motif

            // Utilisateur qui a soumis la demande
            $table->uuid('soumise_par_utilisateur_id');
            // Admin qui a validé ou refusé la demande (Nullable)
            $table->uuid('validee_par_admin_id')->nullable();

            $table->timestamps(); // created_at et updated_at (pour le record lui-même)

            // Champs d'audit (qui a créé/mis à jour le record dans la DB)
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition des clés étrangères
            $table->foreign('mutualiste_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ayant_droit_id')->references('id')->on('ayant_droits')->onDelete('set null');
            $table->foreign('prestation_id')->references('id')->on('prestations')->onDelete('restrict'); // RESTRICT pour les tables lookup/référence
            $table->foreign('adhesion_id')->references('id')->on('adhesions')->onDelete('restrict'); // RESTRICT si l'adhésion doit exister
            $table->foreign('soumise_par_utilisateur_id')->references('id')->on('users')->onDelete('restrict'); // RESTRICT si l'utilisateur soumetteur doit exister
            $table->foreign('validee_par_admin_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('reference');
            $table->index('mutualiste_id');
            $table->index('ayant_droit_id');
            $table->index('prestation_id');
            $table->index('adhesion_id');
            $table->index('statut');
            $table->index('date_soins_facture');
            $table->index('date_soumission');
            $table->index('soumise_par_utilisateur_id');
            $table->index('validee_par_admin_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prise_en_charges');
    }
};
