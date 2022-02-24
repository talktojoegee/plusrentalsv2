<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('bill_id')->nullable();
            $table->unsignedBigInteger('payment_no')->nullable();
            $table->integer('payment_method')->default(1)->comment('1=cash,2=Cheque,3=bank transfer,4=internet');
            $table->dateTime('payment_date')->nullable();
            $table->string('trans_ref')->nullable();
            $table->double('vat')->default(0);
            $table->double('vat_rate')->default(0);
            $table->double('sub_total')->default(0);
            $table->double('total')->default(0);
            $table->unsignedBigInteger('posted_by')->nullable();
            $table->tinyInteger('posted')->default(0)->comment('0=not,1=yes');
            $table->dateTime('date_posted')->nullable();
            $table->unsignedBigInteger('issued_by')->nullable();
            $table->unsignedBigInteger('company_id');
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
        Schema::dropIfExists('payments');
    }
}
