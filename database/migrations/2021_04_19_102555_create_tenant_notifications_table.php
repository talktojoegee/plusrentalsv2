<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->string('route_name')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('sent_by')->nullable();
            $table->tinyInteger('is_read')->default(0)->comment('0=not read, 1=read');
            $table->dateTime('read_at')->nullable();
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
        Schema::dropIfExists('tenant_notifications');
    }
}
