@extends ('template2')

@section ('title') {{ $curso->nombre }} - MOOC UCC @stop

@section ('boton')
<p><a href="{{ route('curso.create') }}" class="btn btn-primary">Crear un nuevo curso</a></p>
@stop


@section ('contenido')
<br>

<div class="div col-sm-12 col-xs-12 ">
  <div class="col-sm-4 col-xs-12">
    <img class="imagen_div" src="../imagenes/{{$curso->imagen_presentacion}} " >
  </div>
  <div class="col-sm-8 col-xs-12 ">
    <div class="col-sm-6 col-xs-12 ">
      <h2 class="strong">{{ $curso->nombre }}</h2>
      <h4>{{ $curso->getTematica() }}</h4>
    </div>
    <div class="col-sm-6 col-xs-12">
      <center>
        <br>
        <h4>{{ $curso->getFechaInicio() }}</h4>
        
        @if($inscrito == 1)
        <a href="{{ URL::route('ver-curso-info', $curso->id_curso) }}">
	        <button type="button" class="btn btn-primary btn-lg btn-block">Seguir al Curso</button>
		</a>
		@else 
	        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Inscribirse al Curso</button>
        @endif
      </center>
    </div>
  </div>
</div>
<br>
<div class="col-sm-8 col-xs-12 div_list2">
  <div class="col-md-12 col-sm-12 col-xs-12">
    @foreach ($curso->getTemarios() as $temario)
    <div class="espaciado">
      <h3 class="strong">{{ $temario->titulo }}</h3>
      {{ $temario->contenido }}
    </div>
    @endforeach

    <header>
      <h3 class="strong">
        Profesores Del Curso
      </h3>
    </header>

    @foreach ($curso->getProfesoresAdmin() as $profe)
    <div class="col-md-4 col-sm-6 col-xs-12 espaciado ">
      <center>
        <h4 class="strong">{{ $profe->tipo_relacion }}</h4>
        <img class="imagen_redonda" src="../imagenes/fotos/{{ $profe->getProfesor()->foto  }} " ><br>

        <p class=strong>
          {{ $profe->getProfesor()->nombre." ".$profe->getProfesor()->apellido }}
        </p>
        {{ $profe->getProfesor()->titulo }}<br><br>
      </center>
    </div>
    @endforeach
    @foreach ($curso->getProfesoresAsistentes() as $profe)
    <div class="col-md-4 col-sm-6 col-xs-12 espaciado ">
      <center>
        <h4 class="strong">{{ $profe->tipo_relacion }}</h4>
        <img class="imagen_redonda" src="../imagenes/fotos/{{ $profe->getProfesor()->foto  }} " ><br>

        <p class="strong">
          {{ $profe->getProfesor()->nombre." ".$profe->getProfesor()->apellido }}
        </p>
        {{ $profe->getProfesor()->titulo }}<br><br>
      </center>
    </div>
    @endforeach
  </div>
</div>
<div class="col-sm-4 col-xs-12 ">
  <div class="div_list2 espaciado">
    <table class="table-curso-detalles">
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
        <td colspan="3"><span class="strong">Prerrequisitos:</span> {{ $curso->prerrequisitos }}</td>
      </tr>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Inscripción</h4>
      </div>
      <div class="modal-body">
        ¿ Está seguro de querer inscribirse en el curso {{ $curso->nombre }} ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          {{ HTML::linkRoute('ver-curso-info', 'Inscribirme', array($curso->id_curso), array('class' => 'btn btn-primary')) }}
      </div>
    </div>
  </div>
</div>

@stop
