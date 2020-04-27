@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Beneficiario'])
		<div class="card-body">
	<form method="POST" action="{{ route('prospectos.presolicitud.beneficiarios.store',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}">
		@csrf
		@method('PUT')
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
		    <div class="row">
				<div class="col-12">
					<div class="d-flex bd-highlight">
					  	<div class="p-2 w-100 bd-highlight">
					  		<label>Beneficiarios</label>
					  	</div>
					  	<div class="p-2 flex-shrink-1 bd-highlight">
					  		<a href="javascript:void(0);" class="add_button" title="Agregar beneficiario"><i class="fas fa-plus"></i></a>
					  	</div>
					</div>
				</div>
			</div>
			@foreach ($presolicitud->beneficiarios as $beneficiario)
				<div class="row">
					<div class="col-12">
						<div class="d-flex bd-highlight">
						  	<div class="p-2 w-100 bd-highlight">
						  		<label>Beneficiario</label>
						  	</div>
						  	<div class="p-2 flex-shrink-1 bd-highlight">
						  		<a href="javascript:void(0);" class="remove_button" title="Add field"><i class="fas fa-minus-circle"></i></a>
						  	</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">✱ Apellido Paterno</label>
						<input type="text" class="form-control" name="paterno[]" required="" value="{{$beneficiario->paterno}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Apellido Materno</label>
						<input type="text" class="form-control" name="materno[]" value="{{$beneficiario->materno}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">✱ Nombre(s)</label>
						<input type="text" class="form-control" name="nombre[]" required="" value="$beneficiario->nombre}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">✱ Edad</label>
						<input type="number" step="1" min="0" class="form-control" name="edad[]" required="" value="{{$beneficiario->edad}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">✱ Parentesco</label>
						<input type="text" step="1" min="0" class="form-control" name="parentesco[]" required="" value="{{$beneficiario->parentesco}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">✱ Porcentaje del bien</label>
						<div class="input-group">
							<input type="number" step="any" min="1" max="100" class="form-control" name="porcentaje[]" required="" onchange="cienporciento(this.value)" value="{{old('porcentaje')}}">
					        <div class="input-group-append">
					          <div class="input-group-text">%</div>
					        </div>
				      	</div>
					</div>
					
				</div>
			@endforeach
				
				<div class="field_wrapper"></div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<button class="btn btn-success" id="submit" type="submit"><i class="fas fa-arrow-alt-circle-right"></i> Siguiente</button>
			</div>
		</div>

	</form>
</div>
@endsection
@push('scripts')
<script>
	$(document).ready(function(){
	    var maxField = 4; //Input fields increment limitation
	    var addButton = $('.add_button'); //Add button selector
	    var wrapper = $('.field_wrapper'); //Input field wrapper
	    var fieldHTML = `
	    <div class="row">
		    <div class="col-12">
				<div class="d-flex bd-highlight">
				  	<div class="p-2 w-100 bd-highlight">
				  		<label>Beneficiario</label>
				  	</div>
				  	<div class="p-2 flex-shrink-1 bd-highlight">
				  		<a href="javascript:void(0);" class="remove_button" title="Add field"><i class="fas fa-minus-circle"></i></a>
				  	</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">✱ Apellido Paterno</label>
				<input type="text" class="form-control" name="paterno[]" required="" value="{{old('paterno')}}">
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Apellido Materno</label>
				<input type="text" class="form-control" name="materno[]" value="{{old('materno')}}">
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">✱ Nombre(s)</label>
				<input type="text" class="form-control" name="nombre[]" required="" value="{{old('nombre')}}">
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">✱ Edad</label>
				<input type="number" step="1" min="0" class="form-control" name="edad[]" required="" value="{{old('edad')}}">
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">✱ Parentesco</label>
				<input type="text" step="1" min="0" class="form-control" name="parentesco[]" required="" value="{{old('parentesco')}}">
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">✱ Porcentaje del bien</label>
				<div class="input-group">
					<input type="number" step="any" min="1" max="100" class="form-control" name="porcentaje[]" required="" onchange="cienporciento(this.value)" value="{{old('porcentaje')}}">
			        <div class="input-group-append">
			          <div class="input-group-text">%</div>
			        </div>
		      	</div>
			</div>
	    </div>
	    `;





	    // '<div class="input-group offset-md-4 col-md-6"> <select id="uva" class="form-control" name="uva[]"><option value="">Seleccione su uva</option></select><input type="number" step="any" min="0.00" placeholder="Hectareas" class="form-control" name="hectarea[]" value=""/><div class="input-group-append"><span class="input-group-text"><strong>ha</strong></span></div><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">$</span></div><input type="number" step="any" min="0.00" placeholder="Costo de la uva" class="form-control" name="costo[]" value=""/><div class="input-group-append"><span class="input-group-text">USD</span></div></div></div>'; //New input field html 
	    var x = 1; //Initial field counter is 1
	    
	    //Once add button is clicked
	    $(addButton).click(function(){
	        //Check maximum number of input fields
	        if(x < maxField){ 
	            x++; //Increment field counter
	            $(wrapper).append(fieldHTML); //Add field html
	        }
	    });
	    
	    //Once remove button is clicked
	    $(wrapper).on('click', '.remove_button', function(e){
	        e.preventDefault();
	        $(this).parent('div').parent('div').parent('div').parent('div').remove(); //Remove field html
	        x--; //Decrement field counter
	    });
	});
	function cienporciento(value){
		var porcentaje = 0.00;
		$('input[name="porcentaje[]"]').each(function(){
			if(this.value){
				porcentaje += +this.value;
			}
		})
		if (porcentaje != 100) {
			alert('El porcentaje total debe de ser del 100%.Tu porcentaje total: '+porcentaje+"%");
			$('#submit').prop('disabled', true);
		}
		else{
			$('#submit').prop('disabled', false);
		}
	}
</script>

@endpush