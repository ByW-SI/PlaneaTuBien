<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<style type="text/css">
		ul,li,p{
			font-size: 13px;
			text-align:justify;
		}
		table, td, th {  
		  border: 1px solid #ddd;
		  text-align: center;
		  font-size: 13px;
		}

		table {
		  border-collapse: collapse;
		  width: 100%;
		  margin-left: 20px;
		  margin-right: 40px;
		}
	</style>
	<title>Manual del consumidor</title>
</head>
<body>
	<div class="container">
		{{-- LOGOTIPO --}}
		<div class="row">
			<div class="twelve columns">
				<div class="u-pull-right">
					<img src="img/logo.png" width="250">
				</div>
			</div>
		</div>
		{{-- TITULO --}}
		<div class="row">
			<div class="twelve columns">
				<div class="u-pull-right">
					<p style="color: orange;">MANUAL DEL CONSUMIDOR</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p style="text-align: justify;">
					Gracias por elegirnos en esta importante decisión de tu vida; en Planea Tú Bien ® estamos comprometidos con la transparencia; a continuación te presentamos un resumen de los puntos más importantes que debes saber sobre nuestra empresa.
				</p>
				<label style="text-align: left;"><strong>¿QUIÉN ES PLANEA TU BIEN?</strong></label>
				<p style="text-align: justify;">
					Planea Tú Bien S.A. DE C.V. es una empresa autorizada por la Secretaría de Economía bajo el Reglamento de Sistemas de Comercialización publicado en el diario oficial el 10 de marzo del 2006; esto nos obliga a cumplir reglas más estrictas en beneficio de nuestros clientes. Nuestros socios fundadores cuentan con más de 10 años de experiencia en la industria del autofinanciamiento y de la banca en nuestro país.
				</p>
				<label style="text-align: left"><strong>CACTERÍSTICAS DEL SISTEMA</strong></label>
				<p style="text-align:justify">
					Planea Tú Bien ® te ofrece autofinanciamiento inmobiliario el cual está autorizado por la Secretaría de Economía. El autofinanciamiento es un esquema colectivo en donde un grupo de personas aporta mensualmente una cantidad de dinero para la obtención del bien inmueble de tu elección. El bien lo obtienes en un periodo máximo de 180 meses. La adjudicación de bienes se realiza de manera mensual por alguno de los métodos establecidos en el contrato de adhesión (Puntuación, Subasta, Secuencial o Liquidación Directa).
				</p>
				<p style="text-align:justify">
					Los eventos se realizan ante fedatario público y es ahí donde se decide quién o quienes podrán obtener su propiedad. Los eventos se realizaran el tercer jueves de cada mes a las 9:00 am en nuestras oficinas. En caso de que el tercer jueves fuera inhábil, el evento se realizará el día habil inmediato anterior. Para participar en los eventos únicamente necesitas estar al corriente en tus pagos; para poder participar en las subastas necesitas tener por lo menos 4 meses de antigüedad en el sistemas y tener por lo menos 180 puntos. Para participar en el método secuencial necesitas tener 720 puntos el mes inmediato anterior al evento de adjudicación.
				</p>
				<p style="text-align:justify">
					Para tener la mayor probabilidad de salir adjudicado, lo más importante es acumular la mayor cantidad de puntos: cada aportación de recursos al grupo te da puntos, la mayor cantidad de puntos la obtienes al ser puntual en tus pagos. Si adelantas mensualidades generas los puntos máximos por cada mes adelantado, <strong>el salir adjudicado por lo tanto depende en gran parte de tu esfuerzo.</strong>
				</p>
				<p style="text-align:justify">
					El monto por contrato séra de entre $300,000 y $500,000 pesos.
				</p>
				<label style="text-align: left"><strong>COSTOS DEL SISTEMA</strong></label>
				<p style="text-align:justify">
					Planea Tú Bien ® te ofrece uno de los mejores esquemas para obtener el bien inmueble de tu preferencia, ya que a diferencia de los esquemas tradicionales de financiamiento no te cobre una tasa de interés; eso no quiere decir que no haya costos asociados por participar en nuestro sistema.
				</p>
			</div>
		</div>
		<div class="row" style="margin-left: 12px; margin-right: 12px; position: fixed;left: 0;bottom: 0;width: 100%;">
			<div class="twelve columns">
				<div class="seven columns u-pull-left">
					<div class="four columns u-pull-left">
						<p style="margin-bottom: 1.5rem; font-size: 13px;">Nombre del cliente:</p>
					</div>
					<div class="eight columns u-pull-right">
						<label style="text-align:center;">{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</label>
						<div style="border-bottom: 0.5px solid #B8242B; top:20px; width: 100%;"></div>
					</div>
				</div>
				<div class="five columns u-pull-right">
					<div class="two columns u-pull-left">
						<p style="margin-bottom: 1.5rem; font-size: 13px;" >Firma:</p>
					</div>
					<div class="ten columns u-pull-right">
						<br>
						<div style="border-bottom: 0.5px solid #B8242B; top:20px; width: 100%;"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="page-break"></div>
		{{-- LOGOTIPO --}}
		<div class="row">
			<div class="twelve columns">
				<div class="u-pull-right">
					<img src="img/logo.png" width="250">
				</div>
			</div>
		</div>

		<br>
		{{-- TABLA --}}
		<div class="row">
			<table class="u-full-width">
				<tbody>
					<tr>
						<th>Cuota de inscripción:</th>
						<td>{{$plan->inscripcion}}%</td>
						<td>Una sola vez al inicio</td>
					</tr>
					<tr>
						<th>Cuota de administración:</th>
						<td>{{$plan->cuota_admon}}%</td>
						<td>Mes a mes en tu mensualidad</td>
					</tr>
					<tr>
						<th>Prima de Seguro de vida Incapacidad Permanente Total e Invalidez:</th>
						<td> {{$plan->s_v}}%</td>
						<td>Mes a mes en tu mensualidad</td>
					</tr>
					<tr>
						<th>Cuota por adjudicación:</th>
						<td>2.5% (más IVA)</td>
						<td>Una sola vez al adjudicarte</td>
					</tr>
					<tr>
						<th>Prima de seguro de daños del bien:</th>
						<td>{{$plan->s_d}}%</td>
						<td>Mes a mes en tu mensualidad una vez asignada tu propiedad</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="twelve columns">
				<p>
					Estos porcentajes se aplican con respecto al Precio de Adjudicación Indexado (Precio del bien contratado actualizado semestralmente de acuerdo al factor de actialización).
				</p>
				<p>
					Hay otros costos inherentes a la compra de cualquier bien como gastos de escrituración, avalúos, etc.
				</p>
				<label><strong>SEGUROS</strong></label>
				<p>Para asegurar que tu o tus beneficiarios puedan adquirir el bien elegido, hemos contratado un Seguro de Vida, Incapacidad Permanente Total e invalidez que te protege en caso de incapacidad total o parcial permanete, o fallecimiento.</p>
				<p>
					Es importante señalar que:
				</p>
				<ul>
					<li>
						La cobertura del seguro sólo aplica cuando estés al corriente en tus mensualidades incluyendo el pago mensual de la prima del seguro, y 
					</li>
					<li>
						Que no hay periodo de gracia al momento del vencimiento de la póliza, es decir que el seguro sólo estará vigente si estás al corriente en tus pagos.
					</li>
				</ul>
				<label><strong>ACTUALIZACIÓN DEL MONTO CONTRATADO</strong></label>
				<p>
					Para que puedas comprar la propiedad de tu elección al momento de tu adjudicación, la mensualidad irá aumentando cada seis meses al factor de actualización.
				</p>
				<label><strong>OTROS PUNTOS IMPORTANTES QUE DEBES SABER</strong></label>
				<p>
					Este manual es de carácter informativo y solo pretende ilustrar de la manera más clara posible los puntos importantes sobre el sistema que contrataste con nosotros; sin embargo te recomendamos que leas el contrato de adhesión, que es el documento que te permite pertenecer a un grupo de consumidores dentro de nuestra empresa, la idea principal es que todos los participantes del grupo firmen el mismo tipo de documento para asegurarnos que todos los participantes reciban su propiedad.
				</p>
				<p>
					Si tienes alguna duda consulta tu contrato de adhesión y nuestro portal de internet <a href="http://www.planeatubien.com"> www.planeatubien.com</a> o ponte en contacto con un asesor quien con gusto te atenderá.
				</p>
			</div>
		</div>
		<div class="row" style="margin-left: 12px; margin-right: 12px; position: fixed;left: 0;bottom: 0;width: 100%;">
			<div class="twelve columns">
				<div class="seven columns u-pull-left">
					<div class="four columns u-pull-left">
						<p style="margin-bottom: 1.5rem; font-size: 13px;">Nombre del cliente:</p>
					</div>
					<div class="eight columns u-pull-right">
						<label style="text-align:center;">{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</label>
						<div style="border-bottom: 0.5px solid orange; top:20px; width: 100%;"></div>
					</div>
				</div>
				<div class="five columns u-pull-right">
					<div class="two columns u-pull-left">
						<p style="margin-bottom: 1.5rem; font-size: 13px;" >Firma:</p>
					</div>
					<div class="ten columns u-pull-right">
						<br>
						<div style="border-bottom: 0.5px solid #B8242B; top:20px; width: 100%;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>