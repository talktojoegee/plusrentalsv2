<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdColumnToAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('tenant_applicants', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('tenant_processors', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('tenant_guarantors', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('areas', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('rental_owners', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('property_exterior_galleries', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('property_interior_galleries', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('property_features', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('property_leases', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('tenants', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('lease_renewals', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('chart_of_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('general_ledgers', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('default_g_l_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('receipts', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('property_inspection_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('tenant_occupants', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('tenant_domestic_staff', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('file_models', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('folder_models', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('task_assignments', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('task_attachments', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('bulk_sms', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('vendors', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('vendor_professions', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('care_takers', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('lease_frequencies', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('tenant_notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('task_conversations', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('emails', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('email_receivers', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('task_frontend_conversations', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('maintenance_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('schedule_leases', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
        Schema::table('task_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('all_tables', function (Blueprint $table) {
            //
        });
    }
}
