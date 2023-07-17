@extends('admin.master')
@section('title','Bitacoras')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/bitacoras') }}" class="nav-link"><i class="fas fa-clipboard-list"></i> Bitacoras </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-clipboard-list"></i> <strong>Bitacoras</strong></h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'report_bitacora'))
                        <li>
                            <a href="{{ url('/admin/report_bitacora') }}" data-toogle="tooltrip" data-placement="top" title="Generar"><i class="fas fa-print"></i> Imprimir Reporte</a>
                        </li>
                    @endif
                    
                </ul>
            </div>

            <div class="inside">
                
                <table id="table-modules" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td><strong>ID</strong></td>
                            <td><strong>ACCION</strong></td>
                            <td><strong>REALIZADO POR</strong></td>
                            <td><strong>FECHA Y HORA</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bitacoras as $b)
                            <tr>
                                <td>{{$b->id}}</td>
                                <td>{{$b->action}}</td>
                                <td>{{$b->user->name.' '.$b->user->lastname.' - '.$b->user->ibm}}</td>
                                <td>{{$b->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection