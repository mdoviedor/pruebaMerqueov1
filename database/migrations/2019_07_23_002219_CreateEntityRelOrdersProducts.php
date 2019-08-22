<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityRelOrdersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relOrdersProducts', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('idOrder')->unsigned();
            $table->integer('idProduct');
            $table->string('nameProduct', 120);
            $table->integer('quantity')->default(0);

            #relacion tablas
            $table->foreign('idOrder', 'fk_relOrderProductsFtOrders')
                ->references('id')->on('orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('relOrdersProducts', function (Blueprint $table) {
            $table->dropForeign('fk_relOrderProductsFtOrders');
        });

        Schema::dropIfExists('relOrdersProducts');
    }
}
