<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesForSoftDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('deleted');
            $table->softDeletes();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn('deleted');
            $table->softDeletes();
        });

        Schema::table('money_flows', function (Blueprint $table) {
            $table->dropColumn('deleted');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->tinyInteger('deleted')->default(0);
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropSoftDeletes();;
            $table->tinyInteger('deleted')->default(0);
        });

        Schema::table('money_flows', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->tinyInteger('deleted')->default(0);
        });
    }
}
