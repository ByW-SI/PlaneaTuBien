<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<style type="text/css">
		ul,li,p{
			font-size: 9px;
			text-align:justify-all;
			margin: 0 5px;
		}
		table, td, th {  
		  border: 1px solid #ddd;
		  text-align: center;
		  font-size: 9px;
		  padding: 0 5px;
		}

		table {
		  border-collapse: collapse;
		  width: 100%;
		  padding: 0 5px;
		  /*margin-left: 20px;
		  margin-right: 40px;*/
		}
		.center{
			text-align: center;
		}
		.left{
			text-align: left;
		}
		.right{
			text-align: right;
		}
		.justify{
			text-align: justify;
		}
		.page-break {
		    page-break-after: always;
		}
	</style>
	<title>Anexo Tanda</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="twelve columns">
				<h6 class="center"><strong>ANEXO</strong></h6>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="background-color:#122; color:#fff">
				<label class="center"><strong>CARTA DE INSTRUCCIÓN</strong></label>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<label class="center"><strong>PLAN: {{$prospecto->perfil->plan}}</strong></label>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<div class="row">
						<div class="one-half column u-pull-left">
							<p class="right">Nombre(s):</p>
							<p class="right">Titular del contrato de adhesión número:</p>
							<p class="right">Del Grupo de Consumidores número:</p>
							<p class="right">Valor del bien:</p>
						</div>
						<div class="one-half column u-pull-right">
							<p class="center" style="border-bottom: 0.5px solid orange;"><strong>{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</strong></p>
							<p class="center" style="border-bottom: 0.5px solid orange; margin-top: 10px;"><strong>{{$presolicitud->id}}</strong></p>
							<p class="center" style="border-bottom: 0.5px solid orange; margin-top: 10px;"><strong>{{$contrato->grupo->id}}</strong></p>
							<p class="center" style="border-bottom: 0.5px solid orange;"><strong>${{number_format($contrato->monto,2)}}</strong></p>
						</div>
					</div>
				</div>
				<div class="one-half column u-pull-right">
					<div class="one-half column u-pull-left">
						<p class="right">Regalo de puntos:</p>
						<p class="right">Precio Total del bien:</p>
						<p class="right">Plazo del Contrato:</p>
						<p class="right">Garantía de adjudicacion a:</p>
						<p class="right">Precio de adjudicación indexado Garantizado:</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center" style="border-bottom: 0.5px solid orange;"><strong>{{$puntos}} puntos</strong></p>
						<p class="center" style="border-bottom: 0.5px solid orange;"><strong>${{number_format($contrato->monto,2)}}</strong></p>
						<p class="center" style="border-bottom: 0.5px solid orange;"><strong>{{$plan->plazo}} meses</strong></p>
						<p class="center" style="border-bottom: 0.5px solid orange;"><strong>{{$plan->plan_meses}} meses</strong></p>
						<p class="center" style="border-bottom: 0.5px solid orange; margin-top:15px;"><strong>${{number_format($plan->monto_adjudicar($contrato->monto,$cotizacion->factor_actualizacion),2)}}</strong></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="row" >
						<table>
							<tbody>
								<tr>
									<th style="background: #cccc"><strong>Aportación Extraordinarias</strong></th>
									<th style="background: #cccc"><strong>%</strong></th>
									<th style="background: #cccc"><strong>Monto</strong></th>
									<th style="background: #cccc"><strong>Mes de pago</strong></th>
								</tr>
								<tr>
									<td>1</td>
									<td>{{$plan->aportacion_1}}%</td>
									<td>${{number_format($plan->monto_aportacion_1($contrato->monto),2)}}</td>
									<td>{{$plan->mes_1}}</td>
								</tr>
								<tr>
									<td>2</td>
									<td>{{$plan->aportacion_2}}%</td>
									<td>${{number_format($plan->monto_aportacion_2($contrato->monto),2)}}</td>
									<td>{{$plan->mes_2}}</td>
								</tr>
								<tr>
									<td>3</td>
									<td>{{$plan->aportacion_3}}%</td>
									<td>${{number_format($plan->monto_aportacion_3($contrato->monto),2)}}</td>
									<td>{{$plan->mes_3}}</td>
								</tr>
								<tr>
									<td>4</td>
									<td>{{$plan->aportacion_liquidacion}}%</td>
									<td>${{number_format($plan->monto_aportacion_liquidacion($contrato->monto),2)}}</td>
									<td>{{$plan->mes_liquidacion}}</td>
								</tr>
								<tr>
									<td>Anual</td>
									<td>{{$plan->anual}}%</td>
									<td>{{number_format($plan->monto_aportacion_anual($contrato->monto),2)}}</td>
									<td>Cada Diciembre</td>
								</tr>
								@if ($plan->semestral !=0.00)
									<td>Semestral</td>
									<td>{{$plan->semestral}}%</td>
									<td>${{number_format($plan->monto_aportacion_semestral($contrato->monto),2)}}</td>
									<td>Cada Junio y Diciembre</td>
								@endif
							</tbody>
						</table>
						<p class="center">Aportaciones Extraordinarias 100% a Capital</p>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					Con fundamento en el artículo 22 fracción III del Reglamento de Sistemas de Comercialización, se expide el presente anexo.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left" style="padding-left: 25px;">
					<strong> Beneficio de cuota de inscripción</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					La cuota de inscripción se cobrará sobre el valor del bien.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					Por este medio instruyo a la empresa PLANEA TU BIEN S.A. DE C.V. para que el <strong style="color: red">2.00%</strong> del valor presente del precio inicial del bien, por concepto de cuota de inscripción correspondiente al contrato celebrado entre las partes, sea pagado en el mes de {{$mes}} del año {{date('Y')}}, y/o en el caso en que el(la) suscrito(a) decida cancelar el contrato vigente con el proveedor, dicho monto será restado de las aportaciones realizadas por el (la) signatario(a).
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left" style="padding-left: 25px;">
					<strong>Aportaciones Extraodinarias 100% a Capital</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					1) % Requerido al mes {{$plan->mes_1}}. 2) % Requerido al mes {{$plan->mes_2}}. 3) % Requerido al mes {{$plan->mes_3}}. 4) % Requerido al mes {{$plan->mes_liquidacion}}. Anual) % Requerido cada Diciembre.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					Aportación Extraordinaria 1: Esta cantidad el consumidor la pagará en el mes de pago {{$plan->mes_1}}.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					Aportación Extraordinaria 2: Esta cantidad el consumidor la pagará en el mes de pago {{$plan->mes_2}}.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					Aportación Extraordinaria 3: Esta cantidad el consumidor la pagará en el mes de pago {{$plan->mes_3}}.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					Aportación Extraordinaria 4: Esta cantidad el consumidor la pagará en el mes de pago 120.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					Aportacion Extraordinaria Anual: Esta cantidad el consumidor la pagara hasta el 7 de diciembre de cada año.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left" style="padding-left: 25px;">
					<strong>Garantía de adjudicación</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					El consumidor adquiere la calidad de adjudicatario al mes inmediato posterior a la reunión de adjudicación 
					correspondiente al plazo que haya elegido, siempre y cuando los pagos de cuota periódica total los realice 
					puntuales y dentro de los primeros 7 días de cada mes, en caso contrario se considerará pago atrasado y su 
					garantía de adjudicación se recorrerá 3 veces el número de meses con atraso. En los contratos celebrados en 
					los meses de diciembre y junio, se considerará un mes adicional para ganar el factor de actualización de dicho 
					periodo. Aun cuando el Consumidor no adquiera la calidad de adjudicatario, éste deberá cumplir con el número 
					de pagos y montos pactados en el presente anexo. <strong> Una vez cubierta la aportación extraordinaria 1, 2, 3, 4 y anual
					según el plazo aplicable, dentro de los primeros 7 días del mes requerido, en caso contrario se considerará 
					pago atrasado y su garantía de adjudicación se recorrerá 3 veces el número de meses con atraso, en caso de 
					incumplimiento a las condiciones del contrato o del anexo, el Proveedor no podrá cumplir con la garantía de 
					adjudicación.</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					El consumidor instruye a la proveedora PLANEA TU BIEN SA DE CV, que en su calidad de integrante los pagos mensuales de la garantía de adjudicación sean fijos, considerando los factores de actualización del periodo de la misma y cuando adquiera la calidad de adjudicatario, que su mensualidad sea fija, considerando los factores de actualización al plazo contratado y una vez entregado el bien, a esta mensualidad se le agregue el seguro de daños del bien que adquiera y cede el remanente al Proveedor, quedando de la siguiente manera. (En caso de existir un atraso el consumidor se compromete a pagar el número de pagos y montos pactados.)
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					{{$plan->mes_s_d-1}} pagos mensuales fijos de ${{number_format($plan->cotizador($contrato->monto,$cotizacion->factor_actualizacion)['cuota_periodica_integrante'],2)}}
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					{{$plan->plazo-($plan->mes_s_d-1)}} pagos mensuales fijos de ${{number_format($plan->cotizador($contrato->monto,$cotizacion->factor_actualizacion)['cuota_periodica_adjudicado'],2)}}
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="center">
					<strong>
						Este documento constituye una manifestación expresa de la voluntad del Consumidor por lo que es personal e
						intransferible, no tiene validez monetaria, no implica ninguna modificación a las cláusulas del contrato de 
						adhesión, ni exime del cumplimiento de las obligaciones contraídas en el mismo.

					</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="center">
					<strong>
						Leído que fue el presente y enteradas las partes de su alcance y contenido, manifestando que no existe, dolo, 
						error o mala fe, ni ningún vicio oculto, lo firman de conformidad ambas partes a {{date('d')}} del {{date('m')}} del {{date('Y')}}
					</strong>
				</p>
			</div>
		</div>

		<div class="row" >

			<div class="row">
				<div class="twelve columns">
					<p class="center">
						<strong>
							PROTESTAMOS LO NECESARIO
						</strong>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<p class="center">
						<strong>
							Ciudad de México a la fecha de celebración
						</strong>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="one-half column u-pull-left">
						<p class="center"><strong>Sello del proveedor</strong></p>
						<div>
							<img src="img/sello.png" style="display: block;margin-left: 125px;margin-right: auto;">
						</div>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center"><strong>Nombre y firma del consumidor</strong></p>
						<div style="border-top: 1px solid orange; margin-top: 50px; padding-left: 15px">
							<p class="center">{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</p>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
</body>
</html>