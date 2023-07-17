@extends('admin.master')
@section('title','Agregar Paciente')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/pacientes') }}" class="nav-link"><i class="fas fa-columns"></i> Pacientes</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/paciente/historial_citas') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Historial de Citas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-3 d-flex">
                <div class="panel shadow">
                    

                    <div class="header">
                        <h2 class="title"><i class="fas fa-radiation-alt"></i><strong> Citas RX</strong></h2>
                    </div>

                    <div class="inside">   
                        @if(count($appointments_rx) > 0 )                                              
                            <ul>
                                @foreach($appointments_rx as $arx)
                                    <li style="margin-left: 25px;"> 
                                        <strong> Fecha: </strong> {{ date('d-m-Y', strtotime($arx->date)) }} 
                                        @if($arx->date_old != NULL)
                                            &nbsp;<small><strong style="color: orange; ">Reprogramada</strong></small>    
                                        @endif
                                        <br>
                                        @if($arx->date_old != NULL)
                                        &nbsp;&nbsp;&nbsp;&nbsp;<small><strong> Fecha Inicial: </strong> {{ date('d-m-Y', strtotime($arx->date_old)) }} <br></small>
                                        @endif
                                        <strong> Estudio(s): </strong>
                                            <ul>
                                                @foreach($details as $d)
                                                    @if($d->idappointment == $arx->id)
                                                        <li>                                                         
                                                            {{ $d->study->name }}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>    
                                    </li>         
                                    <hr>                       
                                @endforeach
                            </ul>
                        @else
                            <label  style="color: red; font-size: 1.5em; margin-left: 15px; font-weight: bold;" >¡No tiene citas en esta área!</label>
                        @endif
                    </div>

                </div>
            </div>

            <div class="col-md-3 d-flex"> 
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-radiation-alt"></i><strong> Citas USG</strong></h2>
                    </div>

                    <div class="inside"> 
                        @if(count($appointments_usg) > 0 )                                              
                            <ul>
                                @foreach($appointments_usg as $ausg)
                                    <li style="margin-left: 25px;"> 
                                        <strong> Fecha: </strong> {{ date('d-m-Y', strtotime($ausg->date)) }} 
                                        @if($ausg->date_old != NULL)
                                            &nbsp;<small><strong style="color: orange; ">Reprogramada</strong></small>    
                                        @endif
                                        <br>
                                        @if($ausg->date_old != NULL)
                                        &nbsp;&nbsp;&nbsp;&nbsp;<small><strong> Fecha Inicial: </strong> {{ date('d-m-Y', strtotime($ausg->date_old)) }} <br></small>
                                        @endif
                                        <strong> Estudio: </strong>    
                                        <ul>
                                            @foreach($details as $d)
                                                @if($d->idappointment == $ausg->id)
                                                    <li>                                                         
                                                        {{ $d->study->name }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>   
                                    </li>         
                                    <hr>                       
                                @endforeach
                            </ul>
                        @else
                            <label  style="color: red; font-size: 1.5em; margin-left: 15px; font-weight: bold;" >¡No tiene citas en esta área!</label>
                        @endif
                        
                    </div>

                </div>
            </div>

            <div class="col-md-3 d-flex">
                <div class="panel shadow">
                    

                    <div class="header">
                        <h2 class="title"><i class="fas fa-radiation-alt"></i><strong> Citas MMO</strong></h2>
                    </div>

                    <div class="inside">                                                 
                        @if(count($appointments_mmo) > 0 )                                              
                            <ul>
                                @foreach($appointments_mmo as $ammo)
                                    <li style="margin-left: 25px;"> 
                                        <strong> Fecha: </strong> {{ date('d-m-Y', strtotime($ammo->date)) }} 
                                        @if($ammo->date_old != NULL)
                                            &nbsp;<small><strong style="color: orange; ">Reprogramada</strong></small>    
                                        @endif
                                        <br>
                                        @if($ammo->date_old != NULL)
                                        &nbsp;&nbsp;&nbsp;&nbsp;<small><strong> Fecha Inicial: </strong> {{ date('d-m-Y', strtotime($ammo->date_old)) }} <br></small>
                                        @endif
                                        <strong> Estudio: </strong>   
                                        <ul>
                                            @foreach($details as $d)
                                                @if($d->idappointment == $ammo->id)
                                                    <li>                                                         
                                                        {{ $d->study->name }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>    
                                    </li>         
                                    <hr>                       
                                @endforeach
                            </ul>
                        @else
                            <label  style="color: red; font-size: 1.5em; margin-left: 15px; font-weight: bold;" >¡No tiene citas en esta área!</label>
                        @endif
                    </div>

                </div>
            </div>       
            
            <div class="col-md-3 d-flex">
                <div class="panel shadow">
                    

                    <div class="header">
                        <h2 class="title"><i class="fas fa-radiation-alt"></i><strong> Citas DMO</strong></h2>
                    </div>

                    <div class="inside">                                                 
                        @if(count($appointments_dmo) > 0 )                                              
                            <ul>
                                @foreach($appointments_dmo as $admo)
                                    <li style="margin-left: 25px;"> 
                                        <strong> Fecha: </strong> {{ date('d-m-Y', strtotime($admo->date)) }} 
                                        @if($admo->date_old != NULL)
                                            &nbsp;<small><strong style="color: orange; ">Reprogramada</strong></small>    
                                        @endif
                                        <br>
                                        @if($admo->date_old != NULL)
                                        &nbsp;&nbsp;&nbsp;&nbsp;<small><strong> Fecha Inicial: </strong> {{ date('d-m-Y', strtotime($admo->date_old)) }} <br></small>
                                        @endif
                                        <strong> Estudio: </strong>  
                                        <ul>
                                            @foreach($details as $d)
                                                @if($d->idappointment == $admo->id)
                                                    <li>                                                         
                                                        {{ $d->study->name }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>     
                                    </li>         
                                    <hr>                       
                                @endforeach
                            </ul>
                        @else
                            <label  style="color: red; font-size: 1.5em; margin-left: 15px; font-weight: bold;" >¡No tiene citas en esta área!</label>
                        @endif
                    </div>

                </div>
            </div>  

            
        </div>
    </div>
@endsection