<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubrecipeSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subrecipe_supplies', function (Blueprint $table) {
            $table->increments('id_subrecipe_supply');
            $table->integer('id_subrecipe')->unsigned();
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
            $table->string('production_required');
            $table->timestamps();

            $table->foreign('id_supply')->references('id_supply')->on('supplies');
            $table->foreign('id_subrecipe')->references('id_subrecipe')->on('subrecipes');

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
        Schema::dropIfExists('subrecipe_supplies');
    }
}
