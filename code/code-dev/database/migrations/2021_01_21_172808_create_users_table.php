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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('ibm')->unique();
            $table->string('password');
            $table->text('permissions')->nullable();
            $table->integer('role');
            $table->integer('status');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('users')->insert(array(
            'id'=>'1',
            'name'=>'Daniel',
            'lastname'=>'Velasquez',
            'ibm'=>'37732',
            'password' => '$2y$10$XE1dTOTWd/.awbfzK5X7Y.Q888C13XhlkJzOv5glIerAk1Bxyojh6', 
            'permissions' => '{"dashboard":"true","dashboard_small_stats":"true","units":"true","unit_add":"true","unit_edit":"true","unit_delete":"true","unit_search":"true","bitacoras":"true","user_list":"true","user_add":"true","user_edit":"true","user_banned":"true","user_delete":"true","user_reset_password":"true","user_permissions":"true","user_info":"true","user_change_password":"true","serviceg_list":"true","serviceg_add":"true","serviceg_edit":"true","service_list":"true","service_add":"true","service_edit":"true","studie_list":"true","studie_add":"true","studie_edit":"true","patient_list":"true","patient_add":"true","patient_edit":"true","patient_edit_affiliation":"true","patient_history_exam":"true","schedule_list":"true","schedule_add":"true","schedule_edit":"true","appointment_list":"true","appointment_add":"true","appointment_materials":"true","appointment_reschedule":"true","appointment_patients_status":"true"}', 
            'role' =>'0', 
            'status'=>'1'
        ));
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
