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
		<div class="row">
			<div class="twelve columns">
				<div class="two-thirds column u-pull-left">
					<p style="text-align: center;"><strong>CONTRATO DE ADHESIÓN</strong></p>
					<p style="text-align: center;"><strong>PLANEA TU BIEN S.A. DE C.V.</strong></p>
					<p style="text-align: center;"><strong>Paseo de la Reforma 2608-1704, Col. Lomas altas C.P. 11950 Delegación Miguel Hidalgo</strong></p>
					<p style="text-align: center;"><strong>Mexico, CDMX.</strong></p>
					<p style="text-align: center;"><strong>TEL. 2167-2559  R.F.C. PTB091030MS1  WWW.PLANEATUBIEN.COM.MX</strong></p>
					<p style="text-align: center;"><strong>AUTORIZACIÓN SECRETARIA DE ECONOMÍA OFICIO No. 410.10/0239 - 410.4.18/048</strong></p>
					<p style="text-align: center;"><strong>REGLAMENTO 10/marzo/2006 REGISTRO PROFECO No. 7023-2010</strong></p>
				</div>
				<div class="one-third column u-pull-right" style="border: 1px solid black;">
					<div class="row">
						<div class="one-half column u-pull-left">
							<p class="justify">FOLIO</p>
							<p class="justify">No. de Grupo</p>
							<p class="justify">No. de Contrato</p>
							<p class="justify">No. de Consumidor</p>
							<p class="justify">Fecha y Hora</p>
						</div>
						<div class="one-half column u-pull-right">
							<p style="border-bottom: 1px solid black">{{$presolicitud->folio}}</p>
							<p style="border-bottom: 1px solid black">{{$presolicitud->id}}</p>
							<p style="border-bottom: 1px solid black">{{$presolicitud->recibos->count()}}</p>
							<p style="border-bottom: 1px solid black">{{$presolicitud->perfil->prospecto->id}}</p>
							<p style="border-bottom: 1px solid black">{{date('d-m-Y H:m')}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="border: 1px solid black;">
			<div class="row">
				<div class="twelve columns"  style="border: 1px solid black;">
					<p class="center"><strong>PARTES DEL CONTRATO</strong></p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<p class="justify">
						CONTRATO DE ADHESIÓN PARA LA PRESTACIÓN DE SERVICIOS DE ADMINISTRACIÓN DE UN SISTEMA DE COMERCIALIZACIÓN CONSISTENTE EN LA INTEGRACIÓN DE GRUPOS DE CONSUMIDORES QUE APORTAN PERIÓDICAMENTE SUMAS DE DINERO PARA LA ADQUISICIÓN DE BIENES INMUEBLES QUE CELEBRAN POR UNA PARTE PLANEA TU BIEN S.A. DE C.V. CON LA REPRESENTACIÓN QUE SE MENCIONA EN “DECLARACIONES” A QUIEN EN LO SUCESIVO SE LE DENOMINARA <strong>“EL PROVEEDOR”</strong> Y POR LA OTRA EN SU CARÁCTER DE CONSUMIDOR A LA PERSONA SEÑALADA A CONTINUACIÓN COMO EL <strong>“CONSUMIDOR”</strong>.
					</p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns"  style="border: 1px solid black;">
					<p class="center"><strong>EL CONSUMIDOR</strong></p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="two-thirds column u-pull-left">
						<div class="two columns u-pull-left">
							<p class="justify">NOMBRE(S):</p>
						</div>
						<div class="ten columns u-pull-right">
							<p class="center" style="border-bottom: 1px solid black">
								{{$presolicitud->paterno." ".$presolicitud->materno." ".$presolicitud->nombre}}
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="two-thirds column u-pull-left">
						<div class="two columns u-pull-left">
							<p class="justify">DOMICILIO:</p>
						</div>
						<div class="ten columns u-pull-right">
							<p class="center" style="border-bottom: 1px solid black">
								{{$presolicitud->calle." #".$presolicitud->numero_ext." interior:".$presolicitud->numero_int}}
							</p>
						</div>
					</div>
					<div class="one-third column u-pull-right">
						<div class="three columns u-pull-left">
							<p class="justify">COLONIA:</p>
						</div>
						<div class="nine columns u-pull-right">
							<p class="center" style="border-bottom: 1px solid black">
								{{$presolicitud->colonia}}
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="two-thirds column u-pull-left">
						<div class="one-half column u-pull-left">
							<div class="two columns u-pull-left">
								<p class="justify">CIUDAD:</p>
							</div>
							<div class="ten columns u-pull-right">
								<p class="center" style="border-bottom: 0.5px solid black">
									{{$presolicitud->municipio}}
								</p>
							</div>
						</div>
						<div class="one-half column u-pull-right">
							<div class="two columns u-pull-left">
								<p class="justify">ESTADO:</p>
							</div>
							<div class="ten columns u-pull-right">
								<p class="center" style="border-bottom: 0.5px solid black">
									{{$presolicitud->estado}}
								</p>
							</div>
						</div>
						
					</div>
					<div class="one-third column u-pull-right">
						<div class="three columns u-pull-left">
							<p class="justify">C.P.:</p>
						</div>
						<div class="nine columns u-pull-right">
							<p class="center" style="border-bottom: 0.5px solid black">
								{{$presolicitud->cp}}
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="two-thirds column u-pull-left">
						<div class="two columns u-pull-left">
							<p>TELÉFONO:</p>
						</div>
						<div class="ten columns u-pull-right">
							<p class="center" style="border-bottom: 1px solid black">
								{{$presolicitud->tel_casa}}
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns"  style="border: 1px solid black;">
					<p class="center"><strong>SEGURO</strong></p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<p class="justify">
						AUTORIZO AL “PROVEEDOR”  A CONTRATAR UN SEGURO DE VIDA, INCAPACIDAD PERMANENTE TOTAL E INVALIDEZ POR EL EQUIVALENTE AL SALDO INSOLUTO DE LA OPERACIÓN Y NOMBRO BENEFICIARIO (S) DEL MISMO A: ______________________________________________________.
					</p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns"  style="border: 1px solid black;">
					<p class="center"><strong>BIEN INMUEBLE CONTRATADO</strong></p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<p class="justify">
						BIEN INMUEBLE LOCALIZADO EN LA C.D. DE: <span style="border-bottom:1px solid black">{{$prospecto->perfil->inmueble_pretendido->estado}}</span>
					</p>
					<p class="justify">
						A.- NÚMERO DE CONSUMIDORES: <span style="border-bottom:1px solid black">{{$presolicitud->folio}}</span> (NO MAS DE 500)
					</p>
					<p class="justify">
						B.- VIGENCIA DEL GRUPO: <span style="border-bottom: 1px solid black;">180 meses</span>
					</p>
					<p class="justify">
						C.- VIGENCIA DEL PLAN <span style="border-bottom: 0.5px solid black;">{{$prospecto->perfil->cotizacion->plazo}}</span> MESES (EQUIVALENTE A IGUAL NUMERO DE CUOTAS PERIÓDICAS)
					</p>
					<p class="justify">
						D.- PRECIO INICIAL DEL BIEN: <span style="border-bottom: 0.5px solid black;">${{number_format($prospecto->perfil->cotizacion->propiedad,2)}}</span> MONEDA NACIONAL ($300,000, $350,000, $400,000, $450,000 Y $500,000) 
					</p>
					<p class="justify">
						E.- FECHA LÍMITE DEL PAGO MENSUAL: <strong>DÍA SIETE DE CADA MES (EN CASO DE SER INHÁBIL SE PAGARA EL HÁBIL INMEDIATO POSTERIOR)</strong>
					</p>
					<p class="justify">
						F.- NÚMERO DE PUNTOS: 
					</p>
					<p class="justify" style="margin-left: 30px;">
						I. (PAGANDO HASTA EL DÍA 7 DE CADA MES O EL HÁBIL INMEDIATO POSTERIOR) 1800 PUNTOS DIVIDIDOS ENTRE LA VIGENCIA DEL PLAN
					</p>
					<p class="justify" style="margin-left: 30px;">
						II.  (PAGANDO ENTRE EL 8 Y EL ULTIMO DÍA HÁBIL DEL MES)1440 PUNTOS DIVIDIDOS ENTRE LA VIGENCIA DEL PLAN 
					</p>
					<p class="justify" style="margin-left: 30px;">
						III. (PAGANDO DESPUÉS DEL ULTIMO DÍA HÁBIL DEL MES)1080 PUNTOS DIVIDIDOS ENTRE LA VIGENCIA DEL PLAN
					</p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns"  style="border: 1px solid black;">
					<p class="center"><strong>CUOTA DE INSCRIPCIÓN Y APORTACIONES</strong></p>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<p class="justify">
						1.- CUOTA DE INSCRIPCIÓN: <strong style="border-bottom: 0.5px solid black;">2.00%</strong> <strong style="border-bottom: 0.5px solid black;">${{number_format($prospecto->perfil->cotizacion->propiedad*0.02,2)}}</strong>
					</p>
					<p class="justify">
						2.- IMPUESTO DE LA CUOTA DE INSCRIPCIÓN (I.V.A.): <strong style="border-bottom: 0.5px solid black;">${{number_format(($prospecto->perfil->cotizacion->propiedad*0.02)*0.16,2)}}</strong>
					</p>
					<p class="justify"><strong>
						CUOTA PERIÓDICA TOTAL (SERA DE MANERA MENSUAL) 
					</strong></p>
					<p class="justify">
						3.- APORTACIÓN PERIÓDICA AL FONDO DEL GRUPO (MENSUAL D/C): <strong style="border-bottom: 0.5px solid black;">${{number_format($prospecto->perfil->cotizacion->propiedad/$prospecto->perfil->cotizacion->plazo,2)}}</strong>
					</p>
					<p class="justify">
						4.- CUOTA DE ADMINISTRACIÓN: <strong style="border-bottom: 0.5px solid black;">0.20%</strong> <strong style="border-bottom: 0.5px solid black;">${{number_format($prospecto->perfil->cotizacion->propiedad*0.002,2)}}</strong>
					</p>
					<p class="justify">
						5.- I.V.A. DE GASTOS DE ADMINISTRACIÓN: <strong style="border-bottom: 0.5px solid black;">${{number_format(($prospecto->perfil->cotizacion->propiedad*0.002)*0.16,2)}}</strong>
					</p>
					<p class="justify">
						6.- PAGO MENSUAL DE SEGURO DE VIDA, INCAPACIDAD PERMANENTE TOTAL E INVALIDEZ:  <strong style="border-bottom: 0.5px solid black;">0.06%</strong> <strong style="border-bottom: 0.5px solid black;">${{number_format($prospecto->perfil->cotizacion->propiedad*0.0006,2)}}</strong>
					</p>
					<p class="justify">
						7.- APORTACIONES A FONDO DE CONTINGENCIA: <strong style="border-bottom: 0.5px solid black;">0.00</strong> (2% de la Aportación Periódica al Fondo del Grupo para adjudicatarios y 4% de la Aportación Periódica al Fondo del Grupo para Adjudicados)
					</p>
					<p class="justify">
						IMPORTE PRIMERA CUOTA PERIÓDICA TOTAL: 
						<strong style="border-bottom: 0.5px solid black;">
							${{number_format($prospecto->perfil->cotizacion->propiedad/$prospecto->perfil->cotizacion->plazo+($prospecto->perfil->cotizacion->propiedad*0.002)+(($prospecto->perfil->cotizacion->propiedad*0.002)*0.16)+($prospecto->perfil->cotizacion->propiedad*0.0006),2)}}
						</strong>
					</p>
					<p class="justify">
						SUMA DE INSCRIPCIÓN Y CUOTA: 
						<strong style="border-bottom: 0.5px solid black;">
							${{number_format(($prospecto->perfil->cotizacion->propiedad*0.02)+(($prospecto->perfil->cotizacion->propiedad*0.02)*0.16)+($prospecto->perfil->cotizacion->propiedad/$prospecto->perfil->cotizacion->plazo+($prospecto->perfil->cotizacion->propiedad*0.002)+(($prospecto->perfil->cotizacion->propiedad*0.002)*0.16)+($prospecto->perfil->cotizacion->propiedad*0.0006)),2)}}
						</strong>
					</p>
					<p class="justify">
						FACTOR DE ACTUALIZACIÓN INICIAL.- <strong style="border-bottom: 0.5px solid black;">3.00%</strong> (EL PRECIO INICIAL DEL BIEN INMUEBLE SERA AJUSTADO CADA 6 MESES POR LO MENOS CONFORME AL INCREMENTO EN EL ÍNDICE NACIONAL DE PRECIOS AL CONSUMIDOR QUE SEÑALE EL BANCO DE MÉXICO EL SEMESTRE INMEDIATO ANTERIOR A LA FIRMA DE ESTE CONTRATO, O CUALQUIER OTRO QUE PARA EL EFECTO DETERMINE LA AUTORIDAD CORRESPONDIENTE, ESTE INCREMENTO LO PAGARAN TODOS LOS INTEGRANTES ADJUDICATARIOS,  NO ADJUDICATARIOS Y ADJUDICADOS,  DESDE EL PRIMER MES HASTA EL TERMINO DEL CONTRATO DE ADHESIÓN, ÉSTE SERA NOTIFICADO EN LA PÁGINA DE INTERNET DEL PROVEEDOR)
					</p>
					<p class="justify">
						LAS REUNIONES DE ADJUDICACIÓN SE LLEVARAN A CABO EL TERCER JUEVES DE CADA MES Y SI NO FUERA HÁBIL EL DÍA HÁBIL INMEDIATO ANTERIOR.

					</p>
				</div>
			</div>
		</div>
		<div class="page-break"></div>
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
		<div class="row">
			<div class="twelve columns">
				<p>
					<strong>CAPITULO I</strong>
				</p>
				<p><strong>DECLARACIONES MANIFIESTA EL PROVEEDOR:</strong></p>
				<p class="justify">
					<strong>1.-</strong>Ser una sociedad mercantil debidamente constituida según la escritura pública número 32849 de fecha 29 de octubre de 2009, protocolizada ante la fe del titular de la notaria publica No. 215 del Distrito Federal Licenciado Uriel Oliva Sánchez con domicilio en Horacio No. 703 colonia Polanco, e inscrita en el del registro público de la propiedad y del comercio con el folio mercantil No. 409346 del día 12 de enero del 2010.
				</p>
				<p class="justify">
					<strong>2.- </strong>Que el Sistema de Comercialización denominado “Planea tu Bien” que promueve, está de acuerdo con los artículos 63 al 63 QUINTUS de la Ley y de acuerdo al Reglamento, publicado el 10 de marzo del 2006. El modelo de este Contrato de Adhesión está registrado en la Procuraduría con el número señalado en la carátula de éste Contrato de Adhesión.
				</p>
				<p class="justify">
					<strong>3.- </strong>QUE SU REGISTRO FEDERAL DE CONTRIBUYENTES CORRESPONDE AL NÚMERO PTB091030MS1 y que sus representantes legales: Leonel Cortes Aburto y Guillermo Reyes Varela Velázquez cuentan individualmente con las facultades suficientes para celebrar el presente Contrato de Adhesión de acuerdo a la escritura pública número 32,849 pasada ante la fe del Notario Público número 215, del Distrito Federal, Lic. Uriel Oliva Sánchez, el día 29 de octubre del 2009, e inscrita en el del registro público de la propiedad y del comercio con el folio mercantil No. 409346 del día 12 de enero de 2010.
				</p>
				<p class="justify">
					<strong>4.-</strong> Que el artículo 59 del Reglamento establece la obligación para el “Proveedor” de proporcionar a la Secretaría, a la Procuraduría y al tercero especialista o auditor externo la información  de los Grupos que le requieran, pudiéndose solicitar que la proporcione por medios electrónicos, en cumplimiento de sus facultades. 
				</p>
				<p class="justify"><strong>DECLARA EL CONSUMIDOR:</strong></p>
				<p class="justify">
					<strong>1.-</strong> Que es su decisión integrarse al Sistema de Comercialización denominado “Planea tu Bien”, que promueve Planea tu Bien S.A. de C.V. el cual le ha sido explicado y ha recibido el Manual del Consumidor que contiene las bases de su funcionamiento. 
				</p>
				<p class="justify">
					<strong>2.- </strong>Que ha leído y comprendido el presente Contrato de Adhesión y se le ha explicado y comprendido el alcance legal del mismo manifestando su aprobación expresamente con su firma.
				</p>
				<p class="justify">
					<strong>3.- </strong>Que está enterado de la obligación del “Proveedor” de proporcionar información de los Grupos de acuerdo a lo establecido en el artículo 59 del Reglamento, tal como se señala en la Declaración número 4 del Proveedor, y acepta que la información relacionada con el Grupo correspondiente se proporcione en los términos señalados. 
				</p>
				<p class="justify"><strong>CAPITULO II</strong></p>
				<p class="justify"><strong>DEFINICIONES</strong></p>
				<p class="justify">Para efectos de este Contrato de Adhesión se entenderá por: </p>
				<p class="justify">
					<strong>1.- Adjudicación</strong>, Al acto periódico mediante el cual se determina a cuál o cuáles Integrantes del Grupo de que se trate o, en su caso, sus beneficiarios, que se encuentren al corriente en el pago de sus cuotas periódicas totales, corresponde el derecho de recibir el bien contratado, mediante la aplicación de los procedimientos previstos en el Contrato de Adhesión;
				</p>
				<p class="justify">
					<strong>2.- Aportación Extraordinaria al Fondo del Grupo</strong>, Al monto en dinero que, en su caso, debe pagar el Consumidor en una fecha determinada en el Contrato de Adhesión, por concepto del pago parcial del precio del bien contratado, en adición a las aportaciones periódicas al Fondo del Grupo; 
				</p>
				<p class="justify">
					<strong>3.- Asignación</strong>, Al acto mediante el cual el Consumidor o, en su caso, su beneficiario, recibe el bien objeto del Contrato de Adhesión; 
				</p>
				<p class="justify">
					<strong>4.- Consumidor</strong>, A la persona física o moral, en términos de la Ley, que contrata un Sistema de Comercialización y que, partir de la contratación y conforme al Contrato de Adhesión, el Consumidor puede asumir las calidades de; 
					<ul>
						<li><strong>a. Solicitante</strong>, Es la calidad que adquiere el Consumidor, desde que firma el Contrato de Adhesión con el Proveedor, hasta que sea integrado a un Grupo de Consumidores y que por ello, sólo está obligado al pago de la Cuota de Inscripción y de la primer Cuota Periódica Total en los términos del propio Contrato de Adhesión; </li>
						<li>
							<strong>b. Integrante</strong>, Es la calidad que adquiere el Consumidor, a partir de que el Proveedor lo incorpora a un Grupo de Consumidores y hasta que asume la calidad de adjudicatario; 
						</li>
						<li>
							<strong>c. Adjudicatario</strong>, Es la calidad que adquiere el Consumidor o, en su caso, su beneficiario, desde que sea exigible su derecho a recibir el bien, hasta antes de la Asignación del bien, o 
						</li>
						<li>
							<strong>d. Adjudicado</strong>, Es la calidad que adquiere el Consumidor o, en su caso, su beneficiario, a partir de la Asignación del bien. 
						</li>
					</ul>
				</p>
				<p class="justify">
					<strong>5.- Contrato de Adhesión</strong>, Al documento elaborado en términos de la Ley, de manera unilateral por el Proveedor, en el que se establecen en formatos uniformes los términos y condiciones aplicables al Sistema de Comercialización de que se trate, y se estipulan los derechos y obligaciones del Proveedor y del Consumidor. 
				</p>
				<p class="justify">
					<strong>6.- Cuota de Inscripción</strong>, Al monto en dinero que debe pagar el Consumidor a la firma del Contrato de Adhesión como contraprestación por los diversos actos de administración que debe realizar el Proveedor con motivo del ingreso del Consumidor al Sistema de Comercialización. 
				</p>
			</div>
		</div>
		<div class="page-break"></div>
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
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>7.- Cuota Periódica Total</strong>, Al monto total en dinero que conforme al Contrato de Adhesión debe pagar el Consumidor al Proveedor, periódicamente durante la vigencia del Contrato de Adhesión, y que consiste en la sumatoria del importe de los siguientes conceptos: 
					<ul>
						<li>
							<strong>a. Aportación Periódica al Fondo del Grupo</strong>, Al monto en dinero que debe pagar el Consumidor a cuenta del precio del bien contratado, incorporado al Fondo del Grupo de que se trate. 
						</li>
						<li>
							<strong>b. Aportación Periódica al Fondo de Contingencia</strong>, Al monto en dinero que, en su caso, debe aportar el Consumidor en las fechas que se determine para integrar el Fondo de Contingencia. 
						</li>
						<li>
							<strong>c. Cuota de Administración</strong>, Al monto en dinero que debe pagar el Consumidor en las fechas que se determinen en el Contrato de Adhesión como contraprestación por los diversos actos que debe realizar el Proveedor para la organización, administración y consecución de los fines del Sistema de Comercialización. 
						</li>
						<li>
							<strong>d. Costo del Seguro de Daños</strong>, Al monto en dinero que, en su caso, debe pagar el Consumidor por conducto del Proveedor en las fechas que se determinen en el Contrato de Adhesión para cubrir el costo del Seguro y Daños del bien. 
						</li>
						<li>
							<strong>e. Costo del Seguro de Vida</strong>, Incapacidad Permanente Total e Invalidez, Al monto en dinero que debe pagar el Consumidor por conducto del Proveedor en las fechas que se determinen en el Contrato de Adhesión, y que debe pagar el Consumidor por conducto del Proveedor para cubrir el costo del seguro de vida, incapacidad permanente total e invalidez.
						</li>
						<li>
							<strong>f.  Las contribuciones que se generen por los conceptos señalados en los incisos anteriores. </strong>
						</li>
					</ul>
				</p>
				<p class="justify">
					<strong>8.- Cuota por Cesión de la Titularidad del Contrato</strong>, Al monto en dinero que debe pagar el Consumidor, como contraprestación por los diversos actos de administración que debe realizar el Proveedor con motivo de la cesión de los derechos del Contrato de Adhesión; 
				</p>
				<p class="justify">
					<strong>9.- Cuota por Sustitución Voluntaria del Bien</strong>, Al monto en dinero que debe pagar el Consumidor, como contraprestación por los diversos actos de administración que debe realizar el Proveedor con motivo de la sustitución voluntaria del bien; 
				</p>
				<p class="justify">
					<strong>10.- Factor de Actualización</strong>, Al coeficiente numérico que se utiliza para actualizar el monto de cada Aportación Periódica al Fondo del Grupo; 
				</p>
				<p class="justify">
					<strong>11.- Fondo del Grupo</strong>, A las cantidades pagadas por los Consumidores del Grupo de que se trate, para adquirir los bienes contratados por tales Consumidores, representadas por las aportaciones periódicas y las aportaciones extraordinarias adicionadas, en su caso, con las Penas por Cancelación del Contrato de Adhesión, las penas por rescisión del Contrato de Adhesión y las penas por incumplimiento de subasta, por causas imputables a los Consumidores, más las cantidades relativas a la recuperación de adeudos, anteriores a la liquidación del grupo; 
				</p>
				<p class="justify">
					<strong>12.- Fondo de Contingencia</strong>, Es aquél constituido opcionalmente por las aportaciones periódicas de los Consumidores para efectos de cubrir, en su caso, insuficiencias de recursos del Fondo del Grupo de que se trate; 
				</p>
				<p class="justify">
					<strong>13.- Grupo, Al conjunto de Consumidores</strong>, establecido en el Contrato de Adhesión, y cuyas aportaciones periódicas y extraordinarias son la principal base para determinar el tiempo y la forma de la Asignación de los bienes en favor de los propios Consumidores; 
				</p>
				<p class="justify">
					<strong>14.- Intereses Moratorios</strong>, Al monto en dinero que debe pagar el Consumidor al Proveedor conforme al sistema que se determine en el Contrato de Adhesión, por concepto de mora en los pagos que está obligado a realizar en términos del propio Contrato de Adhesión; 
				</p>
				<p class="justify">
					<strong>15.- Ley</strong>, A la Ley Federal de Protección al Consumidor; 
				</p>
				<p class="justify">
					<strong>16.- Manual del Consumidor</strong>, Al documento informativo elaborado por el Proveedor para dar a conocer al Consumidor las características y bases de funcionamiento del Sistema de Comercialización de que se trate; 
				</p>
				<p class="justify">
					<strong>17.- Pena por Cancelación del Contrato de Adhesión</strong>, Al monto en dinero que, en su caso, y conforme al Contrato de Adhesión, debe pagar el Consumidor de que se trate en la fecha de la cancelación del Contrato de Adhesión correspondiente; 
				</p>
				<p class="justify">
					<strong>18.- Pena por Rescisión del Contrato de Adhesión</strong>, Al monto en dinero que, en su caso, debe pagar el Consumidor o el Proveedor, de conformidad con el Contrato de Adhesión, como pena por la rescisión de dicho contrato; 
				</p>
				<p class="justify"><strong>19.- Pena por incumplimiento de subasta</strong>, Al monto en dinero que, en su caso y conforme al Contrato de Adhesión, debe pagar el Consumidor de que se trate en la fecha que señale el propio Contrato de Adhesión por no realizar el pago del número de cuotas periódicas totales que haya ofrecido para asumir la calidad de Adjudicatario; </p>
				<p class="justify">
					<strong>20.- Procuraduría</strong>, A la Procuraduría Federal del Consumidor; 
				</p>
				<p class="justify"><strong>21.- Proveedor</strong>, A la persona moral que cuenta con autorización de la Secretaría para operar o administrar el Sistema de Comercialización de que se trate, y con la cual el Consumidor celebra el Contrato de Adhesión; </p>
				<p class="justify">
					<strong>22.- Suministrador</strong>, A la persona física o moral que enajena al Adjudicatario el inmueble; 
				</p>
			</div>
		</div>
		<div class="page-break"></div>
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
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>23.- Reglamento</strong>, Al Reglamento de Sistemas de Comercialización Consistentes en la Integración de Grupos de Consumidores; 
				</p>
				<p class="justify"><strong>24.- Remanente del Fondo del Grupo</strong>, Al monto en dinero correspondiente al Grupo de que se trate, si lo hubiere, disponible en la cuenta bancaria a que se refiere el artículo 39 fracción I del Reglamento de Sistemas de Comercialización Consistentes en la Integración de Grupos de Consumidores, una vez que la totalidad de los Consumidores Adjudicados del propio grupo haya sido asignada y que se hayan liquidado los bienes objeto de tales asignaciones y reintegrado las aportaciones ordinarias y extraordinarias al Fondo del Grupo, a los Consumidores que hubiesen rescindido o cancelado su Contrato de Adhesión; </p>
				<p class="justify">
					<strong>25.- Remanente del Fondo de Contingencia</strong>, Al monto en dinero correspondiente al Grupo de que se trate, si lo hubiere, disponible en la cuenta bancaria a que se refiere el artículo 39 fracción I del Reglamento de Sistemas de Comercialización Consistentes en la Integración de Grupos de Consumidores, una vez que la totalidad de los Consumidores asuman la calidad de Adjudicados y que se hayan liquidado los bienes asignados y, en su caso, se hayan reintegrado las aportaciones periódicas al Fondo de Contingencia, y a los Consumidores que hubiesen rescindido o cancelado su Contrato de Adhesión; 
				</p>
				<p class="justify"><strong>26.- Secretaría</strong>, A la Secretaría de Economía; </p>
				<p class="justify"><strong>27.- Sistema de Comercialización</strong>, Al esquema consistente en la integración de grupos de Consumidores que aportan periódicamente sumas de dinero para ser administradas por el Proveedor, para efectos de adquisición de bienes determinados o determinables, como inmuebles destinados a la habitación, o a uso como locales comerciales; </p>
				<p class="justify"><strong>28.- Valor histórico de las aportaciones del Consumidor</strong>, A la sumatoria de las aportaciones periódicas y extraordinarias al Fondo del Grupo y, en su caso, de las aportaciones periódicas al Fondo de Contingencia, pagadas por el Consumidor en términos nominales; </p>
				<p class="justify"><strong>29.- Valor presente de las aportaciones del Consumidor</strong>, A la sumatoria de las multiplicaciones de los números de aportaciones periódicas y extraordinarias del Fondo del Grupo, y aportaciones periódicas al Fondo de Contingencia pagadas por el Consumidor, por el valor de las respectivas aportaciones que en términos del Contrato de Adhesión se encuentre vigente, y </p>
				<p class="justify"><strong>30.- Valor presente de las aportaciones del Proveedor</strong>, Al resultado de multiplicar el número de bienes pagados por el Proveedor con recursos de su patrimonio para asegurar la adjudicación mínima e incrementar el número de Adjudicaciones de bienes, por el valor actual del bien, a la fecha de restitución de los recursos.</p>
				<p class="justify"><strong>31.- Bienes Inmuebles</strong>, A los terrenos y construcciones terminadas, con uso del suelo destinada a casa habitación o como local comercial, nuevos o usados, con una vida útil remanente mayor al periodo de vigencia del Contrato de Adhesión y que cuenten con los permisos necesarios para tales fines; </p>
				<p class="justify"><strong>32.- Precio de Adjudicación Indexado (PAI)</strong>, al precio inicial del bien inmueble contratado que se actualiza semestralmente, de acuerdo con las variaciones que tenga el Índice Nacional de Precios al Consumidor determinado por el Banco de México o por el índice que lo sustituya; </p>
				<p class="justify"><strong>33.- Subasta</strong>, Al procedimiento para adjudicar un bien al Integrante que ofrezca en su grupo, el pago adelantado del mayor número de cuotas periódicas totales que sumadas a las ya pagadas sea mayor que los demás Consumidores, menos el importe correspondiente al Seguro de Vida, Incapacidad Permanente Total e Invalidez;</p>
				<p class="justify"><strong>34.- Adjudicación por Antigüedad o Permanencia</strong>, Al procedimiento para determinar Adjudicatario en función de la antigüedad del Contrato de Adhesión del Consumidor, respecto de la antigüedad de los contratos de adhesión de los demás Consumidores del Grupo de que se trate;</p>
				<p class="justify"><strong>35.- Adjudicación por Liquidación (directa)</strong>, Al procedimiento cuando se liquide al Proveedor el total de la operación contratada, que se presenta cuando se hace efectivo el derecho del Integrante del grupo o de sus beneficiarios de recibir el bien contratado, cuando el Consumidor, durante la vigencia del Contrato de Adhesión sufre de incapacidad e invalidez permanentes totales o fallece. Así como cuando se liquide al Proveedor, por cualquier otro medio, el valor total de la operación contratada;</p>
				<p class="justify"><strong>36.- Plazo Contratado</strong>.- Al número de meses contratados por el Consumidor, que no puede ser mayor que los señalados en la carátula de este Contrato de Adhesión en “vigencia del plan” y </p>
				<p class="justify"><strong>37.- Valor Histórico Promedio de la Aportaciones del Consumidor</strong>.- A la cantidad que resulta de dividir el monto del valor histórico entre el número de aportaciones pagadas.</p>
				<p class="justify"><strong>CLÁUSULAS</strong></p>
				<p class="justify"><strong>CAPITULO III</strong></p>
				<p class="justify"><strong>FORMACIÓN DE GRUPOS</strong></p>
				<p class="justify">
					<strong>III.01.- Constitución del grupo</strong>.- El grupo que es cerrado, con un número no mayor a 500 Consumidores y con una vigencia de 15 años, se considerará constituido cuando el Proveedor haya integrado al mismo el número de Consumidores que se estipula en la carátula de éste Contrato de Adhesión con la vigencia del plan ahí señalada y cuando los Integrantes hayan realizado su primer pago de la  Cuota Periódica Total. Los Contratos de Adhesión podrán ser de los valores marcados en la carátula del presente contrato. La persona interesada podrá suscribir su Contrato de Adhesión  ante cualquier representante autorizado por el Proveedor, que le extenderá un recibo oficial foliado que incluya su Cuota de Inscripción y el primer pago de la Cuota Periódica Total. 
				</p>
				<p class="justify">
					<strong>III.02.- Primer reunión</strong>.- El Integrante participará en la primera reunión de adjudicación de su grupo dentro de los 120 días naturales siguientes a la fecha de este Contrato de Adhesión. En caso de incumplimiento el Consumidor podrá rescindir el Contrato de Adhesión y solicitar que el Proveedor le devuelva dentro de los 30 días naturales siguientes a la notificación, el valor presente de todos los pagos realizados por el Consumidor, incluida la Cuota de Inscripción si la hubiere.
				</p>
			</div>
		</div>
		<div class="page-break"></div>
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
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>III.03.- Reemplazos</strong>.- El Proveedor podrá cubrir las vacantes   de aquellos Consumidores no Adjudicados que cause baja por cancelación o rescisión durante la vigencia del grupo, el nuevo Integrante deberá cubrir la Cuota de Inscripción vigente y las cuotas totales devengadas a valor presente, o prorratear su importe entre las cuotas periódicas totales que estén pendientes de pago hasta la terminación de la vigencia del grupo. 
				</p>
				<p class="justify">
					<strong>CAPITULO IV</strong>
				</p>
				<p class="justify">
					<strong>APORTACIONES Y CUOTAS</strong>
				</p>
				<p class="justify">
					<strong>IV.01.- APORTACIÓN PERIÓDICA AL FONDO DEL GRUPO</strong>.- Para determinar la Aportación que será mensual, se dividirá el precio vigente del PAI entre el plazo de la operación contratado. El valor de la Aportación se irá ajustando semestralmente a partir de la primera reunión de adjudicación, de acuerdo a las variaciones de los seis meses anteriores que tenga el Índice Nacional de Precio al Consumidor  que publique el Banco de México o el Índice que lo sustituya cuando el Consumidor resulte Adjudicado su Aportación mensual se irá ajustando hasta completar el último pago del bien contratado. 
				</p>
				<p class="justify">
					El Consumidor debe pagar la Cuota de Inscripción para integrarse al grupo descrita en “definiciones”, y así mismo se obliga a pagar durante el numero de meses contratados, los conceptos que integran la Cuota Periódica Total, señalados en la carátula de este Contrato de Adhesión y descritas en “definiciones” que son: la Cuota de Administración, Costo del Seguro de Vida, Incapacidad Permanente Total e Invalidez, Costo del  Seguro de Daños y Aportación Periódica al Fondo de Contingencia y las contribuciones que se generen por los conceptos señalados anteriormente. El porcentaje de incremento que se aplique el PAI se hará en la misma proporción a los demás conceptos que componen la Cuota Periódica  Total. 
				</p>
				<p class="justify">
					<strong>IV.02.- PAGOS ANTICIPADOS</strong>.- En caso de que el Consumidor o Adjudicatario decida pagar por anticipado Cuotas Periódicas  Totales, deberá cubrirlos al valor presente y serán aplicadas a los últimos vencimientos en sentido inverso. Todos los pagos anticipados causan cuotas de administración inclusive en el caso de subastas y Aportaciones Periódicas Totales anticipadas. 
				</p>
				<p class="justify">
					<strong>IV.03.-DUDAS DEL SISTEMA DE COMERCIALIZACIÓN</strong>.- El Proveedor deberá mantener un domicilio, teléfono, fax y dirección de correo electrónico en los que recibirá para su atención las dudas y comentarios que tengan los Consumidores respecto del funcionamiento y operación del Sistema de Comercialización y estará obligado a atender dichas dudas y comentarios en un plazo no mayor a 5 días hábiles posteriores a la fecha en que reciba, a través del medio de comunicación que señale el Contrato de Adhesión. Todas las notificaciones entre las partes deberán hacerse por escrito y realizarse en los domicilios que la misma señale en el Contrato de Adhesión o aquel que en forma indubitable se haya comunicado. 
				</p>
				<p class="justify">
					<strong>IV.04.-RENDIMIENTOS FINANCIEROS POR MANEJO DE APORTACIONES Y REMANENTES</strong>.- Cualquier rendimiento financiero por el manejo de aportaciones y remanentes será integrado al Fondo del Grupo. 
				</p>
				<p class="justify">
					<strong>CAPUTLO V</strong>
				</p>
				<p class="justify">
					<strong>FECHA, LUGAR Y FORMA DE PAGO</strong>
				</p>
				<p class="justify"><strong>V.01.- Vencimiento</strong>.- Las fechas de vencimiento de las Cuotas Periódicas Totales es el día 7 de cada mes, por lo que los pagos realizados después del vencimiento, no serán puntuales.  En caso que el día de vencimiento fuera inhábil, los depósitos deberán realizarse el día hábil inmediato posterior para ser considerados como puntuales.</p>
				<p class="justify">
					<strong>V.02.- Lugar y forma de pago</strong>.- El pago de las cuotas periódicas totales deberá efectuarse directamente por el Consumidor dentro de los plazos establecidos en la cuenta bancaria No. 0170611654  abierta en BBVA Bancomer a nombre de Planea Tu Bien S.A. de C.V..  La primer  Cuota Periódica Total podrá pagarse directamente al Proveedor y éste deberá depositarla a la cuenta bancaria correspondiente, dentro de los cinco días hábiles siguientes a aquél en que se haga el pago.  El Proveedor deberá expedir los estados de cuenta y las fichas impresas correspondientes por cada pago, mismos que le serán enviados al Consumidor con un mínimo de 10 días naturales a la fecha límite de pago puntual.  El Consumidor podrá optar por recogerlos del Proveedor,  o bien, imprimirlos directamente desde el portal de la empresa (www.planeatubien.com.mx). El Consumidor deberá verificar que su recibo de pago sea sellado e impreso por la caja registradora, lo que dará validez a su pago. Todos los pagos serán en moneda nacional y no se aceptarán pagos parciales. Para estos efectos, los comprobantes de los pagos debidamente requisitados ante la Institución Bancaria se tendrán como recibo y serán reconocidos por el Proveedor.  El Proveedor enviará al domicilio del Consumidor estados de cuenta cuando menos con una periodicidad trimestral, salvo que el cliente lo requiera con periodicidad mensual. El Consumidor tendrá la opción de consultar todos sus estados de cuenta a través del portal de internet www.planeatubien.com
				</p>
				<p class="justify">
					<strong>V.03.- Identificación del pago</strong>.- Cada pago será identificado mediante el numero de Contrato de Adhesión, grupo al que pertenece y tipo de pago. En caso de que el primer pago de la Cuota Periódica Total sea realizado con cheque, éste deberá expedirse a favor del Proveedor con la leyenda “NO NEGOCIABLE” y señalar en el reverso el número de Contrato de Adhesión, en caso de que no sea cubierto por el Banco girado, por causas imputables al Consumidor, este pago se considerará como no efectuado. El Proveedor no se responsabiliza de los pagos señaladas en los propios recibos de pago y que no reúnen los requisitos señalados en este Contrato de Adhesión.  Todos los cargos que el banco realice a la cuenta del Proveedor por causas imputables al Consumidor serán pagados por el Consumidor. 
				</p>
				<p class="justify">
					<strong>V.04.- Fecha de pago de la cuota Periódica  Total y recargos por mora</strong>.- La fecha de vencimiento de la cuota Periódica Total es la estipulada en la cláusula V.01, de no efectuarse en esa fecha se cobrará un recargo por mora a una tasa del 3 % mensual más I.V.A. sobre el o los pagos vencidos. 
				</p>
			</div>
		</div>
		<div class="page-break"></div>
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
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>CAPITULO VI</strong>
				</p>
				<p class="justify"><strong>CESIONES, RENUNCIAS, CANCELACIONES, RESCISIONES Y SANCIONES</strong></p>
				<p class="justify"><strong>VI.01.-Cesión de Titularidad del Contrato</strong>.- El Integrante no Adjudicatario que esté al corriente en el pago de sus Cuotas Periódicas Totales, podrá ceder los derechos y obligaciones del presente Contrato de Adhesión, debiendo el cesionario cubrir la Cuota de Inscripción que se encuentre en vigor al momento de la cesión. El Proveedor comunicará dentro de los 10 días naturales a la fecha de presentación del cesionario su aceptación o rechazo, de no hacerlo, se tendrá por realizada la cesión. En todos los casos deberán vencer en la misma fecha y el plazo de liquidación  de los Contratos de Adhesión no se modificará. </p>
				<p class="justify">
					<strong>VI.02.-Renuncia</strong>.- El Consumidor podrá, mediante escrito, cancelar este Contrato de Adhesión dentro de los 5 días hábiles siguientes a la contratación, sin responsabilidad alguna.  En este caso, el Proveedor debe devolverle, dentro, de los 25 días naturales siguientes a la notificación, el importe integro de los pagos realizados. Salvo que dentro de ese período el Consumidor participe en una reunión de adjudicación. A Partir del sexto día no se podrá renunciar a este contrato y se considerara cancelación de acuerdo al inciso siguiente (VI.03.) 
				</p>
				<p class="justify">
					<strong>VI.03.-Cancelación</strong>.- El Integrante no Adjudicado podrá cancelar anticipadamente este Contrato de Adhesión. En este caso, el Proveedor le devolverá, en un plazo máximo de 60 días naturales siguientes a la notificación, el monto total de las Aportaciones Periódicas al Fondo del Grupo, pagadas por el Consumidor a Valor histórico de las aportaciones del Consumidor, menos la Pena por Cancelación del Contrato de Adhesión, que es equivalente al importe de tres aportaciones mensuales a Valor Histórico Promedio de las Aportaciones del Consumidor, mismas que se integraran al Fondo del Grupo correspondiente. 
				</p>
				<p class="justify"><strong>VI.04.-Rescisión</strong>.- El Proveedor podrá rescindir este Contrato de Adhesión, por la falta de pago de dos Cuotas Periódicas Totales en su conjunto, por parte del Consumidor. En este caso, el Proveedor le devolverá, en un plazo máximo de 60 días naturales siguientes a la notificación, el monto total de las Aportaciones Periódicas al Fondo del Grupo pagadas por el Consumidor, a Valor histórico de las aportaciones del Consumidor, menos la Pena por Rescisión del Contrato de Adhesión equivalente al importe de tres aportaciones mensuales a Valor Histórico Promedio de las Aportaciones del Consumidor, la cual será restituida al grupo.</p>
				<p class="justify">
					<strong>VI.05.-En caso de falta de pago de dos Cuotas Periódicas Totales de los Consumidores Adjudicatarios o Adjudicados, el Proveedor podrá optar por cualquiera de las siguientes dos alternativas: </strong>
					<ul>
						<li>
							<strong>a.-</strong> Dar por rescindido el presente Contrato de Adhesión, con todas sus consecuencias legales y por tanto ejercitar las acciones necesarias para este fin, respetando la cláusula anterior. 
						</li>
						<li>
							<strong>b.-</strong> Dar por vencido de inmediato el total de las Cuotas Periódicas Totales adeudadas por el Adjudicatario o Adjudicado y ejercitar la acción cambiaria directa en contra de éste y de su aval a fin de lograr el pago del adeudo, haciendo valer las garantías que hayan sido otorgadas por el Adjudicado y su aval.
						</li>
					</ul>
				</p>
				<p class="justify">
					<strong>VI.06.-Casos en que debe pagarse interés moratorio</strong>.- Cuando se cancele o rescinda este Contrato de Adhesión y el Proveedor no devuelva el dinero al Consumidor dentro de los plazos previstos para cada caso, el Proveedor deberá pagarle al Consumidor un interés moratorio calculado sobre la cantidad a devolver sobre el número de días que transcurran entre la fecha en que debió devolverse el dinero y la fecha en que se realice el pago. Dicho interés será el mismo que aplique el Proveedor en el período por mora en el pago de las Cuotas Periódicas Totales del Consumidor Adjudicado, establecido en la cláusula V.04 de este Contrato de Adhesión.
				</p>
				<p class="justify">
					En los casos de sustitución por rescisión y por cancelación, los nuevos Integrantes del grupo correspondiente deberán cubrir las aportaciones, cuotas y costos, que a la fecha de su integración deberán estar pagados, a fin de no variar los plazos de vencimiento y liquidación del grupo. No se permitirá la incorporación de nuevos Consumidores en sustitución de aquellos que ya hubieren concluido su participación en el grupo correspondiente. Está prohibida la transferencia de miembros de un grupo a otro y la combinación, en el mismo grupo, de bienes de distinta naturaleza. 
				</p>
				<p class="justify">
					<strong>CAPITULO VII</strong>
				</p>
				<p class="justify"><strong>SEGUROS</strong></p>
				<p class="justify">
					<strong>VII.01.- Seguro de Vida</strong>, Incapacidad Permanente Total e Invalidez.- El Proveedor contratará por cuenta y a nombre del Consumidor, cuando éste sea una persona física, un Seguro de Vida, Incapacidad Permanente Total e Invalidez, de conformidad con la legislación aplicable, que cubra las cuotas periódicas totales con vencimiento posterior a que ocurrió el siniestro; se entregara al cliente copia de la póliza correspondiente. El importe a pagar mensualmente por este concepto será el valor del PAI multiplicado por el porcentaje del Seguro de Vida, Incapacidad Permanente Total e Invalidez definido en la caratula. 
				</p>
				<p class="justify">
					El Seguro de Vida, Incapacidad Permanente Total e Invalidez debe estar vigente a más tardar, a partir de la fecha del primer acto de adjudicación en que participe el Consumidor y hasta la conclusión del plazo contratado o hasta que se finiquite la operación, lo que ocurra primero. En caso de que el Consumidor sufra de incapacidad e invalidez permanentes totales o fallezca durante la vigencia de este Contrato de Adhesión se estará en lo siguiente: 
					
				</p>
				<p class="justify">
					<strong>a.-</strong> Surtirá efecto la adjudicación por liquidación (directa) a favor del Integrante o de sus beneficiarios, señalados en este Contrato de Adhesión. 
				</p>
				<p class="justify">
					<strong>b.-</strong> Se liquidarán cuando menos las cuotas  periódicas totales con vencimiento posterior a la fecha en que el Adjudicatario o Adjudicado sufra de incapacidad e invalidez permanentes totales o fallezca. 
				</p>
				
			</div>
		</div>
		<div class="page-break"></div>
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
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>c.- </strong>Si el Proveedor omite contratar este Seguro de Vida, Incapacidad Permanente Total e Invalidez, sin causa justificada, deberá cumplir con lo dispuesto en lo descrito en los dos párrafos anteriores, sin que pueda repercutir el costo de su omisión en el Fondo del Grupo. En el caso de que la institución aseguradora no autorice la contratación del Seguro de Vida, Incapacidad Permanente Total e Invalidez, el proveedor devolverá al titular o a su beneficiario la totalidad de los recursos aportados al grupo. En caso de siniestro, el Proveedor  asistirá al Consumidor o beneficiario en su reclamación: de no proceder, el Proveedor le devolverá al Consumidor no Adjudicado, o beneficiario las aportaciones realizadas al Fondo del Grupo, y en su caso, al Fondo de Contingencia, a Valor histórico de las Aportaciones del Consumidor, sin que se aplique pena alguna, lo anterior, solo en el caso de que en la Cuota Periódica Total que haya pagado el Consumidor, se encuentre incluido el costo del Seguro de Vida, Incapacidad Permanente Total e Invalidez.
				</p>
				<p class="justify">		
					<strong>d. </strong>Lo anterior no aplicará cuando en términos de la legislación en materia de seguros no procede la reclamación del siniestro. En caso de que “El Consumidor” se atrase parcial o totalmente en el pago de su cuota Periódica  Total, se suspenderá su protección de Seguro de Vida, Incapacidad Permanente Total e Invalidez y se reiniciará al ponerse al corriente. Si falleciera se incapacita e invalida en forma permanente y total estando atrasado parcial o totalmente en sus pagos mensuales totales, por ningún motivo tendrá derecho él o su beneficiario designado al beneficio correspondiente.
				</p>
				<p class="justify">
					<strong>VII.02.- Seguro del bien</strong>.- Para la entrega física o legal del bien objeto de este Contrato de Adhesión, el Consumidor deberá contar con un seguro contra los daños del mismo, con vigencia o prórroga obligatoria para todo el periodo en que se adeude parte del precio, o hasta cuando venza la última Cuota Periódica Total, lo que ocurra primero y cuyo destino sea cubrir las cuotas periódicas totales posteriores a la fecha en que se verifique el siniestro.
				</p>
				<p class="justify">
					Para tal propósito, cuando el Consumidor resulte Adjudicatario, el Proveedor le ofrecerá 3 opciones distintas, a tarifas competitivas que reflejen las condiciones del mercado, y contratará el seguro de daños, a nombre y por cuenta del Consumidor, con la Institución de Seguros que éste elija previamente y por escrito, en cuyo caso, el Proveedor puede incorporar las parcialidades del importe de dicho seguro a las cuotas periódicas totales. Una vez aceptada la póliza por parte de la aseguradora se le informa al cliente para que inicie el trámite de escrituración.  En caso de no ser aceptada la póliza la empresa solicitará a otra compañía de seguros el alta del bien y de no ser aceptada se le dará una última oportunidad que el cliente realice el trámite de manera individual y de no ser aceptada se le restituirá el dinero aportado hasta el momento a valor histórico. 
				</p>
				<p class="justify">
					El Consumidor deberá autorizar al Proveedor para que contrate a su nombre, tanto el seguro inicial como las prórrogas. Se entiende que otorga dicho consentimiento con la firma de este Contrato de Adhesión. 
				</p>
				<p class="justify">
					Si el Adjudicatario se atrasa total o parcialmente en el  pago del cargo por el seguro de daños o de su cuota Periódica Total, se suspenderá la protección del seguro contra daños y se reiniciará al ponerse al corriente, si el siniestro ocurriera estando atrasado en sus pagos, por ningún motivo tendrá derecho al beneficio correspondiente.
				</p>
				<p class="justify">
					<strong>CAPITULO VIII</strong>
				</p>
				<p class="justify">
					<strong>ADJUDICACIONES</strong>
				</p>
				<p class="justify">
					<strong>VIII.01.- Actos de adjudicación</strong>.- El Proveedor celebrará mensualmente un acto de adjudicación a fin de determinar quiénes de los Consumidores de cada grupo obtienen el derecho de adjudicarse su bien mediante los procedimientos de puntuación, subasta, secuencial, por adjudicación por liquidación (directa). La adjudicación se celebrará solo entre los Consumidores que se encuentren al corriente en el pago de sus Cuotas Periódicas Totales a la fecha límite estipulada en este Contrato de Adhesión. 
				</p>
				<p class="justify">
					<strong>VIII.02.- Lugar y fecha</strong>.- El Proveedor notificará a todos los Consumidores  del grupo el lugar y fecha del acto de adjudicación a través de un calendario anual, mismo que será renovable a su vencimiento. El evento de adjudicación se celebrará con la participación de un Fedatario Público para dar fe de hechos, y un representante del Proveedor. 
				</p>
				<p class="justify">
					<strong>VIII.03.- Procedimiento de adjudicación</strong>.- En cada acto de adjudicación, el Proveedor debe de adjudicar, cuando menos  un bien objeto del Sistema de Comercialización. Dicha adjudicación mínima  debe realizarse por procedimientos distintos a la adjudicación por liquidación (directa) y Subasta. Cuando los recursos del grupo no sean suficientes, el Proveedor debe aportar el capital necesario  para realizar la adjudicación mínima, y esa cantidad le será restituida a valor presente, de las cuotas periódicas totales que paguen los Consumidores en el periodo siguiente, siempre y cuando existan recursos  suficientes, una vez que se realice la adjudicación mínima correspondiente. Los procedimientos de adjudicación en los que Participa, Orden y Requisitos serán: 
				</p>
				<p class="justify"><strong>a. Puntuación</strong>.- Se designará por lo menos un  “Adjudicatario” y será el “Consumidor” que haya acumulado mayor puntuación por Cuotas Periódicas Totales pagadas, normales y/o anticipadas. Para lograr una mayor puntuación se  pueden ir adelantando pagos, los cuales se aplican a los últimos en sentido inverso, con lo que además se acorta el plazo pactado. Para la Asignación de puntos se tomara como base de criterio establecido en la Carátula del Contrato de Adhesión. No hay requisitos de puntos mínimos ni de permanencia en el Sistema de Comercialización. Si dos o más Integrantes resultan empatados mediante los procedimientos aplicables, la adjudicación se asignará al que tenga mayor antigüedad en el grupo, entiéndase por fecha y hora que ingresa al Sistema de Comercialización.</p>
				<p class="justify">			
					<strong>b. Subasta</strong>.- De haber dinero en el Fondo del Grupo, se celebrará una Subasta por grupo, y podrán participar todos los Consumidores del grupo que tengan antigüedad de 4 meses en el Sistema de Comercialización y tengan 180 puntos ó más, al mes inmediato anterior al evento de adjudicación, que se encuentren al corriente en sus Cuotas Periódicas Totales, y que no sean Adjudicatarios ni Adjudicados. . Para la Asignación de puntos se tomara como base de criterio el establecido en la Carátula del Contrato de Adhesión.  
				</p>
				<p class="justify">
					Pueden ofrecer en sobre cerrado pagar por adelantado las Cuotas Periódicas Totales que deseen, y será asignado “Adjudicatario” el “Consumidor” que, con los puntos que obtenga con su ofrecimiento de Subasta y la puntuación obtenida con anterioridad, acumule una mayor puntuación.
				</p>
				<p class="justify">
					Cada participante hará su oferta inicial utilizando el formato que para tal efecto le proporcionará el Proveedor, asimismo éste aceptará ofertas de Integrantes que no se encuentren presentes, pero que previamente hayan entregado su formato acompañado de una carta poder y el importe de su oferta, la cual deberá ser aprobada por el Fedatario Público que se encuentre presente en el Evento de Adjudicación. 
				</p>
			</div>
		</div>
		<div class="page-break"></div>
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
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					Si por cualquier evento posterior no  queda liquidada la Subasta en 72 horas a partir del momento en que ofreció, o se renuncia a la misma, el Consumidor se hará acreedor a la Pena por Incumplimiento de Subasta equivalente a tres aportaciones mensuales a valor presente. 
				</p>
				<p class="justify">
					Las Cuotas Periódicas Totales que se cobran por adelantado en el caso de ser Adjudicado por el procedimiento de subasta, no podrán ser objeto de incremento alguno y se aplicarán al pago de las últimas mensualidades siguiendo un orden inverso. La determinación de las subastas más altas será constatada mediante fe de hechos de un Fedatario Público.
				</p>
				<p class="justify">
					<strong>c. Secuencial</strong>.- El procedimiento consiste en adjudicar un bien al Consumidor  que se encuentren al corriente en el pago de sus cuotas periódicas totales y  tengan  720 puntos, al mes inmediato anterior al evento de adjudicación. Se adjudicaran tantos como el Fondo del Grupo lo permita. Para la asignación de puntos se tomara como base de criterio establecido en la Carátula del Contrato de Adhesión, ocuparán un lugar de adjudicación, conforme vayan cumpliendo con los requisitos. El Consumidor debe esperar la adjudicación pagando puntualmente cada mes la Cuota Periódica Total, en caso de no hacerlo perderá su lugar y al ponerse al corriente tomará uno nuevo.
				</p>
				<p class="justify">
					<strong>d. Adjudicación por liquidación (directa)</strong>.-  Cuando el Consumidor durante la vigencia de este Contrato de Adhesión, y estando al corriente en el pago de sus cuotas periódicas totales o fallece, se hace efectivo para el Integrante del grupo o su beneficiario, el derecho de recibir el bien contratado, mediante los procedimientos previstos en este Contrato de Adhesión, así como cuando se liquide al Proveedor, por cualquier otro medio, el valor total de la operación contratada. 
				</p>
				<p class="justify">
					Cuando queda dinero suficiente en el Fondo del Grupo después de la adjudicación por puntuación, subasta y secuencial, se hacen subastas adicionales. Si dos o más Integrantes resultan empatados mediante los procedimientos aplicables, la adjudicación se asignará al que tenga mayor antigüedad en el grupo, entiéndase por fecha y hora que ingresa al Sistema de Comercialización. 
				</p>
				<p class="justify">
					<strong>VIII.04.- Rechazo a la adjudicación</strong>.- El Consumidor Adjudicado podrá rechazar la adjudicación del bien contratado por escrito, dentro de los 5 días hábiles siguientes a la notificación, en el caso de no tener indicación alguna dentro de dicho plazo se tendrá por aceptada dicha adjudicación. 
				</p>
				<p class="justify"><strong>VIII.05.- Comunicación</strong>.- El Proveedor deberá difundir dentro de los 10 días naturales siguientes en que se hayan llevado a cabo los actos de adjudicación, por lo menos en un periódico de mayor circulación local, la información relativa a las Adjudicaciones señalando cuando menos número de grupo, nombre y número de los Adjudicatarios, el procedimiento de adjudicación, en orden secuencial del sorteo realizado, y el lugar y fecha de los tres actos de adjudicación subsecuentes.</p>
				<p class="justify"><strong>CAPITULO IX </strong></p>
				<p class="justify"><strong>ENTREGA DE BIENES</strong></p>
				<p class="justify">
					<strong>IX.01.- Aplicación de los recursos</strong>.-  Los Recursos únicamente podrán ser aplicados a la adquisición de bienes inmuebles. Esta aplicación se podrá efectuar únicamente dentro de la ciudad señalada en la carátula de este Contrato de Adhesión. Los retiros que ordene Planea Tu Bien S.A. de C.V. con cargo al Fondo del Grupo y al fondo de contingencia se  destinarán a cubrir los gastos generados por las adjudicaciones y devoluciones y cumplir, cuando menos los siguientes requisitos: 
					<ul>
						<li>
							1. Tener firma mancomunada de: contador o contralor o director general de la empresa; y de uno de los funcionarios con nivel jerárquico inmediato inferior al director general; 
						</li>
						<li>
							2. Ser nominativos, y 
						</li>
						<li>
							3. Poder liquidarse sólo mediante abono a una cuenta bancaria de depósito aperturada a nombre del suministrador; del proveedor.  En los casos contemplados en el artículo 48 del Reglamento de Sistemas de Comercialización Consistentes en la Integración de Grupo de consumidores; o de los consumidores, en los casos de devolución o liquidación de grupos, excepto cuando el consumidor requiera por escrito que se le expida cheque nominativo no negociable. En el caso de inmuebles, al momento de escriturar, se entregara al suministrador cheque para abono en cuenta. 
						</li>
					</ul>
				</p>
				<p class="justify">
					Cualquier rendimiento financiero por el manejo de aportaciones y remanentes será integrado al Fondo del Grupo. 
				</p>
				<p class="justify">
					Se entregara al suministrador cheque para abono en cuenta contra la entrega de copia certificada del testimonio notarial de la hipoteca o garantía fiduciaria, así como el aviso preventivo al Registro Público de la Propiedad. El Proveedor no podrá entregar directa o indirectamente, recursos líquidos al Consumidor con motivo de la adjudicación y Asignación. 
				</p>
				<p class="justify">
					El adjudicatario podrá elegir el bien inmueble que desea adquirir contando para ello con un plazo de 90 días posteriores a la fecha de la adjudicación, de no hacerlo se estará sujeto a lo dispuesto a la cláusula VIII.04. Cuando el bien inmueble tenga un valor diferente al valor actualizado del Contrato de Adhesión,  se estará a lo siguiente: Si el valor es mayor al contratado la diferencia será a cargo del Consumidor, si el valor es menor la diferencia se aplicará a pagos anticipados de acuerdo a la cláusula IV.02. 
				</p>
				<p class="justify">
					<strong>IX.02.- Gastos e impuestos</strong>.-  Los impuestos, gastos, avalúos, honorarios notariales, que se causen al aplicar los recursos a algún inmueble, los liquidará el adjudicatario en la notaria asignada por el Proveedor donde se efectúe el contrato de garantía hipotecaria o fiduciaria, en el momento de la firma los que se deducirán del monto adjudicable. 
				</p>
				<p class="justify"><strong>IX.03.- Derecho de adjudicación</strong>.- Por concepto de derecho de adjudicación, Planea Tu Bien S.A. de C.V. cobrará al adjudicatario el  2.5 % del PAI Adjudicado más el respectivo I.V.A., cantidad que se retendrá al adjudicatario.</p>
				<p class="justify">
					<strong>IX.04.- Entrega de Bienes</strong>.- Cuando el Consumidor sea adjudicatario, el Proveedor le entregará el inmueble contratado, dentro de los 30 días naturales posteriores al cumplimiento de las garantías y requisitos señalados en este Contrato de Adhesión. De no cumplirse lo anterior, por causas imputables al Proveedor, el Consumidor puede optar por:
				</p>
			</div>
		</div>
		<div class="page-break"></div>
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
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>a</strong>. Esperar tanto tiempo como sea necesario, en cuyo caso el Proveedor se obliga a absorber los incrementos en el precio del bien contratado y a pagar al adjudicatario el importe de tres aportaciones periódicas, a Valor Histórico Promedio equivalente a las Aportaciones del Consumidor. 
				</p>
				<p class="justify">
					En este caso, el adjudicatario puede solicitar al Proveedor que adquiera el bien contratado con otro Suministrador que lo tenga disponible. De obtenerse algún descuento en esta transacción, de manera que el importe a pagar sea inferior al precio actualizado del bien contratado, el Proveedor aplicará la diferencia al pago de las cuotas periódicas totales que adeude al adjudicatario. 
				</p>
				<p class="justify">
					<strong>b</strong>. Rescindir este Contrato de Adhesión, obligándose el Proveedor a devolver al Consumidor, dentro de los diez días naturales posteriores a la notificación, el valor presente del total de los pagos realizados por el Consumidor, incluida la Cuota de Inscripción, si la hubiere, más el importe de tres aportaciones periódicas, a Valor Histórico Promedio equivalente a las Aportaciones del Consumidor.
				</p>
				<p class="justify">
					<strong>c</strong>. En el caso que el Consumidor elija el Suministrador del bien contratado y la entrega no se realice por causas imputables al Proveedor, éste se obligará a pagar al adjudicatario, como pena convencional el importe de tres aportaciones periódicas, a Valor Histórico Promedio equivalente a las Aportaciones del Consumidor, dentro de los diez días naturales siguientes a la fecha en que debió integrarse el bien.
				</p>
				<p class="justify">
					<strong>IX.05.- El Proveedor no será responsable de la demora en la entrega del bien contratado en los siguientes casos.- </strong>
				</p>
				<p class="justify">
					<strong>a</strong>. Cuando el Consumidor no elija el bien por causas que le sean imputables. 
				</p>
				<p class="justify">
					<strong>b</strong>. Cuando el Consumidor elija un bien que previo avalúo no garantice suficientemente el patrimonio del grupo. 
				</p>
				<p class="justify">
					<strong>c</strong>. Cuando no se presenten los documentos necesarios para realizar la operación y su inscripción en el Registro Público de la Propiedad. 
				</p>
				<p class="justify">
					<strong>d</strong>. Cuando el Consumidor adjudicatario no esté al corriente en sus pagos mensuales. 
				</p>
				<p class="justify">
					<strong>e</strong>. Por no liquidar los pagos a que se refiere la cláusula IX.08. 
				</p>
				<p class="justify">
					<strong>f</strong>. Caso fortuito o de fuerza mayor debidamente comprobado. 
				</p>
				<p class="justify">
					<strong>IX.06.- Garantía y requisitos de la adjudicación</strong>.- Con el fin de mantener las garantías suficientes para todos los Consumidores durante todo el período del adeudo, se establece la obligación de otorgar previamente garantía hipotecaria o fiduciaria en primer lugar a favor del Proveedor, a elección de éste, sobre cada inmueble en el que se invertirán los recursos adjudicados. El valor del avalúo de los inmuebles que se ofrecen en garantía, deberá ser  como mínimo igual al valor total del o los Contratos de Adhesión que deban garantizar. 
				</p>
				<p class="justify">
					En el caso de que el o los inmuebles que se ofrecen en garantía, no garanticen el  saldo insoluto, se solicitará adicionalmente que la operación esté avalada por una persona propietaria única de un inmueble libre de gravamen, cuyo valor sea como mínimo similar al saldo pendiente de liquidar. El aval se otorgará ante el Notario Público designado por el Proveedor para grabar la propiedad y proceder a su registro obligándose al Consumidor a cubrir los gastos que esto ocasione. Para formalizar las garantías el Consumidor deberá de entregar la siguiente documentación: Escritura del inmueble o la del aval en su caso y certificados de libertad de gravámenes. El Proveedor a solicitud del Consumidor podrá tramitar los certificados de libertad de gravamen de los inmuebles.
				</p>
				<p class="justify">
					El adjudicatario y el aval deberán además firmar el reconocimiento del adeudo, y un pagaré por el total del adeudo pendiente y por las renovaciones del seguro contra daños. Dicho pagaré le será devuelto al finiquito del Contrato de Adhesión correspondiente. En caso de hacerse efectiva la garantía, las aportaciones periódicas recuperadas serán afectadas directamente al patrimonio del Fondo del Grupo. 
				</p>
				<p class="justify">
					<strong>IX.07.- Peritos valuadores</strong>.-  En todos los casos, el bien inmueble a adquirir, deben de ser evaluados por un perito autorizado por el Comité de Crédito del Proveedor y los citados avalúos deben de tener menos de dos meses de antigüedad.
				</p>
				<p class="justify">
					<strong>IX.08.- Pagos por adjudicación</strong>.- El Consumidor tiene la obligación de cubrir, previo a la entrega de los recursos los siguientes conceptos: 
				</p>
				<p class="justify">
					<strong>a</strong>.  Cualquier diferencia en contra del Consumidor por actualización de los conceptos desglosados en su cuota Periódica  Total y recargos por mora si es el caso. 
				</p>
				<p class="justify">
					<strong>b</strong>. Diferencia en el precio del PAI Adjudicado y el bien elegido, incluidos los gastos que se originen ante Notario, impuestos, registros, avalúos, etc. 
				</p>
				<p class="justify">
					<strong>c</strong>. El equivalente al 2.5 % más el I.V.A. del PAI Adjudicado por concepto de derecho de la adjudicación. 
				</p>
				<p class="justify">
					<strong>d</strong>. La parte proporcional del Seguro de daños en general. 
				</p>
				<p class="justify"><strong>CAPITULO XI</strong></p>
				<p class="justify"><strong>LIQUIDACIÓN DEL GRUPO</strong></p>
				<p class="justify">
					<strong>XI.01.- Liquidación</strong>. La liquidación del grupo que se realizara dentro de los 60 días naturales siguientes a la terminación de la vigencia del grupo mencionado en la carátula del presente contrato, y se determinará  si existe un Remanente en el  Fondo del Grupo a repartir, el cual se integrará exclusivamente con la suma de las aportaciones mensuales pagadas por los Adjudicados del grupo, restando el valor de los Contratos de Adhesión que se les hayan Adjudicado y los gastos correspondientes. Si el saldo es positivo, el 50% se aplicará entre los Adjudicados que pagaron todas las cuotas periódicas totales contratadas, en proporción directa a las que fueron pagadas puntualmente en los términos establecidos en el Contrato de Adhesión, y el 50% restante le corresponderá al Proveedor. Realizada la liquidación del grupo, la distribución  de Remanente en el  Fondo del Grupo si lo hubiera, se realizará dentro de los 60 días naturales siguientes a la liquidación. Así mismo, el Proveedor deberá distribuir dentro de los 60 días naturales siguientes a la liquidación del grupo, el total de Remanente del Fondo de Contingencia, si lo hubiere, incluyendo los productos que haya generado entre los Adjudicados que pagaron todas las cuotas periódicas totales en los términos establecidos en el Contrato de Adhesión. 
				</p>
				<p class="justify">
					<strong>XI.02.- Remanente</strong>.- El Adjudicado con derecho al reparto del Remanente en el  Fondo del Grupo, que habiendo sido notificado no se presente a cobrar su parte proporcional en un plazo de 90 días naturales a partir de la notificación, perderá su derecho y el Proveedor deberá donar el importe del reparto que le corresponda al Consumidor, a la Institución de Beneficencia: Fundación Teletón México, A.C. 
				</p>
			</div>
		</div>
		<div class="page-break"></div>
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
		<div class="row">
			<div class="twelve columns">
				<p class="justify">
					<strong>
						CAPITULO XII 
					</strong>
				</p>
				<p class="justify">
					<strong>
						DOMICILIO Y COMPETENCIA 
					</strong>
				</p>
				<p class="justify">
					<strong>XII.01.- Domicilio</strong>.- Tanto el Proveedor como el firmante del presente Contrato de Adhesión, se obligan a comunicar  de inmediato y por escrito cualquier cambio de domicilio para el efecto de oír notificaciones y recibir toda clase de documentación. De no darse aviso de cualquiera de las partes, las notificaciones que se hagan al domicilio anterior serán  válidas y sufrirán efectos legales. 
				</p>
				<p class="justify">
					El Proveedor no será responsable por la demora en notificaciones efectuadas por correo o por alteraciones en el texto de telegramas o avisos, salvo que le sean imputables. 
				</p>
				<p class="justify">
					<strong>XII.02.- Notificación</strong>.- Todas las notificaciones entre las partes deben hacerse por escrito y realizarse en los domicilios que las mismas señalen en este Contrato de Adhesión. Ambas partes se comprometen a notificarse en forma indubitable cualquier cambio posterior. 
				</p>
				<p class="justify">
					<strong>XII.03.- Competencia</strong>.- Es competencia de la Procuraduría en el ámbito administrativo para dirimir las controversias que pudieran surgir en la  interpretación o aplicación de éste Contrato de Adhesión, de conformidad en los artículos: 24 fracción XVI y 86 de la Ley.
				</p>
				<p class="justify">
					<strong>XII.04.- Jurisdicción</strong>.- Las partes se someten expresamente a la atribución de la Procuraduría en la vía administrativa y a la jurisdicción y competencia de los tribunales  de la Ciudad de México. Renunciando por tanto a todo otro fuero que en razón de su domicilio presente o futuro les pudiese corresponder.  Leído que fue el presente Contrato de Adhesión, enteradas las partes intervinientes del alcance de todas y cada una de sus cláusulas, lo firman en la ciudad de México en la fecha que aparece en la carátula. 
				</p>
				<p class="justify">
					<strong>
						En términos de la legislación aplicable, las operaciones y obligaciones derivadas de este Contrato de Adhesión  son responsabilidad exclusiva del Proveedor y de los Consumidores; y su cumplimiento, de ninguna manera, está garantizado ni respaldado económicamente por el Gobierno Federal, ni por persona de derecho público alguna, ni por las instituciones bancarias que reciben los pagos de los Consumidores.  Conforme a lo dispuesto en el Ley y Reglamento, así como lo convenido en el Contrato de Adhesión, la participación del Proveedor en el Sistema de Comercialización se limita a la administración de los recursos de los Consumidores, en los términos y condiciones establecidos en el propio Contrato de Adhesión. Por tanto, respecto a las aportaciones, cuotas y demás importes que el Consumidor se encuentra obligado a cubrir, el Proveedor tiene como obligación administrar los Sistemas de Comercialización en apego al Contrato de Adhesión. Estos Sistemas de Comercialización no constituyen mecanismo de ahorro. 
					</strong>
				</p>
				<p class="justify">
					<strong>
						Cualquier discrepancia entre el texto firmado y el registrado ante la Procuraduría, se tendrá por no puesta, sin menoscabo de las sanciones que correspondan de conformidad con las disposiciones aplicables. 
					</strong>
				</p>
				<span style="text-align: center;">
					<label>RECOMENDACIÓN AL CONSUMIDOR</label>
				</span>
				<span style="text-align: center;">
					<label>POR FAVOR ANTES DE FIRMAR ESTE CONTRATO DE ADHESIÓN LEA CUIDADOSAMENTE CADA UNO DE LOS CAPÍTULOS. </label>
				</span>
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
						<span style="font-size: 12px;">{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</span>
					</div>
					<div class="one-half column u-pull-right"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>