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
			font-size: 16px;
			text-align: justify-all;
			margin: 3 5px;
		}

		table,
		td,
		th {
			border: 1px solid #ddd;
			text-align: center;
			font-size: 16px;
		}

		table {
			border-collapse: collapse;
			width: 100%;
			margin-left: 20px;
			margin-right: 40px;
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
	</style>
	<title>Aviso de Privacidad</title>
</head>

<body>
	<div class="container">

		{{-- LOGOTIPO --}}
		<div class="row">
			<div class="twelve columns">
				<div class="u-pull-right">
					<img src="img/logo.png" width="200">
				</div>
			</div>
		</div>
		{{-- NOMBRE DOCUMENTO --}}
		<div class="row">
			<div class="twelve columns" style="background-color:#f7942b; color:#fff">
				<label class="center"><strong>PREMIO</strong></label>
			</div>
		</div>
		{{-- LUGAR Y FECHA DEL DOCUMENTO --}}
		<div class="row">
			<div class="twelve columns">
				<label class="center"><strong>Premio de Mensualidades Adelantadas Gratis</strong></label>
			</div>
		</div>
		{{-- NOMBRE DEL PACIENTE --}}
		{{-- <div class="row" style="top: 5px; margin-left: 25px;">
			<div class="twelve columns">
				<div class="six columns">
					<label class="center">
						<strong style="border-bottom: 2px solid orange;">
							{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}
		</strong>
		</label>
	</div>
	<div class="six columns"></div>
	</div>
	</div> --}}

	<div class="row" style="top: 25px;">
		<div class="twelve columns">
			<p class="justify">
				Podrá obtener (3) tres mensualidades adelantadas GRATIS del valor del PAI contratado, si se cumple con
				los siguiente
				requisitos.
			</p>
			<br><br>
			<p class="justify">
				Pago puntual de la cuota periodica total dentro de los 7 primeros días habiles del mes correspondiente,
				de la primera cuota periodica total hasta la ciento cincuenta y seis, del plazo contratado.
			</p>
			<br><br>
			<p class="justify">
				De cumplirse con lo anterior, estas doce mensualidades gratis, se aplicarán a la cuota periódica total
				157 a la 168.
			</p>
			<br><br>
			<p class="justify">
				En caso de incumplir y no ser puntual en alguna cuota periódica total o aportaciones extraordinarias,
				se perderán las doce cuotas periódicas totales de regalo, teniendo que pagar su compromiso total de
				las 168 cuotas periódicas totales del plazo contratado.
			</p>
			<br><br>
			<p class="justify">
				Esta promoción aplica al cumplir al 100% los requisitos.
			</p>
			<br>
			<p class="justify">
				A <span for="" style="border-bottom-style: solid; border-bottom-color:coral">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{$prospecto->nombre}} {{$prospecto->appaterno}} {{$prospecto->apmaterno}}
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
			</p>
			<p class="justify">
				Titular del contrato <span for="" style="border-bottom-style: solid; border-bottom-color:coral">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{$contrato->numero_contrato}}
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
			</p>
			<p class="justify">
				De fecha {{date('d')}} de {{__(date('F'))}} del {{date('Y')}}
			</p>
			<p class="justify">
				En México, Ciudad de México
			</p>
		</div>
	</div>
	{{-- FIRMA PACIENTE --}}
	<div class="row" style="margin-left: 12px; margin-right: 12px; position: fixed;left: 0;bottom: 100px;width: 100%;">
		<div class="twelve columns">
			<br>
			<p class="" style="font-size: 10px;">
				PROMOCIÓN LIMITADA <br>
				Solo integrantes es instrasferible.
			</p>
		</div>
	</div>
	</div>
</body>

</html>