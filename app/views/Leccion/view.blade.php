@extends ('template')

@section ('title') Ver Leccion @stop
@section ('title_div') Ver Leccion @stop

@section ('boton')
<p><a href="{{ route('leccion.create') }}" class="btn btn-primary">Crear un nuevo leccion</a></p>
@stop



@section ('contenido') 
 <br>
 
<table id="ticket-table" class="table table-sorting">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Descripción</th>
			<th>Acciones</th>
		</tr>
	</thead>
<tbody>
    <tr>
        <td>{{ $leccion->id_leccion }}</td>
        <td>{{ $leccion->nombre }}</td>
        <td>{{ $leccion->nivel }}</td>
        <td>
          <a href="{{ route('leccion.show', $leccion->id_leccion) }}" class="btn btn-info">
              Ver
          </a>
          <a href="{{ route('leccion.edit', $leccion->id_leccion) }}" class="btn btn-primary">
            Editar
          </a>
        </td>
    </tr>

  </tbody>
</table>

@stop

