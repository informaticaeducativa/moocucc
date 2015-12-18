@extends ('template')

@section ('title') Ver Usuario @stop
@section ('title_div') Ver Usuario @stop

@section ('boton')
<p><a href="{{ route('usuario.create') }}" class="btn btn-primary">Crear un nuevo usuario</a></p>
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
        <td>{{ $usuario->id_usuario }}</td>
        <td>{{ $usuario->nombre }}</td>
        <td>{{ $usuario->nivel }}</td>
        <td>
          <a href="{{ route('usuario.show', $usuario->id_usuario) }}" class="btn btn-info">
              Ver
          </a>
          <a href="{{ route('usuario.edit', $usuario->id_usuario) }}" class="btn btn-primary">
            Editar
          </a>
        </td>
    </tr>

  </tbody>
</table>

@stop

