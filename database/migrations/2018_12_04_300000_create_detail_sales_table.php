<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sales', function (Blueprint $table) {
            $table->increments('id_detail_sales')->index();
            $table->string('date');
            $table->string('week');
            $table->string('month');
            $table->string('year');
            $table->string('week_day');
            $table->string('week_number');
            $table->string('month_name');
            $table->string('day_number');
            $table->string('season');
            $table->string('company');
            $table->string('region');
            $table->string('zone');
            $table->string('waiter');
            $table->string('section_restaurant');
            $table->string('command_type');
            $table->string('time');
            $table->string('time_grouper');
            $table->string('clave_product');
            $table->string('dish');
            $table->string('group_dish');
            $table->string('group_menu');
            $table->string('type_dish');
            $table->string('ticket');
            $table->string('modified');
            $table->string('total_sale');
            $table->string('discounts');
            $table->string('gross_sales');
            $table->string('taxes');
            $table->string('taxes_discounts');
            $table->string('taxes_gross');
            $table->string('sales_net');
            $table->string('cost_sales');
            $table->string('unity_sales');
            $table->string('back_sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_sales');
    }
}
