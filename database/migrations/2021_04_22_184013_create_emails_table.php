<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('email_type')->default(1)->comment('1=tenant, 2=custom');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->unsignedBigInteger('sent_by')->nullable();
            $table->string('subject')->nullable();
            $table->text('email_body')->nullable();
            $table->string('tracking_id')->nullable();
            $table->tinyInteger('scheduled')->nullable()->comment('0=not;1=yes');
            $table->dateTime('schedule_date_time')->nullable();
            $table->tinyInteger('status')->nullable()->comment('0=not sent, 1=sent');
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
        Schema::dropIfExists('emails');
    }
}
