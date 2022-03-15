<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('open');
            $table->dropColumn('high');
            $table->dropColumn('low');
            $table->dropColumn('last');
            $table->dropColumn('change');
            $table->dropColumn('percent_change');
            $table->dropColumn('bid');
            $table->dropColumn('offer');
            $table->dropColumn('volumn');
            $table->dropColumn('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
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
        });
    }
}
