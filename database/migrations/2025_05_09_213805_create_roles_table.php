<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255)->unique();
            $table->string('name', 255)->unique();
            $table->string('description', 255)->nullable();

            $table->timestamps();

            $table->string('created_by_user_id', 36)->nullable();
            $table->string('updated_by_user_id', 36)->nullable();

            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
