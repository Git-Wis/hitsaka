<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idClient')->constrained('passages')->onDelete('cascade');
            $table->foreignId('idVoyage')->constrained('voyages')->onDelete('cascade');
            $table->date('date');
            $table->string('direction');
            $table->boolean('payer')->default(false); // Valeur par défaut
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
