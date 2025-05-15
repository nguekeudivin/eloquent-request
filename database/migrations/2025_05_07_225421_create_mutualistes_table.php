<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mutualistes', function (Blueprint $table) {
            $table->string('id', 36)->primary(); // Clé primaire UUID (définie comme string)

            $table->string('numero_adherent', 255)->unique();
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->date('date_naissance');
            $table->string('lieu_naissance', 255)->nullable();
            $table->enum('sexe', ['MASCULIN','FEMININ'])->nullable();
            $table->text('adresse')->nullable();
            $table->string('telephone', 255)->nullable();
            $table->date('date_premiere_adhesion');
            $table->unsignedBigInteger('fonction_mutualiste_id');
            $table->string('profession');
            $table->timestamps(); // created_at et updated_at

            $table->string('created_by_user_id', 36)->nullable();
            $table->string('updated_by_user_id', 36)->nullable();

            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mutualistes');
    }
};
