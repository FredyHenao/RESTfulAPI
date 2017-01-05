<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vehiculos', function (Blueprint $table) {
            $table->increments('serie');
            $table->string('color');
            $table->float('cilindraje');
            $table->integer('potencia');
            $table->float('peso');
            $table->integer('fabricante_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('tb_vehiculos', function (Blueprint $table) {
            $table->foreign('fabricante_id')->references('id')->on('tb_fabricantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_vehiculos');
    }
}
