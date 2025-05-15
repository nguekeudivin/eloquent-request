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
        Schema::create('restriction_prestations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('mutualiste_id');
            $table->unsignedBigInteger('type_prestation_id');

            $table->date('date_expiration')->nullable();

            $table->timestamps();

            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            $table->unique(['mutualiste_id', 'type_prestation_id'], 'mutualiste_prestation_unique');

            $table->foreign('mutualiste_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_prestation_id')->references('id')->on('type_prestations')->onDelete('restrict');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            $table->index('mutualiste_id');
            $table->index('type_prestation_id');
            $table->index('date_expiration');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restriction_prestations');
    }
};
