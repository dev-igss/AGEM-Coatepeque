{{ url('/admin/ing_7/'.$in->id.'/accept_administration') }}

@if(kvfj(Auth::user()->permissions, 'ing7_accept_administration'))
    <a href="#" data-action="accept_administration" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Aceptar ING-7" ><i class="far fa-check-circle"></i></a>
@endif 

@if(kvfj(Auth::user()->permissions, 'ing7_accept_administration'))
    <a href="#" data-action="reject_administration" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Rechazar ING-7" ><i class="far fa-times-circle"></i></a>
@endif 

@if(kvfj(Auth::user()->permissions, 'ing7_classification'))                                   
    <a href="{{ url('/admin/ing_7/'.$in->id.'/classification') }}" data-toogle="tooltrip" data-placement="top" title="Clasificacion"><i class="fas fa-clipboard-check"></i></a>
@endif

@if(kvfj(Auth::user()->permissions, 'ing7_assignments_areas'))
    <a href="{{ url('/admin/ing_7/'.$in->id.'/assignments_areas') }}" data-toogle="tooltrip" data-placement="top" title="Asignar Area de Mantenimiento"><i class="fas fa-hard-hat"></i></a>
@endif

@if(kvfj(Auth::user()->permissions, 'ing7_buy_hire'))
    <a href="{{ url('/admin/ing_7/'.$in->id.'/buy_hire') }}" data-toogle="tooltrip" data-placement="top" title="Compra y/o Contratación"><i class="fas fa-hand-holding-usd"></i></a> 
@endif

@if(kvfj(Auth::user()->permissions, 'ing7_assignments_personal'))    
    <a href="{{ url('/admin/ing_7/'.$in->id.'/assignments_personal') }}" data-toogle="tooltrip" data-placement="top" title="Asignar Personal"><i class="fas fa-people-arrows"></i></a>                                   
@endif

@if(kvfj(Auth::user()->permissions, 'ing7_follow'))
    <a href="{{ url('/admin/ing_7/'.$in->id.'/follow') }}" data-toogle="tooltrip" data-placement="top" title="Ficha de Seguimiento"><i class="fas fa-clipboard-list"></i></a>
@endif                                    

@if(kvfj(Auth::user()->permissions, 'ing7_print'))
    @if($in->print == '0')
        <a href="{{ url('/admin/ing_7/'.$in->id.'/print') }}" target="_blank" data-toogle="tooltrip" data-placement="top" title="Imprimir"><i class="fas fa-file-pdf"></i></a>
    @endif
@endif

@if(kvfj(Auth::user()->permissions, 'ing7_delete'))
    <a href="{{ url('/admin/ing_7/'.$in->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
@endif

@if(kvfj(Auth::user()->permissions, 'ing7_record'))
    <a href="{{ url('/admin/ing_7/'.$in->id.'/record') }}" data-toogle="tooltrip" data-placement="top" title="Historial de Seguimiento"><i class="fas fa-history"></i></a>
@endif


@elseif(Auth::user()->role == "3"):
    <tbody>
        @foreach($ings7ap as $ip) 
            @foreach($ings7 as $in)
                @if($ip->iding7 == $in->id)
                    <tr>
                        <td>
                        <div class="opts">                              

                            
                            @if(kvfj(Auth::user()->permissions, 'ing7_an_audit'))
                                @if($in->status == '4' && $in->status != '100')                                   
                                    <a href="#" data-action="an_audit" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="En Revision"><i class="fas fa-search"></i></a>
                                @endif 
                            @endif 

                            @if(kvfj(Auth::user()->permissions, 'ing7_accept_reject'))
                                @if($in->status == '5' && $in->status != '100')                                   
                                    <a href="#" id="bt_search" data-object="{{ $in->id }}" data-toogle="tooltrip" data-placement="top" title="Accion"><i class="fas fa-archive"></i></a>
                                @endif 
                            @endif 

                            @if(kvfj(Auth::user()->permissions, 'ing7_in_action'))
                                @if($in->status == '6' && $in->status != '100')                                   
                                    <a href="#" data-action="in_action" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="En Ejecucion"><i class="fas fa-tools"></i></a>
                                @endif 
                            @endif 

                            @if(kvfj(Auth::user()->permissions, 'ing7_follow'))
                                @if($in->status == '8' && $in->status != '100') 
                                    <a href="{{ url('/admin/ing_7/'.$in->id.'/follow') }}" data-toogle="tooltrip" data-placement="top" title="Ficha de Seguimiento"><i class="fas fa-clipboard-list"></i></a>
                                @endif 
                            @endif                                                    

                            @if(kvfj(Auth::user()->permissions, 'ing7_finish'))
                                @if($in->status == '8' && $in->status != '100')                                   
                                    <a href="#" data-action="finish" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Cerrar / Terminar"><i class="fas fa-sign-out-alt"></i></a>
                                @endif 
                            @endif 

                            @if(kvfj(Auth::user()->permissions, 'ing7_record'))                                        
                                <a href="{{ url('/admin/ing_7/'.$in->id.'/record') }}" data-toogle="tooltrip" data-placement="top" title="Historial de Seguimiento"><i class="fas fa-history"></i></a>
                            @endif

                        </div>
                        </td>
                        <td>{{ $in->correlative  }}</td>
                        <td>{{ $in->description }}
                            <br><span><strong> Solicitado Por:</strong> {{ $in->user->name.' '.$in->user->lastname }}</span>
                            <span><strong> Servicio:</strong> {{ $in->service->name }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($in->created_at)->format('d/m/Y') }}</td>
                        <td>{{ getTypeIng7(null, $in->status) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>


    <tr>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
    </tr>
    <tr>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
    </tr>
    <tr>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
    </tr>
    <tr>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
    </tr>
    <tr>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
    </tr>
    <tr>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
    </tr>
    <tr>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
        <td> <br> </td>
    </tr>