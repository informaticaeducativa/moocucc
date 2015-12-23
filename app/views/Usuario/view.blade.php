@extends ('template')

@section ('title') Ver Usuario @stop
@section ('title_div') Usuario {{ $usuario->nombre." ".$usuario->apellido }} @stop

@section ('boton')
<p><a href="{{ route('usuario.create') }}" class="btn btn-primary">Crear un nuevo usuario</a></p>
@stop



@section ('contenido') 
 <br>
 
<center>
	<img class="imagen_redonda" src="../imagenes/fotos/{{ $usuario->foto  }} " ><br>
</center>
<br>				
<table id="ticket-table" class="table table-sorting">
		<tr>
			<th>ID</th>
			<td>{{ $usuario->id }}</td>
		</tr>
		<tr>
			<th>Nombres</th>
			<td>{{ $usuario->nombre }}</td>
		</tr>
		<tr>
			<th>Apellidos</th>
			<td>{{ $usuario->apellido }}</td>
		</tr>
		<tr>
			<th>Tipo de Usuario</th>
			<td>{{ $usuario->tipo_usuario }}</td>
		</tr>
		<tr>
			<th>Fecha de inscripción</th>
			<td>{{ $usuario->fecha }}</td>
		</tr>
		<tr>
			<th>Tipo de Inteligencia</th>
			<td>{{ $usuario->tipo_inteligencia }}</td>
		</tr>
		<tr>
			<th>Titulo</th>
			<td>{{ $usuario->titulo }}</td>
		</tr>
		<tr>
			<td>
			  <a href="{{ route('usuario.edit', $usuario->id_usuario) }}" class="btn btn-primary">
				Editar Usuario
			  </a>
			</td>
		</tr>
</table>

@stop

