@extends ('template')


@section ('title') Lista de Preguntas de la lección @stop

@section ('title_div') Lista de Preguntas de la lección @stop


@section ('contenido')

<p><a href="{{ route('pregunta_leccion.create') }}" class="btn btn-primary">Crear una nueva pregunta de la lección</a></p>

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
    @foreach ($preguntas_leccion as $pregunta_leccion)
    <tr>
        <td>{{ $pregunta_leccion->id_pregunta_leccion }}</td>
        <td>{{ $pregunta_leccion->nombre }}</td>
        <td>{{ $pregunta_leccion->nivel }}</td>
        <td>
          <a href="{{ route('pregunta_leccion.show', $pregunta_leccion->id_pregunta_leccion) }}" class="btn btn-info">
              Ver
          </a>
          <a href="{{ route('pregunta_leccion.edit', $pregunta_leccion->id_pregunta_leccion) }}" class="btn btn-primary">
            Editar
          </a>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop
