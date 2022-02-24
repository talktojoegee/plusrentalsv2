<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_app_id');
            $table->string('email'); //duplicated for login [Same values in tenant application]
            $table->string('password'); //duplicated for login [Same values in tenant application]
            //$table->string('first_name')->nullable();
            //$table->string('surname')->nullable();
            $table->string('avatar')->nullable()->default('avatar.png');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=renting, 2=expired, 3=evicted');
            $table->tinyInteger('account_status')->default(1)->comment('1=active, 2=inactive');
            $table->string('active_subscription_key')->nullable();
            $table->unsignedBigInteger('tenant_glcode')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('evicted_by')->nullable();
            $table->dateTime('date_evicted')->nullable();
            $table->text('eviction_comment')->nullable();
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
        Schema::dropIfExists('tenants');
    }
}
