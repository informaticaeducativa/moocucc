@extends ('template')

@section ('title') Ver Curso @stop
@section ('title_div')  @stop

@section ('boton')
<p><a href="{{ route('curso.create') }}" class="btn btn-primary">Crear un nuevo curso</a></p>
@stop



@section ('contenido') 
 <br>

<div class="div col-sm-12 col-xs-12 border1">
	<div class="col-sm-4 col-xs-12">
		<img class="imagen_div" src="../imagenes/{{$curso->imagen_presentacion}} " >
    </div>
    <div class="col-sm-8 col-xs-12 ">
		<div class="col-sm-6 col-xs-12 ">
			<h2><strong>{{ $curso->nombre }}</strong></h2>
			<h4>{{ $curso->getTematica() }}</h4>
		</div>
		<div class="col-sm-6 col-xs-12">
			<center>
				<br>
				<h4>{{ $curso->getFechaInicio() }}</h4>
				  <a href="{{ route('curso.edit', $curso->id_curso) }}" class="btn btn-primary" style="width:100%">
					  Inscribirse al Curso
				  </a>
			</center>
		</div>
	</div>
</div>
<br>
<div class="col-sm-8 col-xs-12">
	<div class="div_list2">
		
	</div>
</div>
<div class="col-sm-4 col-xs-12">
	<div class="div_list2 espaciado">
		<table class="table table-condensed table-hover espaciado">
			<tr>
				<th colspan="3"><center>Datos del curso</center></th>
			</tr>
			<tr>
				<th width="5%"><span class="glyphicon glyphicon-time" aria-hidden="true"> </th>
				<th>Duración:</th>
				<td>{{ $curso->duracion }}</td>
			</tr>
			<tr>
				<th width="5%"><span class="glyphicon glyphicon-flag" aria-hidden="true"> </th>
				<th>Esfuerzo:</th>
				<td>{{ $curso->esfuerzo }}</td>
			</tr>
			<tr>
				<th width="5%"><span class="glyphicon glyphicon-usd" aria-hidden="true"> </th>
				<th>Precio:</th>
				<td>{{ $curso->precio }}</td>
			</tr>
			<tr>
				<th width="5%"><span class="glyphicon glyphicon-list" aria-hidden="true"> </th>
				<th>Temática:</th>
				<td>{{ $curso->getTematica()}}</td>
			</tr>
			<tr>
				<th width="5%"><span class="glyphicon glyphicon-certificate" aria-hidden="true"> </th>
				<th>Nivel:</th>
				<td>{{ $curso->nivel }}</td>
			</tr>
			<tr>
				<td colspan="3"><strong>Prerrequisitos:</strong> {{ $curso->prerrequisitos }}</td>
			</tr>
		</table>
	</div>
</div>
@stop

