<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPaymentIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_payment_integrations', function (Blueprint $table) {
            $table->id();
            $table->string('gateway')->nullable()->comment('paystack, flutterwave,...');
            $table->tinyInteger('type')->nullable()->comment('0=test,1=live');
            $table->string('ps_public_key')->nullable();
            $table->string('ps_secret_key')->nullable();
            $table->string('ps_payment_url')->nullable();
            $table->string('ps_merchant_email')->nullable();

            $table->string('fl_public_key')->nullable();
            $table->string('fl_secret_key')->nullable();
            $table->string('fl_secret_hash')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
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
        Schema::dropIfExists('company_payment_integrations');
    }
}
