<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<style type="text/css">
		ul,
		li,
		p {
			font-size: 12px;
			text-align: justify-all;
			margin: 0 5px;
		}

		table,
		td,
		th {
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

		.center {
			text-align: center;
		}

		.left {
			text-align: left;
		}

		.right {
			text-align: right;
		}

		.justify {
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
		{{-- <div class="row">
			<div class="twelve columns" style="background-color: #111; color: #fff">
				<label class="center"><strong>CARTA DE INSTRUCCIÓN</strong></label>
			</div>
		</div> --}}
		<div class="row">
			<div class="twelve columns">
				<label class="center"><strong>PLAN LIBRE</strong></label>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<div class="row">
						<div class="one-half column u-pull-left">
							<p class="right">Nombre(s):</p>
							<p class="right">Titular del contrato de adhesión número:</p>
							<p class="right">Del Grupo de Consumidores:</p>
							<p class="right">Precio total del bien:</p>
						</div>
						<div class="one-half column u-pull-right">
							<p class="center" style="border-bottom: 0.5px solid orange;">
								<strong>{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</strong>
							</p>
							<p class="center" style="border-bottom: 0.5px solid orange; margin-top: 10px;">
								<strong>{{$presolicitud->id}}</strong></p>
							<p class="center" style="border-bottom: 0.5px solid orange; margin-top: 10px;">
								<strong>{{$contrato->grupo->id}}</strong></p>
							<p class="center" style="border-bottom: 0.5px solid orange;">
								<strong>${{number_format($contrato->monto,2)}}</strong></p>
						</div>
					</div>
				</div>
				<div class="one-half column u-pull-right">
					<div class="one-half column u-pull-left">
						<p class="right">Regalo de puntos:</p>
						<p class="right">Precio Total del bien:</p>
						<p class="right">Plazo del Contrato:</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center" style="border-bottom: 0.5px solid orange;"><strong>{{$puntos}} puntos</strong>
						</p>
						<p class="center" style="border-bottom: 0.5px solid orange;">
							<strong>${{number_format($contrato->monto,2)}}</strong></p>
						<p class="center" style="border-bottom: 0.5px solid orange;"><strong>168 meses</strong></p>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="six columns">
				<p>Aportación extraordinaria libre 100% a capital</p>
				<table>
					<thead>
						<tr>
							<th>Mínima</th>
							<th>Máximo</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>${{$opcionesCotizacion['minimo']}}</td>
							<td>${{$opcionesCotizacion['maximo']}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					Con fundamento en el artículo 22 fracción III del Reglamento de Sistemas de Comercialización, se
					expide el presente Anexo:
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left" style="padding-left: 25px;">
					<strong>Beneficios Cuota de Inscripción</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					La cuota de inscripción cobrará sobre el valor del bien.
				</p>
				<p class="justify">
					Por este medio, el consumidor reconoce el adeudo de la cuota de inscripción e instruye al proveedor PLANEA TU BIEN, SA DE CV para que, el 2% del valor 
					presente del precio inicial del bien, por concepto de cuota de inscripción, correspondiente al contrato celebrado, será pagado a la adjudicación. Y en caso de que 
					el Consumidor decida cancelar, dicho monto será reetenido de sus aportaciones extraordinarias.
				</p>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					De conformidad con el Capítulo VII.01, el Consumidor instruye al proveedor PLANEA TU BIEN, SA DE CV para que, el procentaje correspondiente a la cuota de seguro 
					se considere pagada dentro de la aportación extraordinaria que el consumidor realice. Las aportaciones extraordinarias serán 100% a capital y no constituyen garantía de 
					adjudicación. Los pagos de aportaciones extraordinarias a que se refiere el presente anexo deberán ser cubiertos dentro de los 7 primeros días del mes. 
					En caso de cancelación anticipada, el consumidor deberá cubrir al proveedor la totalidad de las cuotas de inscripción y administración más IVA, calculadas al mes en que se efectúe la 
					cancelación.
					{{-- El consumidor ratifica a la proveedora PLANEA TU BIEN SA DE CV, que su cuota periódica total, se
					actualiza de acuerdo al contrato de adhesión, y una vez entregado el bien, a esta mensualidad se le
					agregue el seguro de daños del bien que adquiera y cede el remanente al Proveedor, quedando de la
					siguiente manera. --}}
				</p>
				<p class="left">
					El consumidor podrá adquirir la calidad de adjudicatario al menos dentro de los 3 meses posteriores al cumplimiento de pago, del 30% de aportaciones 
					extraordinarias sobre el monto totald del bien. En cumplimiento a lo anterior el consumidor instrue al proveedor PLANEA TU BIEN, S.A DE C.V., a que una vez 
					que adquiera la calidad de adjudicatario, sus pagos mensuales sean fijos considerando el factor aplicable asimismo y una vez realizada la entrega del bien, al
					pago fijo mensual se le agregue el pago de seguro de daños del bien. Por tanto, en este acto y a la liquidación cede el pago fijo mensual se le agregue el pago 
					de seguro de daños del bien. Por tanto, en este acto y a la liquidación cede el remanente al proveedor.
				</p>
				<br>
				<p class="left">
					Este documento constituye una manifestación expresa de la voluntad del consumidor por lo que es personal e intransferible, no tiene validez monetaria, no implica 
					ningúna modificación a las cláusulas del contrato de adhesión, ni exime del cumplimiento de las obligaciones contraídas de el mismo.
				</p>
			</div>
		</div>
		{{-- <div class="row">
			<div class="twelve columns">
				<p class="left" style="padding-left: 25px;">
					Cuota periódica total inicial de
					${{number_format($plan->cuota_periodica_integrante($contrato->monto,$cotizacion->factor_actualizacion),2)}}
				</p>
			</div>
		</div> --}}
		<div class="row">
			<div class="twelve columns">
				<p class="center">
					<strong>
						Leído que fue el presente y enteradas las partes de su alcance y contenido, manifestando que no existe, dolo, error o mala fe,
						ni ningún vicio oculto, lo firman de conformidad ambas partes el 22 de enero del 2020.
					</strong>
				</p>
			</div>
		</div>
		{{-- <div class="row">
			<div class="twelve columns">
				<p class="center">
					<strong>
						Al ser un documento de manifestación voluntaria, no pretende modificar el contenido del contrato
						de adhesión toda vez que siempre prevalecerán las condiciones pactadas en el mismo.
					</strong>
				</p>
			</div>
		</div> --}}
		{{-- <div class="row">
			<div class="twelve columns">
				<p class="center">
					<strong>
						Leído que fue el presente y enteradas las partes de su alcance y contenido, manifestando que no
						existe, dolo, error o mala fe, ni ningún vicio oculto, lo firman de conformidad ambas partes.
					</strong>
				</p>
			</div>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br> --}}
		<div class="row">
			<div class="twelve columns">
				<p class="center">
					<strong>
						PROTESTO LO NECESARIO
					</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="center">
					<strong>
						Ciudad de México a la fecha de su celebración
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
					<div style="border-top: 1px solid orange; margin-top: 50px;">
						<p class="center">
							{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>

</html>