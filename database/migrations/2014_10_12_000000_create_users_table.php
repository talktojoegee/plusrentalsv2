<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('surname')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->integer('marital_status')->nullable();
            $table->tinyInteger('account_status')->default(1)->nullable()->comment('1=active,0=subscription expired, 2=account deactivated, 3=terminated');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->dateTime('hire_date')->nullable();
            $table->integer('department_id')->nullable();
            $table->unsignedBigInteger('job_role')->nullable();
            $table->string('position')->nullable();
            $table->string('avatar')->default('avatar.png')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('url')->nullable();
            $table->string('transaction_password')->nullable();
            $table->string('verification_link')->nullable();
            $table->tinyInteger('verified')->default(0)->nullable(); //if yes = 1;
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
