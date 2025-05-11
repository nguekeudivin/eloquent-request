<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->string('id', 36)->primary();

            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->string('service', 255)->nullable();

            $table->timestamps();

            $table->string('created_by_user_id', 36)->nullable();
            $table->string('updated_by_user_id', 36)->nullable();

            $table->foreign('id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
