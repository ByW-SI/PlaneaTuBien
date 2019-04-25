<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

  		{{-- <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css"> --}}
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/skeleton.css">
		<title>Perfil</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="twelve columns">
					<div class="row">
					    <div class="six columns">
					    	<img src="img/perfil-header.png">
					    </div>
					    <div class="six columns u-pull-right">
					    	<div class="twelve columns">
					    		<div class="row">
						    		<div class="six columns u-pull-left" style="width: 25%;">
						    			<label style="/*border: 1px solid #ccc;*/ text-align: center;">
						    				Folio:
						    			</label>
						    			<label  style="/*border: 1px solid #ccc;*/ text-align: center;">
						    				Asesor:
						    			</label>
						    			<label  style="/*border: 1px solid #ccc;*/ text-align: center;">
						    				Fecha:
						    			</label>
						    			<label  style="/*border: 1px solid #ccc;*/ text-align: center;">
						    				Clave:
						    			</label>
						    			<label  style="/*border: 1px solid #ccc;*/ text-align: center;">
						    				Plan:
						    			</label>
						    		</div>
						    		<div class="six columns u-pull-right" style="width: 75%;">
						    			<label style="border-bottom: 0.5px solid #ccc; text-align: center;">
						    				{{$perfil->folio}}
						    			</label>
						    			<label style="border-bottom: 0.5px solid #ccc; text-align: center;">
						    				{{$perfil->asesor->nombre." ".$perfil->asesor->paterno." ".$perfil->asesor->materno}}
						    			</label>
						    			<label style="border-bottom: 0.5px solid #ccc; text-align: center;">
						    				{{$perfil->fecha}}
						    			</label>
						    			<label style="border-bottom: 0.5px solid #ccc; text-align: center;">
						    				{{$perfil->clave}}
						    			</label>
						    			<label style="border-bottom: 0.5px solid #ccc; text-align: center;">
						    				{{$perfil->cotizacion->plan->nombre}}
						    			</label>
						    		</div>
					    			
					    		</div>
					    	</div>
					    </div>
					</div>
				</div>
		  	</div>
		  	<div class="row">
		  		<div class="six columns">
		  			<h6>Datos Personales</h6>
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="{{$perfil->estado_civil == "Casado" || $perfil->estado_civil == "Unión Libre" ? 'six columns' : 'twelve columns'}}">
	  				<div class="row">
	  					<div class="six columns u-pull-left" style="width: 30%;">
	  						<label style=" /*border: 1px solid #ccc;*/ text-align: center;">{{$perfil->prefijo_1}}</label>
	  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Ocupación:</label>
	  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Empresa:</label>
	  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Antigüedad:</label>
	  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Salario:</label>
	  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">RFC:</label>
	  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Nacionalidad:</label>
	  					</div>
	  					<div class="six columns u-pull-right" style="width: 70%;">
	  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->nombre_completo_1}}</label>
	  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->ocupacion_1}}</label>
	  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->empresa_1}}</label>
	  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->antiguedad_1}}</label>
	  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->salario_1}}</label>
	  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{strtoupper ( $perfil->rfc_1)}}</label>
	  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{strtoupper ( $perfil->nacionalidad_1)}}</label>
	  					</div>
	  				</div>
		  		</div>
		  		@if ($perfil->estado_civil == "Casado" || $perfil->estado_civil == "Unión Libre")
		  			<div class="six columns" style="border-left: 1px solid gray;">
		  				<div class="row">
		  					<div class="six columns u-pull-left" style="width: 30%;">
		  						<label style=" /*border: 1px solid #ccc;*/ text-align: center;">{{$perfil->prefijo_2}}</label>
		  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Ocupación:</label>
		  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Empresa:</label>
		  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Antigüedad:</label>
		  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Salario:</label>
		  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">RFC:</label>
		  						<label style="/*border: 1px solid #ccc;*/ text-align: center;">Nacionalidad:</label>
		  					</div>
		  					<div class="six columns u-pull-right" style="width: 70%;">
		  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->nombre_completo_2}}</label>
		  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->ocupacion_2}}</label>
		  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->empresa_2}}</label>
		  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->antiguedad_2}}</label>
		  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->salario_2}}</label>
		  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{strtoupper ( $perfil->rfc_2)}}</label>
		  						<label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{strtoupper ( $perfil->nacionalidad_2)}}</label>
		  					</div>
		  				</div>
			  		</div>
		  		@endif
		  	</div>
		  	<div class="row">
		  		<div class="twelve columns">
		  			<div class="two columns u-pull-left">
		  				<label style=" text-align: left;">Estado Civil:</label>
		  			</div>
            <div class="ten columns u-pull-right">
              <div class="row">
                <div class="twelve columns">
                  <div class="four columns u-pull-left">
                    <div class="six columns u-pull-left">
                      <label><input type="radio" id="Soltero" {{$perfil->estado_civil == "Soltero" ? 'checked="checked"' :""}}>Soltero</label>
                    </div>
                    <div class="six columns u-pull-right">
                      <label><input type="radio" id="Casado" {{$perfil->estado_civil == "Casado" ? 'checked="checked"' :""}}>Casado</label>
                    </div>        
                  </div>
                  <div class="eight columns u-pull-right">
                    <div class="eight columns u-pull-right">
                      <div class="six columns u-pull-left">
                        <label><input type="radio" id="Unión Libre" {{$perfil->estado_civil == "Unión Libre" ? 'checked="checked"' :""}}>Unión Libre</label>
                      </div>
                      <div class="six columns u-pull-right">
                        <label><input type="radio" id="Divorciado" {{$perfil->estado_civil == "Divorciado" ? 'checked="checked"' :""}}>Divorciado</label>
                      </div>      
                    </div>
                    <div class="four columns u-pull-left">
                      <label><input type="radio" id="Viudo" {{$perfil->estado_civil == "Viudo" ? 'checked="checked"' :""}}>Viudo</label>
                    </div>
                  </div>                    
                </div>
              </div>
            </div>
		  		</div>
		  	</div>
        <div class="row">
          <div class="twelve columns">
            <div class="row">
              <div class="four columns u-pull-left">
                <label for="" style="text-align: left;">Régimen Matrimonial:</label>
              </div>
              <div class="eight columns u-pull-right">
                {{-- <div class="row"> --}}
                  <div class="six columns u-pull-left">
                    <label><input type="radio" id="Sociedad Conyugal" {{$perfil->regimen_matrimonial == "Sociedad Conyugal" ? 'checked="checked"' :""}}>Sociedad Conyugal</label>
                  </div>
                  <div class="six columns u-pull-right">
                    <label><input type="radio" id="Separación de Bienes" {{$perfil->regimen_matrimonial == "Separación de Bienes" ? 'checked="checked"' :""}}>Separación de Bienes</label>
                  </div>
                {{-- </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="two columns u-pull-left">
            <label for="" style="text-align: left;">Dirección:</label>
          </div>
          <div class="ten columns u-pull-right">
            <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->direccion}}</label>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="six columns u-pull-left">
              <div class="four columns u-pull-left">
                <label for="" style="text-align: left;">Teléfono de casa:</label>
              </div>
              <div class="eight columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->telefono_casa}}</label>
              </div>
            </div>
            <div class="six columns u-pull-right">
              <div class="four columns u-pull-left">
                <label for="" style="text-align: left;">Celular:</label>
              </div>
              <div class="eight columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->telefono_celular}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="six columns u-pull-left">
              <div class="four columns u-pull-left">
                <label for="" style="text-align: left;">Teléfono oficina:</label>
              </div>
              <div class="eight columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->telefono_oficina}}</label>
              </div>
            </div>
            <div class="six columns u-pull-right">
              <div class="four columns u-pull-left">
                <label for="" style="text-align: left;">Email:</label>
              </div>
              <div class="eight columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->email}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="seven columns u-pull-left">
              <div class="six columns u-pull-left">
                <label for="" style="text-align: left;">Residencia Actual:</label>
              </div>
              <div class="six columns u-pull-right">
                <div class="four columns u-pull-left">
                  <label><input type="radio" id="Casa" {{$perfil->tipo_residencia == "Casa" ? 'checked="checked"' :""}}>Casa</label>
                </div>
                <div class="eight columns u-pull-right">
                  <label><input type="radio" id="Departamento" {{$perfil->tipo_residencia == "Departamento" ? 'checked="checked"' :""}}>Departamento</label>
                </div>
              </div>
            </div>
            <div class="five columns u-pull-right">
              <div class="five columns u-pull-left">
                <label for="" style="text-align: left;">Habitantes:</label>
              </div>
              <div class="seven columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->habitantes}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="seven columns u-pull-left">
              <div class="six columns u-pull-left">
                <div class="six columns u-pull-left">
                  <label><input type="radio" id="Propio" {{$perfil->duenio_residencia == "Propio" ? 'checked="checked"' :""}}>Propio</label>
                </div>
                <div class="six columns u-pull-right">
                  <label><input type="radio" id="Familiar" {{$perfil->duenio_residencia == "Familiar" ? 'checked="checked"' :""}}>Familiar</label>
                </div>
              </div>
              <div class="six columns u-pull-right">
                <div class="five columns u-pull-left">
                  <label><input type="radio" id="Renta" {{$perfil->duenio_residencia == "Renta" ? 'checked="checked"' :""}}>Renta</label>
                </div>
                <div class="seven columns u-pull-right">
                  <label><input type="radio" id="Hipotecada" {{$perfil->duenio_residencia == "Hipotecada" ? 'checked="checked"' :""}}>Hipotecada</label>
                </div>
              </div>
            </div>
            <div class="five columns u-pull-right">
              <div class="five columns u-pull-left">
                <label for="" style="text-align: right;">$</label>
              </div>
              <div class="seven columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{number_format($perfil->costo_residencia,2)}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="five columns u-pull-left">
              <label for="" style="text-align: left;">¿Cuánto tiempo lleva viviendo ahí?</label>
            </div>
            <div class="seven columns u-pull-right">
              <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{number_format($perfil->costo_residencia,2)}}</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="six columns u-pull-left">
              <div class="five columns u-pull-left">
                <label for="" style="text-align: left;">Hijos:</label>
              </div>
              <div class="seven columns u-pull-right">
                <div class="six columns u-pull-left">
                  <label><input type="radio" id="hijos_si" {{$perfil->hijos ? 'checked="checked"' :""}}>Si</label>
                </div>
                <div class="six columns u-pull-right">
                  <label><input type="radio" id="hijos_no" {{!$perfil->hijos ? 'checked="checked"' :""}}>No</label>
                </div>                  
              </div>
            </div>
            <div class="six columns u-pull-right">
              <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->numero_hijos ? $perfil->numero_hijos : "0"}}</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="six columns u-pull-left">
              <div class="five columns u-pull-left">
                <label for="" style="text-align: left;">Dependientes económicos:</label>
              </div>
              <div class="seven columns u-pull-right">
                <div class="six columns u-pull-left">
                  <label><input type="radio" id="dependientes_economicos_si" {{$perfil->dependientes_economicos ? 'checked="checked"' :""}}>Si</label>
                </div>
                <div class="six columns u-pull-right">
                  <label><input type="radio" id="dependientes_economicos_no" {{!$perfil->dependientes_economicos ? 'checked="checked"' :""}}>No</label>
                </div>
              </div>
            </div>
            <div class="six columns u-pull-right">
              <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->numero_dependientes ? $perfil->numero_dependientes : "0"}}</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="six columns u-pull-left">
              <div class="six columns u-pull-left">
                <label for="" style="text-align: left;">Ingresos extras:</label>
              </div>
              <div class="six columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->ingresos_extras ? $perfil->ingresos_extras : "0"}}</label>
              </div>
            </div>
            <div class="six columns u-pull-right">
              <div class="six columns u-pull-left">
                <label for="" style="text-align: left;">Ingresos totales:</label>
              </div>
              <div class="six columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->ingreso_total ? number_format($perfil->ingreso_total,2) : "0"}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="ten columns u-pull-left">
              <label for="" style="text-align: left;">¿Cuenta con algún tipo de enganche o ahorro destinado para iniciar?</label>
            </div>
            <div class="two columns u-pull-right">
              <div class="six columns u-pull-left">
                <label><input type="radio" id="ahorro_inicial_si" {{$perfil->ahorro_inicial ? 'checked="checked"' :""}}>Si</label>
              </div>
              <div class="six columns u-pull-right">
                <label><input type="radio" id="ahorro_inicial_no" {{!$perfil->ahorro_inicial ? 'checked="checked"' :""}}>No</label>
              </div>
            </div>
          </div>
        </div>
        <div class="page-break"></div>
        <div class="row">
          <div class="twelve columns">
            <div class="four columns u-pull-left">
              <label for="" style="text-align: left;">¿En qué forma lo tiene disponible?</label>
            </div>
            <div class="eight columns u-pull-right">
              <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->forma_ahorro ? $perfil->forma_ahorro : "Ninguna"}}</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="six columns u-pull-left">
              <div class="six columns u-pull-left">
                <label for="" style="text-align: left;">¿Ahorra?</label>
              </div>
              <div class="six columns u-pull-right">
                <div class="six columns u-pull-left">
                  <label><input type="radio" id="ahorra_si" {{$perfil->ahorra ? 'checked="checked"' :""}}>Si</label>
                </div>
                <div class="six columns u-pull-right">
                  <label><input type="radio" id="ahorra_no" {{!$perfil->ahorra ? 'checked="checked"' :""}}>No</label>
                </div>
              </div>
            </div>
            <div class="six columns u-pull-right">    
              <label style="border-bottom: 0.5px solid #ccc; text-align: center;">${{$perfil->ahorros ? number_format($perfil->ahorros,2)." ".$perfil->tipo_ahorro : "0"}}</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="seven columns u-pull-left">
              <div class="nine columns u-pull-left">
                <label for="" style="text-align: left;">¿Alguna otra persona participará en la compra? </label>
              </div>
              <div class="three columns u-pull-right">
                <div class="six columns u-pull-left">
                  <label><input type="radio" id="otro_participante_si" {{$perfil->otro_participante ? 'checked="checked"' :""}}>Si</label>
                </div>
                <div class="six columns u-pull-right">
                  <label><input type="radio" id="otro_participante_no" {{!$perfil->otro_participante ? 'checked="checked"' :""}}>No</label>
                </div>
              </div>
            </div>
            <div class="five columns u-pull-right">
              <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->participante ? $perfil->participante : "Nadie"}}</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="six columns">
            <h6>Historial Crediticio</h6>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="six columns u-pull-left">
              <div class="ten columns u-pull-left">
                <label><input type="radio" id="tarjeta_debito_si" {{$perfil->historial_crediticio->tarjeta_debito ? 'checked="checked"' :""}}>Tarjeta de Débito o Cuenta de Ahorro</label>
              </div>
              <div class="two columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->historial_crediticio->numero_tarjeta_debito ? $perfil->historial_crediticio->numero_tarjeta_debito : "0"}}</label>
              </div>
            </div>
            <div class="six columns u-pull-right">
              <div class="ten columns u-pull-left">
                <label><input type="radio" id="tarjeta_credito_si" {{$perfil->historial_crediticio->tarjeta_credito ? 'checked="checked"' :""}}>Tarjeta de Crédito</label>
              </div>
              <div class="two columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->historial_crediticio->numero_tarjeta_credito ? $perfil->historial_crediticio->numero_tarjeta_credito : "0"}}</label>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="one-half column">
            @if ($perfil->historial_crediticio->tarjetas_debito != "null")
              @foreach (json_decode($perfil->historial_crediticio->tarjetas_debito) as $key=>$debito)
                  <label style="border-bottom: 0.5px solid #ccc; text-align: center;">#{{$key+1}} {{$debito}}</label>
              @endforeach
            @endif
          </div>
          <div class="one-half column">
            @if ($perfil->historial_crediticio->tarjetas_credito != "null")
              @forelse (json_decode($perfil->historial_crediticio->tarjetas_credito) as $key=>$credito)
                  <label style="border-bottom: 0.5px solid #ccc; text-align: center;">#{{$key}} {{$credito}}</label>
              @endforeach
            @endif
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="one-half column u-pull-left">
              <div class="two-thirds column u-pull-left">
                <div class="one-half column u-pull-left">
                  <label for="" style="text-align: left;">Buró de Crédito:</label>
                </div>
                <div class="one-half column u-pull-right">
                  <div class="one-half column u-pull-left">
                    <label><input type="radio" id="en_buro_credito_si" {{$perfil->historial_crediticio->en_buro_credito ? 'checked="checked"' :""}}>Si</label>
                  </div>
                  <div class="one-half column u-pull-right">
                    <label><input type="radio" id="en_buro_credito_no" {{!$perfil->historial_crediticio->en_buro_credito ? 'checked="checked"' :""}}>No</label>
                  </div>
                </div>
              </div>
              <div class="one-third column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->historial_crediticio->buro_credito ? $perfil->historial_crediticio->buro_credito : "0"}}</label>
              </div>
            </div>
            <div class="one-half column u-pull-right">
              <div class="one-half column u-pull-left">
                <label for="" style="text-align: left;">Límite de Crédito:</label>
              </div>
              <div class="one-half column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">${{$perfil->historial_crediticio->limite_credito ? number_format($perfil->historial_crediticio->limite_credito,2) : "0"}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="one-half column u-pull-left">
              <div class="one-third column u-pull-left">
                <label for="" style="text-align: left;">Destino:</label>
              </div>
              <div class="two-thirds column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->historial_crediticio->destino_1 ? $perfil->historial_crediticio->destino_1 : "Nada"}}</label>
              </div>
            </div>
            <div class="one-half column u-pull-right">
              <div class="one-half column u-pull-left">
                <div class="row">
                  <div class="one-half column u-pull-left">
                    <label><input type="radio" id="tipo_destino_1_semanal" {{$perfil->historial_crediticio->tipo_destino_1 == "Semanal" ? 'checked="checked"' :""}}>Semanal</label>
                  </div>
                  <div class="one-half column u-pull-right">
                    <label><input type="radio" id="tipo_destino_1_mensual" {{!$perfil->historial_crediticio->tipo_destino_1 == "Mensual" ? 'checked="checked"' :""}}>Mensual</label>
                  </div>
                </div>
              </div>
              <div class="one-half column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">${{$perfil->historial_crediticio->monto_destino_1 ? number_format($perfil->historial_crediticio->monto_destino_1,2) : "0"}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="one-half column u-pull-left">
              <div class="one-third column u-pull-left">
                <label for="" style="text-align: left;">Destino:</label>
              </div>
              <div class="two-thirds column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->historial_crediticio->destino_2 ? $perfil->historial_crediticio->destino_2 : "Nada"}}</label>
              </div>
            </div>
            <div class="one-half column u-pull-right">
              <div class="one-half column u-pull-left">
                <div class="row">
                  <div class="one-half column u-pull-left">
                    <label><input type="radio" id="tipo_destino_2_semanal" {{$perfil->historial_crediticio->tipo_destino_2 == "Semanal" ? 'checked="checked"' :""}}>Semanal</label>
                  </div>
                  <div class="one-half column u-pull-right">
                    <label><input type="radio" id="tipo_destino_2_mensual" {{!$perfil->historial_crediticio->tipo_destino_2 == "Mensual" ? 'checked="checked"' :""}}>Mensual</label>
                  </div>
                </div>
              </div>
              <div class="one-half column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">${{$perfil->historial_crediticio->monto_destino_2 ? number_format($perfil->historial_crediticio->monto_destino_2,2) : "0"}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="one-half column u-pull-left">
              <div class="one-third column u-pull-left">
                <label for="" style="text-align: left;">Destino:</label>
              </div>
              <div class="two-thirds column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->historial_crediticio->destino_3 ? $perfil->historial_crediticio->destino_3 : "Nada"}}</label>
              </div>
            </div>
            <div class="one-half column u-pull-right">
              <div class="one-half column u-pull-left">
                <div class="row">
                  <div class="one-half column u-pull-left">
                    <label><input type="radio" id="tipo_destino_3_semanal" {{$perfil->historial_crediticio->tipo_destino_3 == "Semanal" ? 'checked="checked"' :""}}>Semanal</label>
                  </div>
                  <div class="one-half column u-pull-right">
                    <label><input type="radio" id="tipo_destino_3_mensual" {{$perfil->historial_crediticio->tipo_destino_3 == "Mensual" ? 'checked="checked"' :""}}>Mensual</label>
                  </div>
                </div>
              </div>
              <div class="one-half column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">${{$perfil->historial_crediticio->monto_destino_3 ? number_format($perfil->historial_crediticio->monto_destino_3,2) : "0"}}</label>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="one-half column u-pull-left">
            <h6>Inmueble Pretendido</h6>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="two-thirds column u-pull-left">
              <div class="five columns u-pull-left">
                <div class="four columns u-pull-left">
                  <label><input type="radio" {{$perfil->inmueble_pretendido->tipo_inmueble == "Casa" ? 'checked="checked"' :""}}>Casa</label>
                </div>
                <div class="eight columns u-pull-right">
                  <label><input type="radio" {{$perfil->inmueble_pretendido->tipo_inmueble == "Departamento" ? 'checked="checked"' :""}}>Departamento</label>
                </div>
              </div>
              <div class="seven columns u-pull-right">
                <div class="four columns u-pull-left">
                  <label><input type="radio" {{$perfil->inmueble_pretendido->tipo_inmueble == "Terreno" ? 'checked="checked"' :""}}>Terreno</label>
                </div>
                <div class="eight columns u-pull-right">
                  <label><input type="radio" {{$perfil->inmueble_pretendido->tipo_inmueble == "Local Comercial" ? 'checked="checked"' :""}}>Local Comercial</label>
                </div>
              </div>
            </div>
            <div class="one-third column u-pull-right">
              <div class="five columns u-pull-left">
                <label><input type="radio" {{$perfil->inmueble_pretendido->tipo_inmueble == "Bodega" ? 'checked="checked"' :""}}>Bodega</label>
              </div>
              <div class="seven columns u-pull-right">
                <div class="one-half column u-pull-left">
                  <label><input type="radio" @if (!in_array($perfil->inmueble_pretendido->tipo_inmueble, ['Casa','Departamento','Terreno','Local Comercial','Bodega']))
                    checked="checked" 
                  @endif>Otro:</label>
                </div>
                <div class="one-half column u-pull-right">
                  @if (!in_array($perfil->inmueble_pretendido->tipo_inmueble, ['Casa','Departamento','Terreno','Local Comercial','Bodega'])) 
                    <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->inmueble_pretendido->tipo_inmueble}}</label>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="two-thirds column u-pull-left">
              <div class="one-third column u-pull-left">
                <label for="" style="text-align: left;">Precio Aproximado:</label>
              </div>
              <div class="two-thirds column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">${{number_format($perfil->inmueble_pretendido->precio_aprox,2)}}</label>
              </div>
            </div>
            <div class="one-third column u-pull-right">
              <div class="two columns u-pull-left">
                <label for="" style="text-align: left;">m²:</label>
              </div>
              <div class="ten columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{number_format($perfil->inmueble_pretendido->area_inmueble,2)}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="one-half column u-pull-left">
              <div class="two columns u-pull-left">
                <label for="" style="text-align: left;">Estado:</label>
              </div>
              <div class="ten columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->inmueble_pretendido->estado}}</label>
              </div>
            </div>
            <div class="one-half column u-pull-right">
              <div class="two columns u-pull-left">
                <label for="" style="text-align: left;">Colonia:</label>
              </div>
              <div class="ten columns u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->inmueble_pretendido->colonia}}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="one-third column u-pull-left">
              <div class="seven columns u-pull-left">
                <div class="two-thirds column u-pull-left">
                  <label for="" style="text-align: left;">Recámaras:</label>
                </div>
                <div class="one-third column u-pull-right">
                  <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->inmueble_pretendido->recamara ? $perfil->inmueble_pretendido->recamara : '0'}}</label>
                </div>
              </div>
              <div class="five columns u-pull-right">
                <div class="two-thirds column u-pull-left">
                  <label for="" style="text-align: left;">Baños:</label>
                </div>
                <div class="one-third column u-pull-right">
                  <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->inmueble_pretendido->banio ? $perfil->inmueble_pretendido->banio : '0' }}</label>
                </div>
              </div>
            </div>
            <div class="two-thirds column u-pull-right">
              <div class="two-thirds column u-pull-left">
                <div class="row">
                  <div class="nine columns u-pull-left">
                    <label for="" style="text-align: left;">Lugares de estacionamiento:</label>
                  </div>
                  <div class="three columns u-pull-right">
                    <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->inmueble_pretendido->estacionamiento ? $perfil->inmueble_pretendido->estacionamiento : '0' }}</label>
                  </div>
                </div>
              </div>
              <div class="one-third column u-pull-right">
                <div class="one-half column u-pull-left">
                  <label for="" style="text-align: left;">Jardin:</label>
                </div>
                <div class="one-half column u-pull-right">
                  <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->inmueble_pretendido->jardin ? $perfil->inmueble_pretendido->jardin : '0' }}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="one-half column u-pull-left">
              <div class="one-half column u-pull-left">
                <label for="" style="text-align: left;">Gastos notariales:</label>
              </div>
              <div class="one-half column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$perfil->inmueble_pretendido->gastos_notariales ? $perfil->inmueble_pretendido->gastos_notariales : '' }}</label>
              </div>
            </div>
            <div class="one-half column u-pull-right">
              <div class="one-half column u-pull-left">
                <label for="" style="text-align: left;">Gastos notariales:</label>
              </div>
              <div class="one-half column u-pull-right">
                <label style="border-bottom: 0.5px solid #ccc; text-align: center;">${{ number_format($perfil->inmueble_pretendido->monto_contratar,2) }}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <label for="" style="text-align: left;">¿Cuánto tiempo ha pensado en esta compra?:</label>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns" style="border-bottom: 0.5px solid #ccc; text-align: center;">
            @if ($perfil->inmueble_pretendido->tiempo_decision)
              <label>{{$perfil->inmueble_pretendido->tiempo_decision}}</label>
            @else
              <br>
            @endif
          </div>
        </div>
        <div class="row page-break"></div>
        <div class="row">
          <div class="twelve columns">
            <label for="" style="text-align: left;">¿Cuánta prioridad le da a esta meta?:</label>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns" style="border-bottom: 0.5px solid #ccc; text-align: center;">
            @if ($perfil->inmueble_pretendido->prioridad )
              <label>{{$perfil->inmueble_pretendido->prioridad}}</label>
            @else
              <br>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="eight columns u-pull-left">
              <label for="" style="text-align: left;">¿La decisión de cumplir su meta depende de alguien más? :</label>
            </div>
            <div class="four columns u-pull-right">
              <div class="one-half column u-pull-left">
                <label><input type="radio" {{$perfil->inmueble_pretendido->desicion_propia ? 'checked="checked"' :""}}>Si</label>
              </div>
              <div class="one-half column u-pull-right">
                <label><input type="radio" {{!$perfil->inmueble_pretendido->desicion_propia ? 'checked="checked"' :""}}>No</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns" style="border-bottom: 0.5px solid #ccc; text-align: center;">
            @if ($perfil->inmueble_pretendido->toma_desicion)
              <label>{{$perfil->inmueble_pretendido->toma_desicion}}</label>
            @else
              <br>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <label for="" style="text-align: left;">¿Porqué no ha logrado su meta?:</label>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns" style="border-bottom: 0.5px solid #ccc; text-align: center;">
            @if ($perfil->inmueble_pretendido->lograr_meta)
              <label>{{ $perfil->inmueble_pretendido->lograr_meta }}</label>
            @else
              <br>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="ten columns u-pull-left">
              <label for="" style="text-align: left;">Si el día de hoy le ofrecemos una propuesta de esquema de financiamiento adaptada a sus necesidades y posibilidades ¿Lo tomaría?:</label>
            </div>
            <div class="two columns u-pull-right">
              <div class="one-half column u-pull-left">
                <label><input type="radio" {{$perfil->inmueble_pretendido->desicion_propia ? 'checked="checked"' :""}}>Si</label>
              </div>
              <div class="one-half column u-pull-right">
                <label><input type="radio" {{!$perfil->inmueble_pretendido->desicion_propia ? 'checked="checked"' :""}}>No</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns"  style="border-bottom: 0.5px solid #ccc; text-align: center;">
            @if ($perfil->inmueble_pretendido->motivo_tomaria_desicion)
              <label>{{$perfil->inmueble_pretendido->motivo_tomaria_desicion}}</label>
            @else
            <br>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="one-half column u-pull-left">
               <label for="" style="text-align: left;">Medio por el cuál se enteró de nosotros:</label>
            </div>
            <div class="one-half column u-pull-right" style="border-bottom: 0.5px solid #ccc; text-align: center;">
              @if ($perfil->inmueble_pretendido->medio_entero)
                <label>{{$perfil->inmueble_pretendido->medio_entero}}</label>
              @else
                <br>
              @endif
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="twelve columns">
            <h6>Referencias Personales</h6>
          </div>
        </div>
        @foreach ($perfil->referencia_personals as $referencia)
          <div class="row">
            <div class="twelve columns">
              <div class="two-thirds column u-pull-left">
                <div class="two columns u-pull-left">
                  <label for="" style="text-align: left;">Nombre:</label>
                </div>
                <div class="ten columns u-pull-right">
                  <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$referencia->nombre_completo}}</label>
                </div>
              </div>
              <div class="one-third column u-pull-right">
                <div class="one-half column u-pull-left">
                  <label for="" style="text-align: left;">Parentesco:</label>
                </div>
                <div class="one-half column u-pull-right">
                  <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$referencia->parentesco}}</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="twelve columns">
              <div class="one-half column u-pull-left">
                <div class="three columns u-pull-left">
                  <label for="" style="text-align: left;">Teléfono:</label>
                </div>
                <div class="nine columns u-pull-right">
                  <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$referencia->telefono}}</label>
                </div>
              </div>
              <div class="one-half column u-pull-right">
                <div class="two columns u-pull-left">
                  <label for="" style="text-align: left;">Celular:</label>
                </div>
                <div class="ten columns u-pull-right">
                  <label style="border-bottom: 0.5px solid #ccc; text-align: center;">{{$referencia->celular}}</label>
                </div>
              </div>
            </div>
          </div>
          <br>
        @endforeach
        <div class="row">
          <div class="six columns">
            <h6>Observaciones</h6>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns" style="border-bottom: 0.5px solid #ccc; text-align: center;"></div>
        </div>
        <br>
        <div class="row">
          <div class="twelve columns" style="border-bottom: 0.5px solid #ccc; text-align: center;"></div>
        </div>
        <br>
        <div class="row">
          <div class="twelve columns" style="border-bottom: 0.5px solid #ccc; text-align: center;"></div>
        </div>
        <br>
        <div class="row">
          <div class="twelve columns" style="border-bottom: 0.5px solid #ccc; text-align: center;"></div>
        </div>
        <div style="position: fixed;left: 0;bottom: 100;width: 100%;">
            <div class="row">
              <div class="twelve columns">
                <p style="font-family: 'Times New Roman', Times, serif; font-style: italic; font-size: 10px;">
                  BAJO PROTESTA DE DECIR VERDAD DECLARO QUE NINGUNA DE LAS ACTIVIDADES QUE DESEMPEÑO EN MI VIDA DIARIA SE CONSIDERA UNA ACTIVIDAD RELEVANTE, INUSUAL O VULNERABLE DE CONFORMIDAD CON LA LFPIORPI (Ley Federal de la Prevención e Identificación de Operaciones con el Recurso de Procedencia Ilicita), RAZÓN POR LA CUAL PROPORCIONARÉ LA DOCUMENTACIÓN NECESARIA PARA VERIFICAR MI SITUACION PATRIMONIAL Y FINANCIERA, CON EL FIN DE INICIAR O CONTINUAR UNA RELACIÓN COMERCIAL Y CONTRACTUAL CON PLANEA TU BIEN S.A. DE C.V. 
                </p>
                <label style="text-align: left;">
                Hago constar que la información proporcionada es verdadera
                </label>
              </div>
            </div>
            <div class="row">
              <div class="twelve columns">
                <div class="two-thirds column u-pull-left">
                  <div class="two columns u-pull-left">
                    <label style="text-align: left;">Nombre:</label>
                  </div>
                  <div class="ten columns u-pull-right" style="border-bottom: 0.5px solid #ccc; text-align: left;">
                    <br>
                  </div>
                </div>
                <div class="one-third column u-pull-right">
                  <div class="three columns u-pull-left">
                    <label style="text-align: left;">Firma:</label>
                  </div>
                  <div class="nine columns u-pull-right" style="border-bottom: 0.5px solid #ccc; text-align: left;">
                    <br>
                  </div>
                </div>
              </div>
            </div>
        </div>
		</div>
	</body>  
</html>