<table class="table table-hover table-striped table-bordered" style="margin-bottom: 0;" id="listaEmpleados">
    <tr class="info">
        <th>#</th>
        <th>Nombre</th>
        <th>Apellido paterno</th>
        <th>Apellido materno</th>
        <th>RFC</th>
        <th>Acción</th>
    </tr>
    @foreach($empleados as $key => $empleado)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$empleado->nombre}}</td>
            <td>{{$empleado->paterno}}</td>
            <td>{{$empleado->materno}}</td>
            <td>{{$empleado->rfc}}</td>
            <td class="text-center">
                <button type="button" class="btn btn-success text-white agregarUsuario" id-empleado={{$empleado->id}}>
                    <i class="fa fa-plus"></i> Agregar usuario
                </button>
            </td>
        </tr>
    @endforeach
</table>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script>
    $(document).ready(function() {
        $('#listaEmpleados').DataTable();
    } );
</script>