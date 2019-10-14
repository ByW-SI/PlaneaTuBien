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
		<br><br>
		{{-- LOGOTIPO DE CABECERA --}}
		<div class="row">
			<div class="twelve columns">
				<div class="u-pull-right">
					<img src="img/ficha_deposito_top.png" width="200">
				</div>
				<div class="two columns u-pull-right">
				</div>
			</div>
		</div>
		<br><br>
		{{-- NOMBRE DEL CLIENTE --}}
		<div class="row">
			<div class="six columns" style="border-bottom: 1px solid orange;">
				<span>
					<strong>{{strtoupper($presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno)}}</strong>
				</span>
			</div>
		</div>

		{{-- DATOS --}}

		<div class="row">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<div class="one-half column u-pull-left">
						<p class="left">Fecha límite de pago:</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center" style="background: #cccc; border-radius:10px;">Día 7 de cada mes</p>
					</div>
				</div>
				<div class="one-half column u-pull-right">
					<div class="one-half column u-pull-left">
						<p class="left">Número de contrato:</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center" style="background: #cccc; border-radius:10px;">{{$contrato->numero_contrato}}</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<div class="one-half column u-pull-left">
						<p class="left">Número de grupo:</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center" style="background: #cccc; border-radius:10px;">{{$contrato->grupo->id}}</p>
					</div>
				</div>
				<div class="one-half column u-pull-right">
					<div class="one-half column u-pull-left">
						<p class="left">Convenio:</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center" style="background: #cccc; border-radius:10px;">{{$contrato->presolicitud->id.$contrato->numero_contrato}}</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<div class="one-half column u-pull-left">
						<p class="left">Número de referencia:</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center" style="background: #cccc; border-radius:10px;">{{$contrato->grupo->id.$contrato->numero_contrato.$presolicitud->cotizacion()->folio}}</p>						
					</div>
				</div>
				<div class="one-half column u-pull-right">
					<div class="one-half column u-pull-left">
							<p class="left">Número de mensualidad:</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center" style="background: #cccc; border-radius:10px;">1 a {{ $corrida_integrante['meses']}}</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<div class="one-half column u-pull-left">
					<p class="left">Aportación al fondo:</p>
						
					</div>
					<div class="one-half column u-pull-right">
					<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['aportacion'],2)}}</p>
						
					</div>
				</div>
				<div class="one-half column u-pull-right">
					<div class="one-half column u-pull-left">
					<p class="left">Cuota de Administración:</p>
						
					</div>
					<div class="one-half column u-pull-right">
					<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['cuota_administracion'],2)}}</p>
						
					</div>
				</div>
			</div>
		</div>

		<div class="row">
				<div class="twelve columns">
					<div class="one-half column u-pull-left">
						<div class="one-half column u-pull-left">
							<p class="left">IVA cuota de administración:</p>
						</div>
						<div class="one-half column u-pull-right">
							<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['iva'],2)}}</p>	
						</div>
					</div>
					<div class="one-half column u-pull-right">
						<div class="one-half column u-pull-left">
							<p class="left">Fondo de contingencia:</p>	
						</div>
						<div class="one-half column u-pull-right">
							<p class="center" style="background: #cccc; border-radius:10px;">$0.00</p>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="twelve columns">
					<div class="one-half column u-pull-left">
						<div class="one-half column u-pull-left">
							<p class="left">Prima de seguro de vida</p>	
						</div>
						<div class="one-half column u-pull-right">
							<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['sv'],2)}}</p>
						</div>
					</div>
					<div class="one-half column u-pull-right">
						<div class="one-half column u-pull-left">
							<p class="left">Prima de seguro de daños:</p>
						</div>
						<div class="one-half column u-pull-right">
							<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['sd'],2)}}</p>							
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="twelve columns">
					<div class="one-half column u-pull-left">
						<div class="one-half column u-pull-left">	
							<p class="left">Importe total a pagar:</p>
						</div>
						<div class="one-half column u-pull-right">
							<p class="center" style="background: #cccc; border-radius:10px;">${{number_format($corrida_integrante['total'],2)}}</p>
						</div>
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="twelve columns" style="border-bottom: 1px solid orange;">
					<p><strong>Recuerda</strong></p>
				</div>
			</div>

			<div class="row">
				<div class="twelve columns">
					<p class="center" style="font-size: 1em;">
						<strong>Paga antes del 7</strong> de cada mes y aumenta tus posibilidades de salir adjudicado.
						<br>
						<strong>¡Alcanza tu meta y construye un patrimonio depositando puntualmente!</strong>
					</p>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="twelve columns">
					<img src="img/ficha_deposito_middle.png" class="u-max-full-width">
				</div>
			</div>

			<div class="row">
				<div class="twelve columns">
					<img src="img/ficha_deposito_footer.png" class="u-max-full-width">
				</div>
			</div>



</body>
</html>