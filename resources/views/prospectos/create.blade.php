@extends('principal')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card card-default">
    <form method="POST" action="{{ route('prospectos.store') }}">
        @csrf
        <div class="card-body">
            <h4 class="text-uppercase text-muted">DATOS GENERALES</h4>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                            <label>✱ Nombre:</label>
                            <input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre" required>
                        </div>
                        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                            <label>✱ Apellido Paterno:</label>
                            <input type="text" class="form-control" value="{{ old('appaterno') }}" name="appaterno"
                                required>
                        </div>
                        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                            <label>Apellido Materno:</label>
                            <input type="text" class="form-control" value="{{ old('apmaterno') }}" name="apmaterno">
                        </div>
                        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                            <label>Fecha de nacimiento:</label>
                            <input type="date" class="form-control" value="{{ old('fecha_nacimiento') }}" name="fecha_nacimiento">
                        </div>
                        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                            <label>Sexo:</label>
                            <select name="sexo" id="" class="form-control" required>
                                <option value="">Seleccionar</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="text-uppercase text-muted mt-4">DATOS DE CONTACTO</h4>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                            <label>✱ Correo electronico:</label>
                            <input type="text" class="form-control" value="{{ old('email') }}" name="email" required>
                        </div>
                        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                            <label>Telefono:</label>
                            <input type="text" class="form-control" value="{{ old('telefono') }}" name="telefono">
                        </div>
                        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                            <label>✱ Telefono celular:</label>
                            <input type="text" class="form-control" value="{{ old('celular') }}" name="celular"
                                required="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-group mt-4">
                <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                    <label>Asesor:</label>
                    <input type="text" class="form-control" value="{{ $asesor->id == 1 ? "" : $asesor->fullname }}"
                        readonly="">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class=" justify-content-center">
                <div class=" text-right text-danger">
                    ✱Campos Requeridos.
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success" id="basic-addon1">
                        <i class="fas fa-save"></i>
                        <strong> Guardar</strong>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection