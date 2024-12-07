<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRoleDefaultInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('USER')->change(); // Change the default value to 'USER'
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->change(); // Revert back to 'user'
        });
    }
}
