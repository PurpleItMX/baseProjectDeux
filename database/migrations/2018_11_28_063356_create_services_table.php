<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id_service');
            $table->string('clave')->unique();
            $table->string('udm');
            $table->string('description');
            $table->integer('id_service_category')->unsigned();
            $table->integer('id_service_type')->unsigned();
            $table->smallInteger('apportionment');
            $table->string('percentage_apportionment');
            $table->smallInteger('estatus');
            $table->timestamps();

            $table->foreign('id_service_category')->references('id_service_category')->on('service_categories');
            //->onDelete('cascade');
            $table->foreign('id_service_type')->references('id_service_type')->on('service_types');
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
        Schema::dropIfExists('services');
    }
}
