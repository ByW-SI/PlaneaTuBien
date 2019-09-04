@extends('empleado.show')
@section('submodulos')
<div class="container p-5">

    <div class="card">
        <div class="card-header">
            <h4>Crear Direcciones</h4>
        </div>
        <form method="POST" action="{{route('empleados.direcciones.store',['empleado'=>$empleado])}}">
        <div class="card-body">
            
                {{ csrf_field() }}
                <div class="form-row mb-3">
                    <div class="col-4">
                        <input name="calle" required type="text" class="form-control" placeholder="*Calle">
                    </div>
                    <div class="col-4">
                        <input name="exterior" required type="text" class="form-control" placeholder="*Exterior">
                    </div>
                    <div class="col">
                        <input name="interior" required type="mail" class="form-control" placeholder="*Interior">
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-4">
                        <input name="colonia" required type="text" class="form-control" placeholder="*Colonia">
                    </div>
                    <div class="col-4">
                        <input name="delegacion" required type="text" class="form-control" placeholder="*Delegación">
                    </div>
                    <div class="col">
                        <input name="estado" required type="text" class="form-control" placeholder="*Estado">
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-4">
                        <input name="cp" required type="text" class="form-control" placeholder="*Código Postal">
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