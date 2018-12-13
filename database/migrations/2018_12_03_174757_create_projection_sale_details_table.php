<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectionSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projection_sale_details', function (Blueprint $table) {
            $table->increments('id_projection_sale_detail');
            $table->integer('id_projection_sale')->unsigned();
            $table->integer('id_supply')->unsigned();
            $table->string('quantity_sold');
            $table->string('quantity_proyec');
            $table->string('price_sale');
            $table->string('price_proyec');
            $table->string('price_without_taxes');
            $table->string('entry');
            $table->string('entry_proyec');
            $table->string('cost');
            $table->string('cost_proyec');
            $table->string('cost_percent_proyec');
            $table->string('cost_total_proyec');
            $table->string('expense_proyec');
            $table->string('utility_proyec');
            $table->string('utility_total_proyec');
            $table->timestamps();

            $table->foreign('id_projection_sale')->references('id_projection_sale')->on('projection_sales');
            //->onDelete('cascade');
            $table->foreign('id_supply')->references('id_supply')->on('supplies');
            //->onDelete('cascade');
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
        Schema::dropIfExists('projection_sale_details');
    }
}
