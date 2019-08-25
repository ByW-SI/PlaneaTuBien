@extends('principal')
@section('content')

<div class="container">
    {{-- Buscador de depositos efectivos --}}
    <form action="{{route('pagos.referencia.buscar')}}" method="POST" class="row">
        @csrf
        {{-- Input de fecha --}}
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="fecha">Fecha de pago</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
        </div>
        {{-- Input de monto --}}
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="monto">Monto pagado</label>
                <input type="number" name="monto" step="0.01" class="form-control" required>
            </div>
        </div>
        {{-- Botón de buscar --}}
        <div class="col-12 col-md-3">
            <div class="form-group">
                <br>
                <input type="submit" id="buscar" class="btn btn-success" value="Buscar">
            </div>
        </div>
    </form>
    {{-- Lista de los depositos efectivos sin referencia --}}
    <div class="row">
        <div class="col-12">
                <div class="card">
                        <div class="card-header">
                            Depositos efectivos
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                            <table class="table table-bordered table-striped" id="corrida">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">fecha</th>
                                        <th class="text-center" scope="col">Concepto</th>
                                        <th class="text-center" scope="col">Monto</th>
                                        <th class="text-center" scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($depositos_efectivos as $key => $deposito)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $deposito->dia }}</td>
                                        <td>{{ $deposito->concepto }}</td>
                                        <td>{{ number_format($deposito->monto, 2) }}</td>
                                        <td>
                                            <button type="button" id="asignar_pago" class="btn btn-warning">
                                                Asignar pago
                                            </button>
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
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        // console.log($('#corrdia'));
        $('#corrida').DataTable();
    } );
</script>

<script>

    $(document).ready( function(){
        $('#asignar_pago').click( function(){
            alert('clickeado');
        } );
    } );

</script>

@endsection