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
        Schema::create('type_allocations', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('libelle')->unique(); // Libellé unique
            $table->decimal('montant_standard', 10, 2); // Montant par défaut
            $table->decimal('montant_max', 10, 2); // Montant maximal
            $table->decimal('montant_min', 10, 2); // Montant minimal

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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_allocations');
    }
};
