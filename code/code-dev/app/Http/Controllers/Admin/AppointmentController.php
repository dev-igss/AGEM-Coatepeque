<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Setting, App\Http\Models\SettingHolyDays, App\Http\Models\Appointment, App\Http\Models\ControlAppointment, App\Http\Models\DetailAppointment, App\Http\Models\MaterialAppointment, App\Http\Models\Patient, App\Http\Models\CodePatient, App\Http\Models\Service, App\Http\Models\Studie, App\Http\Models\Schedule, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth, Session, DB, PDF, Response, Carbon\Carbon;

class AppointmentController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){        
        $today = Carbon::now()->format('Y-m-d');
        $appointments = Appointment::with(['details'])->where('date', $today)->get();       
        $details_appointments = DetailAppointment::all();        

        $data = [
            'appointments' => $appointments,
            'details_appointments' => $details_appointments
        ];

        return view('admin.appointments.home',$data);
    }

    public function postAppointmentSearch(Request $request){ 
        $tipo_paciente = $request->input('type_patient');
        $paciente = $request->input('search_patient');
        $fecha = $request->input('search_date');
        $details_appointments = DetailAppointment::all();    

        if(!is_null($paciente)){
            $paciente_r = Patient::where('type', $tipo_paciente)
                    ->where(function($query) use ($paciente) {
                        $query->where('affiliation','LIKE','%'.$paciente.'%')
                                ->orWhere('name','LIKE','%'.$paciente.'%')
                                ->orWhere('lastname','LIKE','%'.$paciente.'%');
                    })
                    ->first();

            $appointments = Appointment::where('patient_id', $paciente_r->id)
                ->get();
        }

        if(!is_null($fecha)){
            $appointments = Appointment::where('date', $fecha)
                ->get();
        }

        if(!is_null($paciente) && !is_null($fecha)){
            $paciente_r = Patient::where('type', $tipo_paciente)
                    ->where(function($query) use ($paciente) {
                        $query->where('affiliation','LIKE','%'.$paciente.'%')
                                ->orWhere('name','LIKE','%'.$paciente.'%')
                                ->orWhere('lastname','LIKE','%'.$paciente.'%');
                    })
                    ->first();

            $appointments = Appointment::where('patient_id', $paciente_r->id)
                    ->where('date', $fecha)
                    ->get();
        }

        //return $cita;

        $data = [
            'appointments' => $appointments,
            'tipo_paciente' => $tipo_paciente,
            'paciente' => $paciente,
            'fecha' => $fecha,
            'details_appointments' => $details_appointments
        ];

        return view('admin.appointments.search', $data);       
    
    }

    public function getAppointmentAdd(){
        $services = Service::where('type','1')
            ->where('unit_id', '1')
            ->get(); 
        $studies = Studie::pluck('name','id');
        $detalles = DetailAppointment::all();
        $schedules = Schedule::all();
        $all_orders = Appointment::select(['id', 'status'])->get();
        $setting = Setting::all();

        foreach($setting as $set):
            $setting_x_hour = $set->amount_hour_appointment;

        endforeach;
        

        $data = [
            'services' => $services,
            'studies' => $studies,
            'detalles' => $detalles,
            'schedules' => $schedules,
            'setting_x_hour' => $setting_x_hour
        ];

        return view('admin.appointments.add', $data);
    } 

    public function postAppointmentAdd(Request $request){
        $rules = [
            'date' => 'required'
    	];
    	$messagess = [
            'date.required' => 'Se requiere que asigne una fecha para la cita.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            /*$dia_festivo = SettingHolyDays::where('holy_day', $request->input('date'))->first();

            return $dia_festivo;*/

            //return $request->all();

            $idconfig = '1';
            $config_appointment = Setting::findOrFail($idconfig);

            if(!is_null($request->input('patient_id'))):
                $area_temp = NULL;
                $area = NULL;
                $idpatient = $request->input('patient_id');            
                $type_exam = $request->input('type_exam');
            
                $affiliation_p = Patient::select('affiliation', 'exp_prev')
                                    ->where('id', $idpatient)
                                    ->get();

                switch($type_exam):

                    case '0':
                        $code_exp = CodePatient::select('code')
                            ->where('patient_id', $idpatient)
                            ->where('nomenclature', 'RX')
                            ->where('status', '0')
                            ->get();
                        $area = '0';
                        $appointments_odls = Appointment::where('patient_id', $idpatient)
                                    ->where('area',$area)
                                    ->count();
                    break;

                    case '1':
                        $code_exp = CodePatient::select('code')
                            ->where('patient_id', $idpatient)
                            ->where('nomenclature', 'RX')
                            ->where('status', '0')
                            ->get();
                        $area = '0';
                        $area_temp = '1';
                        $appointments_odls = Appointment::where('patient_id', $idpatient)
                                    ->where('area',$area)
                                    ->count();
                    break;

                    case '2':
                        $code_exp = CodePatient::select('code')
                            ->where('patient_id', $idpatient)
                            ->where('nomenclature', 'USG')
                            ->where('status', '0')
                            ->get();
                        $area = '2';
                        $appointments_odls = Appointment::where('patient_id', $idpatient)
                                    ->where('area',$area)
                                    ->count();
                    break;

                    case '3':
                        $code_exp = CodePatient::select('code')
                            ->where('patient_id', $idpatient)
                            ->where('nomenclature', 'MMO')
                            ->where('status', '0')
                            ->get();
                        $area = '3';
                        $appointments_odls = Appointment::where('patient_id', $idpatient)
                                    ->where('area',$area)
                                    ->count();
                    break;

                    case '4':
                        $code_exp = CodePatient::select('code')
                            ->where('patient_id', $idpatient)
                            ->where('nomenclature', 'DMO')
                            ->where('status', '0')
                            ->get();
                        $area = '4';
                        $appointments_odls = Appointment::where('patient_id', $idpatient)
                                    ->where('area',$area)
                                    ->count();
                    break;

                endswitch;





                if(count($affiliation_p) == 0):
                    $appointments_type = '0';
                else:
                    $appointments_type = '1';
                endif;

                DB::beginTransaction();

                $servicio = Service::with(['parent'])->where('id', $request->get('idservice')[0])->get();

                /*if(count($request->get('idservice')) > 1):
                    for($i=0; $i<= count($request->get('idservice')); $i++ ):
                        $servicio1 = Service::with(['parent'])->whereIn('id', [$request->get('idservice')[$i]])->get();

                        return $servicio1;
                    endfor;
                     //return $request->get('idservice');
                else: 
                    return "solo 1 servicio";
                endif;*/

                
                //return $servicio;
                

                foreach($servicio as $ser):
                    $solicitante = $ser->parent->name;
                    if($ser->parent_id == '3' || $ser->parent_id == '1'):
                        $emer_hosp = '1';
                    else: 
                        $emer_hosp = '0';
                    endif;
                endforeach;

                //return $emer_hosp;

                $appointment = new Appointment;
                $appointment->patient_id = $idpatient;
                $appointment->date = $request->input('date');
                if($request->input('schedule') != ""):
                    $appointment->schedule_id = $request->input('schedule');
                else:
                    $appointment->schedule_id = '1'; 
                endif;

                $ca = ControlAppointment::where('date', $appointment->date)->count();



                if($ca == 0):
                    $control = new ControlAppointment;
                    $control->date = $request->input('date');
                    if($area == 0 ):                        
                        if($area_temp != NULL):
                            if($emer_hosp == '1'):
                                $control->amount_rx_special = '1';
                            else:
                                if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                    $control->amount_rx_special_am = '1';
                                else:
                                    $control->amount_rx_special_pm = '1';
                                endif;
                            endif;   
                        else:
                            $control->amount_rx = '1';                         
                        endif;                    
                    elseif($area == 2):
                        $doppler = Studie::findOrFail($request->get('idstudy'));      
                        if($emer_hosp == '1'):  
                            foreach($doppler as $d):
                                if($d->is_doppler == '1'):
                                    $control->amount_usg_doppler = '1';                                    
                                else:
                                    $control->amount_usg = '1';                                    
                                endif;                    
                            endforeach;    
                        else:
                            foreach($doppler as $d):
                                if($d->is_doppler == '1'):
                                    if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                        $control->amount_usg_doppler_am = '1';
                                    else:
                                        $control->amount_usg_doppler_pm = '1';
                                    endif;
                                else:
                                    if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                        $control->amount_usg_am = '1';
                                    else:
                                        $control->amount_usg_pm = '1';
                                    endif;
                                endif;                    
                            endforeach; 
                        endif;                                          
                    elseif($area == 3):
                        if($emer_hosp == '1'):
                            
                        else:
                            if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                $control->amount_mmo_am = '1';
                            else:
                                $control->amount_mmo_pm = '1';
                            endif;
                        endif;                            
                    elseif($area == 4):
                        if($emer_hosp == '1'):
                            $control->amount_dmo = '1';
                        else:
                            if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                $control->amount_dmo_am = '1';
                            else:
                                $control->amount_dmo_pm = '1';
                            endif;
                        endif;                        
                    endif;
                    $control->save();
                else:
                    $ca1 = ControlAppointment::where('date' , $request->input('date'))->get();
                   
                    foreach($ca1 as $c):
                        if($area == 0 ):                               
                            if($area_temp != NULL):
                                if($emer_hosp == '1'):
                                    $c->amount_rx_special = $c->amount_rx_special + 1;   
                                else:
                                    if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                        if($c->amount_rx_special_am == $config_appointment->amount_rx_special_am):
                                            return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                ->with('typealert', 'warning');                                
                                        else:
                                            $c->amount_rx_special_am = $c->amount_rx_special_am + 1;
                                        endif;
                                    else:
                                        if($c->amount_rx_special_pm == $config_appointment->amount_rx_special_pm):
                                            return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                                ->with('typealert', 'warning');                                
                                        else:
                                            $c->amount_rx_special_pm = $c->amount_rx_special_pm + 1;
                                        endif;
                                    endif;
                                endif; 
                            else:
                                $c->amount_rx = $c->amount_rx + 1;                               
                            endif;     
                        elseif($area == 2):                            
                            $doppler = Studie::findOrFail($request->get('idstudy'));     
                            if($emer_hosp == '1'):
                                foreach($doppler as $d):
                                    if($d->is_doppler == '1'):
                                        $c->amount_usg_doppler = $c->amount_usg_doppler + 1;                                   
                                    else:
                                        $c->amount_usg = $c->amount_usg + 1;                                    
                                    endif;                    
                                endforeach;
                            else:
                                foreach($doppler as $d):
                                    if($d->is_doppler == '1'):
                                        
                                        if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                            if($c->amount_usg_doppler_am == $config_appointment->amount_usg_doppler_am):
                                                return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                    ->with('typealert', 'warning');                                
                                            else:
                                                $c->amount_usg_doppler_am = $c->amount_usg_doppler_am + 1;
                                            endif;
                                            
                                        else:
                                            if($c->amount_usg_doppler_pm == $config_appointment->amount_usg_doppler_pm):
                                                return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                    ->with('typealert', 'warning');                                
                                            else:
                                                $c->amount_usg_doppler_pm = $c->amount_usg_doppler_pm + 1;
                                            endif;
                                        endif;
                                    else:
                                        if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                            if($c->amount_usg_am == $config_appointment->amount_usg_am):
                                                return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                    ->with('typealert', 'warning');                                
                                            else:
                                                $c->amount_usg_am = $c->amount_usg_am + 1;
                                            endif;
                                        else:
                                            if($c->amount_usg_pm == $config_appointment->amount_usg_pm):
                                                return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                    ->with('typealert', 'warning');                                
                                            else:
                                                $c->amount_usg_pm = $c->amount_usg_pm + 1;
                                            endif;
                                        endif;
                                    endif;                    
                                endforeach;
                            endif;               
                                                
                        elseif($area == 3):
                            if($emer_hosp == '1'):
                                $c->amount_mmo = $c->amount_mmo + 1;
                            else:
                                if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                    if($c->amount_mmo_am == $config_appointment->amount_mmo_am):
                                        return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                            ->with('typealert', 'warning');                                
                                    else:
                                        $c->amount_mmo_am = $c->amount_mmo_am + 1;
                                    endif;
                                else:
                                    if($c->amount_mmo_pm == $config_appointment->amount_mmo_pm):
                                        return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                            ->with('typealert', 'warning');                                
                                    else:
                                        $c->amount_mmo_pm = $c->amount_mmo_pm + 1;
                                    endif;
                                endif; 
                            endif;                                                   
                        elseif($area == 4):
                            if($emer_hosp == '1'):
                                $c->amount_dmo = $c->amount_dmo + 1;
                            else:
                                if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                    if($c->amount_dmo_am == $config_appointment->amount_dmo_am):
                                        return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                            ->with('typealert', 'warning');                                
                                    else:
                                        $c->amount_dmo_am = $c->amount_dmo_am + 1;
                                    endif;
                                else:
                                    if($c->amount_dmo_pm == $config_appointment->amount_dmo_pm):
                                        return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                            ->with('typealert', 'warning');                                
                                    else:
                                        $c->amount_dmo_pm = $c->amount_dmo_pm + 1;
                                    endif;
                                endif; 
                            endif;                                                   
                        endif;
                        $c->save();
                    endforeach;
                    
                endif;          

                if($request->input('numexpp') != NULL && $request->input('num_code_nom_act') == "" && $request->input('num_code_cor_act') == "" && $request->input('num_code_y_act') == "" ):
                    $appointment->num_study = $request->input('numexpp');
                elseif($request->input('num_code_nom_act') != "" && $request->input('num_code_cor_act') != "" && $request->input('num_code_y_act') != "" ):
                    $code = $request->input('num_code_nom_act').$request->input('num_code_cor_act').'-'.substr($request->input('num_code_y_act'), -2);
                    $appointment->num_study = $code;
                endif;
                $appointment->type = $appointments_type;
                $appointment->area = $area;
                $appointment->service = $solicitante;
                $appointment->status = '0';    

                //return $appointment;
                $appointment->save();      
                $patient_aux = Patient::findOrFail($idpatient);
                $patient_aux->contact =  $request->get('contactp');
                $patient_aux->save();
                
                if($request->input('num_code_nom_act') != "" && $request->input('num_code_cor_act') != "" && $request->input('num_code_y_act') != "" ):
                    $cp = CodePatient::where('patient_id', $idpatient)
                        ->where('nomenclature', $request->input('num_code_nom_act'))
                        ->where('status', '0')    
                        ->update(['status' => 1]);
                    
                    $code = $request->input('num_code_nom_act').$request->input('num_code_cor_act').'-'.substr($request->input('num_code_y_act'), -2);
                    $cp = new CodePatient;
                    $cp->patient_id = $idpatient;                                      
                    $cp->nomenclature = $request->input('num_code_nom_act');
                    $cp->correlative = $request->input('num_code_cor_act');
                    $cp->year = $request->input('num_code_y_act');
                    $cp->code = $code;
                    $cp->status = '0';
                    $cp->save();
                endif;
                

                $idservice = $request->get('idservice');          
                $idstudy = $request->get('idstudy');
                $comment = $request->get('comment');

                $cont=0;

                while ($cont<count($idservice)) {
                    $detalle = new DetailAppointment();
                    $detalle->idappointment=$appointment->id;
                    $detalle->idservice=$idservice[$cont];
                    $detalle->idstudy=$idstudy[$cont];
                    $detalle->comment=$comment[$cont];
                    $detalle->save();
                    $cont=$cont+1;
                }

                DB::commit();

                if($appointment->save()):                 

                    foreach($affiliation_p as $ap):
                        $afp = $ap->affiliation;
                    endforeach;

                    $b = new Bitacora;
                    $b->action = "Registro de cita para paciente con afiliación: ".$afp;
                    $b->user_id = Auth::id();
                    $b->save();

                    if($request->input('present_patient') == '1'):
                        $appointment_aux = Appointment::findOrFail($appointment->id);
                        $appointment_aux->status = '1';  
                        $hora = Carbon::now()->format('H:i');              
                        $appointment_aux->check_in = $hora;


                        if($appointment_aux->save()):               

                            $b = new Bitacora;
                            $b->action = "Cita no. ".$appointment_aux->id.", paciente con afiliación ".$appointment_aux->patient->affiliation." presente";
                            $b->user_id = Auth::id();
                            $b->save();           
                        endif;

                    endif;

                    return back()->with('messages', '¡Cita agendada y guardada con exito!.')
                        ->with('typealert', 'success');

                    
                endif;
            else:
                //return $request->all();

                $patient_new = new Patient;
                $patient_new->unit_id = '1';
                $patient_new->exp_prev = '0';
                $patient_new->type = $request->input('type_patient_new');
                $patient_new->affiliation = e($request->input('affiliationp'));
                $patient_new->name = e($request->input('name_new'));
                $patient_new->lastname = e($request->input('lastname_new'));
                $patient_new->gender = $request->input('gender_new');
                $patient_new->age = e($request->input('age_new'));
                $patient_new->contact = e($request->input('contact_new'));
                
                if($patient_new->save()):
                    if($request->input('num_code_nom') != "" && $request->input('num_code_cor') != "" && $request->input('num_code_y') != "" ):                       
                        $code = $request->input('num_code_nom').$request->input('num_code_cor').'-'.substr($request->input('num_code_y'), -2);
                        $cp = new CodePatient;
                        $cp->patient_id = $patient_new->id;                                      
                        $cp->nomenclature = $request->input('num_code_nom');
                        $cp->correlative = $request->input('num_code_cor');
                        $cp->year = $request->input('num_code_y');
                        $cp->code = $code;
                        $cp->status = '0';
                        $cp->save();
                    endif;

                    $area_temp = NULL;
                    $type_exam = $request->input('type');
                    switch($type_exam):

                        case '0':
                            $area = '0';
                        break;
            
                        case '1':
                            $area = '0';
                            $area_temp = '1';
                        break;
            
                        case '2':
                            $area = '2';
                        break;
            
                        case '3':
                            
                            $area = '3';
                        break;
            
                        case '4':

                            $area = '4';
                        break;
            
                    endswitch;

                    DB::beginTransaction();

                    $servicio = Service::with(['parent'])->where('id', $request->get('idservice')[0])->get();

                    foreach($servicio as $ser):
                        $solicitante = $ser->parent->name;
                        if($ser->parent_id == '3' || $ser->parent_id == '1'):
                            $emer_hosp = '1';
                        else: 
                            $emer_hosp = '0';
                        endif;
                    endforeach;

                    $appointment = new Appointment;
                    $appointment->patient_id = $patient_new->id;
                    $appointment->date = $request->input('date');
                    if($request->input('schedule') != ""):
                        $appointment->schedule_id = $request->input('schedule');
                    else:
                        $appointment->schedule_id = '1'; 
                    endif;

                    $ca = ControlAppointment::where('date', $appointment->date)->count();

                    if($ca == 0):
                        $control = new ControlAppointment;
                        $control->date = $request->input('date');
                        if($area == 0 ):
                            
                            if($area_temp != NULL):
                                if($emer_hosp == '1'):
                                    $control->amount_rx_special = '1';   
                                else:
                                    if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                        $control->amount_rx_special_am = '1';
                                    else:
                                        $control->amount_rx_special_pm = '1';
                                    endif;
                                endif;
                            else:
                                $control->amount_rx = '1';
                            endif;                    
                        elseif($area == 2):
                            $doppler = Studie::findOrFail($request->get('idstudy'));       
                            if($emer_hosp == '1'):
                                foreach($doppler as $d):
                                    if($d->is_doppler == '1'):
                                        $control->amount_usg_doppler = '1';                                        
                                    else:
                                        $control->amount_usg = '1';
                                    endif;                    
                                endforeach;
                            else:
                                foreach($doppler as $d):
                                    if($d->is_doppler == '1'):
                                        if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                            $control->amount_usg_doppler_am = '1';
                                        else:
                                            $control->amount_usg_doppler_pm = '1';
                                        endif;
                                    else:
                                        if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                            $control->amount_usg_am = '1';
                                        else:
                                            $control->amount_usg_pm = '1';
                                        endif;
                                    endif;                    
                                endforeach;
                            endif;             
                                                              
                        elseif($area == 3):
                            if($emer_hosp == '1'):
                                $control->amount_mmo = '1';
                            else:
                                if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                    $control->amount_mmo_am = '1';
                                else:
                                    $control->amount_mmo_pm = '1';
                                endif;
                            endif;
                            
                        elseif($area == 4):
                            if($emer_hosp == '1'):
                                $control->amount_dmo = '1';
                            else:
                                if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                    $control->amount_dmo_am = '1';
                                else:
                                    $control->amount_dmo_pm = '1';
                                endif;
                            endif;
                        endif;
                        $control->save();
                    else:
                        $ca1 = ControlAppointment::where('date' , $request->input('date'))->get();
                        foreach($ca1 as $c):
                            if($area == 0 ):
                                 
                                if($area_temp != NULL):
                                    if($emer_hosp == '1'):
                                        $c->amount_rx_special = $c->amount_rx_special + 1;   
                                    else:
                                        if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                            if($c->amount_rx_special_am == $config_appointment->amount_rx_special_am):
                                                return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                    ->with('typealert', 'warning');                                
                                            else:
                                                $c->amount_rx_special_am = $c->amount_rx_special_am + 1;
                                            endif;
                                        else:
                                            if($c->amount_rx_special_pm == $config_appointment->amount_rx_special_pm):
                                                return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                                    ->with('typealert', 'warning');                                
                                            else:
                                                $c->amount_rx_special_pm = $c->amount_rx_special_pm + 1;
                                            endif;
                                        endif;
                                    endif;
                                else:
                                    $c->amount_rx = $c->amount_rx + 1;  
                                endif;     

                            elseif($area == 2):                            
                                $doppler = Studie::findOrFail($request->get('idstudy'));     
                                if($emer_hosp == '1'):
                                    foreach($doppler as $d):
                                        if($d->is_doppler == '1'):
                                            $c->amount_usg_doppler = $c->amount_usg_doppler + 1;                                   
                                        else:
                                            $c->amount_usg = $c->amount_usg + 1;                                    
                                        endif;                    
                                    endforeach;
                                else:
                                    foreach($doppler as $d):
                                        if($d->is_doppler == '1'):
                                            
                                            if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                                if($c->amount_usg_doppler_am == $config_appointment->amount_usg_doppler_am):
                                                    return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                        ->with('typealert', 'warning');                                
                                                else:
                                                    $c->amount_usg_doppler_am = $c->amount_usg_doppler_am + 1;
                                                endif;
                                                
                                            else:
                                                if($c->amount_usg_doppler_pm == $config_appointment->amount_usg_doppler_pm):
                                                    return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                        ->with('typealert', 'warning');                                
                                                else:
                                                    $c->amount_usg_doppler_pm = $c->amount_usg_doppler_pm + 1;
                                                endif;
                                            endif;
                                        else:
                                            if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                                if($c->amount_usg_am == $config_appointment->amount_usg_am):
                                                    return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                        ->with('typealert', 'warning');                                
                                                else:
                                                    $c->amount_usg_am = $c->amount_usg_am + 1;
                                                endif;
                                            else:
                                                if($c->amount_usg_pm == $config_appointment->amount_usg_pm):
                                                    return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.') 
                                                        ->with('typealert', 'warning');                                
                                                else:
                                                    $c->amount_usg_pm = $c->amount_usg_pm + 1;
                                                endif;
                                            endif;
                                        endif;                    
                                    endforeach;
                                endif;          
                            elseif($area == 3):
                                if($emer_hosp == '1'):
                                    $c->amount_mmo = $c->amount_mmo + 1;
                                else:
                                    if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                        if($c->amount_mmo_am == $config_appointment->amount_mmo_am):
                                            return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                                ->with('typealert', 'warning');                                
                                        else:
                                            $c->amount_mmo_am = $c->amount_mmo_am + 1;
                                        endif;
                                    else:
                                        if($c->amount_mmo_pm == $config_appointment->amount_mmo_pm):
                                            return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                                ->with('typealert', 'warning');                                
                                        else:
                                            $c->amount_mmo_pm = $c->amount_mmo_pm + 1;
                                        endif;
                                    endif;
                                endif;                                                        
                            elseif($area == 4):
                                if($emer_hosp == '1'):
                                    $c->amount_dmo = $c->amount_dmo + 1;
                                else:
                                    if($request->input('schedule') >= 1 && $request->input('schedule') <= 10):
                                        if($c->amount_dmo_am == $config_appointment->amount_dmo_am):
                                            return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                                ->with('typealert', 'warning');                                
                                        else:
                                            $c->amount_dmo_am = $c->amount_dmo_am + 1;
                                        endif;
                                    else:
                                        if($c->amount_dmo_pm == $config_appointment->amount_dmo_pm):
                                            return back()->with('messages', '¡No se pueden agendar mas citas, espacios llenos!.')
                                                ->with('typealert', 'warning');                                
                                        else:
                                            $c->amount_dmo_pm = $c->amount_dmo_pm + 1;
                                        endif;
                                    endif;    
                                endif;                                                    
                            endif;
                            $c->save();
                        endforeach;
                        
                    endif;

                    if($request->input('num_code_new') != NULL):
                        $appointment->num_study = $request->input('num_code_new');
                    elseif($request->input('num_code_nom') != "" && $request->input('num_code_cor') != "" && $request->input('num_code_y') != "" ):
                        $code = $request->input('num_code_nom').$request->input('num_code_cor').'-'.substr($request->input('num_code_y'), -2);
                        $appointment->num_study = $code;
                    endif;
                    $appointment->type = '0';
                    $appointment->area = $area;
                    $appointment->service = $solicitante;
                    $appointment->status = '0';    
                    $appointment->save();      
            
                    $idservice = $request->get('idservice');          
                    $idstudy = $request->get('idstudy');
                    $comment = $request->get('comment');
            
                    $cont=0;
            
                    while ($cont<count($idservice)) {
                        $detalle = new DetailAppointment();
                        $detalle->idappointment=$appointment->id;
                        $detalle->idservice=$idservice[$cont];
                        $detalle->idstudy=$idstudy[$cont];
                        $detalle->comment=$comment[$cont];
                        $detalle->save();
                        $cont=$cont+1;
                    }
            
                    DB::commit();
            
                    if($appointment->save()):                 
                        
                        $b = new Bitacora;
                        $b->action = "Registro de cita para paciente con afiliación: ".$patient_new->affiliation;
                        $b->user_id = Auth::id();
                        $b->save();
            
                        if($request->input('present_patient') == '1'):
                            $appointment_aux = Appointment::findOrFail($appointment->id);
                            $appointment_aux->status = '1';  
                            $hora = Carbon::now()->format('H:i');              
                            $appointment_aux->check_in = $hora;    
                            

                            if($appointment_aux->save()):               

                                $b = new Bitacora;
                                $b->action = "Cita no. ".$appointment_aux->id.", paciente con afiliación ".$appointment_aux->patient->affiliation." presente";
                                $b->user_id = Auth::id();
                                $b->save();           
                            endif;
    
                        endif;
    
                        return back()->with('messages', '¡Cita agendada y guardada con exito!.')
                            ->with('typealert', 'success');
                    endif;


                endif;
            endif;
        endif;
    }

    public function getCalendar(){
        

        $data = [
            
        ];

        return view('admin.appointments.calendar', $data);
    }

    public function getCalendarRx(){
        

        $data = [
            
        ];

        return view('admin.appointments.calendar_rx', $data);
    }

    public function getCalendarUmd(){
        

        $data = [
            
        ];

        return view('admin.appointments.calendar_umd', $data);
    }

    public function getAppointmentMaterials($id){        
        $materials = MaterialAppointment::where('idappointment', $id)->get();
        $detalles = DetailAppointment::where('idappointment', $id)->get();



        $data = [
            'materials' => $materials,
            'detalles' => $detalles
        ];

        return view('admin.appointments.materials', $data);
    }

    public function getAppointmentMaterialsDiscarded($id){
        $material = MaterialAppointment::findOrFail($id);
        $material->status = '1';

        if($material->save()):
            $b = new Bitacora;
            $b->action = "Material marcado como desechado ";
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Material desechado con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getAppointmentRegisterMaterials($id, $idstudy, $idmaterial, $amount){
        $material = new MaterialAppointment;
        $material->idappointment = $id;
        $material->idstudy = $idstudy;
        $material->material = $idmaterial;
        $material->amount = $amount;

        if($material->save()):
            $b = new Bitacora;
            $b->action = "Registro de material a cita no.".$id;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Material registrado y guardado con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getAppointmentReschedule($id, $date, $comment = NULL){
        $appointment = Appointment::findOrFail($id);
        $horario = $appointment->schedule_id;
        $appointment->date_old = $appointment->date;
        $appointment->date = $date;
        $appointment->status = '4';

        $cant_citas = Appointment::select(DB::raw('schedule_id, count(*) as total'))
                    ->where('date', $date)
                    ->where('schedule_id', $appointment->schedule_id)
                    ->groupBy('schedule_id')
                    ->get();
        
        foreach($cant_citas as $cc):
            if($cc->schedule_id === $appointment->schedule_id && $cc->total == 2):
                $disponibles = Appointment::select(DB::raw('schedule_id, count(*) as total'))
                    ->where('date', $date)
                    ->where('schedule_id', '!=' ,$appointment->schedule_id)
                    ->groupBy('schedule_id')
                    ->get();
                
                if(count($disponibles) > 0):
                    foreach($disponibles as $d):
                        if($d->total == 1):
                            $appointment->schedule_id = $d->schedule_id;
                        endif;
                    endforeach;
                endif;                                          
            else:
                $appointment->schedule_id = $horario;          
            endif;
        endforeach;
                

        if($appointment->save()):               

            $b = new Bitacora;
            $b->action = "Reprogamación de cita para paciente con afiliación: ".$appointment->patient->affiliation;
            $b->user_id = Auth::id();
            $b->save();

            return redirect('/admin/citas')->with('messages', '¡Cita reprogramada y guardada con exito!.')
                ->with('typealert', 'success');
        endif;

        
    }

    public function getAppointmentPatientsStatus($id, $status){        
        $appointment = Appointment::findOrFail($id);
        $patient = Patient::where('id', $appointment->patient_id)
                        ->limit(1)
                        ->get();
        $hora = Carbon::now()->addHour(1)->addMinutes(20)->format('H:i'); 
        switch($appointment->area):
            case '0':
                $nomen = 'RX';
            break;

            case '1':
                $nomen = 'RX';
            break;

            case '2':
                $nomen = 'USG';
            break;

            case '3':
                $nomen = 'MMO';
            break;

            case '4':
                $nomen = 'DMO';
            break;
        endswitch;
        
        $code_study = CodePatient::where('patient_id', $appointment->patient_id)
                        ->where('nomenclature', $nomen)
                        ->where('status', '0')
                        ->limit(1)
                        ->get();  
                        
        $num_exp = 0;
        foreach($code_study as $cs):            
            $num_exp = $cs->code;                        
        endforeach;

        if($status == "1"):
            if($num_exp === 0):
                return redirect('/admin/citas')->with('messages', '¡Asigne un numero de expediente primero!.')
                    ->with('typealert', 'warning');  
            else:
                
                $appointment->num_study = $num_exp;                    

                $appointment->status = $status;
                
                $appointment->check_in = $hora;
            endif; 
        else:
            $appointment->status = $status;
        endif; 
            
        if($appointment->save()):               

            $b = new Bitacora;
            if($status == "1"):
                $b->action = "Cita no. ".$appointment->id.", paciente con afiliación ".$appointment->patient->affiliation." presente";
            else:
                $b->action = "Cita no. ".$appointment->id.", paciente con afiliación ".$appointment->patient->affiliation." ausente";
            endif;            
            $b->user_id = Auth::id();
            $b->save();

            return redirect('/admin/citas')->with('messages', '¡Estado de cita actualizado con exito!.')
                ->with('typealert', 'success');            
        endif;
    }

    public function getAppointmentInforme($id){
        $appointment = Appointment::findOrFail($id);

        $data = [
            'appointment' => $appointment
        ];

        $pdf = PDF::loadView('admin.appointments.informe',$data)->setPaper('a4', 'portrait');
        return $pdf->stream('Informe al Patrono '.$appointment->date.'.pdf');
    }

    public function getConfigAppointment(){
        $id = '1';
        $config = Setting::findOrFail($id);

        $data = [
            'config' => $config
        ];

        return view('admin.appointments.setting', $data);
    }

    public function postConfigAppointment(Request $request){
        $id = '1';
        $config_appo = Setting::findOrFail($id);
        $config_appo->amount_rx_special_am = $request->input('amount_rx_special_am');
        $config_appo->amount_rx_special_pm = $request->input('amount_rx_special_pm');
        $config_appo->amount_usg_am = $request->input('amount_usg_am');
        $config_appo->amount_usg_pm = $request->input('amount_usg_pm');
        $config_appo->amount_usg_doppler_am = $request->input('amount_usg_doppler_am');
        $config_appo->amount_usg_doppler_pm = $request->input('amount_usg_doppler_pm');
        $config_appo->amount_mmo_am = $request->input('amount_mmo_am');
        $config_appo->amount_mmo_pm = $request->input('amount_mmo_pm');
        $config_appo->amount_dmo_am = $request->input('amount_dmo_am');
        $config_appo->amount_dmo_pm = $request->input('amount_dmo_pm');

        if($config_appo->save()):
            $b = new Bitacora;
            $b->action = "Cambios en configuración de Citas ";
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Configuraciones de citas actualizadas y guardadas con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getScheduleChange($id, $schedule){
        $appointment = Appointment::findOrFail($id);
        $horario_ant = Schedule::findOrFail($appointment->schedule_id);
        $horario_nuevo = Schedule::findOrFail($schedule);

        //return $horario_nuevo;
        $appointment->schedule_id = $schedule;

        if($appointment->save()):
            $b = new Bitacora;
            $b->action = "Se cambio el horario de la cita no. ".$appointment->id." de: ".$horario_ant->hour_in." a: ".$horario_nuevo->hour_in;
            $b->user_id = Auth::id();
            $b->save();
        
            return back()->with('messages', '¡Cambio de Horario, realizado y guardado con exito!.')
                    ->with('typealert', 'success');
        endif;

        
    }

    public function getConfigHolyDays(){
        $config = SettingHolyDays::all();

        $data = [
            'config' => $config
        ];

        return view('admin.appointments.setting_holy_day', $data);
    }

    public function postConfigHolyDays(Request $request){
        $config_holy_day = new SettingHolyDays();
        $config_holy_day->holy_day = $request->input('holy_day');


        if($config_holy_day->save()):
            $b = new Bitacora;
            $b->action = "Creación de fecha festiva ";
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Día festivo creado y guardado con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
