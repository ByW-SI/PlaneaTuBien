@extends('principal')
@section('content')
	<div class="card">
		<div class="card-header">
			<h5>NUEVO PLAN</h5>
		</div>
		<form method="POST" action="{{ route('plans.store') }}">
			@csrf
			
			<div class="card-body">
				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="">Tipo de plan</label>
						<select name="tipo" id="tipo_plan" class="form-control" required>
							<option value="">Seleccionar</option>
							<option value="libre">Plan libre</option>
							<option value="normal">Plan normal</option>
							<option value="clasica">Plan Tanda Clásica</option>
						</select>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="nombre">Nombre</label>
						<input type="text" placeholder="Nombre del plan" name="nombre" value="{{old("nombre")}}" class="form-control" required="">
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="abreviatura">Abreviatura</label>
						<input type="text" placeholder="abreviatura del plan" name="abreviatura" id="abreviatura" value="{{old("abreviatura")}}" class="form-control" required="">
					</div>

					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="plazo">Plazo</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="plazo" id="plazo" value="{{old("plazo")}}" min="1" class="form-control input-escondible" placeholder="Meses del plan" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_aportacion_adjudicado">Inicio de aportacion adjudicatario</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="mes_aportacion_adjudicado" id="mes_aportacion_adjudicado" value="{{old("mes_aportacion_adjudicado")}}" min="1" class="form-control input-escondible" placeholder="¿En qué mes sus aportaciones son de adjudicado?" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_adjudicado">Adjudicado al mes</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="mes_adjudicado" id="mes_adjudicado" value="{{old("mes_adjudicado")}}" min="1" class="form-control input-escondible" placeholder="¿En qué mes se completa su adjudicacion?" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_s_d">Seguro de desastres al mes</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="mes_s_d" id="mes_s_d" value="{{old("mes_s_d")}}" min="0" class="form-control" placeholder="Tiempo en que es integrante" aria-label=" plan" aria-describedby="basic-addon2">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="plan_meses">Plan (en meses)</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="plan_meses" value="{{old("plan_meses")}}" min="1" class="form-control input-escondible" placeholder="" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="actualizaciones">Número de actualizaciones</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text " id="basic-addon2">#</span>
							</div>
							<input type="number" step="1" name="actualizaciones" id="actualizaciones" value="{{old("actualizaciones")}}" min="0" class="form-control input-escondible" placeholder="Número de actualizaciones al monto a adjudicar" aria-label=" plan" aria-describedby="basic-addon2" required="">
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
						<label for="nombre">Grupos</label>
						<select name="grupos[]" id="grupos" class="select-grupos form-control" multiple="multiple" required="">
							@foreach ($grupos as $grupo)
								<option value="{{$grupo->id}}">{{"# ".$grupo->id." ".$grupo->fecha_inicio." hasta ".$grupo->fecha_fin}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 offset-lg-2 col-xl-4 offset-xl-2 form-group escondible">
						<label for="aportacion_1">Aportación extraordinaria 1</label>
						<div class="input-group mb-3">
							<input type="number" step="any" name="aportacion_1" id="aportacion_1" value="{{old("aportacion_1")}}" min="0" class="form-control input-escondible" placeholder="Porcentaje de aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_1">Mes de aportación extraordinaria 1</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text " id="basic-addon2">#</span>
							</div>
							<input type="number" step="1" name="mes_1" id="mes_1" value="{{old("mes_1")}}" min="1" class="form-control input-escondible" placeholder="Mes en el que se cobrara esta aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Mes</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 offset-lg-2 col-xl-4 offset-xl-2 form-group escondible">
						<label for="aportacion_2">Aportación extraordinaria 2</label>
						<div class="input-group mb-3">
							<input type="number" step="any" name="aportacion_2" id="aportacion_2" value="{{old("aportacion_2")}}" min="0" class="form-control input-escondible" placeholder="Porcentaje de aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_2">Mes de aportación extraordinaria 2</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text " id="basic-addon2">#</span>
							</div>
							<input type="number" step="1" name="mes_2" id="mes_2" value="{{old("mes_2")}}" min="1" class="form-control input-escondible" placeholder="Mes en el que se cobrara esta aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Mes</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 offset-lg-2 col-xl-4 offset-xl-2 form-group escondible">
						<label for="aportacion_3">Aportación extraordinaria 3</label>
						<div class="input-group mb-3">
							<input type="number" step="any" name="aportacion_3" id="aportacion_3" value="{{old("aportacion_3")}}" min="0" class="form-control input-escondible" placeholder="Porcentaje de aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_3">Mes de aportación extraordinaria 3</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text " id="basic-addon2">#</span>
							</div>
							<input type="number" step="1" name="mes_3" id="mes_3" value="{{old("mes_3")}}" min="1" class="form-control input-escondible" placeholder="Mes en el que se cobrara esta aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Mes</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 offset-lg-2 col-xl-4 offset-xl-2 form-group escondible">
						<label for="aportacion_liquidacion">Aportación extraordinaria de liquidación</label>
						<div class="input-group mb-3">
							<input type="number" step="any" name="aportacion_liquidacion" id="aportacion_liquidacion" value="{{old("aportacion_liquidacion")}}" min="0" class="form-control input-escondible" placeholder="Porcentaje de aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_liquidacion">Mes de aportación extraordinaria de liquidación</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text " id="basic-addon2">#</span>
							</div>
							<input type="number" step="1" name="mes_liquidacion" id="mes_liquidacion" value="{{old("mes_liquidacion")}}" min="1" class="form-control input-escondible" placeholder="Mes en el que se cobrara esta aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Mes</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="semestral">Porcentaje semestral</label>
						<div class="input-group mb-3 mt-4">
							<input type="number" step="any" name="semestral" id="semestral" value="{{old("semestral")}}" min="0" class="form-control input-escondible" placeholder="Semestral" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="anual">Porcentaje anual</label>
						<div class="input-group mb-3 mt-4">
							<input type="number" step="any" name="anual" id="anual" value="{{old("anual")}}" min="0" class="form-control input-escondible" placeholder="Anual" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="inscripcion">Porcentaje de inscripción</label>
						<div class="input-group mb-3 mt-4">
							<input type="number" step="any" name="inscripcion" id="inscripcion" value="{{old("inscripcion")}}" min="0" class="form-control input-escondible" placeholder="Unico" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="cuota_admon">Porcentaje de cuota de administración</label>
						<div class="input-group mb-3">
							<input type="number" step="any" name="cuota_admon" id="cuota_admon" value="{{old("cuota_admon")}}" min="0" class="form-control input-escondible" placeholder="Mensual" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="s_v">Porcentaje de seguro de vida</label>
						<div class="input-group mb-3 mt-4">
							<input type="number" step="any" name="s_v" id="s_v" value="{{old("s_v")}}" min="0" class="form-control input-escondible" placeholder="Mensual" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="s_d">Porcentaje de seguro de desastre</label>
						<div class="input-group mb-3">
							<input type="number" step="any" name="s_d" id="s_d" value="{{old("s_d")}}" min="0" class="form-control input-escondible" placeholder="Mensual" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
                <div class="row">
                    <div class="col-4 offset-4 text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Guardar
                        </button>
                    </div>
                    <div class="col-sm-4 text-right text-danger">
                        ✱Campos Requeridos.
                    </div>
                </div>
            </div>
		</form>
	</div>
@endsection
@push('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.select-grupos').select2();

		$('#tipo_plan').change( function(){

			var tipo_plan = $('#tipo_plan').val();

			// ESCONDEMOS ALGUNOS INPUTS
			if(tipo_plan == 'libre'){
				$('.input-escondible').removeAttr('required');
				$('.escondible').hide('slow');
			}

			// MOSTRAMOS ALGUNOS INPUTS
			if(tipo_plan == 'normal'){
				$('.escondible').show('slow');
				$(".input-escondible").prop('required',true);
			}

			// Rellenamos algunos campos
			if(tipo_plan == 'clasica'){
				$('.escondible').show();
				$(".input-escondible").prop('required',true);

				$('#abreviatura').val('TC');
				$('#abreviatura').prop('readonly', true);
				$('#plazo').val(168);
				$('#plazo').prop('readonly', true);
				$('#mes_aportacion_adjudicado').val('1');
				$('#mes_aportacion_adjudicado').parent().parent().hide('slow');
				$('#mes_adjudicado').val('2');
				$('#mes_adjudicado').parent().parent().hide('slow');
				$('#mes_s_d').val('1');
				$('#mes_s_d').parent().parent().hide('slow');
				$('#actualizaciones').val(0);
				$('#actualizaciones').prop('readonly', true);
				$('#aportacion_1').val(25);
				$('#mes_1').val(18);
				$('#aportacion_2').val(0);
				$('#aportacion_2').prop('readonly', true);
				$('#mes_2').val(0);
				$('#mes_2').prop('readonly', true);
				$('#aportacion_3').val(0);
				$('#aportacion_3').prop('readonly', true);
				$('#mes_3').val(0);
				$('#mes_3').prop('readonly', true);
				$('#aportacion_liquidacion').val(0);
				$('#aportacion_liquidacion').prop('readonly', true);
				$('#mes_liquidacion').val(0);
				$('#mes_liquidacion').prop('readonly', true);
				$('#semestral').val(0);
				$('#semestral').prop('readonly', true);
				$('#anual').val(1);
				$('#anual').prop('readonly', true);
				$('#inscripcion').val(3);
				$('#inscripcion').prop('readonly', true);
				$('#cuota_admon').val(0.10);
				$('#cuota_admon').prop('readonly', true);
				$('#s_v').val(0.06);
				$('#s_v').prop('readonly', true);
				$('#s_d').val(0);
				$('#s_d').prop('readonly', true);
				
				
			}
			else if(tipo_plan !== 'libre') {
				$("#abreviatura").val('');
				$("#abreviatura").prop('readonly', false);
				$('#plazo').val('');
				$('#plazo').prop('readonly', false);
				$('#mes_aportacion_adjudicado').val('');
				$('#mes_aportacion_adjudicado').parent().parent().show('slow');
				$('#mes_adjudicado').val('');
				$('#mes_adjudicado').parent().parent().show('slow');
				$('#mes_s_d').val('');
				$('#mes_s_d').parent().parent().show('slow');
				$('#actualizaciones').val('');
				$('#actualizaciones').prop('readonly', false);
				$('#aportacion_1').val('');
				$('#mes_1').val('');
				$('#aportacion_2').val('');
				$('#aportacion_2').prop('readonly', false);
				$('#mes_2').val('');
				$('#mes_2').prop('readonly', false);
				$('#aportacion_3').val('');
				$('#aportacion_3').prop('readonly', false);
				$('#mes_3').val('');
				$('#mes_3').prop('readonly', false);
				$('#aportacion_liquidacion').val('');
				$('#aportacion_liquidacion').prop('readonly', false);
				$('#mes_liquidacion').val('');
				$('#mes_liquidacion').prop('readonly', false);
				$('#semestral').val('');
				$('#semestral').prop('readonly', false);
				$('#anual').val('');
				$('#anual').prop('readonly', false);
				$('#inscripcion').val('');
				$('#inscripcion').prop('readonly', false);
				$('#cuota_admon').val('');
				$('#cuota_admon').prop('readonly', false);
				$('#s_v').val('');
				$('#s_v').prop('readonly', false);
				$('#s_d').val('');
				$('#s_d').prop('readonly', false);
			}
		} );

    });
    </script>
@endpush