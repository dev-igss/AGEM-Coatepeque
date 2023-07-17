<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToControlAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('control_appointments', function (Blueprint $table) {
            $table->integer('amount_usg_doppler_am')->after('amount_usg_doppler')->nullable();
            $table->integer('amount_usg_doppler_pm')->after('amount_usg_doppler_am')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('control_appointments', function (Blueprint $table) {
            //
        });
    }
}
