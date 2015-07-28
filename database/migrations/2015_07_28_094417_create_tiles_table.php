<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiles',function($table)
        {
            $table->increments('id');
            $table->boolean('isLocked');
            $table->string('url');
            $table->integer('x');
            $table->integer('y');
            $table->integer('painting_id')->unsigned();
            $table->foreign('painting_id')->references('id')->on('paintings');


        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('tiles', function($table){
            $table->dropForeign('tiles_painting_id_foreign');
        });
    }
}
