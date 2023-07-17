@extends('admin.master')
@section('title','Categorías')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{ url('/admin/units') }}" class="nav-link"><i class="fas fa-hospital-user"></i> Unidades</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i> Editar Unidad</h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/unidad/'.$unit->id.'/editar', 'files' => true]) !!}
                            
                            <label for="name"> <strong> Nombre de Unidad: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', $unit->name, ['class'=>'form-control']) !!}
                            </div>
                            
                            <label for="name" class="mtop16"><strong> Codigo de Unidad:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('code', $unit->code, ['class'=>'form-control']) !!}
                                </div>
                            
                            <div class="row mtop16">
                                <div class="input-group">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}&nbsp;
                                    <a href="{{ url('admin/units') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>


                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
    </div>

@endsection
