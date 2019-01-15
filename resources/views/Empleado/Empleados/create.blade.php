@extends('empleado.show')
@section('submodulos')
<div class="container p-5">

    <div class="card">
        <div class="card-header">
            <h4>Agregar Empleado</h4>
        </div>
        <form method="POST" action="{{route('empleados.relaciones.store',['empleado'=>$empleado])}}">
            <div class="card-body">

                {{ csrf_field() }}
                <div class="form-row mt-3">
                    <div class="col-6 offset-3">

                        <div class="input-group">
                            <select class="custom-select" id="empleado" aria-label="Example select with button addon">
                                <option selected>Agente...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-success" type="button">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>

@endsection