<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<style type="text/css">
		ul,li,p{
			font-size: 14px;
			text-align:justify-all;
			margin: 3 5px;
		}
		table, td, th {  
		  border: 1px solid #ddd;
		  text-align: center;
		  font-size: 14px;
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
	<title>Carta de bienvenida</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="twelve columns">
				<div class="ten columns u-pull-left"></div>
				<div class="two columns u-pull-right">
					<img src="img/perfil.png" height="40" width="80">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="border-top: 2px solid #B8242B; margin-top: 0px;"></div>
		</div>
		<div class="row" style="margin-top: 5px;">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<img src="img/carta_bienvenida_header.png" height="50%" width="60%">
				</div>
				<div class="one-half column u-pull-right">
					<label class="right">
						México, CDMX a {{date('d')}} de {{__(date('F'))}} del {{date('Y')}}
					</label>
					<label class="center" style="margin-top: 35px;">
						<strong>Carta de Bienvenida</strong>
					</label>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 5px; margin-left: 25px;">
			<div class="twelve columns">
				<label class="left">
					{{$prospecto->perfil->prefijo_1 == "Sr." ? "Estimado cliente:" : "Estimada clienta:"}} 
					<strong style="border-bottom: 0.5px solid black;">
						{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}
					</strong>
				</label>
			</div>
		</div>
		<div class="row" style="margin-top: 5px;">
			<div class="twelve columns">
				<p class="justify">
					Le felicitamos por tomar la decisión de pertenecer a <strong>Planea Tu Bien, S.A. de C.V.</strong> y a través de este medio también te damos la bienvenida al servicio de <strong>Atención a Clientes</strong>, agradecemos por la confianza que ha depositado en nosotros.
				</p>
				<p class="justify">
					Nuestro compromiso es ofrecerle el mejor servicio, así como satisfacer sus necesidades para adquirir su casa, terreno y/o local comercial.
				</p>
				<p class="justify">
					Para brindarle un mejor servicio y asesorarlo sobre el funcionamiento del plan de financiamiento que usted ha contratado, a partir de este momento cualquier asunto relacionado con el contrato celebrado con <strong>Planea Tu Bien, S.A. de C.V.</strong> queremos invitarlo a ponerse en contacto con nuestra área de atención a clientes mediantelas siguientes formas:
				</p>
				<p class="justify" style="margin-left: 25px;">
					Vía correo electrónico:
				</p>
				<label class="justify" style="margin-left: 40px; color: blue">
					atencionclientes@planeatubien.mx
				</label>
				<p class="justify" style="margin-left: 25px;">
					O si lo desea, a los siguientes números telefónicos:
				</p>
				<label class="justify" style="margin-left: 150px;">
					<strong>55-33-22-01</strong> extensiones: <strong>224 / 206 / 244</strong>
				</label>
				<p class="justify">
					<strong>Dirección:</strong>
				</p>
				<p class="justify">
					Homero #229 despacho 103, Col. Chapultepec Morales C.P. 11570
				</p>
				<p class="justify">
					<strong>Horarios:</strong>
				</p>
				<p class="justify">
					Lunes a Viernes de 9:00 - 19:00 hrs., Sábado de 11:00 - 13:00 hrs.
				</p>
				<p class="justify">
					Le recordamos mantener actualizado su e-mail para recibir información importante y las promociones del mes que <strong> Planea Tu Bien</strong> te ofrece.
				</p>
				<p class="justify">
					Gracias por formar parte de <strong>Planea Tu Bien</strong>, esperamos sus pagos puntualmente y le deseamos suerte en su proceso de adjudicación.
				</p>
			</div>
		</div>
		<div class="row" style="margin-top: 10px; margin-right: 50px">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<label class="center">
						Recibí carta de bienvenida
					</label>
				</div>
				<div class="one-half column u-pull-right">
					<label class="center">________________________________________</label>
					<label class="center">NOMBRE COMPLETO Y FIRMA DEL CLIENTE</label>
				</div>
			</div>
			<div class="row" style="margin-left: 12px; margin-right: 12px; position: fixed;left: 0;bottom: 40px;width: 100%;">
				<div class="twelve columns">
					<img src="img/header_privacidad.png" width="100%" height="25%">
				</div>
			</div>
		</div>
	</div>
</body>
</html>