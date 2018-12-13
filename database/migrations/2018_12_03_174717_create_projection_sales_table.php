<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectionSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projection_sales', function (Blueprint $table) {
            $table->increments('id_projection_sale');
            $table->string('folio')->unique();
            $table->string('date_initial');
            $table->string('date_end');
            $table->string('sale_sa');
            $table->string('cost_sa');
            $table->string('sale_proj');
            $table->string('cost_proj');
            $table->string('variation');
            $table->string('estatus');
            $table->string('autorization');
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
        Schema::dropIfExists('projection_sales');
    }
}

