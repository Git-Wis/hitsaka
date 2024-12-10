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
        Schema::create('depense_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du type de dépense
            $table->text('description')->nullable(); // Description facultative
            $table->timestamps();
        });

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depense_types');
    }
};
