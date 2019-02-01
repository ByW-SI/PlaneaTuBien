@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.edit', ['prospecto' => $prospecto]) }}" class="btn btn-warning">
                    <strong>✎ Editar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('prospectos.info')
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}">Cotización</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}">Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CRM</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Datos de la Cotización:</h5>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}" class="btn btn-primary">
                            <i class="fa fa-bars"></i><strong> Lista de Cotizaciones</strong>
                        </a>
                    </div>
                </div>
            </div>
            <form{{-- action=" {{ route('prospectos.cotizacions.store', ['prospecto' => $prospecto]) }}" method="post" --}}>
                {{-- {{ csrf_field() }} --}}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="col-form-label">Valor de la propiedad:</label>
                            <select name="propiedad" class="form-control" id="propiedad">
                                @for($i = 300000; $i <= 20000000; $i += 50000)
                                	<option value="$i">${{ number_format($i, 2) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="col-form-label">Ahorro del cliente:</label>
                            <select name="ahorro" class="form-control" id="ahorro">
                                <option value="">Seleccionar</option>
                                <option value="0">0%</option>
                                <option value="0.05">5%</option>
                                <option value="0.1">10%</option>
                                <option value="0.2">20%</option>
                                <option value="0.3">30%</option>
                                <option value="0.4">40%</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                        	<label class="col-form-label">Plan:</label>
                        	<select name="plan" class="form-control" id="plan">
                        		<option value="">Seleccionar</option>
                        		<option value="Tanda 36">Tanda 36</option>
                        		<option value="Tanda 24">Tanda 24</option>
                        		<option value="Tanda 18">Tanda 18</option>
                        		<option value="Tanda 12">Tanda 12</option>
                        		<option value="Tanda 6">Tanda 6</option>
                        		<option value="Tanda 3">Tanda 3</option>
                        		<option value="Tanda 2">Tanda 2</option>
                        		<option value="Tanda 1">Tanda 1</option>
                        	</select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                        	<label class="col-form-label">Monto a adjudicar:</label>
                        	<div class="input-group">
                        		<div class="input-group-prepend">
                        			<span class="input-group-text">$</span>
                        		</div>
                        		<input type="text" class="form-control" readonly="">
                        	</div>
                        </div>
                        <div class="form-group col-sm-4">
                        	<label class="col-form-label">Plazo:</label>
                        	<input type="text" name="plazo" id="plazo" class="form-control" readonly="">
                        </div>
                        <div class="form-group col-sm-4">
                        	<label id="mens" class="col-form-label"></label>
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
</div>

<script type="text/javascript">
    
	var plan;
	var plazo;
	var adjudicar;

    $(document).ready(function() {

    	$(document).change(function() {
    		set();
    	});

        $('#ahorro').change(function() {
            var ahorro = $('#ahorro').val();
            plan = ahorro == '0' ? 'anda 36' : ahorro == '0.05' ? 'Tanda 12' : ahorro == '0.1' ? 'Tanda 6' : ahorro == '0.2' ? 'Tanda 3' : ahorro == '0.3' ? 'Tanda 2' : ahorro == '0.4' ? 'Tanda 1' : '';
            plazo = plan ? '120' : '';
            calculate();
        });

    });

    function set() {
    	$('#plan').val(plan);
    	$('#plazo').val(plazo);
    }

    function calculate() {
    	var flag = $('#plan').val();
    	if(flag) {
    	} else {
    	}
    }

</script>

@endsection