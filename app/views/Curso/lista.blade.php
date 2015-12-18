@extends ('template')


@section ('title') Lista de Cursos @stop

@section ('title_div') Lista de Cursos @stop


@section ('contenido') 

<p><a href="{{ route('curso.create') }}" class="btn btn-primary">Crear un nuevo curso</a></p>

<br>
<div class="row">
		
    </div>    
	<div class="row row_cursos">
		@foreach ($cursos as $curso)
			<a href="curso/{{ $curso->id_curso }}"> 
			
			<div class="col-md-4 col-sm-6 col-xs-12 album_list">
				<div class="div_list">
						<img class="imagen_div" src="imagenes/{{$curso->imagen_presentacion}} " >
					<div class="espaciado">
						<div class="titulo_curso">
							<h3>{{ $curso->nombre }}</h3>
						</div>
						
						Nivel: {{ $curso->nivel }}<br>
						{{ $curso->getTematica() }}<br>
						{{ $curso->getFechaInicio() }}
					</div>
				</div>
			</div>
			</a>
		@endforeach
    </div>    

@stop
