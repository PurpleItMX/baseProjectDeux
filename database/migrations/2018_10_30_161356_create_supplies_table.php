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
            $table->Integer('id_supply_category')->unsigned();
            $table->Integer('id_supply_type')->unsigned();
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
            $table->Integer('id_provider_primary')->unsigned();
            $table->Integer('id_provider_second')->unsigned();
            $table->Integer('id_provider_third')->unsigned();
            $table->timestamps();

            $table->foreign('id_supply_category')->references('id_supply_category')->on('supply_categories')->onDelete('cascade');
            $table->foreign('id_supply_type')->references('id_supply_type')->on('supply_types')->onDelete('cascade');
            $table->foreign('id_provider_primary')->references('id_provider')->on('providers')->onDelete('cascade');
            $table->foreign('id_provider_second')->references('id_provider')->on('providers')->onDelete('cascade');
            $table->foreign('id_provider_third')->references('id_provider')->on('providers')->onDelete('cascade');
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
