@extends ('template')


@section ('title') Lista de Usuarios @stop

@section ('title_div') Lista de Usuarios @stop


@section ('contenido') 

<p><a href="{{ route('usuario.create') }}" class="btn btn-primary">Crear un nuevo usuario</a></p>

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
    @foreach ($usuarios as $usuario)
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
    @endforeach
  </tbody>
</table>

@stop
