@extends('principal')

@section('content')

<div class="container">
    <h4 class="text-center text-uppercase text-muted">
        EN PRESOLICITUD
    </h4>
    <div class="card">
        <div class="card-body">
            <div class="row-group">
                <div class="table-responsive">
                    <table class="table table-striped" id="crms">
                        <thead>
                            <tr class="thead-dark">
                                <th>Prospecto</th>
                                <th>Perfil</th>
                                <th>Plan</th>
                                <th>Presolicitud</th>
                                <th>Cambiar plan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presolicitudes as $presolicitud)
                            <tr>
                                <td>{{$presolicitud->perfil->prospecto->nombre}}
                                    {{$presolicitud->perfil->prospecto->appaterno}}
                                    {{$presolicitud->perfil->prospecto->apmaterno}}</td>
                                <td></td>
                                <td>{{$presolicitud->perfil->cotizacion->plan->id}}</td>
                                <td>{{$presolicitud->id}}</td>
                                <td>
                                    {{-- BOTÓN MODIFICAR PLAN --}}
                                    <div class="d-flex justify-content-center">
                                        <a 
                                        href="{{route('prospectos.presolicitud.show',['prospecto'=>$presolicitud->perfil->prospecto,'presolicitud'=>$presolicitud]) }}" 

                                        class="btn btn-primary">Modificar</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection