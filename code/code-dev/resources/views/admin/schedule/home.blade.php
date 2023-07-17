@extends('admin.master')
@section('title','Horarios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/horarios') }}" class="nav-link"><i class="fa fa-clock-o"></i> Horarios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions, 'schedule_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Agregar Horario</strong></h2>                            
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/horario/agregar', 'files' => true]) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name"> <strong><sup style="color: red;">(*)</sup> Hora de Inicio: </strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            {{ Form::time('hour_in', \Carbon\Carbon::now()) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="type"><strong><sup style="color: red;">(*)</sup> Hora de Finalización:</strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                            {{ Form::time('hour_out', \Carbon\Carbon::now())}}
                                        </div>
                                    </div>
                                </div>
                                

                                

                                <label for="type"  class="mtop16"><strong><sup style="color: red;">(*)</sup> Jornada:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('type', getHourType('list', null),0,['class'=>'form-select']) !!}
                                </div>

                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-heartbeat"></i><strong> Listado de Horarios</strong></h2>                       
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                            <thead>
                                <tr>
                                    <td><strong>HORA INICIO</strong></td>
                                    <td><strong>HORA FINALIZACIÓN</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $s)
                                    <tr>
                                        
                                        <td>{{$s->hour_in.' '.getHourType(null, $s->type) }}</td>
                                        <td>{{$s->hour_out.' '.getHourType(null, $s->type)}}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection