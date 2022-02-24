<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsPropertyFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_features', function (Blueprint $table) {
            $table->tinyInteger('wifi')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('washer')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('tv_cable')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('refrigerator')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('dryer')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('lawn')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('microwave')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('air_condition')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('gym')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('swimming_pool')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('fire_alarm')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('central_heating')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('window_covering')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('home_theatre')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('emergency_exit')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('onsite_parking')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('elevator')->default(0)->comment('0=no, 1=yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
