@extends('admin.master')
@section('title','Editar Estudio')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/estudios/todos') }}" class="nav-link"><i class="fas fa-database"></i> Examenes ó Estudios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus-circle"></i> <strong>Editar Estudio</strong></h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/estudio/'.$studie->id.'/editar']) !!}
                            <label for="name"> <strong><sup style="color: red;">(*)</sup> Nombre: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', $studie->name, ['class'=>'form-control']) !!}
                            </div>

                            <label for="type"  class="mtop16"><strong><sup style="color: red;">(*)</sup> Tipo de Examen:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('type', getTypeStudie('list', null),$studie->type,['class'=>'form-select']) !!}
                            </div>

                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
