<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Recipe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->foreignId('ingredients_id')->constrained('ingredients');
            $table->foreignId('steps_id')->constrained('steps');
            $table->string('title');
            $table->string('description');
            $table->integer('total_duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe');
    }
}
