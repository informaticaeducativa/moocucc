@extends ('template')

<?php

    if ($evaluacion->exists):
        $form_data = array('route' => array('evaluacion.update', $evaluacion->id_evaluacion), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'evaluacion.store', 'method' => 'POST');
        $action    = 'Crear';
    endif;

?>

@section ('title') {{ $action }} Evaluacion @stop

@section ('title_div') {{ $action }} Evaluacion @stop

@section ('contenido')
</br></br>
<a href="{{ URL::route('editar-curso', $curso->id_curso ) }}" class="btn btn-danger" >Regresar</a>

<center>
	<h1>Crear Evaluación para {{ $curso->nombre  }}</h1>
</center>

<a href="{{ URL::route('ver-curso-tareas', $curso->id_curso ) }}" class="btn btn-primary" target="_blank">Ver Evaluaciones del Curso</a>
</br>
</br>

{{ Form::model($evaluacion, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))
  
  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre o título de la Evaluacion') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del leccion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('semana', 'Semana de publicación del examen') }}
      {{ Form::select('semana', array('1'=>'Semana 1', '2'=>'Semana 2', '3'=>'Semana 3', '4'=>'Semana 4', '5'=>'Semana 5', '6'=>'Semana 6', '7'=>'Semana 7', '8'=>'Semana 8', '9'=>'Semana 9'), null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('calificable', 'Examen calificable?') }}
      {{ Form::select('calificable', array('si'=>'Si', 'no'=>'No'), null, array('class' => 'form-control')) }}
    </div>
  </div>

  {{ Form::hidden('id_curso', $curso->id_curso) }}

  {{ Form::button($action . ' evaluacion', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

{{ Form::close() }}

<hr>
</br>
<h4 class="strong">Evaluaciones añadidas al mismo curso:</h4>
@foreach($curso->getAllEvaluaciones() as $evaluacion)
	<table width="100%" class="table table-hover">
		<tr>
			<th width="30%">
				<strong>{{ $evaluacion->nombre }}</strong>
			</th>
			<th style="vertical-align:middle;">
				<a href="{{ URL::route('ver-tarea', array($curso->id_curso, $evaluacion->id_evaluacion) ) }}" class="btn btn-info" target="_blank">Ver preguntas</a>
			</th>
			<th style="vertical-align:middle;">
				<a href="{{ URL::route('crear-curso-8', $evaluacion->id_evaluacion ) }}" class="btn btn-info">Agregar preguntas</a>
			</th>
		</tr>		
		
	</table>
@endforeach
</br></br>


@stop



