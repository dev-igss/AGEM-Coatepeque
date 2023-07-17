@extends('admin.master')
@section('title','Panel Administrativo')

@section('content')
    

    <div class="container-fluid mtop16">
        @if(kvfj(Auth::user()->permissions, 'dashboard_small_stats'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-chart-bar"></i><strong> Estadísticas Rápidas Del Día</strong></h2>
                    <ul>                                                           
                        <li>
                            <a href="{{ url('/admin/reporte/mensual/citas') }}" ><i class="fa-solid fa-file-pdf"></i> Imprimir Reporte</a>
                        </li>                        
                    </ul>
                </div>

                
                    
                
            </div>

            <div class="row mtop16">

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-users"></i><strong> Citas Agendadas</strong></h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">
                                {{ $citas_d }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-users"></i><strong> Citas en Atención</strong></h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">
                                {{ $citas_d_aten }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-users"></i><strong> Citas Ausentes</strong></h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">
                                {{ $citas_d_aus }}
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>           
        @endif
    </div>

    <div class="container-fluid mtop16 ">
        @if(kvfj(Auth::user()->permissions, 'dashboard_small_tec_ser'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-chart-bar"></i><strong> Estadísticas del Més de {{ ucfirst(\Carbon\Carbon::now()->monthName) }}</strong></h2>
                </div>
            </div>

            <div class="row mtop16">
                <div class="col-md-6">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-chart-bar"></i><strong> Estadística Por Técnicos</strong></h2>
                        </div>

                        <div class="inside">
                            <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                                <thead>
                                    <tr>
                                        <td><strong>TÉCNICO</strong></td>
                                        <td><strong>PACIENTES ATENDIDOS</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tecnicos as $tec)
                                        <tr>
                                            <td>{{ $tec->ibm.' -  '.$tec->nombre }}</td>
                                            <td>
                                                @foreach($citas_x_tec as $ctec)
                                                    @if($ctec->id_tec_cita == $tec->id )
                                                        {{ $ctec->total_citas }}                                               
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
                
                <div class="col-md-6">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-chart-bar"></i><strong> Estadística Por Servicio</strong></h2>
                        </div>

                        <div class="inside">
                            <table id="table-modules1" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                                <thead>
                                    <tr>
                                        <td><strong>SERVICIO</strong></td>
                                        <td><strong>EXAMENES REALIZADOS</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $ser)
                                        <tr>
                                            <td>{{ $ser->nombre }}</td>
                                            <td>
                                                @foreach($citas_x_ser as $cser)
                                                    @if($cser->id_service == $ser->id )
                                                        {{ $cser->total_citas }}                                               
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>           
        @endif
    </div>

    <div class="container-fluid mtop16">
        @if(kvfj(Auth::user()->permissions, 'dashboard_small_stats_month'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-chart-bar"></i><strong> Estadísticas Rápidas De Productividad Generales - {{ ucfirst(\Carbon\Carbon::now()->monthName) }}</strong></h2>
                </div>
            </div>

            <div class="row mtop16">

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-users"></i><strong> Citas Agendadas </strong></h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">
                                {{ $citas_agen }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-users"></i><strong> Citas Atendidas </strong></h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">
                                {{ $citas_aten }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-users"></i><strong> Citas Ausentes</strong></h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">
                                {{ $citas_aus }}
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>           
        @endif
    </div>

    <div class="container-fluid mtop16">
        @if(kvfj(Auth::user()->permissions, 'dashboard_prod_tecnicos_stats'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-chart-bar"></i><strong> Estadísticas De Productividad De los Tecnicos Por Area - {{ ucfirst(\Carbon\Carbon::now()->monthName) }}</strong></h2>
                </div>
            </div>

            <div class="row mtop16 col-md-12">

                <div class="panel shadow">
                    <div class="inside">
                        <table id="table-modules2" class="table table-bordered table-striped" style=" text-align:center;">
                            <thead>
                                <tr>
                                    <td rowspan="2" style="text-align:center;"><strong>TÉCNICO</strong></td>
                                    <td colspan="3"><strong>RAYOS X</strong></td>
                                    <td colspan="3"><strong>ULTRASONIDO</strong></td>
                                    <td colspan="3"><strong>MAMOGRAFIA</strong></td>
                                    <td colspan="3"><strong>DENSITOMETRIA</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>HOY</strong></td>
                                    <td><strong>SEMANA</strong></td>
                                    <td><strong>MES</strong></td>
                                    <td><strong>HOY</strong></td>
                                    <td><strong>SEMANA</strong></td>
                                    <td><strong>MES</strong></td>
                                    <td><strong>HOY</strong></td>
                                    <td><strong>SEMANA</strong></td>
                                    <td><strong>MES</strong></td>
                                    <td><strong>HOY</strong></td>
                                    <td><strong>SEMANA</strong></td>
                                    <td><strong>MES</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tecnicos as $tec)                                
                                    <tr>                                
                                        <td>{{ $tec->ibm.' -  '.$tec->nombre }}</td>
                                        <td>
                                            @foreach($citas_d_tec_g_rx as $ctdgrx)
                                                @if($tec->id === $ctdgrx->id_tecnico)
                                                    {{$ctdgrx->total_citas}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($citas_ld_tec_g_rx as $ctldgrx)
                                                @if($tec->id === $ctldgrx->id_tecnico)
                                                    {{$ctldgrx->total_citas}}
                                                @endif
                                            @endforeach                                            
                                        </td>
                                        <td>
                                            @foreach($citas_m_tec_g_rx as $ctmgrx)
                                                @if($tec->id === $ctmgrx->id_tecnico)
                                                    {{$ctmgrx->total_citas}}
                                                @endif
                                            @endforeach                                            
                                        </td>

                                        <td>
                                            @foreach($citas_d_tec_g_usg as $ctdgusg)
                                                @if($tec->id === $ctdgusg->id_tecnico)
                                                    {{$ctdgusg->total_citas}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($citas_ld_tec_g_usg as $ctldgusg)
                                                @if($tec->id === $ctldgusg->id_tecnico)
                                                    {{$ctldgusg->total_citas}}
                                                @endif
                                            @endforeach                                            
                                        </td>
                                        <td>
                                            @foreach($citas_m_tec_g_usg as $ctmgusg)
                                                @if($tec->id === $ctmgusg->id_tecnico)
                                                    {{$ctmgusg->total_citas}}
                                                @endif
                                            @endforeach                                            
                                        </td>

                                        <td>
                                            @foreach($citas_d_tec_g_mmo as $ctdgmmo)
                                                @if($tec->id === $ctdgmmo->id_tecnico)
                                                    {{$ctdgmmo->total_citas}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($citas_ld_tec_g_mmo as $ctldgmmo)
                                                @if($tec->id === $ctldgmmo->id_tecnico)
                                                    {{$ctldgmmo->total_citas}}
                                                @endif
                                            @endforeach                                            
                                        </td>
                                        <td>
                                            @foreach($citas_m_tec_g_mmo as $ctmgmmo)
                                                @if($tec->id === $ctmgmmo->id_tecnico)
                                                    {{$ctmgmmo->total_citas}}
                                                @endif
                                            @endforeach                                            
                                        </td>

                                        <td>
                                            @foreach($citas_d_tec_g_dmo as $ctdgdmo)
                                                @if($tec->id === $ctdgdmo->id_tecnico)
                                                    {{$ctdgdmo->total_citas}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($citas_ld_tec_g_dmo as $ctldgdmo)
                                                @if($tec->id === $ctldgdmo->id_tecnico)
                                                    {{$ctldgdmo->total_citas}}
                                                @endif
                                            @endforeach                                            
                                        </td>
                                        <td>
                                            @foreach($citas_m_tec_g_dmo as $ctmgdmo)
                                                @if($tec->id === $ctmgdmo->id_tecnico)
                                                    {{$ctmgdmo->total_citas}}
                                                @endif
                                            @endforeach                                            
                                        </td>
                                    </tr>
                                @endforeach
                                                 
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>           
        @endif
    </div>

    <div class="container-fluid mtop16">
        @if(kvfj(Auth::user()->permissions, 'dashboard_prod_individual_stats'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-chart-bar"></i><strong> Estadísticas Rápidas De Productividad Por Area - {{ ucfirst(\Carbon\Carbon::now()->monthName) }}</strong></h2>
                </div>
            </div>

            <div class="row mtop16">

                <div class="panel shadow">
                    <div class="inside">
                        <table id="table-modules1" class="table table-bordered table-striped" style=" text-align:center;">
                            <thead>
                                <tr>
                                    <td colspan="3"><strong>RAYOS X</strong></td>
                                    <td colspan="3"><strong>ULTRASONIDO</strong></td>
                                    <td colspan="3"><strong>MAMOGRAFIA</strong></td>
                                    <td colspan="3"><strong>DENSITOMETRIA</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>HOY</strong></td>
                                    <td><strong>SEMANA</strong></td>
                                    <td><strong>MES</strong></td>
                                    <td><strong>HOY</strong></td>
                                    <td><strong>SEMANA</strong></td>
                                    <td><strong>MES</strong></td>
                                    <td><strong>HOY</strong></td>
                                    <td><strong>SEMANA</strong></td>
                                    <td><strong>MES</strong></td>
                                    <td><strong>HOY</strong></td>
                                    <td><strong>SEMANA</strong></td>
                                    <td><strong>MES</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{ $citas_d_tec_rx }}
                                    </td>
                                    <td>
                                        {{ $citas_ld_tec_rx }}
                                    </td>
                                    <td>
                                        {{ $citas_m_tec_rx }}
                                    </td>
                                    <td>
                                        {{ $citas_d_tec_usg }}
                                    </td>
                                    <td>
                                        {{ $citas_ld_tec_usg }}
                                    </td>
                                    <td>
                                        {{ $citas_m_tec_usg }}
                                    </td>
                                    <td>
                                        {{ $citas_d_tec_mmo }}
                                    </td>
                                    <td>
                                        {{ $citas_ld_tec_mmo }}
                                    </td>
                                    <td>
                                        {{ $citas_m_tec_mmo }}
                                    </td>
                                    <td>
                                        {{ $citas_d_tec_dmo }}
                                    </td>
                                    <td>
                                        {{ $citas_ld_tec_dmo }}
                                    </td>
                                    <td>
                                        {{ $citas_m_tec_dmo }}
                                    </td>
                                </tr>
                                                 
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>           
        @endif
    </div>

    <div class="container-fluid mtop16">
        @if(kvfj(Auth::user()->permissions, 'dashboard_appointments_tec'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-chart-bar"></i><strong> Citas Atendidas en - {{ ucfirst(\Carbon\Carbon::now()->monthName) }}</strong></h2>
                </div>
            </div>

            <div class="row mtop16">
                <div class="container-fluid">
                    <div class="panel shadow">
                        <div class="inside">              
                            <table id="table-modules" class="table table-striped table-hover mtop16">
                                <thead>
                                    <tr>
                                        <td width="48px"><strong> FECHA </strong></td>
                                        <td width="250px"><strong> PACIENTE </strong></td>
                                        <td width="100px"><strong> ESTUDIO(S) </strong></td>
                                        <td width="100px"><strong> MATERIALES </strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($citas_atendidas as $ca)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($ca->date)->format('d-m-Y') }}</td>
                                            <td>
                                                {{ $ca->patient->lastname.' '.$ca->patient->name }} <br>
                                                <small><strong>Af. </strong> {{ $ca->patient->affiliation }} </small>
                                            </td>
                                            <td>    
                                                <small>{{ $ca->details->study->name }} </small>    
                                            </td>
                                            <td>   
                                                {{ getMaterials(null, $ca->materials->material)  }} <small> <strong>Cant. </strong> {{ $ca->materials->amount }}  </small>    
                                            </td>
                                        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>           
        @endif
    </div>


    

@endsection