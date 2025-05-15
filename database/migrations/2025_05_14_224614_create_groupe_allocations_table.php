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
        Schema::create('groupe_allocation', function (Blueprint $table) {
            // Clés étrangères constituant la clé primaire composite
            // groupe_id est INT (FK vers groupe_mutualistes.id)
            $table->unsignedBigInteger('groupe_id');
            // type_allocation_id est INT (FK vers type_allocations.id)
            $table->unsignedBigInteger('type_allocation_id');

            // Montant spécifique de l'allocation pour ce groupe/type
            $table->decimal('montant', 10, 2);

            $table->timestamps(); // created_at et updated_at pour la liaison

            // Champs d'audit pour la liaison
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_by_user_id')->nullable(); // Typo fixed here

            // Définition de la clé primaire composite
            $table->primary(['groupe_id', 'type_allocation_id']);

            // Définition des clés étrangères
            $table->foreign('groupe_id')->references('id')->on('groupe_mutualistes')->onDelete('cascade');
            $table->foreign('type_allocation_id')->references('id')->on('type_allocations')->onDelete('cascade');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_by_user_id')->references('id')->on('users')->onDelete('set null'); // Typo fixed here

            // Index optionnels sur les champs d'audit
            $table->index('created_by_user_id');
            $table->index('updated_by_by_user_id'); // Typo fixed here
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupe_allocation');
    }
};
