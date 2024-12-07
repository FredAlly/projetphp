<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDateColumnInEnregistrementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enregistrements', function (Blueprint $table) {
            // Modifie la colonne 'date' pour qu'elle soit nullable
            $table->date('date')->nullable()->change();
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
            // Revenir à l'état précédent, vous pouvez rendre la colonne nullable si nécessaire
            $table->date('date')->nullable(false)->change();
        });
    }
}
