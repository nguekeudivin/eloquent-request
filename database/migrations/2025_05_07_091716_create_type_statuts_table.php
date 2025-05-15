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
        Schema::create('status_types', function (Blueprint $table) {
            $table->id();
            $table->string('code_interne', 50)->unique();
            $table->string('libelle', 100);
            $table->string('description', 255)->nullable();
            $table->string('contexte', 100);
            $table->string('couleur_hex', 7)->nullable();
            $table->integer('ordre_affichage')->default(0);

            $table->timestamps();

            $table->string('created_by_user_id', 36)->nullable();
            $table->string('updated_by_user_id', 36)->nullable();

            $table->unique(['code_interne', 'contexte'], 'uk_code_contexte');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_types');
    }
};
