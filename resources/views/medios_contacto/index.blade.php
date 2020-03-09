@extends('layouts.app')

@section('content')

<div class="container">
    <h4 class="text-center text-uppercase text-muted">Medios de contacto</h4>
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    {{-- BOTON CREAR MEDIO CONTACTO --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#medioContactoCreateForm">
                        Crear
                    </button>

                    @include('componentes.medios_contacto.create')

                    {{-- TABLA DE MEDOS DE CONTACTO --}}
                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mediosDeContacto as $medioDeContacto)
                                <tr>
                                    <td>{{$medioDeContacto->nombre}}</td>
                                    <td>{{$medioDeContacto->descripcion}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#medio-contacto-{{$medioDeContacto->id}}">
                                            Editar
                                        </button>

                                        @include('componentes.medios_contacto.edit')
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-info">
                                    No hay ningún medio de comunicación
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection