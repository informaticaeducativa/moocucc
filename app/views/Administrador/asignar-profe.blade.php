@extends ('template')

@section ('title') Asignar Profesor a {{ $curso->nombre }} @stop


@section ('contenido')
<center>
	<h1>
		Asignar Profesor a {{ $curso->nombre }}
	</h1>
</center>

<br>

  <div class="row">
	

@foreach($profesores as $profesor)
<div class="col-md-4 col-sm-6 col-xs-6">
	<a href="#">
		<table class="table">
			@if($existe = $profesor->existeRelacionProfesorAdmin($curso->id_curso))
			<tr class="danger">
			@else
			<tr class="success">
			@endif
				<th width="20%">
					@if(substr( $profesor->foto , 0, 4) == 'http')
					<img class="imagen_redonda_reducida" src="{{ $profesor->foto }}" >
					@else
					<img class="imagen_redonda_reducida" src="../../imagenes/fotos/{{ $profesor->foto  }} " >
					@endif
				</th>
				<th style="vertical-align:middle;">
					@if($existe)
					Desvincular
					@else
					Adicionar
					@endif
					 a {{ $profesor->nombre." ".$profesor->apellido }} Como Profesor Administrador
				</th>
			</tr>
		</table>
	</a>
</div>
@endforeach   

@foreach($profesores as $profesor)
<div class="col-md-4 col-sm-6 col-xs-6">
	<a href="#">
		<table class="table">
			@if($existe = $profesor->existeRelacionProfesorBasico($curso->id_curso))
			<tr class="danger">
			@else
			<tr class="success">
			@endif
				<th width="20%">
					@if(substr( $profesor->foto , 0, 4) == 'http')
					<img class="imagen_redonda_reducida" src="{{ $profesor->foto }}" >
					@else
					<img class="imagen_redonda_reducida" src="../../imagenes/fotos/{{ $profesor->foto  }} " >
					@endif
				</th>
				<th style="vertical-align:middle;">
					@if($existe)
					Desvincular
					@else
					Adicionar
					@endif
					 a {{ $profesor->nombre." ".$profesor->apellido }} Como Profesor Básico
				</th>
			</tr>
		</table>
	</a>
</div>
@endforeach    

  </div>


@stop
