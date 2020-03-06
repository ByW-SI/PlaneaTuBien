<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col" style="white-space: nowrap">
                Resultado</th>
            <th scope="col" style="white-space: nowrap">
                Fecha de contacto</th>
            <th scope="col" style="white-space: nowrap">
                Fecha de siguiente contacto</th>
            <th scope="col" style="white-space: nowrap">
                Comentario</th>
            {{-- <th scope="col" style="white-space: nowrap">
                    Asesor que realizó la acción</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($llamadas as
        $llamada)
        <tr>
            <td nowrap>
                {{!$llamada->resultadoLLamada ? '' : $llamada->resultadoLLamada->nombre}}
            </td>
            <td nowrap>{{$llamada->fecha_contacto}}</td>
            <td nowrap>
                {{$llamada->fecha_siguiente_contacto}}
            </td>
            <td nowrap>{{$llamada->comentario}}</td>
            {{-- <td nowrap>
                    {{is_null($llamada->responsable) ? '' : $llamada->responsable->nombre}}
            </td> --}}
        </tr>
        @endforeach
    </tbody>
</table>