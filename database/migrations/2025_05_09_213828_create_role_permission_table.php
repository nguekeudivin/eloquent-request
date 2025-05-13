<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');

            $table->primary(['role_id', 'permission_id']);

            $table->timestamps();

            $table->string('created_by_user_id', 36)->nullable();
            $table->string('updated_by_user_id', 36)->nullable();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');

            $table->index('permission_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
