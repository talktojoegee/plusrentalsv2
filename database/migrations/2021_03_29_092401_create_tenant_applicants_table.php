<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('surname');
            $table->integer('gender')->default(1)->nullable();
            $table->integer('marital_status')->nullable();
            $table->string('avatar')->nullable()->default('avatar.png');
            $table->string('email')->unique();
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->integer('status')->nullable()->default(0)->comment('0=pending,1=approved,2=declined');
            $table->dateTime('residency_date')->nullable();
            $table->unsignedBigInteger('applied_by')->nullable();
            $table->string('leave_note')->nullable();
            $table->string('means_of_identification')->nullable();
            $table->string('attachment')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('tenant_applicants');
    }
}
