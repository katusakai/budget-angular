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

        Schema::table('category', function (Blueprint $table) {
            $table->unique('name');
        });

        Schema::table('sub_category', function (Blueprint $table) {
            $table->unique(['category_id', 'name']);
        });

        Schema::table('money_transaction', function (Blueprint $table) {
            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('money_transaction', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'created_at']);
        });

        Schema::table('sub_category', function (Blueprint $table) {
            $table->dropUnique(['category_id', 'name']);
        });

        Schema::table('category', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });

        Schema::rename('money_transaction', 'money_flows');
        Schema::rename( 'category', 'categories');
        Schema::rename('sub_category','sub_categories');
        Schema::rename('configuration', 'configurations');
    }
}
