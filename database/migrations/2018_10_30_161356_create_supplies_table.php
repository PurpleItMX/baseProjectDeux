<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->increments('id_supply');
            $table->string('clave')->unique();
            $table->string('description');
            $table->string('udm');
            $table->Integer('id_supply_category');
            $table->Integer('id_supply_type');
            $table->Integer('id_season');
            $table->string('tolerance');
            $table->string('stock_fixed');
            $table->string('stock_variable');
            $table->string('minimal_presentation');
            $table->smallInteger('is_inventorial'); //si es inventariable
            $table->smallInteger('is_product'); //si es producto
            $table->smallInteger('is_auditable'); //si es auditable
            $table->smallInteger('is_direct_purchase'); //si es compra directa
            $table->smallInteger('type'); //si es copeo producto unico o venta directa
            $table->smallInteger('estatus');
            $table->Integer('id_provider_primary');
            $table->Integer('id_provider_second');
            $table->Integer('id_provider_third');
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
        Schema::dropIfExists('supplies');
    }
}
