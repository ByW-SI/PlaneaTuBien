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
@if(Session::has('status'))
    <div class="alert alert-success" role="alert">
        <ul>
            {{ Session::get('status') }}
        </ul>
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
                        <form role="form" method="POST" action="{{ route('prospectos.store.excel') }}" accept-charset="UTF-8" enctype="multipart/form-data">
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script>
        $(document).on('change', '#excel_file', function(event) {
            var inputFile = event.currentTarget;
            $(inputFile).parent()
                .find('.custom-file-label')
                .html(inputFile.files[0].name);
        });
    </script>
@endsection
