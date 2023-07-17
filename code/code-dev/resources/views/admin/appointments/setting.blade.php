@extends('admin.master')
@section('title','Configuración de Citas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-columns"></i> Citas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/add') }}" class="nav-link"><i class="fa fa-cogs"></i> Configuración de Citas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::open(['url' => '/admin/cita/configuracion']) !!}
        <div class="row">
        
            <div class="col-md-3 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-list-ol"></i> <strong>Cantidad Citas RX</strong></h2>
                    </div>

                    <div class="inside">                        
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name"><strong>Cantidad Citas A.M:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_rx_special_am', $config->amount_rx_special_am  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>

                                <label for="name" class="mtop16"><strong>Cantidad Citas P.M:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_rx_special_pm', $config->amount_rx_special_pm  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-list-ol"></i> <strong>Cantidad Citas USG</strong></h2>
                    </div>

                    <div class="inside">                        
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name"><strong>Cantidad Citas A.M:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_usg_am', $config->amount_usg_am  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>

                                <label for="name" class="mtop16"><strong>Cantidad Citas P.M:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_usg_pm', $config->amount_usg_pm  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>
                            </div>
                        </div>       
                        <div class="row">
                            <div class="col-md-12">
                                
                                <label for="name" class="mtop16"><strong>Cantidad Citas A.M (DOPPLER):</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_usg_doppler_am', $config->amount_usg_doppler_am  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>

                                <label for="name" class="mtop16"><strong>Cantidad Citas P.M (DOPPLER):</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_usg_doppler_pm', $config->amount_usg_doppler_am  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-list-ol"></i> <strong>Cantidad Citas MMO</strong></h2>
                    </div>

                    <div class="inside">                        
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name"><strong>Cantidad Citas A.M:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_mmo_am', $config->amount_mmo_am ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>

                                <label for="name" class="mtop16"><strong>Cantidad Citas P.M:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_mmo_pm', $config->amount_mmo_pm  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-list-ol"></i> <strong>Cantidad Citas DMO</strong></h2>
                    </div>

                    <div class="inside">                        
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name"><strong>Cantidad Citas A.M:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_dmo_am', $config->amount_dmo_am  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>

                                <label for="name" class="mtop16"><strong>Cantidad Citas P.M:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('amount_dmo_pm', $config->amount_dmo_pm  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>

            
        </div>

        <div class="row mtop16">
        
            <div class="col-md-3 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-list-ol"></i> <strong>Cantidad de Pacientes por Horario</strong></h2>
                    </div>

                    <div class="inside">                        
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name"><strong>Cantidad Pacientes:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('citas_configuradas', Config::get('agem.citas_configuradas')  ,['class'=>'form-control', 'Placeholder' => 'Ingrese una nueva cantida']) !!}
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>


            
        </div>

        <div class="row mtop16">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="inside">
                        {!! Form::submit('Guardar', ['class'=>'btn btn-success', 'id'=>'btn_guardar']) !!}
                    </div>
                </div>                    
            </div>
        </div>

        {!! Form::close() !!}
    </div> 
@endsection