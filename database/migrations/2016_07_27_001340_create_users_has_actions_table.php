<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUsersHasActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_has_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('action_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users_has_actions', function (Blueprint $table) {
            $table->unique(array('user_id', 'action_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_has_actions', function (Blueprint $table) {
            $table->dropUnique(array('user_id', 'action_id'));
        });

        Schema::drop('users_has_actions');
    }
}
