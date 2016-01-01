@extends ('template')

<?php

    if ($leccion->exists):
        $form_data = array('route' => array('leccion.update', $leccion->id_leccion), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'leccion.store', 'method' => 'POST');
        $action    = 'Crear';
    endif;

?>

@section ('title') {{ $action }} Leccion @stop

@section ('title_div') {{ $action }} Leccion @stop

@section ('contenido')

</br>

<center>
	<h1>Crear leccion para {{ $curso->nombre  }}</h1>
</center>

<h4 class="strong">Lecciones añadidas al mismo curso:</h4>
@foreach($curso->getAllLecciones() as $leccion)
	{{ $leccion->nombre }} - Semana {{ $leccion->semana }}</br>
@endforeach
</br>


{{ Form::model($leccion, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre de la lección') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del leccion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('semana', 'Semana de publicación del contenido') }}
      {{ Form::select('semana', array('1'=>'Semana 1', '2'=>'Semana 2', '3'=>'Semana 3', '4'=>'Semana 4', '5'=>'Semana 5', '6'=>'Semana 6', '7'=>'Semana 7', '8'=>'Semana 8', '9'=>'Semana 9'), null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('contenido_grafico', 'Iframe del contenido grafico (Youtube)') }}
      {{ Form::text('contenido_grafico', null, array('placeholder' => 'Introduce el iframe que te comparte youtube', 'class' => 'form-control')) }}
    </div>
     <div class="form-group col-md-10">
      {{ Form::label('contenido_texto', 'Introduce el contenido de texto') }}
      {{ Form::textarea('contenido_texto', null, array('placeholder' => 'Introduce el contenido de texto', 'class' => 'form-control')) }}
    </div>
  </div>
  {{ Form::hidden('server_contenido_grafico', 'youtube') }}
  {{ Form::hidden('id_curso', $curso->id_curso) }}
  {{ Form::button($action . ' leccion', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

{{ Form::close() }}



@stop
