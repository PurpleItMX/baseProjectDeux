<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id_recipe');
            $table->string('clave')->unique();
            $table->string('description');
            $table->string('udm');
            $table->float('cost_sale',8,2);
            $table->float('expenditure_operative',8,2);
            $table->float('margen_actually',8,2);
            $table->float('margen_category',8,2);
            $table->float('price_sale',8,2);
            $table->float('utility',8,2);
            $table->float('iva',8,2);
            $table->float('import_iva',8,2);
            $table->float('price_sale_iva',8,2);
            $table->float('quantity_sale',8,2);
            $table->float('production_cost',8,2);
            $table->float('quantity_sell',8,2);
            $table->float('cost_projection',8,2);
            $table->smallInteger('estatus');
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
        Schema::dropIfExists('recipes');
    }
}
