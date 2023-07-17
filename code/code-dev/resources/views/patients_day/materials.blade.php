@extends('master')
@section('title','Materiales Utilizados')
@section('content')

<div class="container-fluid">
    

    {!! Form::open(['url'=>'/citas_del_dia/materiales']) !!}
        {!! Form::hidden('appointmentid', $idappointment , ['class'=>'form-control', 'id'=> 'appointmentid' ]) !!}
        <div class="row mtop16">

            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-file-prescription"></i><strong> Información de la Cita</strong></h2>
                    </div>

                    <div class="inside">   
                        <span class="title"><i class="fas fa-calendar-alt"></i><strong> Fecha: </strong></span> <br>
                        <span class="text">{{  date('d-m-Y', strtotime($appointment->date))  }}</span> <br>

                        <span class="title"><i class="fas fa-address-card"></i><strong> Afiliación: </strong></span> <br>
                        <span class="text">{{ $appointment->patient->affiliation }}</span> <br>

                        <span class="title"><i class="fas fa-user-circle"></i><strong> Paciente: </strong></span> <br>
                        <span class="text">{{ $appointment->patient->name.' '.$appointment->patient->lastname }}</span><br>

                        <span class="title"><i class="fas fa-folder-open"></i><strong> Expediente: </strong></span> <br>
                        <span class="text">{{ $appointment->num_study }}</span><br> 

                        <hr>
                        <span class="title"><i class="fa fa-mouse-pointer"></i><strong> Acciones: </strong></span> <br> 
                        <a href="#" data-action="comentario" data-path="citas_del_dia/acciones" data-object="{{ $appointment->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Agregar Comentario" ><i class="fa fa-commenting"></i></a>
                        <a href="#" data-action="solicitud_reprogramacion" data-path="citas_del_dia/acciones" data-object="{{ $appointment->id }}"  class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Solicitar Reprogramación" ><i class="fa fa-calendar"></i></a>
                        <a href="#" data-action="ausente_examen" data-path="citas_del_dia/acciones" data-object="{{ $appointment->id }}"  class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Paciente Ausente" ><i class="fa fa-sign-out"></i></a>
                        <a href="#" data-action="agregar_estudio" data-path="citas_del_dia/acciones" data-object="{{ $appointment->id }}" data-area="{{ $appointment->area }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Agregar Estudio" ><i class="fa fa-list-ul"></i></a>
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-x-ray"></i><strong> Listado De Insumos Asignados Por Estudio </strong></h2>
                    </div>

                    <div class="inside">                     
                        <div class="card-body table-responsive">
                            <table id="detalles" class= "table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #c3f3ea">
                                    <th><strong> ELIMINAR </strong></th>
                                    <th><strong> ESTUDIO </strong></th>
                                    <th><strong> MATERIAL </strong></th>
                                    <th><strong> CANTIDAD </strong></th>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            

        </div>

        <div class="row mtop16">

            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-file-prescription"></i><strong> Estudio(s) a Realizar</strong></h2>
                    </div>

                    <div class="inside"> 
                        @foreach($detalle as $d)  
                            <span class="title"><i class="fas fa-radiation-alt"></i><strong> Estudio: </strong></span> <br>
                            <span class="text">{{ $d->study->name }}</span> <br>

                            <span class="title"><i class="fas fa-user-md"></i><strong> Solicitado Por: </strong></span> <br>
                            <span class="text">{{ $d->service->name }}</span><br>

                            <span class="title"><i class="fas fa-comment"></i><strong> Comentario(s): </strong></span> <br>
                            <span class="text"> 
                                @if( $d->comment == NULL)
                                    ---- Sin Comentario(s) ----
                                @else 
                                    {{ $d->comment }}
                                @endif
                                
                            </span><br>

                            <a href="#" id="bt_search" ></a>
                            <a href="#" data-action="materiales" data-object="{{ $d->id }}" data-study="{{ $d->idstudy }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" >Asignar Material</a>

                            <hr>
                        @endforeach
                    </div>

                </div>
            </div>    


            <div class="col-md-8" id="btn_guardar">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-file-prescription"></i><strong> IBM Tecnico Ó Tecnios Que Realizarón El Estudio</strong></h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" ><strong> Tecnico No.1:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('ibm1', null, ['class'=>'form-control']) !!}                             
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="name" ><strong> Tecnico No.2:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('ibm2', null, ['class'=>'form-control']) !!}                             
                                </div>
                            </div>

                        </div>
                        
                        <p><small style="font-size: 0.95em; color:red; margin-left: 75px; font-weight: bold;" >¡Verifique los datos antes de guardar, estos no podrán ser modificados después.!</small></p>
                        <br>
                        {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                    </div>
                </div>                    
            </div>

            
            
            

        </div>
    {!! Form::close() !!}
</div>

<script>
    var modal = document.getElementById('modelId');
    $("#btn_guardar").hide();
    var cont = 0;

    $(document).ready(function(){
        $('#btn_agregar').click(function(){
            agregar_tabla();
        });

        $('#bt_add').click(function(){
            agregar();
        });
        
        $('#bt_search').click(function(){
            $('#modelId').modal("show");
        });
        $('#bt_closeModal').click(function(){
            $('#modelId').modal("hide");
        });
    });

    function evaluar(){
        if (cont > 0){
            document.getElementById("btn_guardar").style.display = "block";
        }else{
            document.getElementById("btn_guardar").style.display = "none";
        }
    }

    function eliminar(index){
        $("#fila" + index).remove();
        cont--;
        evaluar();
    }
    
</script>

@endsection