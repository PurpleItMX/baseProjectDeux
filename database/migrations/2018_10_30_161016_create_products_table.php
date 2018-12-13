<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id_product');
            $table->string('clave')->unique();
            $table->string('description');
            $table->string('udm')->nullable();
            $table->string('company');
            $table->integer('id_product_type')->unsigned()->nullable();
            $table->integer('id_product_category')->unsigned()->nullable();
            $table->float('price_sale',8,2);
            $table->float('margen_category',8,2)->nullable();
            $table->float('margen_actually',8,2)->nullable();
            $table->float('cost_sale',8,2)->nullable();
            $table->float('expenditure_operative',8,2)->nullable();
            $table->float('utility',8,2)->nullable();
            $table->string('iva')->nullable();
            $table->float('import_iva',8,2);
            $table->float('price_sale_iva',8,2);
            $table->smallInteger('estatus')->default(1);;
            $table->timestamps();

            $table->foreign('id_product_category')->references('id_product_category')->on('product_categories');
            $table->foreign('id_product_type')->references('id_product_type')->on('product_types');

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
        Schema::dropIfExists('products');
    }
}
