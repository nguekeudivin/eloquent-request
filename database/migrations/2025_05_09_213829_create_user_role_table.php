<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->string('user_id', 36);
            $table->unsignedBigInteger('role_id');

            $table->primary(['user_id', 'role_id']);

            $table->timestamps();

            $table->string('created_by_user_id', 36)->nullable();
            $table->string('updated_by_user_id', 36)->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('RESTRICT')->onUpdate('CASCADE');

            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');

            $table->index('role_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_role');
    }
};
