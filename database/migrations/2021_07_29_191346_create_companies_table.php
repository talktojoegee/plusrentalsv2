<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->string('company_name')->default(config('app.name'))->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('website')->nullable();
            $table->string('tagline')->nullable();
            $table->string('logo')->default('logo.png')->nullable();
            $table->string('favicon')->default('favicon.png')->nullable();
            $table->integer('no_of_units')->default(1)->comment('I manage _ units');
            $table->tinyInteger('paid')->default(0)->comment('0=free,1=paid');
            $table->tinyInteger('account_status')->default(1)->comment('1=active,2=deactivated,3=sub. expired');
            $table->integer('plan_id')->default(1)->comment('1=essential,2=growth,3=premium');
            $table->string('active_subscription_key')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('company_policy')->nullable();
            $table->string('company_policy_attachment')->nullable();
            $table->string('privacy_policy')->nullable();
            $table->string('privacy_policy_attachment')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
