@extends('admin.master')
@section('title','Examenes / Estudios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/estudios/todos') }}" class="nav-link"><i class="fas fa-heartbeat"></i> Examenes / Estudios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions, 'studie_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Agregar Examen / Estudio</strong></h2>                            
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/estudio/agregar', 'files' => true]) !!}
                                <label for="name"> <strong><sup style="color: red;">(*)</sup> Nombre: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="type"  class="mtop16"><strong><sup style="color: red;">(*)</sup> Tipo de Examen:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('type', getTypeStudie('list', null),0,['class'=>'form-select']) !!}
                                </div>

                                <label for="unit_id"  class="mtop16"><strong><sup style="color: red;">(*)</sup> Unidad Hospitalaria:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('unit_id', $units,1,['class'=>'form-select']) !!}
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
                        <h2 class="title"><i class="fas fa-heartbeat"></i><strong> Listado de Examenes / Estudios </strong></h2>
                        <ul>
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i class="fas fa-filter"></i>  Filtrar <span class="caret"></span>
                                    </button>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{url('/admin/estudios/0')}}">RX</a></li>
                                        <li><a href="{{url('/admin/estudios/1')}}"> RX Especiales</a></li>
                                        <li><a href="{{url('/admin/estudios/2')}}"> USG</a></li>
                                        <li><a href="{{url('/admin/estudios/3')}}"> MMO</a></li>
                                        <li><a href="{{url('/admin/estudios/4')}}"> DMO</a></li>
                                        <li><a href="{{url('/admin/estudios/todos')}}"> Todos</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                            <thead>
                                <tr>
                                    <td><strong>OPCIONES</strong></td>
                                    <td><strong>NOMBRE</strong></td>
                                    <td><strong>TIPO</strong></td>
                                    <td><strong>UNIDAD HOSPITALARIA</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studies as $s)
                                    <tr>
                                        <td>
                                            <div class="opts"> 
                                                @if(kvfj(Auth::user()->permissions, 'studie_edit'))
                                                    <!-- pendiente hacer esta vista -->
                                                    <a href="{{ url('/admin/estudio/'.$s->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                                @endif  
                                            </div>
                                        </td>
                                        <td>{{$s->name}}</td>
                                        <td>{{ getTypeStudie(null, $s->type) }}</td>
                                        <td>{{$s->unit->name}}</td>
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
