<option value="">Seleccionar</option>
@foreach($asesores as $asesor)
	<option value="{{ $asesor->id }}">{{ $asesor->nombre }} {{ $asesor->paterno }}</option>
@endforeach