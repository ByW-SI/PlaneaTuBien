<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<style type="text/css">
		ul,li,p{
			font-size: 12px;
			text-align:justify-all;
			margin: 3 5px;
		}
		table, td, th {  
		  border: 1px solid #ddd;
		  text-align: center;
		  font-size: 12px;
		}

		table {
		  border-collapse: collapse;
		  width: 100%;
		  margin-left: 20px;
		  margin-right: 40px;
		}
		label{
			margin: 10 15px;
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
	</style>
	<title>Ficha de Deposito</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="twelve columns">
				<div class="ten columns u-pull-left">
					<img src="img/ficha_deposito_top.png" height="40" width="80">
				</div>
				<div class="two columns u-pull-right">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="border-top: 2px solid #081170; margin-top: 0px;"></div>
		</div>
		<h6 class="center">{{strtoupper($presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno)}}</h6>
		<div class="row">
			<div class="twelve columns">
				<div class="two-thirds column u-pull-left">
					<div class="one-half column u-pull-left">
						<label class="center" style="background: #081170; color: white; border-radius: 12px; margin: 5 5px;">FICHA DE DEPÓSITO</label>
					</div>
					<div class="one-half column u-pull-right">
						<p>REALIZA TU PAGO EN CUALQUIER SUCURSAL <img src="img/bbva.png" height="15px" width="70px"></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="two-thirds column u-pull-left">
					<div class="one-half column u-pull-left" >
						<p class="left">Fecha limite de pago:</p>
						<p class="left">Número de contrato:</p>
						<p class="left">Número de grupo:</p>
						<p class="left">Convenio:</p>
						<p class="left">Numero de referencia:</p>
						<p class="left">Numero de mensualidad:</p>
						<p class="left">Aportación al fondo:</p>
						<p class="left">Cuota de Administracion:</p>
						<p class="left">IVA cuota de administración:</p>
						<p class="left">Fondo de contingencia:</p>
						<p class="left">Prima de seguro de vida</p>
						<p class="left">Prima de seguro de daños:</p>
						<p class="left">Importe total a pagar:</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center" style="background: #cccc; border-radius:10px;">Día 7 de cada mes</p>
						<p class="center" style="background: #cccc; border-radius:10px;">{{$contrato->numero_contrato}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">{{$contrato->grupo->id}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">{{$recibo->clave.$recibo->numero_contrato}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">{{$contrato->grupo->id.$contrato->numero_contrato.$presolicitud->cotizacion()->folio}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">1 de {{ $corrida_integrante['meses']}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['aportacion'],2)}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['cuota_administracion'],2)}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['iva'],2)}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">$0.00</p>
						<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['sv'],2)}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['sd'],2)}}</p>
						<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['total'],2)}}</p>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<img src="img/deposito_derecho.png">
				</div>
			</div>
		</div>
		<div class="row">
			<img src="img/deposito_bottom.png">
		</div>
	</div>

</body>
</html>