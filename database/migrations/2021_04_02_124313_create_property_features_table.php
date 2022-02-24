<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->integer('bedrooms')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('bedrooms_comment')->nullable()->default(0);
            $table->integer('bathrooms')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('bathrooms_comment')->nullable()->default(0);
            $table->integer('study_room')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('study_room_comment')->nullable()->default(0);
            $table->integer('dinning_room')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('dinning_room_comment')->nullable()->default(0);
            $table->integer('carports')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('carports_comment')->nullable()->default(0);
            $table->integer('kitchens')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('kitchens_comment')->nullable()->default(0);
            $table->integer('garages')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('garages_comment')->nullable()->default(0);
            $table->integer('flooring')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('flooring_type')->nullable()->default(0);
            $table->integer('laundry')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('laundry_comment')->nullable()->default(0);
            $table->integer('balcony')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('balcony_comment')->nullable()->default(0);
            $table->integer('pool')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('pool_comment')->nullable()->default(0);
            $table->integer('garden')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('garden_comment')->nullable()->default(0);
            $table->integer('views')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('views_comment')->nullable()->default(0);
            $table->integer('security')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('security_comment')->nullable()->default(0);
            $table->integer('store_room')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('store_room_comment')->nullable()->default(0);
            $table->integer('lounges')->nullable()->default(0)->comment('0=no,1=yes');
            $table->string('lounges_comment')->nullable()->default(0);
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
        Schema::dropIfExists('property_features');
    }
}
