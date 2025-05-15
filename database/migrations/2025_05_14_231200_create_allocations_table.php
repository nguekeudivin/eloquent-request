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
        Schema::create('allocations', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Clé primaire UUID

            // FK vers mutualistes (qui partagent l'ID de users)
            $table->uuid('mutualiste_id');
            // FK vers type_allocations (INT)
            $table->unsignedBigInteger('type_allocation_id');

            $table->date('date'); // Date à laquelle l'aide a été accordée/demandée
            $table->decimal('montant', 10, 2); // Montant de l'aide
            $table->text('motif'); // Motif ou raison de l'aide

            // Statut de l'aide
            $table->enum('statut', ['ACCORDEE','VERSEE','REFUSEE','ANNULEE']);

            // Admin qui a vérifié/validé l'aide (Nullable)
            $table->uuid('verifiee_par_admin_id')->nullable();
            // Admin qui a enregistré le versement (Nullable)
            $table->uuid('versee_par_admin_id')->nullable();


            $table->timestamps(); // created_at et updated_at

            // Champs d'audit (qui a créé/mis à jour le record dans la DB)
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition des clés étrangères
            $table->foreign('mutualiste_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_allocation_id')->references('id')->on('type_allocations')->onDelete('restrict'); // RESTRICT pour les tables lookup
            $table->foreign('verifiee_par_admin_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('versee_par_admin_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('mutualiste_id');
            $table->index('type_allocation_id');
            $table->index('statut');
            $table->index('date');
            $table->index('verifiee_par_admin_id');
            $table->index('versee_par_admin_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocations');
    }
};
