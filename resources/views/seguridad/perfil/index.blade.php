@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
    	<div class="row">
    		<div class="col-sm-4">
    			<h4>Perfiles:</h4>
    		</div>
            <div class="col-sm-4 text-center">
                <a class="btn btn-success" href="{{ route('perfils.create') }}">
                    <i class="fa fa-plus"></i><strong> Agregar Perfil</strong>
                </a>
            </div>
    	</div>
    </div>
    <div class="card-body">
    	<div class="row">
            <div class="col-sm-12">
                @if(count($perfiles) > 0)
                    <table class="table table-hover table-striped table-bordered" style="margin-bottom: 0;">
                        <tr class="info">
                            <th style="width: 22%">Nombre</th>
                            <th style="width: 55%">Módulos</th>
                            <th style="width: 22%">Acciones</th>
                        </tr>
                        @foreach($perfiles as $perfil)
                            <tr>
                                <td>{{ $perfil->nombre }}</td>
                                <td>
                                    @php($arr = [])
                                    @php($i = 0)
                                    @foreach($perfil->componentes as $componente)
                                        @php($flag = true)
                                        @if($i == 0)
                                            @php($arr[] = $componente->modulo->nombre)
                                            @php($i++)
                                        @else
                                            @foreach($arr as $modulo)
                                                @if($modulo == $componente->modulo->nombre)
                                                    @php($flag = false)
                                                @endif
                                            @endforeach
                                            @if($flag)
                                                @php($arr[] = $componente->modulo->nombre)
                                            @endif
                                        @endif
                                    @endforeach
                                    @foreach($arr as $modulo)
                                        {{ $modulo }}.
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="{{ route('perfils.show', ['perfil' => $perfil]) }}">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('perfils.edit', ['perfil' => $perfil]) }}">
                                        ✎ Editar
                                    </a>
                                    <form method="post" action="{{ route('perfils.destroy', ['perfil' => $perfil]) }}" style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-times"></i> Borrar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h4>No hay perfiles disponibles.</h4>
                @endif
            </div>
    	</div>
    </div>
</div>

    @endsection