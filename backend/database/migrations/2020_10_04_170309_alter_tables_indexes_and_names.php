<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesIndexesAndNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('money_flows', 'money_transaction');
        Schema::rename('categories', 'category');
        Schema::rename('sub_categories', 'sub_category');
        Schema::rename('configurations', 'configuration');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('money_transaction', 'money_flows');
        Schema::rename( 'category', 'categories');
        Schema::rename('sub_category','sub_categories');
        Schema::rename('configuration', 'configurations');
    }
}
