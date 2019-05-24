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
		  font-size: 9px;
		}

		table {
		  border-collapse: collapse;
		  width: 100%;
		 	margin: 0 5px; 
		 	font-size:  9px;
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
	<title>Declaración de salud</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="twelve columns">
				<div class="two-half column u-pull-left">
					<p class="left">
						<strong>
							TOKIO MARINE COMPAÑÍA DE SEGUROS, S.A. DE C.V.
						</strong>
					</p>
					<p class="left">
						Blvd. Adolfo López Mateos 261, 5to. Piso 
					</p>
					<p class="left">
						Col. Los Alpes 
					</p>
					<p class="left">
						01010 México, CDMX. 
					</p>
					<p class="left">
						Tel. 5278-2100 
					</p>
					<p class="left">
						Fax 5278-2155 
					</p>
				</div>
				<div class="one-half column u-pull-right">
					<img src="img/tokio_marine.png" align="right">
				</div>
			</div>
		</div>
		<div class="row" style="position: absolute; top: 60px;">
			<div class="twelve columns">
				<label class="center" style="background: #87CEFA; width: 50%; margin: auto;"><strong>DECLARACIÓN DE SALUD</strong></label>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="ten columns u-pull-left">
					<div class="two-thirds column u-pull-left">
						<div class="four columns u-pull-left">
							<p class="left"><strong>Nombre Completo:</strong></p>
						</div>
						<div class="eight columns u-pull-right"  style="border-bottom: 1px solid black">
							<p class="center"><strong>{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</strong></p>
						</div>
					</div>
					<div class="one-third column u-pull-right">
						<div class="four columns u-pull-left">
							<p class="left">
								<strong>RFC:</strong>
							</p>
						</div>
						<div class="eight columns u-pull-right" style="border-bottom: 1px solid black">
							<p class="center"><strong>{{$presolicitud->rfc}}</strong></p>
						</div>
					</div>
				</div>
				<div class="two columns u-pull-right">
					<div class="one-half column u-pull-left">
						<p class="center">
							<input type="checkbox" {{$presolicitud->sexo == "Masculino" ? 'checked=""' : ''}}><strong>M</strong>
						</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="center">
							<input type="checkbox" {{$presolicitud->sexo == "Femenino" ? 'checked=""' : ''}}><strong>F</strong>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="nine columns u-pull-left">
					<div class="five columns u-pull-left">
						<p class="left">
							<strong>Lugar y Fecha de Nacimiento:</strong>
						</p>
					</div>
					<div class="seven columns u-pull-right" style="border-bottom: 1px solid black">
						<p class="center"><strong> {{$presolicitud->lugar_nacimiento}}, {{$presolicitud->fecha_nacimiento}}</strong></p>
					</div>
				</div>
				<div class="three columns u-pull-right">
					<div class="ten columns u-pull-left"  style="margin:0 0;">
						<p class="left">
							<strong>Edad Actual:</strong>
						</p>
					</div>
					<div class="two columns u-pull-right" style="border-bottom: 1px solid black">
						<p class="center"><strong> {{$presolicitud->edad}}</strong></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<div class="one-half column u-pull-left">
						<p class="left"><strong>Estatura:</strong>___________</p>
					</div>
					<div class="one-half column u-pull-right">
						<p class="left"><strong>Peso:</strong>______________</p>
					</div>
				</div>
				<div class="one-half column u-pull-right">
					<div class="four columns u-pull-left">
						<p class="left"><strong>Ocupación:</strong></p>	
					</div>
					<div class="eight columns u-pull-right" style="border-bottom: 1px solid black">
						<p class="center"><strong >{{$presolicitud->profesion}}</strong></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="two-thirds column u-pull-left">
					<p class="justify">
						¿Durante el último año ha sufrido alguna alteración en su peso (aumento o disminución) de 10 kgs. ó más?
					</p>
					<p class="justify">
						De responder afirmativamente mencionar el número de kilos __________
					</p>
				</div>
				<div class="one-third column u-pull-right">
					<div class="one-half column u-pull-left">
						<label class="center">SI(___)</label>
					</div>
					<div class="one-half column u-pull-right">
						<label class="center">NO(____)</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					¿En los últimos cinco años ha consultado con algún médico, ha estado bajo tratamiento o  tomando algún medicamento por padecer o haber padecido las siguientes enfermedades? Favor de tachar la respuesta correcta: 
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<table>
					<tbody>
						<tr>
							<th style="background: #cccc">Pregunta</th>
							<th style="background: #cccc">SI</th>
							<th style="background: #cccc">NO</th>
							<th style="background: #cccc">Pregunta</th>
							<th style="background: #cccc">SI</th>
							<th style="background: #cccc">NO</th>
						</tr>
						<tr>
							<td style="width: 40%">
									1. ¿Cáncer, leucemia, tumores malignos, lupus?
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width: 40%">
									9. ¿Enfermedades crónicas o incurables? 
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
						</tr>
						<tr>
							<td style="width: 40%">
									2. ¿Enfermedades de la sangre? 
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width: 40%">
									10. ¿Extirpación de algún órgano importante o parte de él?		
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
						</tr>
						<tr>
							<td style="width: 40%">
									3. ¿Problemas relacionados con el corazón o el sistema circulatorio,  Infartos?
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width: 40%">
									11. ¿Cirrosis hepática, hepatitis crónica (“A“ o “B“), pancreatitis? 
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
						</tr>
						<tr>
							<td style="width: 40%">
									4. ¿Hipertensión arterial?  
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width: 40%">
									12. ¿Enfisema, asma crónica, tuberculosis?
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
						</tr>
						<tr>
							<td style="width: 40%">
									5. ¿Trastornos neurológicos, cerebro-vasculares, mentales, depresión nerviosa? 
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width: 40%">
									13. ¿Ha sido internado en un hospital o clínica para estudios, operación o tratamiento?
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
						</tr>
						<tr>
							<td style="width: 40%">
									6. ¿Diabetes Mellitus en cualquiera de sus tipos?
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width: 40%">
									14. ¿Sangrado del tubo digestivo?
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
						</tr>
						<tr>
							<td style="width: 40%">
									7. ¿SIDA o seropositivo al VIH, o enfermedades de la sangre?
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width: 40%">
								15. ¿Fumador de más de 40 cigarrillos diarios, o bebedor llegando al estado de embriaguez más de 5 veces al año?

								
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
						</tr>
						<tr>
							<td style="width: 40%">
									8. ¿Insuficiencia renal o afección en ambos riñones?
							</td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
							<td style="width:5%"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					En caso de respuesta(s) afirmativa(s), especificar detalles, fechas, evolución, estado actual, etc.  
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns" style="border-bottom: 0.5px solid black; margin-top: 10px"></div>
		</div>
		<div class="row">
			<div class="twelve columns" style="border-bottom: 0.5px solid black; margin-top: 10px"></div>
		</div>
		<div class="row">
			<div class="twelve columns" style="border-bottom: 0.5px solid black; margin-top: 10px"></div>
		</div>
		<div class="row">
			<div class="twelve columns" style="border-bottom: 0.5px solid black; margin-top: 10px"></div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="two-thirds column u-pull-left">
					<p class="left">
						¿Practica algún Deporte?  SI (___)   NO (___)  ¿Cuál?_________________________________
					</p>
				</div>
				<div class="one-third column u-pull-right">
					<p class="left">
						Frecuencia:_______________________
					</p>
				</div>
			</div>
		</div>
		<label>Antecedentes Familiares</label>
		<div class="row">
			<table>
				<tr>
					<th style="width: 15%;background: #cccc;">
						Parentesco
					</th>
					<th style="width: 10%;background: #cccc;">
						Edad
					</th>
					<th style="width: 25%;background: #cccc;">
						Estado de Salud
					</th>
					<th style="width: 50%;background: #cccc;">
						Padecimiento / Causa de Fallecimiento
					</th>
				</tr>
				<tr>
					<td>
						Madre
					</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Padre</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Hermanos</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Hijos</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					Enterado de lo que antecede y para efecto de esta solicitud de seguro, declaro que todos los hechos a que se refiere este cuestionario son verdaderos, en la inteligencia de que la no declaración o inexacta o falsta declaración de un hecho importante que se me pregunte, podría originar la pérdida de mi derecho como Asegurado o del beneficiario en su caso;  asimismo estoy dispuesto, si fuera necesario, a pasar un examen médico por cuenta de la Compañía, si ésta lo estima conveniente.   Además autorizo a los médicos o personas que me hayan asistido o examinado, o a los hospitales o clínicas a los que haya ingresado para diagnóstisco o tratamiento de cualquier enfermedad, para que proporcionen a Tokio Marine Compañía de Seguros, S.A. de C.V. todos los informes que se refieran a mi estado de salud, inclusive los datos de enfermedades anteriores.  Para tal efecto relevo a las personas arriba mencionadas del secreto profesional.  
				</p>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="two-thirds column u-pull-left">
					<div class="four columns u-pull-left">
						<p class="left">Contratante:</p>
					</div>
					<div class="eight columns u-pull-right" style="border-bottom: 0.5px solid black;">
						<p class="center"><strong>{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</strong></p>
					</div>
				</div>
				<div class="one-third column u-pull-right">
					<div class="one-half column u-pull-left">
						<p class="left">Número Poliza:</p>
					</div>
					<div class="one-half column u-pull-right" style="border-bottom: 0.5px solid black;">
						<p class="center"><strong>{{$folio}}</strong></p>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<div class="twelve columns" style="border-bottom: 0.5px solid black; margin-top: 5px"></div>
					<p class="center">Lugar y Fecha</p>
				</div>
				<div class="one-half column u-pull-right">
					<div class="twelve columns" style="border-bottom: 0.5px solid black; margin-top: 5px"></div>
					<p class="center">Nombre y Firma del solicitante</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>