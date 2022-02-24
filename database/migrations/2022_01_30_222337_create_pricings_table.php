<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->double('file_storage')->nullable()->comment('Amount allocated')->default(50000);
            $table->tinyInteger('report')->nullable()->default(1)->comment('1=yes,2=no');
            $table->tinyInteger('sms')->comment('1=yes,2=no')->default(1);
            $table->string('max_no_prop')->comment('Max. # of properties: N-A || N-M')->default('5-M');
            $table->tinyInteger('rent_payment')->default(1)->comment('1=both,2=offline,3=online');
            $table->tinyInteger('accounting')->default(2)->comment('1=yes,2=no');
            $table->tinyInteger('max_no_team')->default(5)->comment('Max. # of team members');
            $table->tinyInteger('online_app')->default(1)->comment('Online lease application: 1=yes,2=no');
            $table->tinyInteger('tenant_screening')->default(1)->comment('1=yes,2=no');
            $table->tinyInteger('property_inspection')->default(1)->comment('1=yes,2=no');
            $table->tinyInteger('tenant_portal')->default(1)->comment('1=yes,2=no');
            $table->tinyInteger('marketplace_listing')->default(1)->comment('1=yes,2=no');
            $table->tinyInteger('manager_portal')->default(1)->comment('1=yes,2=no');
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
        Schema::dropIfExists('pricings');
    }
}
