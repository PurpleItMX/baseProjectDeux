<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id_sales')->index();
            $table->string('date');
            $table->string('week');
            $table->string('table');
            $table->string('year');
            $table->string('company');
            $table->string('waiter');
            $table->string('section_restaurant');
            $table->string('command_type');
            $table->string('time');
            $table->string('region');
            $table->string('zone');
            $table->string('time_grouper');
            $table->string('week_number');
            $table->string('week_day');
            $table->string('month_name');
            $table->string('season');
            $table->string('day_number');
            $table->string('ticket');
            $table->string('command_number');
            $table->string('tickets_number');
            $table->string('tables_number');
            $table->string('diners');
            $table->string('tips');
            $table->string('total_sale');
            $table->string('discounts');
            $table->string('gross_sales');
            $table->string('taxes');
            $table->string('taxes_discounts');
            $table->string('taxes_gross');
            $table->string('sales_net');
            $table->string('cost_sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
