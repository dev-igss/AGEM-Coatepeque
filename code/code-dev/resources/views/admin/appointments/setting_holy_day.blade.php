@extends('admin.master')
@section('title','Configuración de Dias Festivos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/unidades') }}" class="nav-link"><i class="fas fa-hospital-user"></i> Días Festivos</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions, 'unit_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Agregar Día Festivo</strong></h2>
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/cita/configuracion/dias/festivos', 'files' => true]) !!}
                                <label for="name"><strong><sup style="color: red;">(*)</sup> Seleccione una fecha:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('holy_day', null, ['class'=>'form-control']) !!}
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
                        <h2 class="title"><i class="fas fa-hospital-user"></i><strong> Listado de Días Festivos </strong></a>
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-striped table-hover mtop16">
                            <thead>
                                <tr>
                                    <td width="140px"> <strong>OPCIONES</strong> </td>
                                    <td><strong> DÍA FESTIVO</strong> </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($config as $c)
                                    <tr>
                                        <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'unit_edit'))
                                                <a href="{{ url('/admin/unidad/'.$c->id.'/editar') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permissions, 'unit_delete'))
                                                <a href="{{ url('/admin/unidad/'.$c->id.'/borrar') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                        </td>
                                        <td>{{ $c->holy_day }}</td>
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
