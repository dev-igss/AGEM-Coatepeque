@extends('admin.master')
@section('title','Citas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/citas') }}" class="nav-link"><i class="fas fa-calendar-alt"></i> Citas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-calendar-alt"></i><strong> Listado de Citas</strong> </h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'appointment_calendar')) 
                        <ul>
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i class="fa fa-calendar"></i>  Ver Calendario <span class="caret"></span>
                                    </button>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/admin/cita/calendario/rx') }}">RX</a></li>
                                        <li><a href="{{ url('/admin/cita/calendario/umd') }}"> USG-MMO-DMO</a></li>
                                        <li><a href="{{ url('/admin/cita/calendario') }}"> General</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    @endif
                    @if(kvfj(Auth::user()->permissions, 'appointment_setting'))
                        <li>
                            <a href="{{ url('/admin/cita/configuracion') }}" ><i class="fa fa-cogs"></i> Configuración de Citas</a>
                        </li>
                    @endif
                    @if(kvfj(Auth::user()->permissions, 'appointment_add'))
                        <li>
                            <a href="{{ url('/admin/cita/agregar') }}" ><i class="fas fa-plus-circle"></i> Agendar Cita</a>
                        </li>
                    @endif
                    
                </ul>
            </div>

            <div class="inside">  
                    {!! Form::open(['url' => '/admin/cita/busqueda']) !!}
                        <div class="row">
                            <div class="col-md-5" >                                
                                <div class="input-group">
                                    {!! Form::date('search_date', $fecha, ['class'=>'form-control', 'placeholder' => 'Realice una busqueda fecha']) !!}
                                </div>                                
                            </div>

                            <div class="col-md-5" >                                
                                <div class="input-group">
                                    {!! Form::select('type_patient', getTypePatient('list', null),$tipo_paciente,['class'=>'form-select col-md-2', 'id'=> 'patient_type' ]) !!}
                                    {!! Form::text('search_patient', $paciente, ['class' => 'form-control', 'placeholder' => 'Realice una busqueda por paciente']) !!}        
                                </div>                                
                            </div>

                            <div class="col-md-2" >                                
                                <div class="input-group">
                                    {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}     
                                    <a href="{{ url('/admin/citas') }}" class="btn btn-warning">Limpiar</a>                                   
                                </div>                                
                            </div>
                        </div>
                        
                    {!! Form::close() !!}    
                
                        
                <hr>      

                <table id="table-modules" class="table table-striped table-hover mtop16">
                    <thead>
                        <tr>
                            <td><strong> OPCIONES </strong></td>
                            <td><strong> FECHA </strong></td>
                            <td><strong> PACIENTE </strong></td>
                            <td><strong> ESTUDIOS A REALIZAR </strong></td>
                            <td><strong> ESTADO </strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $a)
                            <tr>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'appointment_reschedule'))
                                            @if($a->status == '0')
                                                <a href="#" data-action="reprogramar" data-path="admin/cita" data-object="{{ $a->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Reprogramación" ><i class="fas fa-calendar-alt"></i></a>
                                            @endif
                                            @if($a->status == '5')
                                                <a href="#" data-action="reprogramacion_forzada" data-path="admin/cita" data-object="{{ $a->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Reprogramación Forzada" ><i class="fas fa-calendar-alt"></i></a>
                                            @endif
                                            @if($a->status == '0' || $a->status == '4' || $a->status == '5')
                                                <a href="#" data-date="{{$a->date}}" data-exam="{{$a->area}}" data-action="cambio_horario" data-path="admin/cita" data-object="{{ $a->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Cambio de Horario" ><i class="fa-solid fa-clock"></i></a>
                                            @endif
                                        @endif

                                        <!--@if(kvfj(Auth::user()->permissions, 'appointment_reschedule'))
                                            @if($a->status == '0')
                                            <a href="{{ url('/admin/cita/'.$a->id.'/materiales') }}"  title="Constancia de Cita" ><i class="fa fa-file-text"></i></a>
                                            @endif
                                        @endif-->

                                        @if(kvfj(Auth::user()->permissions, 'appointment_patients_status'))
                                            @if($a->status == '0' || $a->status == '4')
                                                <a href="#" data-action="paciente_presente" data-path="admin/cita" data-object="{{ $a->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Paciente Presente"><i class="fas fa-calendar-check"></i></a>
                                                <a href="#" data-action="paciente_ausente" data-path="admin/cita" data-object="{{ $a->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Paciente Ausente"><i class="fas fa-calendar-times"></i></a>
                                            @endif
                                        @endif

                                        @if(kvfj(Auth::user()->permissions, 'appointment_materials'))
                                            @if($a->status == '3')
                                                <a href="{{ url('/admin/cita/'.$a->id.'/materiales') }}"  title="Materiales Usados" ><i class="fas fa-x-ray"></i></a>
                                            @endif
                                        @endif

                                        @if(kvfj(Auth::user()->permissions, 'appointment_materials'))
                                            @if($a->status == '3')
                                                <a href="{{ url('/admin/cita/'.$a->id.'/informe_al_patrono') }}" target="_blank" title="Informe al Patrono" ><i class="fa fa-file"></i></a>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($a->date)->format('d-m-Y') }} <br>
                                    @if($a->schedule_id != NULL)
                                        <small><strong>Horario: </strong> {{ \Carbon\Carbon::parse($a->schedule->hour_in)->format('H:i').' '.getHourType(null, $a->schedule->type) }}</small><br>
                                    @else
                                        <small><strong>Horario: </strong> Sin Asignar</small><br>
                                    @endif
                                    <small> {{ getExamB(null, $a->area)  }} - {{ getTypeAppointment(null, $a->type)  }} </small>
                                </td>
                                <td> 
                                    {{ $a->patient->name.' '.$a->patient->lastname }} <br>
                                    <span>AF. {{ $a->patient->affiliation }}</span> <br>                                    
                                    <small>Expediente. {{ $a->num_study }}</small>
                                </td>
                                <td> 
                                    @foreach($details_appointments as $details)
                                        @if($details->idappointment == $a->id)
                                            @if($details->study->is_doppler == 1)
                                                <span style="font-size: 0.90em; color: red;"><i class="fa-solid fa-chevron-right"></i> {{ $details->study->name }} <br></span>
                                            @else
                                                <span style="font-size: 0.90em;"><i class="fa-solid fa-chevron-right"></i> {{ $details->study->name }} <br></span>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ getStatusAppointment(null, $a->status)  }}                                    
                                    @if($a->status == '3')
                                        <p>
                                            <small style=" font-size: 0.95em;">
                                                @if($a->ibm_tecnico_2 == NULL)
                                                    <strong >Tecnico: </strong> {{ $a->tecnico1->name.' '.$a->tecnico1->lastname }}
                                                @else
                                                    <strong >Tecnicos: </strong> {{ $a->tecnico1->name.' '.$a->tecnico1->lastname }} <br>
                                                    {{ $a->tecnico2->name.' '.$a->tecnico2->lastname }}
                                                @endif
                                            </small>
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection