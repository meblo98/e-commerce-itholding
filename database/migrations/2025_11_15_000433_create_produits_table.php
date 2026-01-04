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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->longText('description');
            $table->string("image");
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('marque_id')->nullable();
            $table->decimal('prix', 12, 2)->default(0);
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('marque_id')->references('id')->on('marques')->onDelete('cascade');
            $table->boolean('active')->default(true);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
