@extends ('template')

<?php
    if ($temario->exists):
        $form_data = array('route' => array('temario.update', $temario->id_temario), 'method' => 'PATCH', 'files'=> true);
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'temario.store', 'method' => 'POST', 'files'=> true);
        $action    = 'Crear';
    endif;
?>

@section ('title') {{ $action }} Temario @stop

@section ('title_div') {{ $action }} Temario @stop

@section ('contenido')
<br><br>
<br><br>
@if ($action == 'Editar')
<a href="{{ URL::route('ver-curso-contenido', $curso->id_curso ) }}" class="btn btn-primary" >Regresar</a>
@else
<a href="{{ URL::route('editar-curso', $curso->id_curso ) }}" class="btn btn-primary" >Regresar</a>
@endif

<br>
<h2>Crear mensaje semanal del curso del curso {{ $curso->nombre }}</h2>

<a href="{{ URL::route('ver-curso-contenido', $curso->id_curso ) }}" class="btn btn-warning" target="_blank">Ver mensajes semanales del Curso</a>
</br>
</br>

{{ Form::model($temario, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-10">
      {{ Form::label('posicion', 'Semana de Contenido') }}
      {{ Form::select('posicion', array('1'=>'Semana 1', '2'=>'Semana 2', '3'=>'Semana 3', '4'=>'Semana 4', '5'=>'Semana 5', '6'=>'Semana 6', '7'=>'Semana 7', '8'=>'Semana 8', '9'=>'Semana 9'), null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-10">
      {{ Form::label('contenido', 'Contenido de inicio') }}
      {{ Form::textarea('contenido', null, array('placeholder' => 'Introduce el contenido', 'class' => 'form-control')) }}
    </div>

  </div>
  {{ Form::hidden('id_curso', $curso->id_curso) }}
  {{ Form::hidden('tipo_contenido', 'semana') }}
  {{ Form::hidden('titulo', 'xxxxxxxxxxx') }}

  {{ Form::button($action . ' temario', array('type' => 'submit', 'class' => 'btn btn-success')) }}

{{ Form::close() }}



@stop
