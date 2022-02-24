<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_owner_id')->nullable()->comment('The owner of the property');
            $table->unsignedBigInteger('added_by');
            $table->string('unit_no')->nullable();
            $table->string('property_name')->nullable();
            $table->text('description')->nullable();
            $table->integer('location_id');
            $table->integer('area_id');
            $table->integer('property_type');
            $table->string('address')->nullable();
            $table->integer('frequency')->default(1);
            $table->double('rental_price')->default(0);
            $table->double('status')->default(0)->comment('0=undecided,1=pending,2=expired,3=cancelled,4=active,5=sold,6=withdrawn,7=rented,8=terminated,9=conditionally terminated');
            $table->tinyInteger('listing_type')->default(1)->nullable()->comment('1=For rent, 2=For sale');
            $table->double('security_deposit')->default(0)->nullable();
            $table->double('late_fee')->default(0)->nullable();
            $table->double('current_valuation')->default(0)->nullable();
            $table->double('purchase_price')->default(0)->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->unsignedBigInteger('property_account');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('allocated_to')->default(0)->nullable();
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
        Schema::dropIfExists('properties');
    }
}
