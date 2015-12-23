@extends ('template')


@section ('title') Lista de Evaluaciones @stop

@section ('title_div') Lista de Evaluacioness @stop


@section ('contenido') 

<p><a href="{{ route('evaluacion.create') }}" class="btn btn-primary">Crear un nuevo evaluacion</a></p>

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
    @foreach ($evaluaciones as $evaluacion)
    <tr>
        <td>{{ $evaluacion->id_evaluacion }}</td>
        <td>{{ $evaluacion->nombre }}</td>
        <td>{{ $evaluacion->nivel }}</td>
        <td>
          <a href="{{ route('evaluacion.show', $evaluacion->id_evaluacion) }}" class="btn btn-info">
              Ver
          </a>
          <a href="{{ route('evaluacion.edit', $evaluacion->id_evaluacion) }}" class="btn btn-primary">
            Editar
          </a>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop
