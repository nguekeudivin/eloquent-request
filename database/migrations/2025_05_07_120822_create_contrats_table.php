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
        Schema::create('contrats', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Clé primaire UUID
            $table->string('nom')->unique(); // Nom unique
            $table->text('description')->nullable();
            $table->date('date_debut_validite');
            $table->date('date_fin_validite')->nullable();
            $table->decimal('montant_cotisation_base', 10, 2);
            $table->decimal('montant_adhesion', 10, 2);
            $table->enum('periode_cotisation', ['MENSUEL', 'TRIMESTRIEL', 'ANNUEL']);
            $table->boolean('est_actif')->default(true);
            $table->timestamps(); // created_at et updated_at

            // Champs d'audit (UUID si l'utilisateur a un UUID)
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition des clés étrangères pour les champs d'audit
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
             $table->index('date_debut_validite');
             $table->index('date_fin_validite');
             $table->index('est_actif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
