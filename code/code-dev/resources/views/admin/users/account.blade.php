@extends('admin.master')
@section('title','Informacion de Cuenta')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/user/account/info') }}" class="nav-link"><i class="fas fa-id-card"></i> Información de Cuenta</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-fingerprint"></i> <strong>Cambiar Contraseña</strong></h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/usuario/cuenta/cambiar/contrasena']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name"><strong>Contraseña Actual:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::password('apassword', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="name"><strong>Nueva Contraseña:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::password('password', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="name"><strong>Confirmar Contraseña:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::password('cpassword', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-address-card"></i> <strong>Información del Usuario</strong></h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url'=>'/cuenta/informacion/editar']) !!}
                        <div class="row">

                            <div class="col-md-4">
                                <label for="ibm"><strong>IBM:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('ibm', Auth::user()->ibm, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="name"><strong>Nombre:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', Auth::user()->name, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="lastname"><strong>Apellidos:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('lastname', Auth::user()->lastname, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>


                        </div>

                        <div class="row mtop16">
                            <div class="col-md-6">
                                <label for="email"><strong>Correo Institucional:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('email', Auth::user()->email, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="phone"><strong>Teléfono:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::number('phone', Auth::user()->phone, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>

                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
