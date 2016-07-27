<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->text('description');
            $table->string('equipment', 80);
            $table->timestamp('begin');
            $table->timestamps('deadline');
            $table->timestamp('deadline2');
            $table->boolean('deadline2_requested');
            $table->boolean('deadline2_authorized');
            $table->integer('failure_analysis_id')->unsigned();
        });

        Schema::table('action', function (Blueprint $table) {
            $table->foreign('failure_analysis_id')->references('id')->on('failure_analyses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action', function (Blueprint $table) {
            $table->dropForeign(['failure_analysis_id']);
        });

        Schema::drop('actions');
    }
}
