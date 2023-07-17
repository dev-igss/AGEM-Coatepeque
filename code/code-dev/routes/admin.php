<?php

    Route::prefix('/admin')->group(function(){

        //Dashboard
        Route::get('/','Admin\DashboardController@getDashboard')->name('dashboard');

        //Units
        Route::get('/unidades', 'Admin\UnitsController@getHome')->name('units');
        Route::post('/unidad/agregar', 'Admin\UnitsController@postUnitAdd')->name('unit_add');
        Route::get('/unidad/{id}/editar', 'Admin\UnitsController@getUnitEdit')->name('unit_edit');
        Route::post('/unidad/{id}/editar', 'Admin\UnitsController@postUnitEdit')->name('unit_edit');
        Route::get('/unidad/{id}/borrar', 'Admin\UnitsController@getUnitDelete')->name('unit_delete');

        //Services
        Route::get('/servicios_general', 'Admin\ServiceController@getHome')->name('serviceg_list');
        Route::post('/servicios_general/agregar', 'Admin\ServiceController@postServicesGeneralAdd')->name('serviceg_add');        
        Route::get('/servicios_general/{id}/editar', 'Admin\ServiceController@getServicesGeneralEdit')->name('serviceg_edit');
        Route::post('/servicios_general/{id}/editar', 'Admin\ServiceController@postServicesGeneralEdit')->name('serviceg_edit');
        Route::get('/servicios_general/{id}/servicios','Admin\ServiceController@getServicesGeneralServices')->name('service_list');
        Route::post('/servicios_general/servicios/agregar','Admin\ServiceController@postServicesGeneralServicesAdd')->name('service_add');
        Route::get('/servicios_general/servicios/{id}/editar','Admin\ServiceController@getServicesGeneralServicesEdit')->name('service_edit');
        Route::post('/servicios_general/servicios/{id}/editar','Admin\ServiceController@postServicesGeneralServicesEdit')->name('service_edit');

        //Studies
        Route::post('/estudio/agregar', 'Admin\StudieController@postStudieAdd')->name('studie_add'); 
        Route::get('/estudios/{type}', 'Admin\StudieController@getHome')->name('studie_list');       
        Route::get('/estudio/{id}/editar', 'Admin\StudieController@getStudieEdit')->name('studie_edit');
        Route::post('/estudio/{id}/editar', 'Admin\StudieController@postStudieEdit')->name('studie_edit');

        //Horarios
        Route::get('/horarios', 'Admin\ScheduleController@getHome')->name('schedule_list');
        Route::post('/horario/agregar', 'Admin\ScheduleController@postScheduleAdd')->name('schedule_add');
        Route::get('/horario/{id}/editar', 'Admin\ScheduleController@getScheduleEdit')->name('schedule_edit');
        Route::post('/horario/{id}/editar', 'Admin\ScheduleController@postScheduleEdit')->name('schedule_edit');

        //Patients        
        Route::get('/paciente/agregar', 'Admin\PatientController@getPatientAdd')->name('patient_add');        
        Route::post('/paciente/agregar', 'Admin\PatientController@postPatientAdd')->name('patient_add');   
        Route::get('/pacientes/{filtro}', 'Admin\PatientController@getHome')->name('patient_list');  
        Route::post('/paciente/busqueda', 'Admin\PatientController@postSearch')->name('patient_list');       
        Route::get('/paciente/{id}/editar', 'Admin\PatientController@getPatientEdit')->name('patient_edit');
        Route::post('/paciente/{id}/editar', 'Admin\PatientController@postPatientEdit')->name('patient_edit');        
        Route::get('/paciente/configuracion', 'Admin\PatientController@getConfigPatient')->name('patient_setting');
        Route::post('/paciente/configuracion', 'Admin\PatientController@postConfigPatient')->name('patient_setting');
        Route::get('/paciente/{id}/historial_citas', 'Admin\PatientController@getPatientHistoryExam')->name('patient_history_exam');
        Route::get('/paciente/{id}/historial_codigos_expedientes', 'Admin\PatientController@getPatientHistoryCode')->name('patient_history_exam');
        Route::get('/paciente/{id}/borrar', 'Admin\PatientController@getPatientDelete')->name('patient_delete');
        Route::get('/paciente/{id}/restablecer', 'Admin\PatientController@getPatientRestore')->name('patient_restore');

        //Citas
        Route::get('/citas', 'Admin\AppointmentController@getHome')->name('appointment_list');
        Route::get('/cita/agregar', 'Admin\AppointmentController@getAppointmentAdd')->name('appointment_add');        
        Route::post('/cita/agregar', 'Admin\AppointmentController@postAppointmentAdd')->name('appointment_add');
        Route::post('/cita/busqueda', 'Admin\AppointmentController@postAppointmentSearch')->name('appointment_list');
        Route::get('/cita/calendario', 'Admin\AppointmentController@getCalendar')->name('appointment_calendar'); 
        Route::get('/cita/calendario/rx', 'Admin\AppointmentController@getCalendarRx')->name('appointment_calendar'); 
        Route::get('/cita/calendario/umd', 'Admin\AppointmentController@getCalendarUmd')->name('appointment_calendar'); 
        Route::get('/cita/{id}/materiales', 'Admin\AppointmentController@getAppointmentMaterials')->name('appointment_materials');
        Route::get('/cita/materiales/{id}/material_desechado', 'Admin\AppointmentController@getAppointmentMaterialsDiscarded')->name('appointment_materials');
        Route::get('/cita/{id}/registro_materiales/{idstudy}/{idmaterial}/{amount}', 'Admin\AppointmentController@getAppointmentRegisterMaterials')->name('appointment_materials');
        Route::get('/cita/{id}/reprogramar/{date}', 'Admin\AppointmentController@getAppointmentReschedule')->name('appointment_reschedule');
        Route::get('/cita/{id}/cambio_horario/{horario}', 'Admin\AppointmentController@getScheduleChange')->name('appointment_reschedule');
        Route::get('/cita/{id}/reprogramacion_forzada/{date}/{comment?}', 'Admin\AppointmentController@getAppointmentReschedule')->name('appointment_reschedule'); 
        Route::get('/cita/{id}/paciente_presente/{status}', 'Admin\AppointmentController@getAppointmentPatientsStatus')->name('appointment_patients_status');
        Route::get('/cita/{id}/paciente_ausente/{status}', 'Admin\AppointmentController@getAppointmentPatientsStatus')->name('appointment_patients_status');
        Route::get('/cita/{id}/informe_al_patrono', 'Admin\AppointmentController@getAppointmentInforme')->name('appointment_materials');
        Route::get('/cita/configuracion', 'Admin\AppointmentController@getConfigAppointment')->name('appointment_setting');
        Route::post('/cita/configuracion', 'Admin\AppointmentController@postConfigAppointment')->name('appointment_setting');
        Route::get('/cita/configuracion/dias/festivos', 'Admin\AppointmentController@getConfigHolyDays')->name('appointment_setting');
        Route::post('/cita/configuracion/dias/festivos', 'Admin\AppointmentController@postConfigHolyDays')->name('appointment_setting');

        //Bitacoras
        Route::get('/bitacoras','Admin\BitacoraController@getBitacora')->name('bitacoras'); 

        //Reportes
        Route::get('/reportes','Admin\DashboardController@getStaticsDates')->name('dashboard');      
        Route::post('/reporte/filtrado/fechas','Admin\DashboardController@postStaticsBetweenDates')->name('dashboard');  
        Route::get('/reporte/mensual/citas','Admin\DashboardController@getStaticsMonth')->name('dashboard');  

        //Users        
        Route::get('/usuarios', 'Admin\UserController@getUsers')->name('user_list');
        Route::post('/usuario/agregar', 'Admin\UserController@postUserAdd')->name('user_add');
        Route::get('/usuario/{id}/editar', 'Admin\UserController@getUserEdit')->name('user_edit');
        Route::post('/usuario/{id}/editar', 'Admin\UserController@postUserEdit')->name('user_edit');
        Route::post('/usuario/{id}/reiniciar_contrasena','Admin\UserController@postResetPassword')->name('user_reset_password');
        Route::get('/usuario/{id}/suspender', 'Admin\UserController@getUserBanned')->name('user_banned');
        Route::get('/usuario/{id}/permisos', 'Admin\UserController@getUserPermissions')->name('user_permissions');
        Route::post('/usuario/{id}/permisos', 'Admin\UserController@postUserPermissions')->name('user_permissions');
        Route::get('/usuario/cuenta/informacion','Admin\UserController@getAccountInfo')->name('user_info');
        Route::post('/usuario/cuenta/cambiar/contrasena','Admin\UserController@postAccountChangePassword')->name('user_change_password');       
        
        
        //Request Ajax 
        Route::get('/agem/api/load/add/patient/{code}/{exam}', 'Admin\ApiController@getPatient');
        Route::get('/agem/api/load/add/patient/beneficiario/{code}/{exam}', 'Admin\ApiController@getPatientBeneficiario');
        Route::get('/agem/api/load/generate/code/{code}', 'Admin\ApiController@getCodePatient');
        Route::get('/agem/api/load/studies/{type}', 'Admin\ApiController@getStudies');
        Route::get('/agem/api/load/appointments/{date}/{area}', 'Admin\ApiController@getAppointments');
        Route::get('/agem/api/load/schedules/{date}/{area}', 'Admin\ApiController@getSchedule');
        Route::get('/agem/api/load/control/studies/{date}', 'Admin\ApiController@getStudiesControlDate');
        Route::get('/agem/api/load/holy/days/{date}', 'Admin\ApiController@getHolyDays');
        Route::get('/agem/api/load/schedules/change', 'Admin\ApiController@getScheduleChange');
        Route::get('/agem/api/load/appointments', 'Admin\ApiController@getAppointmentsView');
        Route::get('/agem/api/load/appointments/rx', 'Admin\ApiController@getAppointmentsViewRx');
        Route::get('/agem/api/load/appointments/umd', 'Admin\ApiController@getAppointmentsViewUmd');
        Route::get('/agem/api/load/consulta/medicos/{mes}/{year}', 'Admin\ApiController@getPruebaConsulta');
        
    });
