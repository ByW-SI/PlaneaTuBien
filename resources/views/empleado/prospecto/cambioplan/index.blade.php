@extends('principal')
@section('content')
<div class="card card-default">
	<div class="card-header">
		<h4>Cambiar plan a {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}</h4>
	</div>
	<div class="card-body">
		<div class="row-group">
			<div class="d-flex justify-content-center">
				<form action="{{route('cambio-plan-update', ['prospecto' => $prospecto, 'cotizacion' => $prospecto->cotizaciones->first()])}}" method="post">
	                {{ csrf_field() }}
	                <div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
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
	                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group">
	                            <label for="monto">✱Valor de la propiedad</label>
	                            <div class="input-group mb-3">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text" id="basic-addon1">$</span>
	                                </div>
	                                <input class="form-control" type="text" name="monto" id="monto" value="{{ number_format($prospecto->cotizaciones->first()->monto, 0) }}" readonly="" required="">
	                            </div>
	                        </div>
	                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
	                            <label for="ahorro">✱Ahorro del cliente</label>
	                            <select name="ahorro" id="ahorro_cliente" class="form-control input-escondible" required="">
	                                <option value="">Seleccionar</option>
	                                <option value="0">0%</option>
	                                <option value="5">5%</option>
	                                <option value="10">10%</option>
	                                <option value="20">20%</option>
	                                <option value="30" selected="">30%</option>
	                                <option value="40">40%</option>
	                            </select>
	                        </div>
	                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
	                            <label for="plan">✱Plan</label>
	                            <select name="plan" id="plan_cliente" class="form-control input-escondible" required="">
	                                <option value="">Seleccionar</option>
	                                @foreach ($planes as $plan)
	                                    <option value="{{$plan->id}}">{{$plan->nombre}}</option>
	                                @endforeach
	                            </select>
	                        </div>
	                        <div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group escondible">
	                            <label for="monto">Porcentaje de descuento </label>
	                            <div class="input-group mb-3">
	                                <input class="form-control input-escondible" type="number" id="descuento_input" name="descuento" min="0" max="30" value="0.00">
	                                <div class="input-group-append">
	                                    <span class="input-group-text" id="basic-addon1">%</span>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
	                            <label class="col-form-label">Promocion:</label>
	                            <select name="promocion" class="form-control input-escondible" id="promocion_select">
	                                <option value="">Seleccione una de las promociones</option>
	                                    @foreach ($promociones as $promocion)
	                                        <option value="{{$promocion->id}}">{{$promocion->nombre}}</option>   
	                                    @endforeach   
	                            </select>
	                        </div>
	                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
	                            <label class="col-form-label">Pago de inscripción:</label>
	                            <select name="tipo_inscripcion" class="form-control input-escondible" id="tipo_inscripcion_select" required="">
	                                <option value="">Seleccione una opcion</option>
	                                <option value="inscripcion_total">Inscripción Total</option>   
	                                <option value="inscripcion_diferida">Inscripción Diferida</option>   
	                                <option value="0_inscripcion_inicial">0% de inscripción</option>   
	                            </select>
	                        </div>
	                    </div>
	                    <div class="row escondible" id="promocion_div">
	                    </div>
	                    <div id="cotizador" class="escondible">    
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
</div>
@endsection