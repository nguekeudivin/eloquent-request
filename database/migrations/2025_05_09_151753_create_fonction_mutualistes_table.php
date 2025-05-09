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
        Schema::create('fonction_mutualistes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 255);

            $table->foreignId('groupe_mutualite_id')
                  ->constrained('groupe_mutualistes')
                  ->onDelete('RESTRICT')
                  ->onUpdate('CASCADE');

            $table->timestamps();

            $table->string('created_by_user_id', 36)->nullable();
            $table->string('updated_by_user_id', 36)->nullable();

            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');

            $table->unique(['libelle', 'groupe_mutualiste_id'], 'uk_fonction_groupe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonction_mutualistes');
    }
};
