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

</br></br>
@if ($action == 'Editar')
<a href="{{ URL::route('ver-curso-contenido', $curso->id_curso ) }}" class="btn btn-primary" >Regresar</a>
@else
<a href="{{ URL::route('editar-curso', $curso->id_curso ) }}" class="btn btn-primary" >Regresar</a>
@endif

<center>
	<h1>Crear lección para {{ $curso->nombre  }}</h1>
</center>

<a href="{{ URL::route('ver-curso-contenido', $curso->id_curso ) }}" class="btn btn-warning" target="_blank">Ver Lecciones del Curso</a>
</br>
</br>
<h3 id="mensajeerror" style="color:red;"></h3>
{{ Form::model($leccion, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre de la lección') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre de la lección', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('semana', 'Semana de publicación del contenido') }}
      {{ Form::select('semana', array('1'=>'Semana 1', '2'=>'Semana 2', '3'=>'Semana 3', '4'=>'Semana 4', '5'=>'Semana 5', '6'=>'Semana 6', '7'=>'Semana 7', '8'=>'Semana 8', '9'=>'Semana 9'), null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('contenido_grafico', 'Iframe del contenido gráfico (Youtube)') }}
      {{ Form::text('contenido_grafico', null, array('placeholder' => 'Introduce el iframe para el contenido visual', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-10">
      {{ Form::label('contenido_texto', 'Introduce el contenido de texto') }}
      {{ Form::textarea('contenido_texto', null, array('placeholder' => 'Introduce el contenido de texto', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-10">
      {{ Form::label('kinestesico', 'Introduce el contenido de Kinestésico') }}
      {{ Form::textarea('kinestesico', null, array('placeholder' => 'Introduce el contenido de Kinestésico', 'class' => 'form-control')) }}
    </div>
  </div>
  {{ Form::hidden('server_contenido_grafico', 'youtube') }}
  {{ Form::hidden('id_curso', $curso->id_curso) }}
  {{ Form::button($action . ' leccion', array('type' => 'submit', 'class' => 'btn btn-success')) }}

{{ Form::close() }}

<script src= "http://code.jquery.com/jquery-2.2.0.min.js" ></script>
<script>
$(function() {

  jQuery.ajax({
    url: '../../../existe-mensaje',
    data: { semana: 1, curso: $("[name=id_curso]").val() },
    success: function (result) {

      if(result == "0"){ $('#mensajeerror').text("Para poder visualizar el curso en la semana 1 debe agregar el mensaje semanal");  }
      else { $('#mensajeerror').text("");      }
    },
    async: false
  });

  $('#semana').on('change', function(){
      console.log("cambio: "+$(this).val()+" "+$("[name=id_curso]").val());

      jQuery.ajax({
        url: '../../../existe-mensaje',
        data: { semana: $(this).val(), curso: $("[name=id_curso]").val() },
        success: function (result) {

          if(result == "0"){ $('#mensajeerror').text("Para poder visualizar el curso en la semana "+$("#semana").val()+" debe agregar el mensaje semanal primero");  }
          else { $('#mensajeerror').text("");      }
        },
        async: false
      });

  });

});
</script>

@stop
