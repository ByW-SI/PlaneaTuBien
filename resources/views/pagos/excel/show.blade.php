@extends('principal')
@section('content')
    <div class="container">
        <form role="form" method="POST" action="{{ route('excel.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="row">
                        {{-- Archivo de excel a subir --}}
                        <div class="form-group col-sm-12">
                            <label for="excel_file">Seleccionar archivo a importar:</label>
                            <input class="form-control" name="excel_file" type="file" id="excel_file" accept=".xls, .xlsx, .csv">
                        </div>
                        {{-- Boton para subir archivo excel --}}
                        <div class="form-group col-sm-12">
                            <input class="btn btn-success btn-block" type="submit" value="Importar">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </form>
        <form role="form" method="GET" action="{{ route('excel.find') }}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    {{-- caja de busqueda --}}
                    <div class="form-group col-sm-12">
                        <label for="query">Referencia a buscar:</label>
                        <input class="form-control" name="query" type="text" id="query" accept=".xls, .xlsx, .csv">
                    </div>
                    {{-- Boton para realizar busqueda --}}
                    <div class="form-group col-sm-12">
                        <input class="btn btn-success btn-block" type="submit" value="Buscar">
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </form>
    </div>

@endsection