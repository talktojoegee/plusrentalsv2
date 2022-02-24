<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyInspectionSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_inspection_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->text('message')->nullable();
            $table->dateTime('schedule_date')->nullable();
            $table->tinyInteger('status')->nullable()->default(0)->comment('0=not inspected, 1=inspected, 2=declined');
            $table->text('attended_by')->nullable()->comment('admin tour guard');
            $table->dateTime('date_attended')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('property_inspection_schedules');
    }
}
