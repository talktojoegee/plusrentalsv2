<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_owners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('surname')->nullable();
            $table->string('first_name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->integer('ownership_type')->nullable()->default(1)->comment('1=individual,2=company/trust');
            $table->string('company_name')->nullable();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->string('slug')->nullable();
            $table->integer('gender')->nullable()->default(1);
            $table->integer('marital_status')->nullable()->default(1);
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
        Schema::dropIfExists('rental_owners');
    }
}
