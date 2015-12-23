@extends ('template')

@section ('title') Ver Curso @stop
@section ('title_div') Ver Curso @stop

@section ('boton')
<p><a href="{{ route('curso.create') }}" class="btn btn-primary">Crear un nuevo curso</a></p>
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
        <td>{{ $curso->id_curso }}</td>
        <td>{{ $curso->nombre }}</td>
        <td>{{ $curso->nivel }}</td>
        <td>
          <a href="{{ route('curso.show', $curso->id_curso) }}" class="btn btn-info">
              Ver
          </a>
          <a href="{{ route('curso.edit', $curso->id_curso) }}" class="btn btn-primary">
            Editar
          </a>
        </td>
    </tr>

  </tbody>
</table>

@stop

