<?php

use App\Tools\Temporary\MoneyAmountMigrator;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->moneyAmountMigrator = new MoneyAmountMigrator();

        $this->moneyAmountMigrator->ExportToJson();;

        Schema::table('money_flows', function (Blueprint $table) {
            $table->string('amount', 255)->nullable()->change();
        });

        $this->moneyAmountMigrator->ClearAmountFromTable();

        Schema::table('money_flows', function (Blueprint $table) {
            $table->decimal('amount')->nullable()->charset(null)->change();
        });


        $data = $this->moneyAmountMigrator->GetFromJsonFile();

        $this->moneyAmountMigrator->FillDataToTable($data);

        Schema::table('money_flows', function (Blueprint $table) {
            $table->decimal('amount')->nullable(false)->change();
        });

        $this->moneyAmountMigrator->DeleteFile();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('money_flows', function (Blueprint $table) {
            $table->string('amount', 255)->nullable(false)->change();
        });
    }
}
