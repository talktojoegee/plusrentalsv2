<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->tinyInteger('account_type');
            $table->tinyInteger('bank')->default(0)->comment('0=not bank, 1=bank');
            $table->unsignedBigInteger('glcode');
            $table->unsignedBigInteger('parent_account')->nullable();
            $table->tinyInteger('type')->default(0)->comment('1=General, 2=Detail');
            $table->timestamps();
            $table->unsignedBigInteger('company_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_chart_of_accounts');
    }
}
