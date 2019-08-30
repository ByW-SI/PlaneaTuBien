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
            <h3 class="text-center my-3">Alta de clientes</h3>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                    </div>
                    <div class="col-12 col-md-4">
                        <form role="form" method="POST" action="{{ route('excel-clientes.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
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
        </div>
    </div>
@endsection