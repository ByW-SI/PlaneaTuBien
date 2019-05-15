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
			<div class="twelve columns" style="border-top: 2px solid #B8242B; margin-top: 0px;"></div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<h6 class="center"><strong>ANEXO</strong></h6>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
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
							<p class="center" style="border-bottom: 0.5px solid black;"><strong>{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</strong></p>
							<p class="center" style="border-bottom: 0.5px solid black; margin-top: 10px;"><strong>{{$presolicitud->id}}</strong></p>
							<p class="center" style="border-bottom: 0.5px solid black; margin-top: 10px;"><strong>{{$recibo->contrato->grupo->id}}</strong></p>
							<p class="center" style="border-bottom: 0.5px solid black;"><strong>${{number_format($recibo->contrato->monto,2)}}</strong></p>
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
						<p class="center" style="border-bottom: 0.5px solid black;"><strong>{{$puntos}} puntos</strong></p>
						<p class="center" style="border-bottom: 0.5px solid black;"><strong>${{number_format($recibo->contrato->monto,2)}}</strong></p>
						<p class="center" style="border-bottom: 0.5px solid black;"><strong>168 meses</strong></p>
						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="row" >
						
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
					<strong>Aportaciones Extraodinarias 100% a Capital</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					El consumidor adquiere la calidad de adjudicatario, en la reunión de adjudicación posterior al cumplimiento del 25% de aportacion extraordinaria del monto actualizado del precio total del bien a adjudicar, así como haya realizado mínimo 18 pagos mensuales consecutivos, este al corriente en sus cuotas periodicas totales correspondientes al mes inmediato anterior, y el 1% anual cada diciembre de aportacion extraordinaria del monto actualizado del precio total del bien a adjudicar.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left">
					El consumidor ratifica a la proveedora PLANEA TU BIEN SA DE CV, que su cuota periodica total, se actualiza de acuerdo al contrato de adhesión, y una vez entregado el bien, a esta mensualidad se le agregue el seguro de daños del bien que adquiera y cede el remanente al Proveedor, quedando de la siguiente manera.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="left" style="padding-left: 25px;">
					cuota periodica total inicial de ${{number_format($plan->cuota_periodica_integrante($recibo->contrato->monto),2)}}
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>El presente certificado promocional es personal e intransferible, no tiene validez monetaria, no implica ninguna modificación a las cláusulas del contrato de adhesión, ni exime del cumplimiento de las obligaciones contraídas en el mismo.</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>Al ser un documento de manifestación voluntaria, no pretende modificar el contenido del contrato de adhesión toda vez que siempre prevalecerán las condiciones pactadas en el mismo.</strong>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>Leído que fue el presente y enteradas las partes de su alcance y contenido, manifestando que no existe, dolo, error o mala fe, ni ningún vicio oculto, lo firman de conformidad ambas partes.</strong>
				</p>
			</div>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
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
					<div style="border-top: 1px solid black; margin-top: 50px; padding-left: 15px">
						<p class="center">{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>
</html>