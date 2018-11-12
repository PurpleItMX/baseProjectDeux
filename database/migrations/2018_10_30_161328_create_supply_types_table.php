<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_types', function (Blueprint $table) {
            $table->increments('id_supply_type');
            $table->string('clave')->unique();
            $table->string('description');
            $table->integer('id_supply_category')->unsigned();
            $table->smallInteger('estatus');
            $table->timestamps();

            $table->foreign('id_supply_category')->references('id_supply_category')->on('supply_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supply_types');
    }
}
