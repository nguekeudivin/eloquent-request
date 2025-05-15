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
        Schema::create('remboursements', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Clé primaire UUID

            // FK vers prise_en_charges (UUID) avec contrainte d'unicité
            $table->uuid('prise_en_charge_id')->unique();

            // FK vers modalite_remboursements (INT)
            $table->unsignedBigInteger('modalite_remboursement_id')->nullable(); // Rendre nullable si une modalité n'est pas toujours associée

            $table->date('date_paiement'); // Date à laquelle le paiement a été effectué
            $table->decimal('montant_paye', 10, 2); // Montant effectivement payé

            // Mode de paiement (Enum)
            $table->enum('mode_paiement', ['VIREMENT BANCAIRE', 'CHEQUE', 'ESPECES CAISSE'] );

            $table->string('reference_transaction')->nullable(); // Référence de la transaction

            // Admin qui a enregistré/initié le paiement
            $table->uuid('paye_par_admin_id');

            $table->timestamps(); // created_at et updated_at

            // Champs d'audit (qui a créé/mis à jour le record dans la DB)
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('updated_by_user_id')->nullable();

            // Définition des clés étrangères
            $table->foreign('prise_en_charge_id')->references('id')->on('prise_en_charges')->onDelete('restrict'); // RESTRICT si le remboursement ne peut pas être supprimé si la prise en charge existe
            $table->foreign('modalite_remboursement_id')->references('id')->on('modalite_remboursements')->onDelete('set null'); // SET NULL si la modalité est supprimée
            $table->foreign('paye_par_admin_id')->references('id')->on('users')->onDelete('restrict'); // RESTRICT si l'admin payeur doit exister
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');

            // Index optionnels
            $table->index('date_paiement');
            $table->index('mode_paiement');
            $table->index('paye_par_admin_id');
            $table->index('modalite_remboursement_id');
            $table->index('created_by_user_id');
            $table->index('updated_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remboursements');
    }
};
