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
        Schema::create('cotisations', function (Blueprint $table) {

            $table->uuid('id')->primary(); // Clé primaire UUID

            // FK vers adhesions (UUID)
            $table->uuid('adhesion_id');

            $table->string('periode_concerne'); // Période couverte (ex: "2024-03", "2024-T2", "2024")
            $table->decimal('montant_prevu', 10, 2); // Montant initial prévu
            $table->decimal('montant_paye', 10, 2)->default(0.00); // Montant payé (initialisé à 0)
            $table->date('date_limite_paiement'); // Date limite de paiement
            $table->date('date_paiement_effective')->nullable(); // Date de paiement effectif (si payée)

            // Statut de l'échéance
            $table->enum('statut', ['DUE','PAYEE', 'PARTIELLE', 'EN RETARD', 'ANNULEE']);

            $table->string('reference_externe')->nullable(); // Référence externe optionnelle

            $table->timestamps(); // created_at et updated_at

            // Champs d'audit
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition des clés étrangères
            $table->foreign('adhesion_id')->references('id')->on('adhesions')->onDelete('cascade');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('adhesion_id');
            $table->index('statut');
            $table->index('date_limite_paiement');
            $table->index('date_paiement_effective');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
};
