<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id_product_type');
            $table->string('clave')->unique();
            $table->string('description');
            $table->integer('id_product_category')->unsigned();
            $table->smallInteger('estatus');
            $table->timestamps();

            $table->foreign('id_product_category')->references('id_product_category')->on('product_categories');

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
        Schema::dropIfExists('product_types');
    }
}
