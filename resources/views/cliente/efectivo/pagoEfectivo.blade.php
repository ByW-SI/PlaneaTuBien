<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		{{-- <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css"> --}}
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<title>Pago en efectivo</title>
</head>
<body>
	<div class="container">
		<div style="position: absolute; left: 10%; right: 25%; top: 35%; bottom: 35%;">
			{{-- <img src="img/perfil.png"  style="opacity: 0.1;filter: alpha(opacity=10); height: 100%; width: 600px"> --}}
		</div>
		<div class="row">
			<label style="color: #B8242B; text-align: center; font-size: 15px;background: #c4c4c4">INFORMACIÓN PARA PAGO EN EFECTIVO</label>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="two columns u-pull-left">
					<img src="img/perfil.png" height="50" width="100">
				</div>
				<div class="ten columns column u-pull-right">
					<div class="two-thirds column u-pull-left">
						<label style="font-size: 10px; text-align: justify;">
							PLANEA TU BIEN, S.A. DE C.V. Jalapa 17 despacho 301 , col Roma. C.P 06700 , delegación Cuauhtemoc. Mexico D.F. TEL. 5533-2201  R.F.C. PTB091030MS1 <a href="www.planeatubien.com.mx" style="color: black">WWW.PLANEATUBIEN.COM.MX</a>
						</label>
					</div>
					<div class="one-third column u-pull-right" style="margin-top: 7px;">
						<div class="one-half column u-pull-left">
							<label style="font-size: 7px">FOLIO:</label>
							<label style="font-size: 7px">FECHA:</label>
						</div>
						<div class="one-half column u-pull-right">
							<label style="font-size: 7px; border-bottom: 0.5px solid #B8242B;text-align: center;"></label>
							<label style="font-size: 7px; border-bottom: 0.5px solid #B8242B;text-align: center;">{{date('d-m-Y')}}</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 60px">
			<div class="twelve columns" style="margin-left: 5px; margin-right: 5px; text-align: center;">
				<table class="u-full-width">
					<thead>
						<tr>
							<th>Referencia</th>
							<th>Monto</th>
							<th>Número de Contrato</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $fila)
						<tr>
							<td>{{ $fila["referencia"] }}</td>
							<td>{{ number_format($fila["monto"], 2) }}</td>
							<td>{{ $fila["num_contrato"] }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" style="margin-top: 60px;">
				<div class="four columns"></div>
				<div class="four columns u-pull-left" style="background-color: rgba(0, 0, 0, 0.16);border-radius: 10px;border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding: 0.75rem 1.25rem;">
					<p><b>Banco:</b> BBVA</p>
					<p><b>Nombre del Titular:</b> PTB</p>
					<p><b>Convenio</b></p>
					<p><b>CLABE:</b>1111222233334444</p>
				</div>
		</div>
		<div class="row" style="margin-top: 60px;font-size: 10px;">
				<div class="four columns"></div>
				<div class="five columns u-pull-left">
					<p><b>Recuerde que debe de hacer un pago por contrato.</b></p>
				</div>
		</div>
	</div>
</body>
</html>