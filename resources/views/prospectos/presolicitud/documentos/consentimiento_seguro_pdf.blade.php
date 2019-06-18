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
		  margin-left: 5px;
		  margin-right: 5px;
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
		.header-bg{
			background: #563D7C;
			color: white;
		}
	</style>
	<title>Consentimiento de seguro</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="twelve columns" style="border-top: 2px solid #B8242B; margin-top: 0px;"></div>
		</div>
		<h6 class="center">CONSENTIMIENTO</h6>
		<div class="row" style="margin-top: 5px;">
			<div class="twelve columns">
				<p class="justify">
					El que se suscribe <strong style="border-bottom: 0.5px solid black;">{{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}</strong> como integrante del Grupo <strong style="border-bottom: 0.5px solid black;">PLANEA TU BIEN, S.A. DE C.V.</strong> otorgo mi CONSENTIMIENTO para ser incluido como asegurado en el Programa de Seguro de Vida Grupo Deudor que <strong style="border-bottom: 0.5px solid black;">PLANEA TU BIEN, S.A. DE C.V.</strong> contrate a mi nombre con una suma asegurada consistente en <strong style="border-bottom: 0.5px solid black;">Saldo Insoluto Vigente del Crédito</strong> en el entendido de que deberé cumplir con los requisitos que señale la Compañía de Seguros con la cual se contrate el Programa de Seguro de Vida Grupo para poder ser incluido en el mismo y para lo cual designo como Beneficiarios a:
				</p>
			</div>
		</div>
		<div class="row">
			<table>
				<tbody>
					<tr>
						<th colspan="8" class="center header-bg"><label><strong>DATOS DE LOS BENEFICIARIOS</strong></label></th>
					</tr>
					<tr>
						<th colspan="3" class="center header-bg">
							<label>NOMBRE COMPLETO DE LOS BENEFICIARIOS</label>
						</th>
						<th class="header-bg">
							<label>PARENTESCO</label>
						</th>
						<th class="center header-bg">
							<label>EDAD</label>
						</th>
						<th class="center header-bg">
							<label>PORCENTAJE</label>
						</th>
						<th colspan="2" class="center header-bg">
							<label>IRREVOCABLE</label>
						</th>
					</tr>
					<tr>
						<th class="header-bg">
						</th>
						<th class="header-bg">
						</th>
						<th class="header-bg">
						</th>
						<th class="header-bg"></th>
						<th class="header-bg"></th>
						<th class="header-bg"></th>
						<th class="header-bg">SI</th>
						<th class="header-bg">NO</th>
					</tr>
					<tr>
						<td colspan="3">
							<strong>PLANEA TU BIEN S.A. DE C.V.</strong>
						</td>
						<td>
							Otorgante del Crédito
						</td>
						<td>
						</td>
						<td>
							Saldo Insoluto
						</td>
						<td>
							X
						</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row" style="margin-top: 5px;">
			<div class="twelve columns">
				<p class="justify">
					Asimismo conozco la ADVERTENCIA que hace la Ley General de Instituciones y Sociedades Mutualistas de Seguros "En caso de que se desee nombrar como beneficiarios a menores de edad, no deberé señalar a un mayor de edad como representante del los menores para efecto de que en su representación, cobre la indemnización.
				</p>
				<p class="justify">
					Lo anterior porque las legislaciones civiles previenen la forma en que debe designarse tutores, albaceas, representantes de herederos u otros cargos similares y no consideran el contrato de seguro como instrumento adecuado para tales designaciones.
				</p>
				<p class="justify">
					La desigación que se hiciera de un mayor de edad como representante de menores beneficiarios, durante la minoría de edad de ellos, legalmente puede implicar que se nombra beneficiario al mayor de edad, quien en todo caso solo tendría obligación moral, pues la desigación que se hace de beneficiarios en un contrato de seguro le concede el derecho incondicionado de disponer de la suma asegurada".
				</p>
			</div>
		</div>
		<div class="row" style="margin-top: 5px;">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<label class="center">
						México, CDMX a {{date('d')}} de {{__(date('F'))}} del {{date('Y')}}
					</label>
				</div>
			</div>
		</div>
		
		<div class="row" style="margin-top: 10px; margin-left: 12px">
			<div class="twelve columns">
				<div class="one-half column u-pull-left">
					<label class="center">________________________________________</label>
					<label class="center">NOMBRE COMPLETO Y FIRMA DEL INTEGRANTE DEL GRUPO</label>
				</div>
			</div>
		</div>
	</div>
</body>
</html>