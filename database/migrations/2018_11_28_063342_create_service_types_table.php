<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_types', function (Blueprint $table) {
            $table->increments('id_service_type');
            $table->string('clave')->unique();
            $table->string('description');
            $table->integer('id_service_category')->unsigned();
            $table->smallInteger('estatus');
            $table->timestamps();

            $table->foreign('id_service_category')->references('id_service_category')->on('service_categories');
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
        Schema::dropIfExists('service_types');
    }
}
