@extends ('template2')

@section ('title') Ver Curso @stop

@section ('boton')
<p><a href="{{ route('curso.create') }}" class="btn btn-primary">Crear un nuevo curso</a></p>
@stop


@section ('contenido')
<br>

<div class="div col-sm-12 col-xs-12 ">
  <div class="col-sm-4 col-xs-12">
    <img class="imagen_div" src="../../imagenes/{{$curso->imagen_presentacion}} " >
  </div>
  <div class="col-sm-8 col-xs-12 ">

		<center>
      <h2 class="strong">{{ $curso->nombre }}</h2>

		</br>
		<table width="100%">
			<tr>
				<th>
					<a href="{{ URL::route('admin-ver-curso', $curso->id_curso ) }}" class="btn btn-warning" style="width:100%" target="_blank">Visualización de la página de presentación del Curso</a>				
				</th>
			</tr>
			<tr><th></th></tr>			
			<tr>
				<th>
					<a href="{{ URL::route('ver-curso-info', $curso->id_curso ) }}" class="btn btn-warning" style="width:100%" target="_blank">Visualización de como se ve el contenido del Curso</a>				
				</th>
			</tr>
			<tr><th></th></tr>
			<tr>
				<th>
					<a href="{{ URL::route('crear-curso-2', $curso->id_curso ) }}" class="btn btn-primary" style="width:100%">Crear contenido de presentación del curso</a>
				</th>
			</tr>
			<tr><th></th></tr>
			<tr>
				<th>
					<a href="{{ URL::route('crear-curso-3', $curso->id_curso ) }}" class="btn btn-primary" style="width:100%">Asignar profesores al curso</a>
				</th>
			</tr>
			<tr><th></th></tr>
			<tr>
				<th>
					<a href="{{ URL::route('crear-curso-4b', $curso->id_curso ) }}" class="btn btn-primary" style="width:100%">Crear contenido de inicio del curso</a>
				</th>
			</tr>
			<tr><th></th></tr>
			<tr>
				<th>
					<a href="{{ URL::route('crear-curso-5', $curso->id_curso ) }}" class="btn btn-primary" style="width:100%">Crear contenido del curso</a>
				</th>
			</tr>
			<tr><th></th></tr>
			<tr>
				<th>
					<a href="{{ URL::route('crear-curso-6', $curso->id_curso ) }}" class="btn btn-primary" style="width:100%">Crear lección del curso</a>
				</th>
			</tr>
			<tr><th></th></tr>
			<tr>
				<th>
					<a href="{{ URL::route('crear-curso-7', $curso->id_curso ) }}" class="btn btn-primary" style="width:100%">Crear evaluación del curso</a>
				</th>
			</tr>
      </table>
      </center>
    </div>

</div>
<br>


@stop
