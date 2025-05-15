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
        Schema::create('modalite_remboursements', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('type_prestation_id');
            $table->unsignedBigInteger('type_ayant_droit_id');

            $table->decimal('taux_hopital_public', 5, 2); // Pourcentage (ex: 75.50)
            $table->decimal('taux_hopital_prive', 5, 2); // Pourcentage (ex: 50.00)

            $table->timestamps();

            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Unicité composite : une seule modalité par combinaison type prestation / type ayant droit
            $table->unique(['type_prestation_id', 'type_ayant_droit_id'], 'modalite_unique');

            // Définition des clés étrangères
            $table->foreign('type_prestation_id')->references('id')->on('type_prestations')->onDelete('restrict');
            $table->foreign('type_ayant_droit_id')->references('id')->on('type_ayant_droits')->onDelete('restrict');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('type_prestation_id');
            $table->index('type_ayant_droit_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modalite_remboursements');
    }
};
