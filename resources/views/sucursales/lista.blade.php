@foreach($sucursales as $sucursal)
<option value="{{ $sucursal->id }}">{{$sucursal->nombre}}</option>
@endforeach