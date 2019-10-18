@extends('empleado.show')
@section('submodulos')
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Laborales</a>
            </li>
            @if($empleado->tipo != "Asesor")
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.vacacions.index' , ['empleado' => $empleado]) }}">Vacaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.beneficiario.index' , ['empleado' => $empleado]) }}">Beneficiario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.permisos.index' , ['empleado' => $empleado]) }}">Permisos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.faltas.index' , ['empleado' => $empleado]) }}">Faltas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.estudios.index' , ['empleado' => $empleado]) }}">Estudios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.emergencias.index' , ['empleado' => $empleado]) }}">Emergencias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.disciplinas.index' , ['empleado' => $empleado]) }}">Falta Administrativa</a>
            </li>
        </ul>
    </div>
</div>
<div class="card card-default">
	<form role="form" method="POST" action="{{ route('empleados.laborals.store',['empleado'=>$empleado]) }}">
	{{ csrf_field() }}
	<div class="card-header">
		<h4 class="title">Datos Laborales</h4>
	</div>
	<div class="card-body">
		<div class="row row-group">
			<input type="hidden" name="empleado_id" value="{{$empleado->id}}">
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="fecha_contrato"><i class="fa fa-asterisk" aria-hidden="true"></i>Fecha de contratación:</label>
				<input class="form-control" type="date" id="fecha_contrato" name="fecha_contrato" required value="{{!$empleado->datos_laborales()->first() ? : $empleado->datos_laborales()->first()->fecha_contrato }}" {{ !$empleado->datos_laborales()->first() ? : !$empleado->datos_laborales()->first()->fecha_contrato ? : 'readonly'}}>
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="contrato_id"> Tipo de contrato:</label>
				<select type="select" class="form-control" name="contrato_id" id="contrato_id" >
                <option value="">Seleccionar</option>

					@foreach (App\TipoContrato::get() as $contrato)
                        <option value="{{$contrato->id}}">{{$contrato->nombre}}</option>
                    @endforeach
				</select>
			</div>
			{{-- INPUT FECHA FIN CONTRATO --}}
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4" id="fecha_fin_contrato" style="display: none">
				<label class="control-label" for="contrato_id"><i class="fas fa-sync"></i> Fecha de fin de contrato:</label>
				<input type="date" class="form-control" name="fecha_fin_contrato" id="input_fecha_fin_contrato">
			</div>
			{{-- INPUT PUESTO --}}
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="tipo"> Puesto:</label>
				<select required class="form-control" id="tipo" name="tipo">
                    <option value="">Seleccionar</option>
                    @foreach (App\TipoPuesto::get() as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
			</div>
			
			{{-- INPUT TIPO JORNADA --}}

			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
				<label class="control-label" for="tipo_jornada_id"> Tipo de jornada:</label>
				<select type="select" class="form-control" name="tipo_jornada_id" id="tipo_jornada_id" >
					<option value="">Seleccionar</option>
                    @foreach (App\TipoJornada::get() as $jornada)
                    <option value="{{$jornada->id}}">{{$jornada->nombre}}</option>
                    @endforeach
				</select>
			</div>

			{{-- INPUT RIESGO PUESTO --}}

			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
				<label class="control-label" for="riesgo_puesto"> Riesgo puesto:</label>
				<select type="select" class="form-control" name="riesgo_puesto" id="riesgo_puesto" >
					<option  value="">Sin Definir</option>
					<option value="1 - Clase I">1 - Clase I</option>
					<option value="2 - Clase II">2 - Clase II</option>
					<option value="3 - Clase III">3 - Clase III</option>
					<option value="4 - Clase IV">4 - Clase IV</option>
					<option value="5 - Clase V">5 - Clase V</option>
					<option value="99 - No aplica">99 - No aplica</option>
				</select>
			</div>
			
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="lugar_trabajo">Lugar de Trabajo:</label>
				<select type="select" name="lugar_trabajo" class="form-control" id="lugar_trabajo" value="">
					<option id="1" value="Oficinas">Oficinas</option>
					<option id="2" value="Campo">Campo</option>
				</select>
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="salario_nomina"><i class="fa fa-asterisk" aria-hidden="true"></i>Salario Nóminal:</label>
				<input class="form-control" type="text" id="salario_nomina" name="salario_nomina" value="" required>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="salario_dia">Salario Diario:</label>
				<input class="form-control" type="text" id="salario_dia" name="salario_dia" value="">
			</div>
			{{-- INPUT PERIODO PAGA --}}
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="periodo_paga">Periodicidad de Pago:</label>
				<select type="select" class="form-control" name="periodo_paga" id="periodo_paga">
					<option value="">Seleccionar</option>
					<option value="01 - Diario">01 - Diario</option>
					<option value="02 - Semanal">02 - Semanal</option>
					<option value="03 - Catorcenal">03 - Catorcenal</option>
					<option value="04 - Quincenal">04 - Quincenal</option>
					<option value="05 - Mensual">05 - Mensual</option>
					<option value="06 - Bimestral">06 - Bimestral</option>
					<option value="07 - Unidad obra">07 - Unidad obra</option>
					<option value="08 - Comisión">08 - Comisión</option>
					<option value="09 - Precio alzado">09 - Precio alzado</option>
					<option value="99 - otra periodicidad">99 - otra periodicidad</option>
				</select>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="prestaciones">Prestaciones:</label>
				<select class="form-control" type="select" name="prestaciones" id="prestaciones">
					<option id="1" value="De Ley">De Ley</option>
				</select>
			</div>
			{{-- INPUT REGIMEN CONTRATACION --}}
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="regimen">Régimen de Contratación:</label>
				<select class="form-control" type="select" name="regimen" id="regimen">
					<option value="">Seleccionar</option>
					<option value="02 - Sueldos">02 - Sueldos</option>
					<option value="03 - Jubilados">03 - Jubilados</option>
					<option value="04 - Pensionados">04 - Pensionados</option>
					<option value="05 - Asimilados Miembros Sociedades Cooperativas Produccion">05 - Asimilados Miembros Sociedades Cooperativas Producción</option>
					<option value="06 - Asimilados Integrantes Sociedades Asociaciones Civiles">06 - Asimilados Integrantes Sociedades Asociaciones Civiles</option>
					<option value="07 - Asimilados Miembros consejos">07 - Asimilados Miembros consejos</option>
					<option value="08 - Asimilados comisionistas">08 - Asimilados comisionistas</option>
					<option value="09 - Asimilados - Honorarios">09 - Asimilados - Honorarios</option>
					<option value="10 - Asimilados acciones">10 - Asimilados acciones</option>
					<option value="11 - Asimilados otros">11 - Asimilados otros</option>
					<option value="99 - Otro Regimen">99 - Otro Regimen</option>
				</select>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="hora_entrada">Hora de Entrada:</label>
				<input class="form-control" type="time" id="hora_entrada" name="hora_entrada" value="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="hora_salida">Hora de Salida:</label>
				<input class="form-control" type="time" id="hora_salida" name="hora_salida" value="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="hcomida">Hora de Comida:</label>
				<input class="form-control" type="time" name="hora_comida" id="hora_comida" value="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="banco"><i class="fas fa-sync"></i> Banco:</label>
				<select class="form-control" type="select" name="banco" id="banco">
					<option value="">Sin Definir</option>
					@foreach ($bancos as $banco)
						<option id="{{$banco->nombre}}" value="{{$banco->nombre}}">{{$banco->nombre}}</option>
					@endforeach
				</select>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="cuenta">Cuenta:</label>
				<input class="form-control" type="text" id="cuenta" name="cuenta" value="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="clabe">CLABE:</label>
				<input class="form-control" type="clabe" name="clabe" id="clabe" value="">
            </div>
		</div>
	</div>
	<div class="card-header">
		<h4 class="title">Datos de Baja</h4>
	</div>
	<div class="card-body">
		<div class="row row-group">
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
	            <label class="control-label" for="fecha_baja">Fecha de la baja:</label>
				<input class="form-control" type="date" id="fecha_baja" name="fecha_baja" value="">
	        </div>
	        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
	            <label class="control-label" for="baja_id">Tipo de Baja:</label>
				<select class="form-control" type="select" name="baja_id" id="baja_id">
					<option id="0" value="">No hay baja</option>
					@foreach ($bajas as $baja)
						<option id="{{$baja->id}}" value="{{$baja->id}}">{{ $baja->nombre }}</option>
					@endforeach
				</select>
	        </div>
	        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
	            <label class="control-label" for="comentario_baja">Comentarios:</label>
				<textarea class="form-control" id="comentario_baja" name="comentario_baja" maxlength="500"></textarea>
	        </div>
	    </div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<button type="submit" class="btn btn-success" id="basic-addon1">
				<i class="fas fa-save"></i>
				<strong> Guardar</strong>
			</button>
		</div>
	</div>
    </form>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        function getAreas()
        {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url: "{{ url('/getareas') }}",
            type: "GET",
            dataType: "html",
          }).done(function(resultado){
            $("#area_id").html(resultado);
          });
        }
        function getContratos(){
            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: "{{ url('/getcontratos') }}",
                type: "GET",
                dataType: "html",
            }).done(function(resultado){
                $("#contrato_id").html(resultado);
            });
        }
        function getPuestos(){
            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: "{{ url('/getpuestos') }}",
                type: "GET",
                dataType: "html",
            }).done(function(resultado){
                $("#puesto_id").html(resultado);
            });
        }
        function getBajas(){
            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: "{{ url('/getbajas') }}",
                type: "GET",
                dataType: "html",
            }).done(function(resultado){
                $("#tipobaja_id").html(resultado);
            });
        }
        function getBancos(){
            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: "{{ url('/getbancos') }}",
                type: "GET",
                dataType: "html",
            }).done(function(resultado){
                $("#banco").html(resultado);
            });
        }
        $('#salario_nomina').on('change', function(event) {
            const sal_dia = parseInt($(this).val()) / 30;
            $('#salario_dia').val( parseFloat(sal_dia).toFixed(2) );
        });

	$('#contrato_id').change( function(){

		// SI EL CONTRATO ES POR TIEMPO INDETERMINADO, AÑADIMOS EL CAMPO DE FIN DE CONTRATO, EN CASO CONTRARIO, BORRAMOS EL CAMPO
        // console.log( $(this).val() );
		if( $(this).val() == 1 ){
			$('#fecha_fin_contrato').show('slow');
		}else{
			$('#input_fecha_fin_contrato').val(null);
			$('#fecha_fin_contrato').hide('slow');
		}
	} );

</script>
@endpush
