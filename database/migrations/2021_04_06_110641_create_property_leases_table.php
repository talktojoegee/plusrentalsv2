<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_leases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_id')->comment('refers to tenant/person renting');
            $table->unsignedBigInteger('property_id');
            $table->integer('lease_frequency_id')->nullable();
            $table->double('rent_amount')->default(0)->nullable();
            $table->double('security_fee')->default(0)->nullable();
            $table->tinyInteger('terms_and_conditions')->default(1)->comment('1=accept,0=declined');
            $table->tinyInteger('status')->default(0)->comment('0=prospect, 1=renting, 2=expired, 3=evicted');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable();
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
        Schema::dropIfExists('property_leases');
    }
}
