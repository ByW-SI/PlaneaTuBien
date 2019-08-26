@extends('principal')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4">
            <form action="{{route('prueba.ejecutar')}}" method="POST">
                @csrf
                <div class="form-group">
                    <p class="text-justify">
                        Este botón es de prueba. Se encarga de realizar la tarea que 
                        se ejecutará cada mes con el fin de añadir las 
                        mensualidades y asignarle a la nueva mensualidad 
                        su respectivo abono y recargo.
                    </p>
                    <button type="submit" id="prueba" class="btn btn-success btn-block">
                        EJECUTAR
                    </button>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-4"></div>
    </div>
</div>

@endsection