<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id_provider');
            $table->string('clave')->unique();
            $table->string('rfc')->unique();
            $table->string('name')->unique();
            $table->string('name_commercial')->unique();
            $table->smallInteger('type'); // si es persona fisica persona moral extrangero o proveedor general
            $table->string('street');
            $table->string('number_ext');
            $table->string('number_int')->nullable();
            $table->string('colony');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip_code');
            $table->integer('phone')->nullable();
            $table->string('email')->unique();
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
        Schema::dropIfExists('providers');
    }
}
