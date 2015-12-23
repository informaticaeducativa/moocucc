@extends ('template')


@section ('title') Lista de Preguntas @stop

@section ('title_div') Lista de Preguntas @stop


@section ('contenido') 

<p><a href="{{ route('pregunta.create') }}" class="btn btn-primary">Crear un nuevo pregunta</a></p>

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
    @foreach ($preguntas as $pregunta)
    <tr>
        <td>{{ $pregunta->id_pregunta }}</td>
        <td>{{ $pregunta->nombre }}</td>
        <td>{{ $pregunta->nivel }}</td>
        <td>
          <a href="{{ route('pregunta.show', $pregunta->id_pregunta) }}" class="btn btn-info">
              Ver
          </a>
          <a href="{{ route('pregunta.edit', $pregunta->id_pregunta) }}" class="btn btn-primary">
            Editar
          </a>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop
