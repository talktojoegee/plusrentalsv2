<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('tenant_id')->nullable()->comment('client');
            $table->unsignedBigInteger('tenant_app_id')->nullable()->comment('potential tenant');
            $table->string('invoice_no')->nullable();
            $table->string('ref_no')->nullable();
            $table->tinyInteger('invoice_type')->comment('1=new lease,2=Lease renewal, 3=Sale of property');
            $table->integer('payment_method')->default(1)->comment('1=cash,2=Cheque,3=bank transfer,4=internet');
            $table->dateTime('issue_date')->nullable();
            $table->dateTime('due_date')->nullable();
            //$table->double('rental_amount')->default(0);
            $table->double('vat')->default(0);
            $table->double('vat_rate')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=paid,2=partly-paid, 3=declined');
            $table->double('sub_total')->default(0);
            $table->double('total')->default(0);
            $table->double('paid_amount')->default(0);
            $table->unsignedBigInteger('issued_by')->nullable();
            $table->tinyInteger('posted')->default(0)->comment('0=not posted,1=posted');
            $table->unsignedBigInteger('posted_by')->nullable();
            $table->dateTime('date_posted')->nullable();
            $table->tinyInteger('trashed')->default(0)->comment('0=not trashed,1=trashed');
            $table->unsignedBigInteger('trashed_by')->nullable();
            $table->dateTime('date_trashed')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
