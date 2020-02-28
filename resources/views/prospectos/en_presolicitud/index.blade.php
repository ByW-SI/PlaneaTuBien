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
                                <td>{{$presolicitud->perfil->cotizacion->plan->id}} {{$presolicitud->perfil->cotizacion->plan->nombre}}</td>
                                <td>{{$presolicitud->id}}</td>
                                <td>

                                    {{-- BOTÓN MODIFICAR PLAN --}}
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-presolicitud-{{$presolicitud->id}}">
                                        Modificar
                                    </button>

                                    {{-- MODAL MODIFICAR PLAN --}}
                                    <div class="modal fade" id="modal-presolicitud-{{$presolicitud->id}}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{$presolicitud->id}}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{route('cotizaciones.planes.update',['cotizacion'=>$presolicitud->perfil->cotizacion->id])}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-12 mt-2">
                                                                <label for="">Nuevo plan</label>
                                                                <select name="plan_id" id="" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    @foreach ($planes as $plan)
                                                                    <option value="{{$plan->id}}">{{$plan->id}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 mt-2">
                                                                <button type="submit" class="btn btn-success">
                                                                    Cambiar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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