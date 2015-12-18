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
  <p>
    <a href="{{ route('pregunta.index') }}" class="btn btn-info">Lista de Preguntas</a>
  </p>

<br>

{{ Form::model($pregunta, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre del pregunta') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del pregunta', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('fecha_inicio', 'Fecha de inicio') }}
      {{ Form::input('date', 'fecha_inicio', null, array('placeholder' => 'Introduce la fecha de inicio del pregunta', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('imagen_presentacion', 'Imagen del pregunta') }}
      {{ Form::file('imagen_presentacion', null, array('placeholder' => 'Introduce la imagen del pregunta', 'class' => 'form-control')) }}        
    </div>
     <div class="form-group col-md-5">
      {{ Form::label('comienzo', 'Comienzo del pregunta') }}
      {{ Form::text('comienzo', null, array('placeholder' => 'Introduce cuando comienza el pregunta', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('id_tematica', 'Tematica del pregunta') }}
      {{ Form::select('id_tematica', $tematicas, null, array('placeholder' => 'Introduce cuando comienza el pregunta', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('nivel', 'Nivel del pregunta') }}
      {{ Form::select('nivel',  array('Principiante' => 'Principiante', 'Medio' => 'Medio', 'Avanzado'=>'Avanzado'), null, array('class' => 'form-control')) }}        
    </div>
  </div>
  
  {{ Form::button($action . ' pregunta', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}



@stop  
