@extends ('template')

@section ('title') Ver Pregunta @stop
@section ('title_div') Ver Pregunta @stop

@section ('boton')
<p><a href="{{ route('pregunta.create') }}" class="btn btn-primary">Crear un nuevo pregunta</a></p>
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

  </tbody>
</table>

@stop

