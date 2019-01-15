@extends('empleado.show')
@section('submodulos')
<div class="container p-5">

    <div class="card">
        <div class="card-header">
            <h4>Crear Contactos</h4>
        </div>
        <form method="POST" action="{{route('empleados.contactos.store',['empleado'=>$empleado])}}">
        <div class="card-body">
            
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="col-4">
                        <input name="telefono" required type="text" class="form-control" placeholder="*Teléfono">
                    </div>
                    <div class="col-4">
                        <input name="celular" required type="text" class="form-control" placeholder="Celular">
                    </div>
                    <div class="col">
                        <input name="correo" required type="mail" class="form-control" placeholder="Correo">
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-4 offset-4 text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                </div>
                <div class="col-sm-4 text-right text-danger">
                    ✱Campos Requeridos.
                </div>
            </div>
        </div> 
        
        </form>
    </div>
    
</div>

@endsection