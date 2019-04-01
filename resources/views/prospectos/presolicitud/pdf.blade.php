<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		{{-- <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css"> --}}
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<title>Presolicitud</title>
</head>
<body>
	<div class="container">
		<div style="position: absolute; left: 10%; right: 25%; top: 35%; bottom: 35%;">
			<img src="img/perfil.png"  style="opacity: 0.1;filter: alpha(opacity=10); height: 100%; width: 600px">
		</div>
		<div class="row">
			<label style="color: #B8242B; text-align: center; font-size: 20px;background: #c4c4c4">PRE SOLICITUD DE INSCRIPCIÓN</label>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="two columns u-pull-left">
					<img src="img/perfil.png" height="50" width="100">
				</div>
				<div class="ten columns column u-pull-right">
					<div class="two-thirds column u-pull-left">
						<label style="font-size: 11px; text-align: justify;">
							PLANEA TU BIEN, S.A. DE C.V. Jalapa 17 despacho 301 , col Roma. C.P 06700 , delegación Cuauhtemoc. Mexico D.F. TEL. 5533-2201  R.F.C. PTB091030MS1 <a href="www.planeatubien.com.mx" style="color: black">WWW.PLANEATUBIEN.COM.MX</a>
						</label>
					</div>
					<div class="one-third column u-pull-right" style="margin-top: 7px;">
						<div class="one-half column u-pull-left">
							<label style="font-size: 12px">FOLIO:</label>
							<label style="font-size: 12px">FECHA:</label>
						</div>
						<div class="one-half column u-pull-right">
							<label style="font-size: 12px; border-bottom: 0.5px solid #B8242B;text-align: center;">{{$perfil->folio}}</label>
							<label style="font-size: 12px; border-bottom: 0.5px solid #B8242B;text-align: center;">{{date('d/m/Y', strtotime($perfil->fecha))}}</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row"  style="border:1px solid black;">
			<div class="twelve columns" style="margin-left: 5px; margin-right: 5px;">
				<div class="one-third column u-pull-left">
					<div class="one-half column u-pull-left">
						<label style="font-size: 9px">Precio Inicial del Bien:</label>
					</div>
					<div class="one-half column u-pull-right">
						<label style="font-size: 9px;border-bottom: 0.5px solid #B8242B;text-align: center;">${{number_format($perfil->inmueble_pretendido->precio_aprox,2)}}</label>
					</div>
				</div>
				<div class="two-thirds column u-pull-right">
					<div class="five columns u-pull-left">
						<div class="row">
							<div class="one-half column u-pull-left">
								<label style="font-size: 9px">Plazo Contratado:</label>
							</div>
							<div class="one-half column u-pull-right">
								<label style="font-size: 9px;border-bottom: 0.5px solid #B8242B;text-align: center;">{{$perfil->cotizacion->mes3}} (meses)</label>
							</div>
						</div>
					</div>
					<div class="seven columns u-pull-right">
						<div class="one-half column u-pull-left">
							<label style="font-size: 9px"> Seguro de Vida Adicional:</label>
						</div>
						<div class="one-half column u-pull-right" style="border-bottom: 0.5px solid #B8242B;font-size: 9px; text-align: left;">
							$
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="border-top: 2px solid #B8242B; margin-top: 2px;">
			<div class="three columns u-pull-left" style="color: #B8242B;background: #c4c4c4; text-align: center; margin-top: 0.5px;">
				<label>SOLICITANTE</label>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px; margin-right: 4px;">
				<div class="three columns u-pull-left">
					<label style="font-size: 13px;">Nombre o Razón Social:</label>
				</div>
				<div class="nine columns u-pull-right">
					<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
					<div class="six columns u-pull-left">
						<div class="row">
							<div class="one-half column u-pull-left" >
								<label style="text-align: center; font-size: 13px;">
									{{$perfil->prospecto->appaterno}}
								</label>
								<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 25px; position: absolute;">Apellido Paterno</label>
							</div>
							<div class="one-half column u-pull-right" >
								<label style="text-align: center; font-size: 13px;">
									{{$perfil->prospecto->apmaterno}}
								</label>
								<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 25px; position: absolute;">Apellido Materno</label>
							</div>
						</div>
					</div>
					<div class="six columns u-pull-right" >
						<label style="text-align: center; font-size: 13px;">
							{{$perfil->prospecto->nombre}} 
						</label>
						<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 100px; position: absolute;">Nombre(s)</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px; margin-right: 4px;">
				<div class="one columns u-pull-left">
					<label style="font-size: 13px;">Dirección:</label>
				</div>
				<div class="eleven columns u-pull-right">
					<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
					<div class="two-thirds column u-pull-left">
						<div class="row">
							<div class="two two-thirds column u-pull-left">
								<br>
								<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 125px; position: absolute;">Calle</label>
							</div>
							<div class="one-third column u-pull-right">
								<br>
								<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 40px; position: absolute;">Número</label>
							</div>
						</div>
					</div>
					<div class="one-third column u-pull-right">
						<br>
						<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 80px; position: absolute;">Colonia</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px; margin-right: 4px">
				<div class="two-thirds column u-pull-left">
					<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
					<div class="row">
						<div class="two-thirds column u-pull-left">
							<div class="one-half column u-pull-left">
								<br>
								<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 80px; position: absolute;">Delegación/Municipio</label>
							</div>
							<div class="one-half column u-pull-right">
								<br>
								<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 80px; position: absolute;">Estado</label>
							</div>
						</div>
						<div class="one-third column u-pull-right">
							<br>
							<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 60px; position: absolute;">Código Postal</label>
						</div>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<div class="two columns u-pull-left">
						<label style="font-size: 13px;">RFC:</label>
					</div>
					<div class="ten columns u-pull-right">
						<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
						<label style="text-align: center; font-size: 13px;">
							{{$perfil->rfc_1}} 
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px;margin-right: 4px;">
				<div class="two-thirds column u-pull-left">
					<div class="one-half column u-pull-left">
						<label style="font-size: 13px;">Telefonos:</label>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<label style="font-size: 13px;">Correo Electrónico:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px; margin-right: 4px;">
				<div class="two-thirds column u-pull-left">
					<div class="two-thirds column u-pull-left">
						<div class="one-half column u-pull-left">
							<div class="four columns u-pull-left">
								<label style="font-size: 13px;">Casa:</label>
							</div>
							<div class="eight columns u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<label style="text-align: center; font-size: 13px;">
									{{$perfil->telefono_casa}} 
								</label>
							</div>
						</div>
						<div class="one-half column u-pull-right">
							<div class="four columns u-pull-left">
								<label style="font-size: 13px;">Oficina:</label>
							</div>
							<div class="eight columns u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<label style="text-align: center; font-size: 13px;">
									{{$perfil->telefono_oficina}} 
								</label>
							</div>
						</div>
					</div>
					<div class="one-third column u-pull-right">
						<div class="four columns u-pull-left">
							<label style="font-size: 13px;">Celular:</label>
						</div>
						<div class="eight columns u-pull-right">
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
							<label style="text-align: center; font-size: 13px;">
								{{$perfil->telefono_celular}} 
							</label>
						</div>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
					<label style="text-align: center; font-size: 13px;">
						{{$perfil->email}} 
					</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px; margin-right: 4px;">
				<div class="two-thirds column u-pull-left">
					<div class="row">
						<div class="one-half column u-pull-left">
							<div class="one-half column u-pull-left">
								<label style="font-size: 13px;">Fecha de Nacimiento:</label>
							</div>
							<div class="one-half column u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<label style="text-align: center; font-size: 13px;">
									&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;
								</label>
								<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 20px; position: absolute;">dd&nbsp;&nbsp;&nbsp;&nbsp;mm&nbsp;&nbsp;&nbsp;&nbsp;aaaa</label>
							</div>
						</div>
						<div class="one-half column u-pull-right">
							<div class="one-half column u-pull-left">
								<label style="font-size: 13px;">Lugar de Nacimiento:</label>
							</div>
							<div class="one-half column u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<br>
							</div>
								
						</div>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<div class="one-half column u-pull-left">
						<label style="font-size: 13px;">Nacionalidad:</label>
					</div>
					<div class="one-half column u-pull-right">
						<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
						<label style="text-align: center; font-size: 13px;">
							{{$perfil->nacionalidad_1}} 
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px;margin-right: 4px;">
				<div class="two-thirds column u-pull-left">
					<div class="row">
						<div class="one-half column u-pull-left">
							<div class="one-half column u-pull-left">
								<div class="one-third column u-pull-left">
									<label style="font-size: 13px;">Sexo:</label>
								</div>
								<div class="two-thirds column u-pull-right">
									<div class="one-half column u-pull-left">
										<label style="font-size: 13px;"><input type="checkbox" style="color: #B8242B">M</label>
									</div>
									<div class="one-half column u-pull-right">
										<label style="font-size: 13px;"><input type="checkbox" style="color: #B8242B">F</label>
									</div>
								</div>
							</div>
							<div class="one-half column u-pull-right">
								<div class="one-third column u-pull-left">
									<label style="font-size: 13px;">Edad:</label>
								</div>
								<div class="two-thirds column u-pull-right">
									<div class="one-half column u-pull-left">
										<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
										<br>
									</div>
									<div class="one-half column u-pull-right" >
										<label style="font-size: 13px;">(Años)</label>
									</div>
								</div>
							</div>
						</div>
						<div class="one-half column u-pull-right">
							<div class="one-third column u-pull-left">
								<label style="font-size: 13px;">Estado Civil:</label>
							</div>
							<div class="two-thirds column u-pull-right">
								<div class="one-half column u-pull-left">
									<label style="font-size: 10px;"><input type="checkbox" {{$perfil->estado_civil == "Soltero" ? 'checked="checked"' : ''}} style="color: #B8242B">Soltero</label>
								</div>
								<div class="one-half column u-pull-right">
									<label style="font-size: 10px;"><input type="checkbox" {{$perfil->estado_civil == "Casado" ? 'checked="checked"' : ''}} style="color: #B8242B">Casado</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<div class="one-third column u-pull-left">
						<label style="font-size: 10px;"><input type="checkbox" {{$perfil->estado_civil == "Viudo" ? 'checked="checked"' : ''}} style="color: #B8242B">Viudo</label>
					</div>
					<div class="two-thirds column u-pull-right">
						<label class="one-half column u-pull-left" style="font-size: 10px;"><input type="checkbox" {{$perfil->estado_civil == "Divorciado" ? 'checked="checked"' : ''}} style="color: #B8242B">Divorciado</label>
						<label class="one-half column u-pull-right" style="font-size: 10px;"><input type="checkbox" {{$perfil->estado_civil == "Unión Libre" ? 'checked="checked"' : ''}} style="color: #B8242B">Unión Libre</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-right: 4px; margin-left:4px;">
				<div class="two-thirds column u-pull-left">
					<div class="one-half column u-pull-left">
						<div class="four columns u-pull-left">
							<label style="font-size: 13px;">Profesión/ Actividad:</label>
						</div>
						<div class="eight columns u-pull-right">
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
							<label style="text-align: center; font-size: 13px;">
								{{$perfil->ocupacion_1}} 
							</label>
						</div>
					</div>
					<div class="one-half column u-pull-right">
						<div class="one-half column u-pull-left">
							<label style="font-size: 13px;">Empresa donde trabaja:</label>
						</div>
						<div class="one-half column u-pull-right">
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
							<label style="text-align: center; font-size: 13px;">
								{{$perfil->empresa_1}} 
							</label>
						</div>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<div class="four columns u-pull-left">
						<label style="font-size: 13px;">Puesto:</label>
					</div>
					<div class="eight columns u-pull-right">
						<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
						<br>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-right: 4px; margin-left:4px;">
				<div class="two-thirds column u-pull-left">
					<div class="one-half column u-pull-left">
						<div class="four columns u-pull-left">
							<label style="font-size: 13px;">Antigüedad trabajo actual:</label>
						</div>
						<div class="eight columns u-pull-right">
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
							<label style="text-align: center; font-size: 13px;">
								{{$perfil->antiguedad_1}} 
							</label>
						</div>
					</div>
					<div class="one-half column u-pull-right">
						<div class="one-half column u-pull-left">
							<label style="font-size: 13px;">Antigüedad trabajo anterior:</label>
						</div>
						<div class="one-half column u-pull-right">
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
							<br>
						</div>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<div class="four columns u-pull-left">
						<label style="font-size: 13px;">Ingreso Mensual Familiar:</label>
					</div>
					<div class="eight columns u-pull-right">
						<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
						<label style="text-align: center; font-size: 13px;">
							${{number_format($perfil->ingreso_total,2)}} 
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-right: 4px; margin-left: 4px;">
				<div class="one-half column u-pull-left">
					<label style="font-size: 13px;">¿CÓMO SE ENTERO DE NOSOTROS?:</label>
				</div>
				<div class="one-half column u-pull-right">
					<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
					<label style="text-align: center; font-size: 13px;">
						{{$perfil->inmueble_pretendido->medio_entero}}
					</label>
				</div>
			</div>
		</div>
		<div class="row" style="border-top: 2px solid #B8242B; margin-top: 2px;">
			<div class="eight columns u-pull-left" style="color: #B8242B;background: #c4c4c4; text-align: center; margin-top: 0.5px;">
				<label>CÓNYUGE, CONCUBINO U  OBLIGADO SOLIDARIO</label>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px; margin-right: 4px;">
				<div class="two columns u-pull-left">
					<label style="font-size: 13px;">Nombre:</label>
				</div>
				<div class="ten columns u-pull-right">
					<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
					<label style="text-align: center; font-size: 13px;">
						{{$perfil->nombre_completo_2}}
					</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px; margin-right: 4px;">
				<div class="two-thirds column u-pull-left">
					<div class="row">
						<div class="one-half column u-pull-left">
							<div class="one-half column u-pull-left">
								<label style="font-size: 13px;">Fecha de Nacimiento:</label>
							</div>
							<div class="one-half column u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<label style="text-align: center; font-size: 13px;">
									&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;
								</label>
								<label style="font-size: 9px; height: 15px; text-align: center; top: 20px; margin-left: 20px; position: absolute;">dd&nbsp;&nbsp;&nbsp;&nbsp;mm&nbsp;&nbsp;&nbsp;&nbsp;aaaa</label>
							</div>
						</div>
						<div class="one-half column u-pull-right">
							<div class="one-half column u-pull-left">
								<label style="font-size: 13px;">Lugar de Nacimiento:</label>
							</div>
							<div class="one-half column u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<br>
							</div>
								
						</div>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<div class="one-half column u-pull-left">
						<label style="font-size: 13px;">Nacionalidad:</label>
					</div>
					<div class="one-half column u-pull-right">
						<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
						<label style="text-align: center; font-size: 13px;">
							{{$perfil->nacionalidad_2}} 
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px;margin-right: 4px;">
				<div class="two-thirds column u-pull-left">
					<div class="one-half column u-pull-left">
						<label style="font-size: 13px;">Telefonos:</label>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<label style="font-size: 13px;">Correo Electrónico:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px; margin-right: 4px;">
				<div class="two-thirds column u-pull-left">
					<div class="two-thirds column u-pull-left">
						<div class="one-half column u-pull-left">
							<div class="four columns u-pull-left">
								<label style="font-size: 13px;">Casa:</label>
							</div>
							<div class="eight columns u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<br>
							</div>
						</div>
						<div class="one-half column u-pull-right">
							<div class="four columns u-pull-left">
								<label style="font-size: 13px;">Oficina:</label>
							</div>
							<div class="eight columns u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<br>
							</div>
						</div>
					</div>
					<div class="one-third column u-pull-right">
						<div class="four columns u-pull-left">
							<label style="font-size: 13px;">Celular:</label>
						</div>
						<div class="eight columns u-pull-right">
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
							<br>
						</div>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
					<br>
				</div>
			</div>
		</div>
		<div class="row" style="border-top: 2px solid #B8242B; margin-top: 2px;">
			<div class="six columns u-pull-left" style="color: #B8242B;background: #c4c4c4; text-align: center; margin-top: 0.5px;">
				<label>BENEFICIARIOS</label>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px;margin-right: 4px;">
				<div class="two-thirds column u-pull-left">
					<div class="one-half column u-pull-left">
						<label style="font-size: 13px;">Nombre:</label>
					</div>
				</div>
			</div>
		</div>
		@for ($i = 0; $i < 4; $i++)
			<div class="row">
				<div class="twelve columns" style="margin-left: 4px;margin-right: 4px;">
					<div class="seven columns u-pull-left">
						<div class="seven columns u-pull-left">
							<div class="two columns u-pull-left" style="background: #c4c4c4;text-align: center;">
								{{$i+1}}
							</div>
							<div class="ten columns u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<br>
							</div>
						</div>
						<div class="five columns u-pull-right">
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
							<br>
						</div>
					</div>
					<div class="five columns u-pull-right">
						<div class="four columns u-pull-left">
							<label style="font-size: 13px;">Parentesco:</label>
						</div>
						<div class="eight columns u-pull-right">
							<div class="six columns u-pull-left">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<br>
							</div>
							<div class="six columns u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<label style="text-align: right;">%</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endfor
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px;margin-right: 4px;">
				<div class="seven columns u-pull-left">
					<div class="seven columns u-pull-left">
						<div class="nine columns u-pull-left">
							<div class="one-half column u-pull-left">
								<label style="font-size: 9px; text-align: center">Apellido Paterno:</label>
							</div>
							<div class="one-half column u-pull-right">
								<label style="font-size: 9px; text-align: center">Apellido Materno:</label>
							</div>
						</div>
						<div class="three columns u-pull-right">
							<label style="font-size: 9px; text-align: center">Nombre(s):</label>
						</div>
					</div>
					<div class="five columns u-pull-right">
						<label style="font-size: 9px; text-align: center">Edad:</label>
					</div>
				</div>
				<div class="five columns u-pull-right">
					<div class="four columns u-pull-left">
					</div>
					<div class="eight columns u-pull-right">
					</div>
				</div>
			</div>
		</div>
		<div class="page-break"></div>
		<div style="position: absolute; left: 10%; right: 25%; top: 35%; bottom: 35%;">
			<img src="img/perfil.png"  style="opacity: 0.1;filter: alpha(opacity=10); height: 100%; width: 600px">
		</div>
		<div class="row" style="border-top: 2px solid #B8242B; margin-top: 2px;">
			<div class="six columns u-pull-left" style="color: #B8242B;background: #c4c4c4; text-align: center; margin-top: 0.5px;">
				<label>REFERENCIAS PERSONALES</label>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="margin-left: 4px;margin-right: 4px;">
				<div class="two-thirds column u-pull-left">
					<div class="one-half column u-pull-left">
						<label style="font-size: 13px;">Nombre:</label>
					</div>
				</div>
			</div>
		</div>
		@foreach ($perfil->referencia_personals as $index=>$referencia)
			<div class="row">
				<div class="twelve columns" style="margin-left: 4px;margin-right: 4px;">
					<div class="nine columns u-pull-left">
						<div class="seven columns u-pull-left">
							<div class="two columns u-pull-left" style="background: #c4c4c4;text-align: center;">
								{{$index+1}}
							</div>
							<div class="ten columns u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<label style="font-size: 13px;">{{$referencia->nombre_completo}}</label>
							</div>
						</div>
						<div class="five columns u-pull-right">
							<div class="four columns u-pull-left">
								<label style="font-size: 13px;">Teléfono:</label>
							</div>
							<div class="eight columns u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<label style="font-size: 13px; text-align: center">{{$referencia->telefono}}</label>
							</div>
						</div>
					</div>
					<div class="three columns u-pull-right">
						<div class="six columns u-pull-left">
							<label style="font-size: 13px;">Parentesco:</label>
						</div>
						<div class="six columns u-pull-right">
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
							<label style="font-size: 13px; text-align: center">{{$referencia->parentesco}}</label>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		<div class="container" style="border: 1px solid #B8242B; border-left: 1px solid #B8242B;border-right: 1px solid #B8242B;">
			<div class="row">
				<div class="six columns u-pull-left" style="color: #B8242B;background: #c4c4c4; text-align: center; margin-top: 0.5px;">
					<label>RECIBO PROVISIONAL</label>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns" style="margin-left: 4px; margin-right: 4px">
					<div class="two-thirds column u-pull-left">
						<div class="row">
							<div class="two-thirds column u-pull-left">
								<div class="one-half column u-pull-left" style="border-bottom: 0.5px solid #B8242B">
									<br>
									<label style="font-size: 9px; height: 15px; text-align: center; top: 24px; margin-left: 55px; position: absolute;">Sucursal</label>
								</div>
								<div class="one-half column u-pull-right" style="border-bottom: 0.5px solid #B8242B">
									<label style="font-size: 13px; text-align: center">{{$perfil->asesor->nombre." ".$perfil->asesor->paterno." ".$perfil->asesor->materno}}</label>
									<label style="font-size: 9px; height: 15px; text-align: center; top: 24px; margin-left: 60px; position: absolute;">Asesor</label>
								</div>
							</div>
							<div class="one-third column u-pull-right" style="border-bottom: 0.5px solid #B8242B">
								<label style="font-size: 13px; text-align: center">{{$perfil->clave}}</label>
								<label style="font-size: 9px; height: 15px; text-align: center; top: 24px; margin-left: 60px; position: absolute;">Clave</label>
							</div>
						</div>
						<div class="row">
							<div class="two-thirds column u-pull-left" >
								<br>
								<div class="three columns u-pull-left">
									<label class="one-half column u-pull-left" style="font-size: 10px;">Tarjeta de crédito</label>
									<input class="one-half column u-pull-right" type="checkbox"  style="color: #B8242B">
								</div>
								<div class="nine columns u-pull-right" style="border-bottom: 0.5px solid #B8242B; text-align: left;">
									No.
								</div>
								<br>
								<br>
								<div class="row">
									<div class="twelve columns">
										<div class="three columns u-pull-left">
											<label style="font-size: 10px;">Banco Emisor:</label>
										</div>
										<div class="nine columns u-pull-right" >
											<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
											<br>
										</div>
									</div>
								</div>
							</div>
							<div class="one-third column u-pull-right" style="text-align: right;">
								<br>
								<label style="font-size: 8px;">VISA<input type="checkbox"  style="color: #B8242B"></label>
								<label style="font-size: 8px;">MASTERCARD<input type="checkbox"  style="color: #B8242B"></label>
								<label style="font-size: 8px;">AMERICAN EXPRESS<input type="checkbox"  style="color: #B8242B"></label>
							</div>
						</div>
					</div>
					<div class="one-third column u-pull-right" style="background: #c4c4c4; height: 120px;">
						<div class="one-half column u-pull-left" style="text-align: right;">
							<label style="font-size: 10px;">Inscripción Inicial:</label>
							<label style="font-size: 10px;">I.V.A.:</label>
							<label style="font-size: 10px;">Subtotal:</label>
							<label style="font-size: 10px;">Cuota Periódica Total:</label>
							<label style="font-size: 10px;">TOTAL:</label>
						</div>
						<div class="one-half column u-pull-right">
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
							<br>
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:40px; width: 100%;"></div>
							<br>
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:60px; width: 100%;"></div>
							<br>
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:100px; width: 100%;"></div>
							<br>
							<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:115px; width: 100%;"></div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row"  style="margin-left: 4px; margin-right: 4px">
				<div class="eleven columns">
					<div class="two columns u-pull-left">
						<label style="font-size: 10px;">Cheque<input type="checkbox"  style="color: #B8242B"></label>
					</div>
					<div class="ten columns u-pull-right">
						<div class="eight columns u-pull-left" style="border-bottom: 0.5px solid #B8242B; text-align: left;">
							No.
						</div>
						<div class="four columns u-pull-right">
							<div class="one-half column u-pull-left">
								<label style="font-size: 10px;">Banco Emisor:</label>
							</div>
							<div class="one-half column u-pull-right">
								<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row"  style="margin-left: 4px; margin-right: 4px">
				<div class="four columns u-pull-left">
					<label style="font-size: 10px;">Cantidad del Pago Total (con letra):</label>
				</div>
				<div class="eight columns u-pull-right">
					<div style="border-bottom: 0.5px solid #B8242B; position: absolute; top:20px; width: 100%;"></div>
					<br>
				</div>
			</div>
			<div class="row"  style="margin-left: 6px; margin-right: 6px">
				<div class="twelve columns">
					<label style="font-size: 10px; text-align: justify;">En caso de pago con cheque, éste deberá de ser nominativo a nombre de Planea Tu Bien S.A. de C.V., y deberá de ser llenado a máquina o con letra de molde. Anexar copia de identificación con fotografía y firma. En caso de persona moral, deberá presentar copia del Acta Constitutiva y de los poderes del representante legal, con registro público de la Propiedad y de Comercio. No firme ni entregue dinero si el promotor no se acredita con identificación vigente de Planea Tu Bien S.A. de C.V.. Esta presolicitud sólo es válida en original y con nombre y firma del asesor.</label>
				</div>
			</div>
			<div class="row"  style="margin-left: 6px; margin-right: 6px">
				<div class="twelve columns">
					<label style="font-size: 12px; text-align: justify;"><strong>AL FIRMAR Y ENTREGAR SU PAGO INICIAL, DEBERÁ DE COMUNICARSE CON NOSOTROS PARA  CONFIRMARNOS EL NÚMERO DE ESTA SOLICITUD</strong></label>
				</div>
			</div>
			<div class="row" style="margin-left: 6px; margin-right: 6px">
				<div class="twelve columns">
					<div class="one-half column u-pull-left">
						<div class="one-half column u-pull-left" style=" border: 1px solid #B8242B; height: 50px"></div>
						<div class="one-half column u-pull-right" style=" border: 1px solid #B8242B; height: 50px"></div>
					</div>
					<div class="one-half column u-pull-right">
						<div class="one-half column u-pull-left" style=" border: 1px solid #B8242B; height: 50px"></div>
						<div class="one-half column u-pull-right" style=" border: 1px solid #B8242B; height: 50px"></div>
					</div>
				</div>
			</div>
			<div class="row" style="margin-left: 6px; margin-right: 6px">
				<div class="twelve columns">
					<div class="one-half column u-pull-left">
						<div class="one-half column u-pull-left" style=" text-align: center; font-size: 11px;">
							<label>NO. DE CONTRATO</label>
						</div>
						<div class="one-half column u-pull-right" style=" text-align: center; font-size: 11px;">
							<label>NOMBRE Y FIRMA DEL ASESOR</label>
						</div>
					</div>
					<div class="one-half column u-pull-right">
						<div class="one-half column u-pull-left" style=" text-align: center; font-size: 11px;">
							<label>NOMBRE Y FIRMA DEL SOLICITANTE</label>
						</div>
						<div class="one-half column u-pull-right" style=" text-align: center; font-size: 11px;">
							<label>SELLO DE LA EMPRESA</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page-break"></div>
		<div style="position: absolute; left: 10%; right: 25%; top: 35%; bottom: 35%;">
			<img src="img/perfil.png"  style="opacity: 0.1;filter: alpha(opacity=10); height: 100%; width: 600px">
		</div>
		<div class="row" style="margin-left: 12px; margin-right: 12px">
			<div class="twelve columns" style="text-align: justify;">
				<p for="" style="margin-bottom: 1.5rem; font-size: 13px;" >
					Gracias por tu confianza depositada en nuestra empresa. Para nosotros en muy importante que conozcas y entiendas el funcionamiento de nuestro sistema, así como los beneficios que obtienes y los compromisos que adquieres.  Por favor lee cuidadosamente este cuestionario, contéstalo y escribe tu nombre y firma de conformidad en la parte inferior.
				</p>
			</div>
		</div>
		<div class="row" style="margin-left: 12px; margin-right: 12px">
			<div class="six columns u-pull-left">
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>1.-</strong> ¿Te informaron que los recursos adjudicados servirán únicamente para comprar un bien inmueble? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>2.-</strong> ¿Sabes que tu adjudicación dependerá de tu pago puntual  de las Cuotas Periódicas Totales y de los Anticipos que realices? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>3.-</strong> ¿Te informaron que la fecha de pago es la señalada en la caratula de tu  contrato, si que si te retrasas no podras participar en la reunión de adjudicación siendo integrante, y que como adjudicado se te cobrara el 3% mas IVA de intereses? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>4.-</strong> ¿Sabes que NO  se puede garantizar una fecha predeterminada de adjudicación?   SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>5.-</strong> ¿El plan que elegiste está de acuerdo a tus necesidades y tu capacidad de pago? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>6.-</strong> ¿Te informaron que no existe una postura de subasta que te asegure que serás adjudicado? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>7.-</strong> ¿Sabes que si pagas después de la fecha de corte obtendrás menos puntos que pueden retrasar la adjudicación del bien inmueble? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>8.-</strong> ¿Te informaron que para participar en los eventos de adjudicación debes de estar al corriente en tus pagos? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>9.-</strong> ¿Sabes que para estar asegurado contra vida y daños debes de estar al corriente en tus pagos? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
			</div>
			<div class="six columns u-pull-right">
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>10.-</strong> ¿Te informaron que si te sales del sistema te regresaremos solo tu aportación a valor histórico restándole la pena convencional  de 3 aportaciones, los seguros pagados  la cuota de inscripción y las comisiones cobradas? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>11.-</strong>¿Te informaron que el bien inmueble que compres, deberá estar libre de gravamen y que se quedara como garantía de pago? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>12.-</strong>¿Me confirmas que se te entrego el manual del consumidor, en el cual se te explica el sistema de autofinanciamiento, así como el calendario de eventos de adjudicación? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>13.-</strong>¿Te informaron que el asesor solo  está autorizado en recibir dinero en efectivo para la inscripción y primera mensualidad? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>14.-</strong>¿Sabes que para realizar tus pagos lo puedes hacer directamente en la sucursal bancaria o con cheque a nombre de Planea Tu Bien S.A. de C.V.? (en caso de pago con cheque será recibido salvo buen fin) SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>15.-</strong>¿Estas enterado que tus pagos irán incrementando cada 6 meses  de acuerdo a la inflación? Y que las mensualidades atrasadas las tendrás que pagar con dicho incremento? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>16.-</strong>¿ Te informaron que tienes que notificar a la empresa cualquier cambio en tus datos personales para poder seguir en contacto contigo? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
				<p style="margin-bottom: 1.5rem; font-size: 13px;" >
					<strong>17.-</strong>¿Estas enterado que cualquier ofrecimiento debe estar en el contrato de adhesión y que ningún asesor puede ofrecerte algo distinto? SI<input type="checkbox"  style="color: #B8242B"> NO<input type="checkbox"  style="color: #B8242B">
				</p>
			</div>
		</div>
		<div class="row" style="margin-left: 12px; margin-right: 12px; position: fixed;left: 0;bottom: 0;width: 100%;">
			<div class="twelve columns">
				<div class="seven columns u-pull-left">
					<div class="four columns u-pull-left">
						<p style="margin-bottom: 1.5rem; font-size: 13px;">Nombre del cliente:</p>
					</div>
					<div class="eight columns u-pull-right">
						<br>
						<div style="border-bottom: 0.5px solid #B8242B; top:20px; width: 100%;"></div>
					</div>
				</div>
				<div class="five columns u-pull-right">
					<div class="two columns u-pull-left">
						<p style="margin-bottom: 1.5rem; font-size: 13px;" >Firma:</p>
					</div>
					<div class="ten columns u-pull-right">
						<br>
						<div style="border-bottom: 0.5px solid #B8242B; top:20px; width: 100%;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>