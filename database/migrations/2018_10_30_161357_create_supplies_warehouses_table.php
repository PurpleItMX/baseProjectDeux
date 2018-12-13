<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies_warehouses', function (Blueprint $table) {
            $table->increments('id_supply_warehouse');
            $table->integer('id_warehouse')->unsigned();
            $table->integer('id_supply')->unsigned();
            $table->string('percent');
            $table->timestamps();
            //$table->primary(['id_warehouse', 'id_supply']);

            $table->foreign('id_warehouse')->references('id_warehouse')->on('warehouses');
            $table->foreign('id_supply')->references('id_supply')->on('supplies');

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
        Schema::dropIfExists('supplies_warehouses');
    }
}
