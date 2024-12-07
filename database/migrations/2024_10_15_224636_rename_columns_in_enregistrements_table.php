<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsInEnregistrementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enregistrements', function (Blueprint $table) {
            $table->renameColumn('id_utilisateur', 'utilisateur_id');
            $table->renameColumn('id_film', 'film_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enregistrements', function (Blueprint $table) {
            $table->renameColumn('utilisateur_id', 'id_utilisateur');
            $table->renameColumn('film_id', 'id_film');
        });
    }
}
