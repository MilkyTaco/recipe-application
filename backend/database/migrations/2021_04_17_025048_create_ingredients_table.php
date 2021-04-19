<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->string('name');
            $table->decimal('amount', 5, 2);
            $table->integer('total_duration');
            $table->string('measuring_instrument');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
