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
					<div class="col-12 col-md-4"></div>
					<div class="col-12 col-md-4">
						<label for="">Tipo de plan</label>
						<select name="tipo_plan" id="tipo_plan" class="form-control" required>
							<option value="">Seleccionar</option>
							<option value="plan libre">Plan libre</option>
							<option value="plan normal">Plan normal</option>
						</select>
					</div>
					<div class="col-12 col-md-4"></div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="nombre">Nombre</label>
						<input type="text" placeholder="Nombre del plan" name="nombre" value="{{old("nombre")}}" class="form-control" required="">
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="abreviatura">Abreviatura</label>
						<input type="text" placeholder="abreviatura del plan" name="abreviatura" value="{{old("abreviatura")}}" class="form-control" required="">
					</div>

					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="plazo">Plazo</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="plazo" value="{{old("plazo")}}" min="1" class="form-control" placeholder="Meses del plan" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_aportacion_adjudicado">Inicio de aportacion adjudicatario</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="mes_aportacion_adjudicado" value="{{old("mes_aportacion_adjudicado")}}" min="1" class="form-control input-escondible" placeholder="¿En qué mes sus aportaciones son de adjudicado?" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_adjudicado">Adjudicado al mes</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="mes_adjudicado" value="{{old("mes_adjudicado")}}" min="1" class="form-control input-escondible" placeholder="¿En qué mes se completa su adjudicacion?" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group escondible">
						<label for="mes_s_d">Seguro de desastres al mes</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="mes_s_d" value="{{old("mes_s_d")}}" min="0" class="form-control" placeholder="Tiempo en que es integrante" aria-label=" plan" aria-describedby="basic-addon2">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">Meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="plan_meses">Plan (en meses)</label>
						<div class="input-group mb-3">
							<input type="number" step="1" name="plan_meses" value="{{old("plan_meses")}}" min="1" class="form-control" placeholder="" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="1" name="actualizaciones" value="{{old("actualizaciones")}}" min="0" class="form-control input-escondible" placeholder="Número de actualizaciones al monto a adjudicar" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="any" name="aportacion_1" value="{{old("aportacion_1")}}" min="0" class="form-control input-escondible" placeholder="Porcentaje de aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="1" name="mes_1" value="{{old("mes_1")}}" min="1" class="form-control input-escondible" placeholder="Mes en el que se cobrara esta aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="any" name="aportacion_2" value="{{old("aportacion_2")}}" min="0" class="form-control input-escondible" placeholder="Porcentaje de aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="1" name="mes_2" value="{{old("mes_2")}}" min="1" class="form-control input-escondible" placeholder="Mes en el que se cobrara esta aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="any" name="aportacion_3" value="{{old("aportacion_3")}}" min="0" class="form-control input-escondible" placeholder="Porcentaje de aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="1" name="mes_3" value="{{old("mes_3")}}" min="1" class="form-control input-escondible" placeholder="Mes en el que se cobrara esta aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="any" name="aportacion_liquidacion" value="{{old("aportacion_liquidacion")}}" min="0" class="form-control input-escondible" placeholder="Porcentaje de aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="1" name="mes_liquidacion" value="{{old("mes_liquidacion")}}" min="1" class="form-control input-escondible" placeholder="Mes en el que se cobrara esta aportación" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
							<input type="number" step="any" name="semestral" value="{{old("semestral")}}" min="0" class="form-control input-escondible" placeholder="Semestral" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="anual">Porcentaje anual</label>
						<div class="input-group mb-3 mt-4">
							<input type="number" step="any" name="anual" value="{{old("anual")}}" min="0" class="form-control input-escondible" placeholder="Anual" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="inscripcion">Porcentaje de inscripción</label>
						<div class="input-group mb-3 mt-4">
							<input type="number" step="any" name="inscripcion" value="{{old("inscripcion")}}" min="0" class="form-control input-escondible" placeholder="Unico" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="cuota_admon">Porcentaje de cuota de administración</label>
						<div class="input-group mb-3">
							<input type="number" step="any" name="cuota_admon" value="{{old("cuota_admon")}}" min="0" class="form-control input-escondible" placeholder="Mensual" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="s_v">Porcentaje de seguro de vida</label>
						<div class="input-group mb-3 mt-4">
							<input type="number" step="any" name="s_v" value="{{old("s_v")}}" min="0" class="form-control input-escondible" placeholder="Mensual" aria-label=" plan" aria-describedby="basic-addon2" required="">
							<div class="input-group-append">
								<span class="input-group-text " id="basic-addon2">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 form-group escondible">
						<label for="s_d">Porcentaje de seguro de desastre</label>
						<div class="input-group mb-3">
							<input type="number" step="any" name="s_d" value="{{old("s_d")}}" min="0" class="form-control input-escondible" placeholder="Mensual" aria-label=" plan" aria-describedby="basic-addon2" required="">
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
			if(tipo_plan == 'plan libre'){
				$('.input-escondible').removeAttr('required');
				$('.escondible').hide('slow');
			}

			// MOSTRAMOS ALGUNOS INPUTS
			if(tipo_plan == 'plan normal'){
				$('.escondible').show('slow');
				$(".input-escondible").prop('required',true);
			}
		} );

    });
    </script>
@endpush