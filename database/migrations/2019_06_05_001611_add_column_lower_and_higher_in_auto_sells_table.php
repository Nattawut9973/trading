<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLowerAndHigherInAutoSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auto_sells', function (Blueprint $table) {
            $table->renameColumn('price','lower_price');
            $table->decimal('higher_price')->after('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auto_sells', function (Blueprint $table) {
            $table->renameColumn('lower_price','price');
            $table->dropColumn('higher_price');
        });
    }
}
