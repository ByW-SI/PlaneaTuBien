<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<style type="text/css">
		ul,li,p{
			font-size: 8px;
			text-align:justify-all;
			margin: 0 5px;
		}
		table, td, th {  
		  border: 1px solid #ddd;
		  text-align: center;
		  font-size: 8px;
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
	<title>Formato de Domiciliación</title>
</head>
<body>
	<div class="container" style="border: 1px solid black;">
		<div class="row" style="border-bottom: 1px solid black">
			<div class="twelve columns">
				<label class="right" style="margin-top: 10px; margin-right: 55px; margin-bottom: 10px;">
					<strong>
						AUTORIZACIÓN PARA DOMICILIACIÓN DE MENSUALIDADES
					</strong>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="two-thirds column u-pull-left">
				<p class="left">
					EMISOR (Nombre o Razón Social) 
				</p>
				<label class="center">
					<strong>
						PLANEA TU BIEN SA DE CV
					</strong>
				</label>
			</div>
			<div class="one-third column u-pull-right" style="border-left: 1px solid black">
				<p class="left">
					R.F.C.
				</p>
				<label class="center">
					<strong>
						PTB091030MS1
					</strong>
				</label>
			</div>
		</div>
		<div class="row" style="border-top: 1px solid black">
			<div class="twelve columns">
				<p class="left">
					DOMICILIO DEL EMISOR(calle, número, colonia, código postal, ciudad y estado)
				</p>
				<label class="center">
					<strong>
						HOMERO 229, INT-103, COL. CHAPULTEPEC MORALES, C.P. 11570, MÉXICO, CIUDAD DE MÉXICO
					</strong>
				</label>
			</div>
		</div>
		<div class="row"  style="border-top: 1px solid black">
			<div class="two-thirds column u-pull-left">
				<p class="left">
					CLIENTE DEL EMISOR TITULAR DEL SERVICIO(Nombre Completo) 
				</p>
				<label class="center">
					<strong>
						{{strtoupper($domiciliacion->emisor)}}
					</strong>
				</label>
			</div>
			<div class="one-third column u-pull-right" style="border-left: 1px solid black">
				<p class="left">
					REFERENCIA

				</p>
				<label class="center">
					<strong>
						{{strtoupper($domiciliacion->referencia)}}
					</strong>
				</label>
			</div>
		</div>
		<div class="row" style="border-top: 1px solid black">
			<div class="twelve columns">
				<div class="two-thirds column u-pull-left">
					<div class="one-half column u-pull-left">
						<p class="left">
							CONCEPTO DEL RECIBO
						</p>
						<label class="center"><strong>
							PAGO DE MENSUALIDAD
						</strong></label>
					</div>
					<div class="one-half column u-pull-right" style="border-left: 1px solid black">
						<p class="left">
							MONTO DEL RECIBO
						</p>
						<label class="center"><strong>
							${{number_format($plan->cuota_periodica_integrante($contrato->monto,$contrato->recibo->presolicitud->cotizacion()->factor_actualizacion),2)}}
						</strong></label>
					</div>
				</div>
				<div class="one-third column u-pull-right" style="border-left: 1px solid black">
					<p class="left">
						IVA DEL RECIBO
					</p>
					<label class="center"><strong>
						$0.00
					</strong></label>
				</div>
			</div>
		</div>
		<div class="row" style="border-top: 1px solid black">
			<div class="twelve columns">
				<p class="left">
					CLIENTE USUARIO TITULAR DE LA CUENTA BANCARIA (Nombre completo)
				</p>	
				<label class="center"><strong>
					{{strtoupper($domiciliacion->titular)}}
				</strong></label>
			</div>
		</div>
		<div class="row" style="border-top: 1px solid black">
			<div class="twelve columns">
				<div class="one-half column u-pull-left" style="border-right: 1px solid black; height:130px;">
					<p class="left">
						BANCO RECEPTOR DONDE RECIDA LA CUENTA BANCARIA(Razón Social)
					</p>
					<label class="center"><strong>
						{{strtoupper($domiciliacion->banco)}}
					</strong></label>
				</div>
				<div class="one-half column u-pull-right" style=" margin-top: 2px;">
					<p class="left">
						Numero de {{$domiciliacion->tipo}}
					</p>
					<label class="center"><strong>
						{{strtoupper($domiciliacion->numero)}}
					</strong></label>
				</div>
			</div>
		</div>
		<div class="row" style="border-top: 1px solid black">
			<div class="twelve columns">
				<label class="justify" style="margin: 4 8px;">
					Autorizo al Banco Receptor para que realice por mi cuenta los pagos por los conceptos que en este documento se detallan, con cargo a la cuenta bancaria identificada por la CLABE o número de tarjeta de débito o crédito indicado al rubro. Convengo en que el Banco Receptor queda liberado de toda responsabilidad si el Emisor ejecutara acciones contra mi, derivados de la Ley o el Contrato que tengamos celebrado, y que el Banco Receptor no estará obligado a efectuar ninguna reclamación al Emisor, ni a interponer recursos de ninguna especie contra multas, sanciones o cobros indebidos, todo lo cual en caso de ser necesario, será ejecutado por mí. El Banco Receptor tampoco será responsable si el Emisor no entregara oportunamente los comprobantes de servicioes, o si los pagos se realizaran extemporáneamente por razones ajenas al Banco Receptor, el cual tendrá absoluta libertad de cancelarme este servicio si en mi cuenta no existieran fondos suficientes para cubrir uno o más de los pagos que le requiera el Emisor, o bien, ésta estuviera bloqueada por algun motivo.
				</label>
			</div>
		</div>
		<div class="row" style="border-top: 1px solid black">
			<div class="twelve columns">
				<div class="one-half column u-pull-left" style="border-right: 1px solid black; height:50px;">
					<p class="left">
						FECHA (DD/MM/AAAA)
					</p>
					<label class="center"><strong>{{date('d/m/Y')}}</strong></label>
				</div>
				<div class="one-half column u-pull-right">
					<p class="left">
						FIRMA DEL CLIENTE USUARIO TITULAR DE LA CUENTA BANCARIA
					</p>
					<br>
				</div>
			</div>
		</div>
	</div>
</body>
</hml>