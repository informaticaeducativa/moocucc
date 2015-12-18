@extends ('template')

@section ('title') Ver Temario @stop
@section ('title_div') Ver Temario @stop

@section ('boton')
<p><a href="{{ route('temario.create') }}" class="btn btn-primary">Crear un nuevo temario</a></p>
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
        <td>{{ $temario->id_temario }}</td>
        <td>{{ $temario->nombre }}</td>
        <td>{{ $temario->nivel }}</td>
        <td>
          <a href="{{ route('temario.show', $temario->id_temario) }}" class="btn btn-info">
              Ver
          </a>
          <a href="{{ route('temario.edit', $temario->id_temario) }}" class="btn btn-primary">
            Editar
          </a>
        </td>
    </tr>

  </tbody>
</table>

@stop

