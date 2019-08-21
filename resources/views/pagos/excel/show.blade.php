@extends('principal')
@section('content')
    @if(\Session::has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <h4>{{ Session::get('status') }}</h4>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif
    <div class="container">

        <div class="card mb-5">
            <h3 class="text-center my-3">ESTADOS DE CUENTA</h3>
            <div class="card-body">
                {{-- Contenedor excel --}}
                <div class="row">
                    <div class="col-12 col-md-4">
                    </div>
                    <div class="col-12 col-md-4">
                        <form role="form" method="POST" action="{{ route('excel.store') }}" accept-charset="UTF-8" enctype="multipart/form-data" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{-- Boton para buscar archivo excel --}}
                            <div class="input-group col-sm-12">
                                <input class="custom-file-input" name="excel_file" type="file" id="excel_file" accept=".xlsx">
                                <label for="excel_file" class="custom-file-label">Importar archivo en formato .xlsx</label>
                                <input class="btn btn-success btn-block mt-1" type="submit" value="Importar">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-4">
                    </div>
                </div>
            </div>
            <hr>
            {{-- <div class="card-body"> --}}
                
                {{-- Tabla de estados de cuenta --}}
                {{-- <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped" id="example">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Referencia</th>
                                    <th class="text-center" scope="col"># Contrato</th>
                                    <th class="text-center" scope="col">Cliente</th>
                                    <th class="text-center" scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($depostios_efectivos as $key=>$deposito_efectivo)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$deposito_efectivo->concepto}}</td>
                                    <td>
                                        @if ($deposito_efectivo->contrato()->first())
                                            {{$deposito_efectivo->contrato()->first()->numero_contrato}}
                                        @else
                                            <span class="text-danger">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($deposito_efectivo->contrato()->first())
                                            @if ($deposito_efectivo->contrato()->first()->presolicitud()->first())
                                                {{$deposito_efectivo->contrato()->first()->presolicitud()->first()->nombre}}
                                                {{$deposito_efectivo->contrato()->first()->presolicitud()->first()->paterno}}
                                                {{$deposito_efectivo->contrato()->first()->presolicitud()->first()->materno}}
                                            @endif
                                        @else
                                            <span class="text-danger">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="GET" action="{{ route('estadoCuenta.detalle') }}" class="text-center">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="deposito_id" value="{{$deposito_efectivo->id}}">
                                            <button type="submit" class="btn btn-warning" id="showDetalle">
                                                <i class="fa fa-eye"></i>
                                                <strong>Detalles</strong>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            {{-- </div> --}}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection