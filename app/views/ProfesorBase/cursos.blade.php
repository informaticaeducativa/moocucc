@extends ('template2')

@section ('title') Ver Curso @stop

@section ('contenido')

<div class="col-sm-12 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">

	<div class="container">
		<center>
			<header>
				<h1>Cursos a los que estas inscrito como Profesor Base</h1>
			</header>
		</center>
		<br>
		<div class="row row_cursos">
			@foreach ($relaciones as $relacion)
			<a href="ver-curso-info/{{ $relacion->getCurso()->id_curso }}">

				<div class="col-md-4 col-sm-6 col-xs-12 album_list">
					<div class="div_list">
						<img class="imagen_div" src="../imagenes/{{$relacion->getCurso()->imagen_presentacion}} " >
						<div class="espaciado">
							<div class="titulo_curso">
								<h3>{{ $relacion->getCurso()->nombre }}</h3>
							</div>

							Nivel: {{ $relacion->getCurso()->nivel }}<br/>
							{{ $relacion->getCurso()->getTematica() }}<br/>
							{{ $relacion->getCurso()->getFechaInicio() }}
						</div>
					</div>
				</div>
			</a>
			@endforeach
		</div>
		<br/>
	</div>

	<div class="container">
		<center>
			<header>
				<h1>Pruebas Extras</h1>
			</header>
		</center>
		<br>
		<div class="row row_cursos">
			<center>
				<a href="ver-curso-info/4">
					<div class="col-md-4 col-sm-6 col-xs-12 album_list">
						<div class="div_list">
							<img class="imagen_div" src="../imagenes/test.jpg " >
							<div class="espaciado">
								<div class="titulo_curso">
									<h3>Test de Inteligencias</h3>
								</div>

								Nivel: Básico<br/>
								<br/>

							</div>
						</div>
					</div>
				</a>
			</center>
		</div>
		<br/>
	</div>

@stop
