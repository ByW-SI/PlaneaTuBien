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
	<title>Aviso de Privacidad</title>
</head>
<body>
	<div class="container">
		<div style="position: absolute; left: 10%; right: 25%; top: 35%; bottom: 35%;">
			<img src="img/perfil.png"  style="opacity: 0.1;filter: alpha(opacity=10); height: 100%; width: 600px">
		</div>
	
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
		<div class="row" style="top: 5px;">
			<div class="twelve columns">
				<label class="right">
					México, CDMX a {{date('d')}} de {{__(date('F'))}} del {{date('Y')}}
				</label>
			</div>
		</div>
		<div class="row" style="top: 5px; margin-left: 25px;">
			<div class="twelve columns">
				<label class="left">
					{{$prospecto->perfil->prefijo_1 == "Sr." ? "Estimado:" : "Estimada:"}} 
					<strong style="border-bottom: 0.5px solid black;">
						{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}
					</strong>
				</label>
			</div>
		</div>
		<div class="row" style="top: 25px;">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<p class="justify">Recientemente el IFAI, en conformidad con la Ley Federal de Protección de Datos Personales, ha exhortado a todas las organizaciones que recaban datos personales a expedir su Aviso de Privacidad</p>
					<p class="justify">
						A través del Aviso de Privacidad las organizaciones reguladas deben establecer claramente qué tipo de datos recaban y el uso que le dan a éstos.
					</p>
					<p class="justify">
						Asimismo, le informamos:
					</p>
					<ul>
						<li class="justify">
							Un dato personal es cualquier información relacionada con usted.
						</li>
						<li class="justify">
							Usted es dueño de sus datos personales y solo usted decide cómo, cuándo, a quién y para qué entrega su información personal.
						</li>
					</ul>
				</div>
				<div class="one-half column u-pull-right">
					<ul>
						<li class="justify">
							Los mexicanos contamos hoy con una legislación que protege la información personal que pueda encontrarse en las bases de datos de cualquier persona física, o empresa como aseguradoras, bancos, tiendas departamentales, telefónicas, hospitales, laboratorios, universidades.
						</li>
						<li class="justify">
							La ley regula la forma y condiciones en que las empresas deben utilizar sus datos personales.
						</li>
						<li class="justify">
							Quienes manejan datos deberán prever medidas de seguridad y establecer mecanismos para usted pueda Acceder, Rectificar, Cancelar u Oponerse al manejo de su información personal.
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row" style="top: 25px;">
			<div class="twelve columns">
				<p class="justify">
					En cumplimiento a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares(la "ley") le informamos los términos y condiciones del Aviso de Privacidad de Planea Tu Bien, S.A. de C.V. (en lo sucesivo PTB) con domicilio en Homero 229 int. 103 Col. Chapultepec Morales C.P. 11570 CDMX.
				</p>
				<p class="justify">
					Los Datos Personales, como dicho término se define en la Ley, que usted libre y voluntariamente proporcione a PTB están destinados para fines de identificación, promoción, venta, publicidad, estadística, análisis interno, información a clientes y consumidores, cobranza o cualquier otra actividad análoga de conformidad con el objeto social de PTB.
				</p>
				<p class="justify">
					PTB podrá contratar a uno o varios terceros como proveedores de servicios para administrar los Datos Personales que se recaban a través de cualquier medio por PTB, por lo que podrá incluso transferir esa información a dicho(s) tercero(s) sin fines comerciales sino únicamente en cumplimiento de la prestación de servicios contratados. Asimismo, PTB podrá transmitir sus datos personales con y entre sus empresas subsidiarias y unidades de negocio para los fines mencionados en el párrafo inmediato anterior.
				</p>
				<p class="justify">
					PTB tiene implementadas medidas de seguridad físicas, electrónicas y técnicas para proteger sus Datos Personales, sin embargo, usted tendrá derecho a solicitar su rectificación a partir del 6 de enero de 2012 enviando un fax al 5533-2201 ext. 4 con una copia de su identificación e indicándonos cuáles son los datos que se deberán ser modificados. El plazo para atender su solicitud será de 3 días hábiles.
				</p>
				<p class="justify">
					Nos reservamos el derecho de efectuar en cualquier momento modificaciones o actualizaciones al presente aviso de privacidad, para la atención de novedades lesgislativas, políticas internas o nuevos requerimentos para la prestación u ofrecimiento de nuestros servicios o productos. Estas modificaciones estarán disponibles al público en nuestras oficinas ubicadas en Homero 229 int. 103 Col. Chapultepec Morales C.P. 11570 CDMX.
				</p>
				<p class="justify">
					Si considera que su derecho de protección de datos personales ha sido lesionado por alguna conducta de nuestros colaboradores, o presume que en el tratamiento de sus datos personales existe alguna violación a las disposiciones previstas en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, podrá interponer la queja o denuncia correspondiente ante el IFAI.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<br>
				<label class="center">________________________________________</label>
				<label class="center">NOMBRE COMPLETO Y FIRMA DEL CLIENTE</label>
				<p class="center" style="font-size: 10px;">Para más información, visite este enlace: http://wwww.ifai.gob.mx/Particulares/faq o llame al Tel. 01 800 TELIFAI (01 800 8354324)</p>
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