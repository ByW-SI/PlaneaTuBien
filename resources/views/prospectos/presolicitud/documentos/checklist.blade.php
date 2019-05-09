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
			<div class="twelve columns" style="border-top: 2px solid #B8242B; margin-top: 0px;"></div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<div class="one-third column u-pull-left">
					<h4>Checklist Folder</h4>
				</div>
				<div class="two-thirds column u-pull-right">
					<div class="two columns u-pull-left">
						<label for="">Cliente:</label>
						<label for="">Contrato:</label>
						<label for="">Grupo:</label>
					</div>
					<div class="ten columns u-pull-right center">
						<label>{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</label>
						<label>{{$recibo->contrato->id}}</label>
						<label>{{$recibo->contrato->grupo->id}}</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="one-half column u-pull-left left">
				<label for="">Ficha de deposito</label>
				<label for="">Perfil</label>
				<label for="">Presolicitud firmada</label>
				<label for="">Contrato firmado</label>
				<label for="">Hoja de aceptación de seguro</label>
				<label for="">Manual del consumidor firmado</label>
				<label for="">Cuestionario de calidad</label>
				<label for="">Aviso de privacidad</label>
				<label for="">Copia de ficha del deposito</label>
				<label for="">Identificación oficial</label>
				<label for="">Comprobante de domicilio</label>
				<label for="">Croquis de ubicación</label>
				<label for="">Carta de bienvenida</label>
				<label for="">Anexos</label>
			</div>
			<div class="one-half column u-pull-right left">
				<label for=""><input type="checkbox" readonly disabled {{$checklist->ficha_deposito_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->perfil_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->presolicitud_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->contrato_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->hoja_aceptacion_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->manual_consumidor_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->calidad_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->privacidad_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->copia_ficha_deposito_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->identificacion_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->comprobante_domicilio_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->croquis_ubicacion_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->carta_bienvenida_path ? 'checked=""' : '' }}></label>
				<label for=""><input type="checkbox" readonly disabled {{$checklist->anexos_path ? 'checked=""' : '' }}></label>
			</div>
		</div>
		<div class="row" style="margin-left: 12px; margin-right: 12px; position: fixed;left: 0;bottom: 15;width: 100%;">
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
	</div>
</body>
</html>