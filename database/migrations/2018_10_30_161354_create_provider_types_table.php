<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_types', function (Blueprint $table) {
            $table->increments('id_provider_type');
            $table->string('clave')->unique();
            $table->string('description');
            $table->integer('id_provider_category')->unsigned();
            $table->smallInteger('estatus');
            $table->timestamps();

            $table->foreign('id_provider_category')->references('id_provider_category')->on('provider_categories');
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
        Schema::dropIfExists('provider_types');
    }
}
