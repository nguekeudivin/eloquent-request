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
        Schema::create('groupe_mutualistes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 255)->unique();
            $table->timestamps();

            $table->string('created_by_user_id', 36)->nullable();
            $table->string('updated_by_user_id', 36)->nullable();

            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupe_mutualistes');
    }
};
