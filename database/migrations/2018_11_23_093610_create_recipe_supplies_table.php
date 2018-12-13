<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_supplies', function (Blueprint $table) {
            $table->increments('id_recipe_supply');
            $table->integer('id_recipe')->unsigned();
            $table->integer('id_supply')->unsigned();
            $table->string('clave')->unique();
            $table->string('description');
            $table->string('unity');
            $table->string('cost');
            $table->string('gr_recipe');
            $table->string('performance');
            $table->string('gr_neto');
            $table->string('cost_supply');
            $table->string('quantity_occupy');
            $table->string('cost_total');
            $table->timestamps();

            $table->foreign('id_supply')->references('id_supply')->on('supplies');
            $table->foreign('id_recipe')->references('id_recipe')->on('recipes');

        Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_supplies');
    }
}
