<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<style type="text/css">
		ul,li,p{
			font-size: 10px;
			text-align:justify-all;
			margin: 0 5px;
		}
		table, td, th {  
		  border: 1px solid #ddd;
		  text-align: center;
		  font-size: 10px;
		}

		table {
		  border-collapse: collapse;
		  width: 100%;
		  margin-left: 20px;
		  margin-right: 40px;
		}
		.center{
			text-align: center;
		}
		.justify{
			text-align: justify-all;
		}
	</style>
	<title>Contrato</title>
</head>
<body>
	<div class="container">
		<!-- INICIO ENCABEZADO PAG-->
		<div class="row">
			<div class="twelve columns">
				<div class="nine columns u-pull-left"></div>
				<div class="three columns u-pull-right">
					<img src="img/logo.png" height="40" width="130">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="border-top: 2px solid #B8242B; margin-top: 0px;"></div>
		</div>
		<!-- FIN ENCABEZADO PAG-->
		<!-- <div class="page-break"></div> -->
		<div class="row">
			<div class="twelve columns">
				<h5 class="center">Cotización {{ $plan->nombre }}</h5>
				<p>
					<b>Monto:</b> ${{number_format($monto,2)}} &nbsp;&nbsp;&nbsp; 
					<b>Plazo:</b> {{$plan->plazo}} meses &nbsp;&nbsp;&nbsp; 
					<b>Aportaciones extraordinarias</b> {{ $res['aportaciones_extraordinarias'] }}%  &nbsp;&nbsp;&nbsp;
					<b>Monto a financiar</b> ${{ number_format($res['monto_financiar'],2) }}  &nbsp;&nbsp;&nbsp;
					<b>Cuota de administración</b> {{$plan->cuota_admon}}%  &nbsp;&nbsp;&nbsp;
					<b>Monto a adjudicar</b> ${{ number_format($res['monto_adjudicar'],2)}}  &nbsp;&nbsp;&nbsp;
				</p>
					<!--#############-->
			</div>
		</div>
		<br>
		<br>
		<br>
		<div class="row">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<div class="one-half column u-pull-left"></div>
					<div class="one-half column u-pull-right" style="text-align: center; border-top: 0.5px solid #ccc">
						<label>PROVEEDOR</label>
						<span style="font-size: 12px;">Planea Tu Bien S.A. de C.V.</span>
					</div>
				</div>
				<div class="one-half column u-pull-right">
					<div class="one-half column u-pull-left" style="text-align: center; border-top: 0.5px solid #ccc">
						<label>CONSUMIDOR</label>
						<span style="font-size: 12px;">NOMBRE</span>
					</div>
					<div class="one-half column u-pull-right"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>