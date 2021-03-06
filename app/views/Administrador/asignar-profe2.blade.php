@extends ('template')

@section ('title') Asignar Profesor a {{ $curso->nombre }} @stop


@section ('contenido')
<center>
	<h1>
		Asignar Profesor a {{ $curso->nombre }}
	</h1>
</center>

<br>
	<div class="col-md-12 col-sm-12 col-xs-12">

	<a href="{{ URL::route('ver-curso', $curso->id_curso ) }}" class="btn btn-primary" target="_blank">Ver Presentación del Curso</a>
	<h3>
		Docentes Principales
	</h3>
	@foreach($profesores as $profesor)
	@if($profesor->existeRelacionProfesorAdmin($curso->id_curso))
	<div class="col-md-4 col-sm-6 col-xs-6">
		<a href="{{ URL::route('desasignar-profesor', array($curso->id_curso, $profesor->id, 'Docente Principal' ) ) }}">
			<table class="table">
				<tr class="danger">

					<th width="20%">
						@if(substr( $profesor->foto , 0, 4) == 'http')
						<img class="imagen_redonda_reducida" src="{{ $profesor->foto }}" >
						@else
						<img class="imagen_redonda_reducida" src="../../imagenes/fotos/{{ $profesor->foto  }} " >
						@endif
					</th>
					<th style="vertical-align:middle;">
						Desvincular a {{ $profesor->nombre." ".$profesor->apellido }} Como Docente Principal
					</th>
				</tr>
			</table>
		</a>
	</div>
	@endif
	@endforeach
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">

	<h3>
		Docentes
	</h3>
	@foreach($profesores as $profesor)
	@if($profesor->existeRelacionProfesorBasico($curso->id_curso))
	<div class="col-md-4 col-sm-6 col-xs-6">
		<a href="{{ URL::route('desasignar-profesor', array($curso->id_curso, $profesor->id, 'Profesor Basico' ) ) }}">
			<table class="table">
				<tr class="danger">

					<th width="20%">
						@if(substr( $profesor->foto , 0, 4) == 'http')
						<img class="imagen_redonda_reducida" src="{{ $profesor->foto }}" >
						@else
						<img class="imagen_redonda_reducida" src="../../imagenes/fotos/{{ $profesor->foto  }} " >
						@endif
					</th>
					<th style="vertical-align:middle;">
						Desvincular a {{ $profesor->nombre." ".$profesor->apellido }} Como Docente
					</th>
				</tr>
			</table>
		</a>
	</div>
	@endif
	@endforeach


	</div>
	</br>
	<hr>
	<div class="col-md-12 col-sm-12 col-xs-12">

	<strong>Buscar a:</strong>
	{{ Form::open(array('route' => 'redirect-asignar-profesores', 'method' => 'GET')) }}
		{{ Form::hidden('id', $curso->id_curso	) }}
		{{ Form::text('nombre') }}

		{{ Form::submit('Buscar', array('class'=>'btn btn-primary') ) }}
	{{ Form::close() }}

	<h2>Para Asignar</h2>

@foreach($profesores2 as $profesor)
@if(!$profesor->existeRelacionProfesorAdmin($curso->id_curso))
<div class="col-md-4 col-sm-6 col-xs-6">
	<a href="{{ URL::route('asignar-profesor', array($curso->id_curso, $profesor->id, 'Profesor Admin' ) ) }}">
		<table class="table">
			<tr class="success">
				<th width="20%">
					@if(substr( $profesor->foto , 0, 4) == 'http')
					<img class="imagen_redonda_reducida" src="{{ $profesor->foto }}" >
					@else
					<img class="imagen_redonda_reducida" src="../../imagenes/fotos/{{ $profesor->foto  }} " >
					@endif
				</th>
				<th style="vertical-align:middle;">
					Adicionar a {{ $profesor->nombre." ".$profesor->apellido }} Como Docente Principal
				</th>
			</tr>
		</table>
	</a>
</div>
@endif
@endforeach

@foreach($profesores2 as $profesor)
@if(!$existe = $profesor->existeRelacionProfesorBasico($curso->id_curso))

<div class="col-md-4 col-sm-6 col-xs-6">
	<a href="{{ URL::route('asignar-profesor', array($curso->id_curso, $profesor->id, 'Profesor Basico' ) ) }}">
		<table class="table">
			<tr class="success">
				<th width="20%">
					@if(substr( $profesor->foto , 0, 4) == 'http')
					<img class="imagen_redonda_reducida" src="{{ $profesor->foto }}" >
					@else
					<img class="imagen_redonda_reducida" src="../../imagenes/fotos/{{ $profesor->foto  }} " >
					@endif
				</th>
				<th style="vertical-align:middle;">
					Adicionar a {{ $profesor->nombre." ".$profesor->apellido }} Como Docente
				</th>
			</tr>
		</table>
	</a>
</div>
@endif
@endforeach

</div>

@stop
