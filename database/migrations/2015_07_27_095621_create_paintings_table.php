<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaintingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paintings',function($table)
        {
            $table->increments('id');
            $table->boolean('isFinished');
            $table->string('theme');
            $table->integer('tileNumber');
            $table->integer('tilesDone');
            $table->string('url');

        });
            // isFinished is if the

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paintings');
    }
}
