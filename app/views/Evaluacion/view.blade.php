@extends ('template')

@section ('title') Ver Evaluacion @stop
@section ('title_div') Ver Evaluacion @stop

@section ('boton')
<p><a href="{{ route('evaluacion.create') }}" class="btn btn-primary">Crear un nuevo evaluacion</a></p>
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

  </tbody>
</table>

@stop

