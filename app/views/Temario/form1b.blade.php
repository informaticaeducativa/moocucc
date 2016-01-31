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
<a href="{{ URL::route('ver-curso-info', $curso->id_curso ) }}" class="btn btn-danger" >Regresar</a>
@else
<a href="{{ URL::route('editar-curso', $curso->id_curso ) }}" class="btn btn-danger" >Regresar</a>
@endif

<h2>Crear mensajes de inicio del curso {{ $curso->nombre }}</h2>

<a href="{{ URL::route('ver-curso-info', $curso->id_curso ) }}" class="btn btn-primary" target="_blank">Ver mensajes de inicio del Curso</a>
</br>
</br>

{{ Form::model($temario, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-10">
      {{ Form::label('titulo', 'Título del Contenido') }}
      {{ Form::text('titulo', null, array('placeholder' => 'Introduce el título del contenido', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-10">
      {{ Form::label('contenido', 'Contenido de inicio') }}
      {{ Form::textarea('contenido', null, array('placeholder' => 'Introduce el contenido', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-10">
      {{ Form::label('usuario', 'Quien publica el contenido') }}
      {{ Form::select('usuario', array( '1'=>'Mio', ''=>'Todos los profesores' ), null, array('class' => 'form-control')) }}
    </div>

  </div>
  {{ Form::hidden('id_curso', $curso->id_curso) }}
  {{ Form::hidden('tipo_contenido', 'inicio') }}

  {{ Form::button($action . ' temario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

{{ Form::close() }}



@stop
