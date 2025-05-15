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
        Schema::create('prestations', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée (Integer)
            $table->string('nom')->unique(); // Nom unique
            $table->text('description')->nullable(); // Description optionnelle
            $table->string('code_interne')->nullable()->unique(); // Code interne unique optionnel
            $table->decimal('montant_reference', 10, 2)->nullable(); // Montant de référence optionnel
            $table->boolean('est_active')->default(true); // Statut d'activité

            // FK vers type_prestations (INT) - Assumant TypePrestation a un ID INT
            $table->unsignedBigInteger('type_prestation_id')->nullable();

            $table->timestamps(); // created_at et updated_at

            // Champs d'audit (UUID si l'utilisateur a un UUID)
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition des clés étrangères
            $table->foreign('type_prestation_id')->references('id')->on('type_prestations')->onDelete('set null'); // SET NULL si le type est supprimé
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('code_interne');
            $table->index('est_active');
            $table->index('type_prestation_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestations');
    }
};
