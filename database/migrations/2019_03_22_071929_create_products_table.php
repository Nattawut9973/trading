<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('symbol')->nullable();
            $table->double('open')->nullable();
            $table->double('high')->nullable();
            $table->double('low')->nullable();
            $table->double('last')->nullable();
            $table->double('change')->nullable();
            $table->double('percent_change')->nullable();
            $table->double('bid')->nullable();
            $table->double('offer')->nullable();
            $table->double('volumn')->nullable();
            $table->double('value')->nullable();
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
        Schema::drop('products');
    }
}
