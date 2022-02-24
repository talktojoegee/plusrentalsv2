<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_receivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('email_id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('is_read')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('is_sent')->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('is_trash')->default(0)->comment('0=no, 1=yes');
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
        Schema::dropIfExists('email_receivers');
    }
}
