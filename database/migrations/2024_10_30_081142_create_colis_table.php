<?php

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
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->string('num_colis')->unique();
            $table->foreignId('id_expe')->constrained('expeditaires')->onDelete('cascade');
            $table->foreignId('id_dest')->constrained('destinataires')->onDelete('cascade');
            $table->integer('updated_bye')->default(0);
            $table->string('direction');
            $table->decimal('poids', 8, 2);
            $table->string('type');
            $table->date('date_envoi');
            $table->string('statut')->default('Deposé');
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
        Schema::dropIfExists('colis');
    }
};
