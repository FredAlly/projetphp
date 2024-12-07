<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnregistrementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enregistrements', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté
            $table->unsignedBigInteger('id_utilisateur'); // ID utilisateur
            $table->unsignedBigInteger('id_film'); // ID film
            $table->string('statut'); // Statut (à voir, vu, en cours, etc.)
            $table->timestamp('date'); // Date
            $table->boolean('efface')->default(0); // Effacé (0 ou 1)
            $table->string('nom_utilisateur'); // Nom de l'utilisateur
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enregistrements_');
    }
}
