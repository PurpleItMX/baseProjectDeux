<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubrecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subrecipes', function (Blueprint $table) {
            $table->increments('id_subrecipe');
            $table->string('clave')->unique();
            $table->string('description');
            $table->string('udm');
             $table->string('unit_cost')->nullable();
            $table->string('performance')->nullable();
            $table->string('recipe_cost')->nullable();
            $table->string('previous_production_week')->nullable();
            $table->string('quantity_produce')->nullable();
            $table->smallInteger('estatus');
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
        Schema::dropIfExists('subrecipes');
    }
}
