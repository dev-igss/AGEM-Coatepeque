@extends('master')
@section('title','Citas del Día RX')
@section('content')
<section style="text-align: center;">
    <div class="home_action_bar shadow">
        <div class="row"> 
            <h2><strong>Estudios Radiológicos Del Día: {{ $date }} </strong></h2>
        </div>        
    </div>
</section>

<div class="container-fluid ">
    <div >       
        <div class="row d-flex">
            @foreach($appointments as $a)
                <div class="col-md-4 mtop16">                    
                    <div class="card text-center">
                        <div class="card-header" style="font-size: 1.2em; ">
                            <strong> Paciente: </strong>   <br>
                            {{ $a->patient->lastname.', '.$a->patient->name}} <br>
                        </div>

                        <div class="card-body" style="font-size: 1.2em;"> 
                             
                            <p class="card-text" style="margin-top:-15px;"><strong>Edad - Genero: </strong>  {{ $a->patient->age.'a' }} - @if($a->gender == 0) Masculino @else Femenino @endif</p>        
                            <p class="card-text" style="margin-top:-15px;"> <strong>Expediente: </strong> {{ $a->num_study }}</p>     
                            <p class="card-text">
                                <small> 
                                    <strong>Estudio(s): </strong> 
                                    @foreach($detalles as $d)
                                        @if($d->idappointment == $a->id)
                                            @if($loop->last)
                                                {{ $d->study->name }}                                                
                                            @else
                                                {{ $d->study->name }},
                                            @endif                                                                                    
                                        @endif
                                    @endforeach

                                </small>
                                <p class="card-text">
                                    <strong>Servicio: </strong> 
                                        {{ $a->service }}                                                
                                </p> 
                            </p>    
                                                       
                        </div>
                        <div class="card-footer text-muted">
                            <a href="{{ url('/citas_del_dia/'.$a->id.'/materiales') }}" data-action="materials" >Más Información</a>
                        </div>
                    </div>                    
                </div>
            @endforeach
        </div>    
    </div>
</div>

@endsection