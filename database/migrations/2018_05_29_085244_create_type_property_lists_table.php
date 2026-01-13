<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypePropertyListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_property_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('opt1');
            $table->integer('opt2');
            $table->integer('opt3');
            $table->integer('opt4');
            $table->integer('opt5');
            $table->integer('opt6');
            $table->integer('opt7');
            $table->integer('opt8');
            $table->integer('opt9');
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
        Schema::dropIfExists('type_property_lists');
    }
}
