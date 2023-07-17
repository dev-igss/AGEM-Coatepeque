@extends('connect.master')

@section('title','Inicio de Sesión')

@section('content')
    <div class="box box_login shadow">

        <div class="header">
            <a href="{{url('/')}}">
                <img src="{{url('/static/imagenes/igss.png')}}" alt="">
            </a>
        </div>

        <div class="inside">
            {!! Form::open(['url' => '/inicio_sesion']) !!}

            <label for="ibm"><b>IBM</b></label>
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-address-card"></i></div>
                </div>
                {!! Form::text('ibm', null, ['class' => 'form-control'])!!}
            </div>

            <label for="password" class="mtop16"><b>Contraseña</b></label>
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
                {!! Form::password('password', ['class' => 'form-control'])!!}
            </div>

            {!! Form::submit('Ingresar', ['class' => 'btn btn-success mtop16']) !!}
            {!! Form::close() !!}

            @if(Session::has('message'))
                <div class="container">
                    <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
                        {{ Session::get('message') }}
                        @if( $errors->any() )
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <script>
                            $('.alert').slideDown();
                            setTimeout(function(){ $('.alert').slideUp(); },10000);
                        </script>
                    </div>
                </div>
            @endif

            <div class="footer mtop16">
                <a href="{{url('/citas_del_dia_rx')}}"><i class="fa fa-arrow-left"></i> Citas RX</a> 
                <a href="{{url('/citas_del_dia_umd')}}"><i class="fa fa-arrow-left"></i> Citas USG-MMO-DMO</a> 
            </div>
        </div>

        
    </div>
@stop