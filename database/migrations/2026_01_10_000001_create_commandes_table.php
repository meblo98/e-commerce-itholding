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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_commande')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            
            // Informations client (pour les commandes sans compte)
            $table->string('nom_client')->nullable();
            $table->string('email_client')->nullable();
            $table->string('telephone_client')->nullable();
            $table->text('adresse_livraison')->nullable();
            
            // Montants
            $table->decimal('sous_total', 10, 2);
            $table->decimal('frais_livraison', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            
            // Statut et suivi
            $table->enum('statut', ['en_attente', 'confirmee', 'en_preparation', 'expediee', 'livree', 'annulee'])->default('en_attente');
            $table->enum('statut_paiement', ['en_attente', 'paye', 'echoue'])->default('en_attente');
            $table->string('methode_paiement')->nullable();
            
            // Tracking
            $table->string('numero_tracking')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
