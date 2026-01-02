<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ajouter un index unique sur le champ titre
        Schema::table('categories', function (Blueprint $table) {
            // Éviter l'échec si l'index existe déjà
            $table->unique('titre');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['titre']);
        });
    }
};
