@extends ('template')

@section ('title') Asignar Colores de Badges a {{ $curso->nombre }} @stop


@section ('contenido')

<br/>
<a href="{{ URL::route('editar-curso', $curso->id_curso ) }}" class="btn btn-danger" >Regresar</a>
    <script type="text/javascript" src="{{URL::to('js/canvas1.js')}}"></script>

    <style>
       body{
            background: #999999;
       }
 </style>

 <h1 class="strong text-center">Colores para los Badges</h1>
 <h3 class="strong text-right">Curso: {{$curso->nombre}}</h3>
    <table>
      <tr>
        <th>
          Primer Color:
        </th>
        <td>
          <input name="color1" id="color1" class="form-control" type="color" value="{{$badge->color1}}" />
        </td>
      </tr>
      <tr>
        <th>
          Segundo Color:
        </th>
        <td>
          <input name="color2" id="color2" class="form-control" type="color" value="{{$badge->color2}}" />
        </td>
      </tr>
      <tr>
        <th>
          <button type="button" name="button" class="btn btn-info" onclick="generarBadges()">Visualización</button>
        </th>
        <th>
          <button type="button" name="button_guardar_colores" id="button_guardar_colores" class="btn btn-primary" >Guardar Colores</button>
        </th>
      </tr>
      <tr>
        <th colspan="2">
          <div id="label_colores" class="text-center" style="color:blue;display:none;">Datos Guardados</div>
        </th>
      </tr>
    </table>
    <input type="hidden" name="id_curso" id="id_curso" value="{{$curso->id_curso}}">

    <br/>
    <canvas id="canvas1" width="140" height="140"></canvas>
    <canvas id="canvas2" width="140" height="140"></canvas>
    <canvas id="canvas3" width="140" height="140"></canvas>
    <canvas id="canvas4" width="140" height="140"></canvas>
    <canvas id="canvas5" width="140" height="140"></canvas>
    <canvas id="canvas6" width="140" height="140"></canvas>
    <canvas id="canvas7" width="140" height="140"></canvas>
    <canvas id="canvas8" width="140" height="140"></canvas>
    <canvas id="canvas9" width="140" height="140"></canvas>
    <canvas id="canvas10" width="140" height="140"></canvas>
    <canvas id="canvas11" width="140" height="140"></canvas>
    <canvas id="canvas12" width="140" height="140"></canvas>

    <canvas id="canvas_completo" width="140" height="140"></canvas>

<script type="text/javascript">
  generarBadges();

//boton guardar colores
$("#button_guardar_colores").click(function() {

  var curso = $("#id_curso").val();
  var color1 = $("#color1").val();
  var color2 = $("#color2").val();

  jQuery.ajax({
    url: '../../../../guardar_color',
    data: {curso: curso, color1: color1, color2: color2 },
    success: function (result) {
      console.log(result);
    },
    async: true
  });


});
</script>

@stop
