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
        Schema::create('conversation_participant', function (Blueprint $table) {
            // Clés étrangères constituant la clé primaire composite
            $table->uuid('conversation_id');
            $table->uuid('user_id');

            $table->dateTime('date_jointure');
            $table->boolean('est_actif')->default(true);

            $table->timestamps();

            // Définition de la clé primaire composite
            $table->primary(['conversation_id', 'user_id']);

            // Définition des clés étrangères
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Index optionnels
            $table->index('date_jointure');
            $table->index('est_actif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_participant');
    }
};
