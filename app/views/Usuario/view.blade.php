@extends ('template')

@section ('title') Ver Usuario {{ $usuario->nombre }} @stop
@section ('title_div') Usuario {{ $usuario->nombre." ".$usuario->apellido }} @stop

@section ('boton')
<p><a href="{{ route('usuario.create') }}" class="btn btn-primary">Crear un nuevo usuario</a></p>
@stop



@section ('contenido')
 <br>
 <center>
	<h1>{{ $usuario->nombre }}</h1>
</center>
<center>
	@if(substr( $usuario->foto , 0, 4) == 'http')
	<img class="imagen_redonda" src="{{ $usuario->foto}}" ><br>
	@else
	<img class="imagen_redonda" src="../imagenes/fotos/{{ $usuario->foto  }} " ><br>
	@endif
</center>
<br>
<table id="ticket-table" class="table table-sorting">
		<tr>
			<th>ID</th>
			<td>{{ $usuario->id }}</td>
		</tr>
		<tr>
			<th>Nombre</th>
			<td>{{ $usuario->nombre.' '.$usuario->apellido }}</td>
		</tr>
		@if ($usuario->tipo_usuario == 'Administrador')
		<tr>
			<th>Tipo de Usuario</th>
			<td>{{ $usuario->tipo_usuario }}</td>
		</tr>
		@else
		<tr>
			<th>Tipo de Inteligencia</th>
			<td>{{ $usuario->tipo_inteligencia }}</td>
		</tr>
		@endif
		<tr>

			<th>Fecha de inscripción</th>
			<td>{{ $usuario->fecha }}</td>
		</tr>
		
		<tr>
			<th>Título</th>
			<td>{{ $usuario->titulo }}</td>
		</tr>

</table>

@stop
