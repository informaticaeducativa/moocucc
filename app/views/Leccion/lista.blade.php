@extends ('template')


@section ('title') Lista de Lecciones @stop

@section ('title_div') Lista de Lecciones @stop


@section ('contenido') 

<p><a href="{{ route('leccion.create') }}" class="btn btn-primary">Crear un nuevo leccion</a></p>

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
    @foreach ($lecciones as $leccion)
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
    @endforeach
  </tbody>
</table>

@stop
