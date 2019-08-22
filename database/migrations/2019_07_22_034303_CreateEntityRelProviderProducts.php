<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityRelProviderProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relProviderProducts', function (Blueprint $table) {

            $table->integer('idProvider')->unsigned();
            $table->integer('idProduct')->unsigned();
            $table->integer('backUpStock');

            $table->primary(['idProvider', 'idProduct']);

            #relacion tablas
            $table->foreign('idProvider', 'fk_relProviders')
                ->references('id')->on('providers')->onDelete('cascade');

            $table->foreign('idProduct', 'fk_relProducts')
                ->references('id')->on('products')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relProviderProducts', function (Blueprint $table) {
            $table->dropForeign('fk_relProviders');
            $table->dropForeign('fk_relProducts');
        });

        Schema::dropIfExists('relProviderProducts');
    }
}
