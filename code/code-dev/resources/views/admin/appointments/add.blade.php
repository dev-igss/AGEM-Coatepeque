@extends('admin.master')
@section('title','Agendar Cita')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-columns"></i> Citas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agendar Nueva</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div id="alert-dia-festivo" class="row" style="text-align: center; color: red; display: none;">
            <div class="col-md-12 d-flex">
                <div class="panel shadow">
                    <!-- Modal -->

                    <div class="header" >
                        <h2 class="title"><i class="fa-solid fa-triangle-exclamation"></i><strong> Advertencia</strong></h2>
                    </div>

                    <div class="inside">
                        <h3>¡Día festivo, solo puede registrar estudio para las áreas de emergencia y hospitalización!</h3>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::open(['url'=>'/admin/cita/agregar']) !!}
        <div class="row mtop16">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <!-- Modal -->

                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i><strong> Información Paciente</strong></h2>
                    </div>

                    <div class="inside">   
                        
                        {!! Form::hidden('patient_id', null, ['class'=>'form-control', 'id'=> 'patient_id']) !!}
                        {!! Form::hidden('type_exam', null, ['class'=>'form-control', 'id'=> 'type_examp']) !!}

                        <label for="name" ><strong> Numero de Afiliacion: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('affiliationp', null, ['class'=>'form-control', 'id'=>'affiliationp']) !!}
                            {!! Form::select('type', getExamB('list', null),0,['class'=>'form-select col-md-4', 'id'=> 'exam_b' ]) !!}
                            <a href="#" class="btn btn-sm btn-info " id="btn_add_patient_search" data-toogle="tooltrip" data-placement="top" title="Buscar" ><i class="fas fa-search"></i> </a>
                            <a href="{{ url('/admin/cita/agregar') }}" class="btn btn-sm btn-warning " data-toogle="tooltrip" data-placement="top" title="Limpiar" ><i class="fa fa-refresh"></i> </a>
                        </div>

                        <label class="mtop16" style="color: red; font-size: 1em; margin-left: 50px; font-weight: bold; display: none;" id="patient_msg" >¡No se encontró al paciente, regístrelo por favor!</label>
                        
                        

                        <div class="input-group">

                            <div id="div_beneficiarios" style="display: none; margin-top: 10px; width: 100%;">
                                <label for="name" class="mtop16"><strong>¿Seleccionar Beneficiario?:</strong></label>
                                <div class="input-group ">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::select('beneficiario_question', ['0'=>'No','1'=>'Sí'],0,['class'=>'form-select', 'id'=>'beneficiario_question']) !!}
                                </div>

                                <div id="div_select_beneficiarios" style="display: none; margin-top: 10px; width: 100%;">
                                    <select name="beneficiarios" id="beneficiarios" class="form-select " aria-label="Default select example">
                                        <option selected>Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            

                        <label for="name" class="mtop16"><strong> Nombre:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('namep', null, ['class'=>'form-control', 'id'=> 'namep', 'readonly']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Apellidos:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('lastnamep', null, ['class'=>'form-control', 'id'=>'lastnamep', 'readonly']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Contacto:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('contactp', null, ['class'=>'form-control', 'id'=>'contactp']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Numero de Expediente Actual:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('numexpp', null, ['class'=>'form-control', 'id' => 'numexpp', 'readonly']) !!}
                            <a href="#" class="btn btn-sm btn-primary " id="btn_generate_code_patient_actual" ><i class="fas fa-qrcode"></i> Generar</a>
                            <a href="#" class="btn btn-sm btn-warning " id="btn_manual_code_patient_actual" ><i class="fas fa-qrcode"></i> Manual</a>
                        </div>

                        <div class="input-group"> 
                            <div id="div_manual_code_patient_actual" style="display: none; margin-top: 10px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="ibm" class="mtop16"><strong> Nomenclatura:</strong></label>
                                        {!! Form::text('num_code_nom_act', null, ['class'=>'form-control', 'id' => 'num_code_nom_act']) !!}
                                    </div>

                                    <div class="col-md-6"> 
                                        <label for="ibm" class="mtop16"><strong> Correlativo:</strong></label>
                                        {!! Form::text('num_code_cor_act', null, ['class'=>'form-control', 'id' => 'num_code_cor_act']) !!} 
                                    </div>                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">  
                                        <label for="ibm" class="mtop16"><strong> Año:</strong></label>
                                        {!! Form::text('num_code_y_act', null, ['class'=>'form-control', 'id' => 'num_code_y_act']) !!} 
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        

                        
                        

                    </div>

                </div>
            </div>

            <div class="col-md-4" id="register" style="display: none;"> 
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-calendar-alt"></i><strong> Registro de Paciente</strong></h2>
                    </div>

                    <div class="inside"> 

                        <label for="name"><strong> Nombre:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name_new', null, ['class'=>'form-control']) !!}
                            {!! Form::select('type_patient_new', getTypePatient('list', null),0,['class'=>'form-select col-md-2', 'id'=> 'patient_type' ]) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Apellidos:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('lastname_new', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label for="name" class="mtop16"><strong>Genero:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('gender_new', getGenderPatient('list', null),0,['class'=>'form-select']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">

                                <label for="name" class="mtop16"><strong>Edad:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('age_new', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <label for="name" class="mtop16"><strong> Contacto:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('contact_new', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Numero de Expediente:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('num_code_new', null, ['class'=>'form-control', 'id' => 'num_code_new']) !!}
                            <a href="#" class="btn btn-sm btn-primary " id="btn_generate_code" ><i class="fas fa-qrcode"></i> Generar</a>
                            <a href="#" class="btn btn-sm btn-warning " id="btn_manual_code" ><i class="fas fa-qrcode"></i> Manual</a>
                        </div>

                        <div class="input-group"> 
                            <div id="div_manual_code_new" style="display: none; margin-top: 10px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="ibm" class="mtop16"><strong> Nomenclatura:</strong></label>
                                        {!! Form::text('num_code_nom', null, ['class'=>'form-control', 'id' => 'num_code_nom']) !!}
                                    </div>

                                    <div class="col-md-6"> 
                                        <label for="ibm" class="mtop16"><strong> Correlativo:</strong></label>
                                        {!! Form::text('num_code_cor', null, ['class'=>'form-control', 'id' => 'num_code_cor']) !!} 
                                    </div>                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">  
                                        <label for="ibm" class="mtop16"><strong> Año:</strong></label>
                                        {!! Form::text('num_code_y', null, ['class'=>'form-control', 'id' => 'num_code_y']) !!} 
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        
                     
                        
                    </div>

                </div>
            </div>

            

            <div class="col-md-4" id="estudios_paciente" style="display: none;"> 
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-calendar-alt"></i><strong> Estudios del Paciente</strong></h2>
                    </div>

                    <div class="inside">                      
                        <table id="detalles1" class= "table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: #c3f3ea">
                                <th><strong> FECHA </strong></th>
                                <th><strong> ESTUDIO </strong></th>
                            </thead>
                            <tbody>
                                

                            </tbody>
                        </table> 


                        <label class="mtop16" style="color: red; font-size: 1.5em; margin-left: 80px; font-weight: bold; display: none;" id="appointment_msg" >¡No se encontraron estudios en esta especialidad!</label>


                        
                    </div>

                </div>
            </div> 

            
        </div>

                
        <div class="row mtop16">
            <div class="col-md-4">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-calendar-plus"></i><strong> Información Para Cita Nueva</strong></h2>
                    </div>

                    <div class="inside"> 
                        
                        <label for="name"><strong>Fecha a Agendar:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::date('date', null, ['class'=>'form-control', 'id' => 'date_new_app', 'required']) !!}
                            <!--<a href="#" class="btn btn-sm btn-info " id="bt_ver_citas" ><i class="fa-solid fa-calendar-day"></i> Ver C.C</a>-->
                        </div>

                        <div id="alert-control-citas" class="row mtop16" style="display: none;">
                            <div class="col-md-12 d-flex">
                                <div class="panel shadow">
                                    <!-- Modal -->

                                    <div class="header" >
                                        <h2 class="title"><i class="fa-solid fa-calendar-day"></i><strong> Listado de Citas Agendadas Este Día</strong></h2>
                                    </div>

                                    <div class="inside">
                                        <div id="citas_agendadas_rx" style="display: none;">
                                            <label for="name" ><strong> Control de Citas RX:</strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">AM</span>
                                                {!! Form::text('control_rx_am', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_rx_am', 'readonly']) !!}
                                                &emsp;&emsp;&emsp;&emsp;&emsp;
                                                <span class="input-group-text" id="basic-addon1">PM</span>
                                                {!! Form::text('control_rx_pm', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_rx_pm', 'readonly']) !!}
                                            </div>
                                        </div>

                                        <div id="citas_agendadas_usg" style="display: none;">
                                            <label for="name" ><strong> Control de Citas USG:</strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">AM</span>
                                                {!! Form::text('control_usg_am', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_usg_am', 'readonly']) !!}
                                                &emsp;&emsp;&emsp;&emsp;&emsp;
                                                <span class="input-group-text" id="basic-addon1">PM</span>
                                                {!! Form::text('control_usg_pm', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_usg_pm', 'readonly']) !!}
                                            </div>

                                            <label for="name" class="mtop16"><strong> Control de Citas USG Doppler:</strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">AM</span>
                                                {!! Form::text('control_usg_doppler_am', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_usg_doppler_am', 'readonly']) !!}
                                                &emsp;&emsp;&emsp;&emsp;&emsp;
                                                <span class="input-group-text" id="basic-addon1">PM</span>
                                                {!! Form::text('control_usg_doppler_pm', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_usg_doppler_pm', 'readonly']) !!}
                                            </div>
                                        </div>

                                        <div id="citas_agendadas_mmo" style="display: none;">
                                            <label for="name" ><strong> Control de Citas MMO:</strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">AM</span>
                                                {!! Form::text('control_mmo_am', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_mmo_am', 'readonly']) !!}
                                                &emsp;&emsp;&emsp;&emsp;&emsp;
                                                <span class="input-group-text" id="basic-addon1">PM</span>
                                                {!! Form::text('control_mmo_pm', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_mmo_pm', 'readonly']) !!}
                                            </div>
                                        </div>

                                        <div id="citas_agendadas_dmo" style="display: none;">
                                            <label for="name" ><strong> Control de Citas DMO:</strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">AM</span>
                                                {!! Form::text('control_dmo_am', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_dmo_am', 'readonly']) !!}
                                                &emsp;&emsp;&emsp;&emsp;&emsp;
                                                <span class="input-group-text" id="basic-addon1">PM</span>
                                                {!! Form::text('control_dmo_pm', null, ['class'=>'form-control col-md-4', 'rows' => '1', 'id'=>'control_dmo_pm', 'readonly']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {!! Form::hidden('citas_configuradas', $setting_x_hour, ['id' => 'citas_configuradas']) !!}
                        <label for="name" class="mtop16"><strong>Horarios de Atención:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            <select name="schedule" id="schedules" style="width: 88%" >
                                @foreach($schedules as $s)
                                    <option value=""></option>
                                    <option value="{{ $s->id }}">{{ \Carbon\Carbon::parse($s->hour_in)->format('H:i').' '.getHourType(null, $s->type) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="idsupplier" class="mtop16"><strong> Servicio Solicitante:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>                            
                            <select name="pidservice" id="pidservice" style="width: 88%" >
                                @foreach ($services as $s)
                                    <option value=""></option>
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="idsupplier" class="mtop16"><strong> Estudio / Examen A Realizar:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::select('studies', $studies,0,['class'=>'form-select', 'id' => 'studies', 'style' => 'width: 88%']) !!}
                            {!! Form::hidden('studies_actual', 0, ['id' => 'studies_actual']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Comentario:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('pcomment', null, ['class'=>'form-control', 'rows' => '1', 'id'=>'pcomment']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>¿Paciente Presente?:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::select('present_patient', ['0'=>'No','1'=>'Sí'],0,['class'=>'form-select' ]) !!}
                        </div>

                        <div class="input-group mtop16">
                            {!! Form::button('Agregar', ['class'=>'btn btn-primary', 'id'=>'btn_agregar']) !!}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-calendar-plus"></i><strong> Detalle de Estudio(s) a Realizar</strong></h2>
                    </div>

                    <div class="inside">

                        <div class="card-body table-responsive">
                            <table id="detalles" class= "table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #c3f3ea">
                                    <th><strong> ELIMINAR </strong></th>
                                    <th><strong> SERVICIO </strong></th>
                                    <th><strong> ESTUDIO </strong></th>
                                    <th><strong> COMENTARIO </strong></th>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>          
                
                <div class="panel shadow mtop16">
                    <div class="inside">
                        {!! Form::submit('Guardar', ['class'=>'btn btn-success', 'id'=>'btn_guardar']) !!}
                    </div>
                </div>                 
            </div>
        </div>

        
        {!! Form::close() !!}
    </div>


    <script>
       
        var modal = document.getElementById('modelId');
        var modalVerCitas = document.getElementById('modalVerCitas');
        $("#btn_guardar").hide();
        var cont = 0;


        $(document).ready(function(){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            } 
                
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("date_new_app").setAttribute("min", today);




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

            $('#bt_ver_citas').click(function(){
                $('#modalVerCitas').modal("show");
            });

            $('#bt_cerrar_ver_citas').click(function(){
                $('#modalVerCitas').modal("hide");
            });
        });



        function limpiar(){
            $("#ppatient_id").val("");
            $("#affiliation_b").val("");
            $("#ppatient_name").val("");
            $("#ppatient_lastname").val("");
            $("#ppatient_contact").val("");
            $("#pcodelast").val("");
            $("#pdate").val("");
            $("#pnumexp").val("");
            $("#pstudie").val("");
            $("#pservice").val("");
        }

        function agregar_tabla(){
            idservice=$("#pidservice").val();
            service=$("#pidservice option:selected").text();
            idstudy=$("#studies").val();
            study=$("#studies option:selected").text();
            comment=$("#pcomment").val();
            if (idservice !="" && idstudy !="" ){
                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idservice[]" value="'+idservice+'">'+service+'</td><td><input type="hidden" name="idstudy[]" value="'+idstudy+'">'+study+'</td><td><input type="hidden" name="comment[]" value="'+comment+'">'+comment+'</td></tr>';
                cont++;
                limpiar();
                evaluar();
                $('#detalles').append(fila);
            }else{
                alert("Error al ingresar el detalle de la cita, revise los datos de seleccionados.")
            }
        }

        function evaluar(){
            if (cont > 0){
                $("#btn_guardar").show();
            }else{
                $("#btn_guardar").hide();
            }
        }

        function eliminar(index){
            $("#fila" + index).remove();
            cont--;
            evaluar();
        }
        
    </script>
@endsection