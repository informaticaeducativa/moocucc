@extends ('template2')

@section ('title') Ver Curso {{$curso->nombre}} @stop



@section ('contenido') 

<div class="col-sm-3 col-xs-12  bg_blue_80">
	<div class=" espaciado">
		<img class="imagen_div" src="../imagenes/{{$curso->imagen_presentacion}} " >
	
		<table class="table-curso-detalles">
			
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-info', $curso->id_curso ) }}"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-info', 'Inicio', array($curso->id_curso), array()) }}</th>
				</tr>
			
			<a href="#">
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-contenido', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-contenido', 'Contenido del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
			<a href="#">
			</a>	
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-tareas', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-tareas', 'Tareas', array($curso->id_curso), array()) }}</th>
				</tr>
			<a href="#">
			</a>	
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-info-sign" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso', 'Información del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
			</a>
		</table>
	</div>
</div>

<div class="col-sm-9 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<center><h1> Ver Curso {{$curso->nombre}} </h1></center>
		@foreach ($curso->getTemarios() as $temario)
					<div class="espaciado">
						<h3><strong>{{ $temario->titulo }}</strong></h3>
						{{ $temario->contenido }}
					</div>
		@endforeach

		<h3><strong>Profesores Del Curso</strong></h3>
		@foreach ($curso->getProfesoresAdmin() as $profe)
		<div class="col-md-4 col-sm-6 col-xs-12 espaciado ">
			<center>	
				<h4><strong>{{ $profe->tipo_relacion }}</strong></h4>
				<img class="imagen_redonda" src="../imagenes/fotos/{{ $profe->getProfesor()->foto  }} " ><br>
				
				<strong>{{ $profe->getProfesor()->nombre." ".$profe->getProfesor()->apellido }}</strong><br>
				{{ $profe->getProfesor()->titulo }}<br><br>
			</center>
		</div>
		@endforeach
		@foreach ($curso->getProfesoresAsistentes() as $profe)
		<div class="col-md-4 col-sm-6 col-xs-12 espaciado ">
			<center>
				<h4><strong>{{ $profe->tipo_relacion }}</strong></h4>
				<img class="imagen_redonda" src="../imagenes/fotos/{{ $profe->getProfesor()->foto  }} " ><br>
				
				<strong>{{ $profe->getProfesor()->nombre." ".$profe->getProfesor()->apellido }}</strong><br>
				{{ $profe->getProfesor()->titulo }}<br><br>
			</center>
		</div>
		@endforeach
	</div>
</div>

@stop


