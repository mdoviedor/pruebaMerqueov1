<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityProductOutOfInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productsOutOfInventory', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 120);
            $table->string('description', 190);
            $table->integer('stock');

            $table->integer('idProvider')->unsigned();

            #relacion tablas
            $table->foreign('idProvider', 'fk_productsOutInventoryFtProfiders')
                ->references('id')->on('providers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productsOutOfInventory', function (Blueprint $table) {
            $table->dropForeign('fk_productsOutInventoryFtProfiders');
        });

        Schema::dropIfExists('productsOutOfInventory');
    }
}
