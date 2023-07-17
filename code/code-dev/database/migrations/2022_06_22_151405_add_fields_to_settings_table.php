<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->integer('vacation')->after('amount_usg_doppler_pm')->nullable();
            $table->integer('vacation_date_in')->after('vacation')->nullable();
            $table->integer('vacation_date_out')->after('vacation_date_in')->nullable();
            $table->integer('amount_vacation_usg_am')->after('vacation_date_out')->nullable();
            $table->integer('amount_vacation_usg_pm')->after('amount_vacation_usg_am')->nullable();
            $table->integer('amount_vacation_usg_doppler_am')->after('amount_vacation_usg_pm')->nullable();
            $table->integer('amount_vacation_usg_doppler_pm')->after('amount_vacation_usg_doppler_am')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
