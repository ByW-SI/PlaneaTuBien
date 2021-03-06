<div class="col-12 mt-3">
    <h4 class="text-uppercase text-muted">Datos de la cotización</h4>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form
                action="{{route('empleados.prospectos.cotizacions.store', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}"
                method="post">
                {{ csrf_field() }}
                {{-- <div class="card-body"> --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row my-3">
                    <div class="col-sm-3">
                        <input type="radio" class="inputTipoPlan" name="plan-radio" id="plan-libre" value="libre">
                        <label class="form-check-label" for="plan-libre">
                            Plan libre
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <input type="radio" class="inputTipoPlan" name="plan-radio" id="plan-clasica" value="clasica">
                        <label class="form-check-label" for="plan-clasica">
                            Tanda Clasica
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <input type="radio" class="inputTipoPlan" name="plan-radio" id="plan-tradicional"
                            value="tradicional">
                        <label class="form-check-label" for="plan-tradicional">
                            Tanda Tradicional
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <input type="radio" class="inputTipoPlan" name="plan-radio" id="plan-normal" value="normal">
                        <label class="form-check-label" for="plan-normal">
                            Plan normal
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group">
                        <label for="monto">✱Valor de la propiedad</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">$</span>
                            </div>
                            <select name="monto" id="monto" class="form-control" required="">
                                <option value="">Seleccione un monto</option>
                                @for ($i = 300000; $i <= 20000000; $i+=50000)
                                    @if ($i != 550000)
                                    <option value="{{$i}}">$ {{number_format($i,2)}}</option>
                                    @endif
                                @endfor
                            </select>
                            {{-- <input class="form-control" type="number" name="monto" id="monto" min="300000" max="20000000" step="50000" required=""> --}}
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
                            <option value="30">30%</option>
                            <option value="40">40%</option>
                        </select>
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group" id="contenedorInputPlanCliente"
                        style="display:none;">
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
                            <input class="form-control input-escondible" type="number" id="descuento_input"
                                name="descuento" min="0" max="30" value="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon1">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
                        <label class="col-form-label">Promocion:</label>
                        <select name="promocion" class="form-control" id="promocion_select">
                            <option value="">Ninguna</option>
                            @foreach ($promociones as $promocion)
                            <option value="{{$promocion->id}}">{{$promocion->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
                        <label class="col-form-label">Pago de inscripción:</label>
                        <select name="tipo_inscripcion" class="form-control input-escondible"
                            id="tipo_inscripcion_select" required="">
                            <option value="">Seleccione una opcion</option>
                            <option value="inscripcion_total">Inscripción Total</option>
                            <option value="inscripcion_diferida">Inscripción Diferida</option>
                            <option value="0_inscripcion_inicial">0% de inscripción</option>
                        </select>
                    </div>
                </div>
                <div class="row escondible" id="promocion_div">
                </div>
                <div id="cotizador">
                </div>
                {{-- </div> --}}
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
            </form>
        </div>
    </div>
</div>