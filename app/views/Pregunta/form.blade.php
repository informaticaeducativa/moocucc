@extends ('template')

<?php

    if ($pregunta->exists):
        $form_data = array('route' => array('pregunta.update', $pregunta->id_pregunta), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'pregunta.store', 'method' => 'POST');
        $action    = 'Crear';
    endif;

?>

@section ('title') {{ $action }} Pregunta @stop

@section ('title_div') {{ $action }} Pregunta @stop

@section ('contenido')

</br>
</br>
@if ($action == 'Editar')
<a href="{{ URL::route('ver-tarea', array( $evaluacion->getIdCurso(), $evaluacion->id_evaluacion )  ) }}" class="btn btn-danger" >Regresar</a>
@else
<a href="{{ URL::route('crear-curso-7', $evaluacion->getIdCurso() ) }}" class="btn btn-danger" >Regresar</a>
@endif

<center>
	<h1>Crear Pregunta para {{ $evaluacion->nombre  }}</h1>
</center>

<a href="{{ URL::route('ver-tarea', array($evaluacion->getIdCurso(), $evaluacion->id_evaluacion) ) }}" class="btn btn-primary" target="_blank">Ver Presentación del examen</a>
</br></br>

{{ Form::model($pregunta, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
   <div class="form-group col-md-10">
      {{ Form::label('nombre', 'Pregunta') }}
      {{ Form::textarea('nombre', null, array('placeholder' => 'Introduce la pregunta', 'class' => 'form-control')) }}
   </div>
   <div class="form-group col-md-5">
      {{ Form::label('opcion_multiple', 'Pregunta de opcion multiple?') }}
      {{ Form::select('opcion_multiple', array('si'=>'Si', 'no'=>'No'), null, array('class' => 'form-control')) }}
    </div>
   </div>
  <div class="row" id="row_opciones">
    <div class="form-group col-md-5">
      {{ Form::label('opcion_a', 'Opcion A') }}
      {{ Form::text('opcion_a', null, array('placeholder' => 'Introduce la opcion de respuesta A', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('opcion_b', 'Opcion B') }}
      {{ Form::text('opcion_b', null, array('placeholder' => 'Introduce la opcion de respuesta B', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('opcion_c', 'Opcion C') }}
      {{ Form::text('opcion_c', null, array('placeholder' => 'Introduce la opcion de respuesta C', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('opcion_d', 'Opcion D') }}
      {{ Form::text('opcion_d', null, array('placeholder' => 'Introduce la opcion de respuesta D', 'class' => 'form-control')) }}
    </div>
  </div>
  <div class="row">
   <div class="form-group col-md-5">
      {{ Form::label('respuesta', 'Respuesta a la pregunta') }}
      {{ Form::text('respuesta', null, array('placeholder' => 'Letra en caso de ser opcion multiple, sino la respuesta como tal', 'class' => 'form-control')) }}
    </div>

  </div>
  {{ Form::hidden('id_evaluacion', $evaluacion->id_evaluacion) }}
  {{ Form::hidden('tipo', 'multiple') }}

  {{ Form::button($action . ' pregunta', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

{{ Form::close() }}


<script src= "http://code.jquery.com/jquery-2.2.0.min.js" ></script>
<script>

 $("#opcion_multiple" ).change(function()
  {
	  if( $("#opcion_multiple" ).val() == 'no'){
		 $("#opcion_a").val("x");
		 $("#opcion_b").val("x");
		 $("#opcion_c").val("x");
		 $("#opcion_d").val("x");
		 $("#row_opciones").hide();
	  }
	  else
	  {
		 $("#opcion_a").val("");
		 $("#opcion_b").val("");
		 $("#opcion_c").val("");
		 $("#opcion_d").val("");
		 $("#row_opciones").show();
	  }
  });

</script>

@stop
