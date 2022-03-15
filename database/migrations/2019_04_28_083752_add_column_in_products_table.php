<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('open')->after('symbol')->nullable();
            $table->string('high')->after('open')->nullable();
            $table->string('low')->after('high')->nullable();
            $table->string('last')->after('low')->nullable();
            $table->string('change')->after('last')->nullable();
            $table->string('percent_change')->after('change')->nullable();
            $table->string('bid')->after('percent_change')->nullable();
            $table->string('offer')->after('bid')->nullable();
            $table->string('volumn')->after('offer')->nullable();
            $table->string('value')->after('volumn')->nullable();
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
}
