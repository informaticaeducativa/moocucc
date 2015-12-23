@extends ('template')


@section ('title') Lista de Cursos @stop

@section ('title_div') Lista de Cursos @stop


@section ('contenido') 

<p><a href="{{ route('curso.create') }}" class="btn btn-primary">Crear un nuevo curso</a></p>

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
    @foreach ($cursos as $curso)
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
    @endforeach
  </tbody>
</table>

@stop
