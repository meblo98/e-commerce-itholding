<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropForeign(['marque_id']);
        });

        DB::statement('ALTER TABLE produits MODIFY marque_id BIGINT UNSIGNED NULL');

        Schema::table('produits', function (Blueprint $table) {
            $table->foreign('marque_id')
                ->references('id')
                ->on('marques')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropForeign(['marque_id']);
        });

        $fallbackMarqueId = DB::table('marques')->min('id');
        if ($fallbackMarqueId) {
            DB::table('produits')->whereNull('marque_id')->update(['marque_id' => $fallbackMarqueId]);
        } else {
            DB::table('produits')->whereNull('marque_id')->delete();
        }

        DB::statement('ALTER TABLE produits MODIFY marque_id BIGINT UNSIGNED NOT NULL');

        Schema::table('produits', function (Blueprint $table) {
            $table->foreign('marque_id')
                ->references('id')
                ->on('marques')
                ->onDelete('cascade');
        });
    }
};
