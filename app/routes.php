<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//RUTAS API
Route::group(array('prefix' => 'api'), function()
{

  Route::get('badges', function()
  {
    $data = Input::all();
    if(isset( $data['usuario_id']) && isset( $data['curso_id']) ){
      $cursos = Curso::where('nombre', 'ILIKE', '%'.$data['texto-buscar'].'%')->get();
      $usuario = Usuario::find(Session::get('user_id'));
      $cursos = $usuario->misCursos();
      $avances = Avance::where('tipo','=','evaluacion')->where('id_usuario','=',$usuario->id)->orderBy('id_curso','DESC')->orderBy('fecha','ASC')->get();

    }
    else{
      return Response::json( array("result"=>"error") );
    }
  });

  Route::get('usuarios', function()
  {
    $usuarios = Usuario::all();
    return Response::json( $usuarios );
  });

  Route::get('temarios', function()
  {
    $data = Input::all();
    if( isset( $data['id_curso']) &&  isset($data['tipo_contenido']) ){
      $temarios = Temario::where('id_curso', '=', $data['id_curso'])->where('tipo_contenido', '=', $data['tipo_contenido'])->get();
    }
    else if( isset( $data['id_curso'] )){
      $temarios = Temario::where('id_curso', '=', $data['id_curso'])->get();
    }
    else
    {
      $temarios = Temario::all();
    }
    return Response::json( $temarios );
  });

  Route::get('usuario/id/{id}', function($id)
  {
    $usuario = Usuario::where('id', '=', $id)->get();
    return Response::json( $usuario );
  });

  Route::get('usuario/social/{id_social}', function($id_social)
  {
    $usuario = Usuario::where('id_social', '=', $id_social)->get();
    return Response::json( $usuario );
  });

  Route::get('tematicas', function()
  {
    $tematicas = Tematica::all();
    return Response::json( $tematicas );
  });

  Route::get('tematica/{id}', function($id)
  {
    $tematica = Tematica::where('id_tematica', '=', $id)->get();
    return Response::json( $tematica );
  });

  //  /rest/cursos
  //  /rest/cursos?texto-buscar
  Route::get('cursos', function()
  {
    $data = Input::all();
    if(isset( $data['texto-buscar'] )){
      $cursos = Curso::where('nombre', 'ILIKE', '%'.$data['texto-buscar'].'%')->get();
    }
    else{
      $cursos = Curso::where('id_curso', '<>', '0')->get();
    }
    return Response::json( $cursos );
  });

  Route::get('curso/{id}', function($id)
  {
    $cursos = Curso::where('id_curso', '=', $id)->get();
    return Response::json( $cursos );
  });

  Route::get('curso_usuario/{user_id}', function($user_id)
  {
    $user_courses = DB::table('relacion_usuario_curso')->where('id_usuario', '=', $user_id)->get();
    return Response::json(($user_courses));
  });

  //  /rest/desuscribir/{idusuario}/curso/{idcurso}
  Route::get('desuscribir/{idusuario}/curso/{idcurso}', function($idusuario, $idcurso)
  {
    $value = RelacionUsuarioCurso::where('tipo_relacion', '=', 'Estudiante')->where('id_usuario', '=', $idusuario)->where('id_curso', '=', $idcurso)->update(array('estado' => 'inactivo'));
    return Response::json( $value );
  });

  //  /rest/agregar-ciudad/{nombre}
  Route::get('agregar-ciudad/{nombre}', function($nombre)
  {
    $ciudad = $nombre;
    $ciudad = strtoupper( substr($ciudad, 0,1) ).strtolower( substr($ciudad, 1, strlen($ciudad)-1) );
    if( DB::table('ciudad')->where('nombre', $ciudad)->count() == 0 ){
      DB::table('ciudad')->insert(array('nombre' => $ciudad));
    }
    $ciudades = DB::table('ciudad')->get();
    return Response::json(($ciudades));
  });

  //  /rest/agregar-pais/{nombre}
  Route::get('agregar-pais/{nombre}', function($nombre)
  {
    $pais = $nombre;
    $pais = strtoupper( substr($pais, 0,1) ).strtolower( substr($pais, 1, strlen($pais)-1) );
    if( DB::table('pais')->where('nombre', $pais)->count() == 0 ){
      DB::table('pais')->insert(array('nombre' => $pais));
    }
    $paises = DB::table('pais')->get();
    return Response::json(($paises));
  });

  //  /rest/agregar-universidad/{nombre}
  Route::get('agregar-universidad/{nombre}', function($nombre)
  {
    $universidad = $nombre;
    $universidad = strtoupper( substr($universidad, 0,1) ).strtolower( substr($universidad, 1, strlen($universidad)-1) );
    if( DB::table('universidad')->where('nombre', $universidad)->count() == 0 ){
      DB::table('universidad')->insert(array('nombre' => $universidad));
    }
    $universidades = DB::table('universidad')->get();
    return Response::json(($universidades));
  });
  // add course to user
  Route::post('assign-course', function()
  {
    $data = Input::all();
    $course_id = $data['course_id'];
    $user_id = $data['user_id'];
    DB::table('relacion_usuario_curso')->insert(array('id_usuario' => $user_id, 'id_curso' => $course_id, 'tipo_relacion' => 'Estudiante', 'fecha_creacion' => date('Y-m-d H:i:s'), 'estado' => 'activo'));
    return 0;
  });

  // /api/classes
  Route::get('classes', function()
  {
    $data = Input::all();
    if (array_key_exists('week_id', $data) && array_key_exists('course_id', $data)) {
      $week = $data['week_id'];
      $course = $data['course_id'];
      $classes = Leccion::where('semana', '=', $week)
      ->where('id_curso', '=', $course)
      ->get();
    } elseif (array_key_exists('course_id', $data)) {
      $course = $data['course_id'];
      $classes = Leccion::where('id_curso', '=', $course)->get();
    } else {
      $classes = Leccion::all();
    }
    return Response::json($classes);
  });

  // /api/tests
  Route::get('tests', function()
  {
    $data = Input::all();
    if (array_key_exists('week_id', $data) && array_key_exists('course_id', $data)) {
      $week = $data['week_id'];
      $course = $data['course_id'];
      $tests = Evaluacion::where('semana', '=', $week)
      ->where('id_curso', '=', $course)
      ->get();
    } elseif (array_key_exists('course_id', $data)) {
      $course = $data['course_id'];
      $tests = Evaluacion::where('id_curso', '=', $course)->get();
    } else {
      $tests = Evaluacion::all();
    }
    return Response::json($tests);
  });
  // /api/questions
  Route::get('questions', function()
  {
    $data = Input::all();
      if (array_key_exists('test_id', $data)) {
      $test = $data['test_id'];
      $questions = Pregunta::where('id_evaluacion', '=', $test)->get();
    } else {
      $questions = Pregunta::all();
    }
    return Response::json($questions);
  });

  // /api/grade?id

  Route::get('grade', function()
  {
    $data = Input::all();
    $test = $data['test_id'];
    $user = $data['user_id'];
    $grade = Calificacion::where('id_evaluacion', '=', $test)->where('id_usuario', '=', $user)->get();
    return Response::json($grade);
  });

  // POST /api/grade

  Route::post('grade', function()
  {
    $data = Input::all();
    $test = $data['test_id'];
    $user = $data['user_id'];
    $grade = $data['grade'];
    $attemps = $data['attemps'];
    $course = $data['course_id'];
    $date = $data['date'];
    Calificacion::insert(array('id_usuario' => $user, 'id_evaluacion' => $test, 'nota' => $grade, 
                              'fecha' => $date ,'id_curso' => $course, 'intentos' => $attemps));
    return 0;
  });

  // PUT /api/grade

  Route::put('grade', function()
  {
    $data = Input::all();
    $test = $data['test_id'];
    $user = $data['user_id'];
    $grade = $data['grade'];
    $attemps = $data['attemps'];
    Calificacion::where('id_evaluacion', '=', $test)->where('id_usuario', '=', $user)
            ->update(array('nota' => $grade, 'intentos' => $attemps));
    return 0;
  });

  // /api/test/{test_id}
  Route::get('test/{test_id}', function($test_id)
  {
    $test = Evaluacion::where('id_evaluacion', '=', $test_id)->get();
    return Response::json(($test));
  });

  // /api/class/{class_id}
  Route::get('class/{class_id}', function($class_id)
  {
    $class = Leccion::where('id_leccion', '=', $class_id)->get();
    return Response::json(($class));
  });

  //  /rest/ciudades
  Route::get('listar-ciudades', function()
  {
    $ciudades = DB::table('ciudad')->get();
    return Response::json(($ciudades));
  });

  //filter city by id
  Route::get('ciudad/{city_id}', function($city_id)
  {
    $city = DB::table('ciudad')->where('id_ciudad', '=', $city_id)->get();
    return Response::json(($city));
  });

  //  /rest/paises
  Route::get('listar-paises', function()
  {
    $paises = DB::table('pais')->get();
    return Response::json(($paises));
  });

  //filter country by id
  Route::get('pais/{country_id}', function($country_id)
  {
    $country = DB::table('pais')->where('id_pais', '=', $country_id)->get();
    return Response::json(($country));
  });

  //  /rest/universidades
  Route::get('listar-universidades', function()
  {
    $universidades = DB::table('universidad')->get();
    return Response::json(($universidades));
  });

  //filter university by id
  Route::get('universidad/{university_id}', function($university_id)
  {
    $university = DB::table('universidad')->where('id_universidad', '=', $university_id)->get();
    return Response::json(($university));
  });

  //  /rest/test
  Route::get('test', function()
  {
    $data = Input::all();
    if(!isset( $data['prueba'] )){  $data['prueba']='';	}
    return Response::json( "Mensaje secreto: ".$data['prueba'] );
  });

});



//
//RUTAS DEL INDEX
//
Route::get('/', function()
{
  /*
  Session::put('user_id', '1');
  Session::put('user', 'Mark Gonzalez');
  Session::put('inteligencia', 'kinestesico');
  Session::put('tipo_usuario', 'Administrador');
  Session::put('titulo', 'Estudiante');
  */

  $cursos = Curso::where('id_curso', '<>', '0')->get();
  return View::make('index')->with('cursos', $cursos)->with('palabra', '');
});


Route::get('index',  array('as' => 'index',function()
{

  $cursos = Curso::where('id_curso', '<>', '0')->get();
  return View::make('index')->with('cursos', $cursos)->with('palabra', '');

}));

Route::post('index',  array('as' => 'index',function()
{
  $data = Input::all();
  $palabra = $data['texto-buscar'];
  $cursos = Curso::where('nombre', 'ILIKE', '%'.$palabra.'%')->get();
  return View::make('index')->with('cursos', $cursos)->with('palabra', $palabra);
}));

Route::get('logout',  array('as' => 'logout',function()
{
  Session::flush();
  return Redirect::to('index');
}));



//Ver usuario (todos)
Route::get('usuario/{id}', array('as'=>'usuario','uses'=> 'UsuarioController@show' ))->where('id', '[0-9]+');



//
//RUTAS DE ELEMENTOS LLAMADOS POR AJAX
//
Route::get('listar-imagenes', array('as' => 'listar-imagenes', function()
{
  $directorio = opendir("./imagenes"); //ruta actual
  $todos =  array();
  while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
  {
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
    }
    else if( strtolower(substr($archivo, strlen($archivo)-3, strlen($archivo) )) == "jpg" ||
    strtolower(substr($archivo, strlen($archivo)-3, strlen($archivo) )) == "png" ||
    strtolower(substr($archivo, strlen($archivo)-3, strlen($archivo) )) == "gif"
    )
    {
      $todos[] =  array("title"=>$archivo,"value" => $archivo);
    }
  }
  return Response::json( ($todos) );
}));


Route::get('desuscribir', array('as' => 'desuscribir', function()
{
  $data = Input::all();
  $id = $data['curso'];
  $usuario = Session::get('user_id');
  //RelacionUsuarioCurso::where('tipo_relacion', '=', 'Estudiante')->where('id_usuario', '=', $usuario)->where('id_curso', '=', $id)->update(array('estado' => 'inactivo'));
  return Response::json( "".$id );
}));

Route::get('existe-mensaje', function()
{
  $data = Input::all();
  $semana = $data['semana'];
  $curso = $data['curso'];

  $cantidad = DB::table('temario')->where('posicion', $semana)->where('id_curso', $curso)->where('tipo_contenido', 'semana')->count();
  return Response::json( "".$cantidad );

});


Route::get('agregar-datos', function()
{
  $data = Input::all();
  $universidad = $data['universidad'];
  $ciudad = $data['ciudad'];
  $pais = $data['pais'];
  $titulo = $data['titulo'];
  $id = Session::get('user_id');
  DB::table('usuario')->where('id', $id)->update(array('ciudad' => $ciudad, 'pais' => $pais, 'universidad' => $universidad, 'titulo' => $titulo ));
  Session::put('titulo', $titulo);
  return Response::json((  $ciudad.' '.$pais.' '.$universidad.' '.$titulo.' '.$id ));
});
Route::get('agregar-ciudad', function()
{
  $data = Input::all();
  $ciudad = $data['nombre'];
  $ciudad = strtoupper( substr($ciudad, 0,1) ).strtolower( substr($ciudad, 1, strlen($ciudad)-1) );
  if( DB::table('ciudad')->where('nombre', $ciudad)->count() == 0 ){
    DB::table('ciudad')->insert(array('nombre' => $ciudad));
  }
  $ciudades = DB::table('ciudad')->get();
  return Response::json(($ciudades));
});
Route::get('agregar-pais', function()
{
  $data = Input::all();
  $pais = $data['nombre'];
  $pais = strtoupper( substr($pais, 0,1) ).strtolower( substr($pais, 1, strlen($pais)-1) );
  if( DB::table('pais')->where('nombre', $pais)->count() == 0 ){
    DB::table('pais')->insert(array('nombre' => $pais));
  }
  $paises = DB::table('pais')->get();
  return Response::json(($paises));
});
Route::get('agregar-universidad', function()
{
  $data = Input::all();
  $universidad = $data['nombre'];
  $universidad = strtoupper( substr($universidad, 0,1) ).strtolower( substr($universidad, 1, strlen($universidad)-1) );
  if( DB::table('universidad')->where('nombre', $universidad)->count() == 0 ){
    DB::table('universidad')->insert(array('nombre' => $universidad));
  }
  $universidades = DB::table('universidad')->get();
  return Response::json(($universidades));
});

Route::get('listar-ciudades', function()
{
  $ciudades = DB::table('ciudad')->get();
  return Response::json(($ciudades));
});
Route::get('listar-paises', function()
{
  $paises = DB::table('pais')->get();
  return Response::json(($paises));
});
Route::get('listar-universidades', function()
{
  $universidades = DB::table('universidad')->get();
  return Response::json(($universidades));
});

Route::get('obtener-inteligencia',  function()
{
  return Session::get('inteligencia');
});

Route::get('obtener-inscritos',  function()
{
  $data = Input::all();
  $id = $data['curso'];
  $curso = Curso::find($id);
  return $curso->getInscritosJSON();
});

Route::get('obtener-inscritos-universidad',  function()
{
  $data = Input::all();
  $id = $data['curso'];
  $curso = Curso::find($id);
  return $curso->getInscritosUniversidadJSON();
});

Route::get('obtener-demografia',  function()
{
  $data = Input::all();
  $id = $data['curso'];
  $curso = Curso::find($id);
  return $curso->getDemografiaJSON();
});

Route::get('obtener-demografia-pais',  function()
{
  $data = Input::all();
  $id = $data['curso'];
  $curso = Curso::find($id);
  return $curso->getDemografiaPaisJSON();
});

Route::get('validar-quiz',  function()
{
  $data = Input::all();

  $leccion = $data['leccion'];
  $preguntas = $data['preguntas'];
  $respuestas = $data['respuestas'];
  $evaluacion = Evaluacion::find($leccion);
  $postData = $evaluacion->getPreguntasQuiz();
  $respuestas_buenas=0;
  $contador=0;

  foreach ($postData as $pregunta)
  {
    if($pregunta["respuesta"] === $respuestas[$contador])
    {
      $respuestas_buenas++;
    }
    $contador++;
  }

  $intentos = 1;
  $nota = intval(($respuestas_buenas*100 / $contador));
  $avanza = "no";


  $count = Calificacion::where('id_usuario', '=', Session::get('user_id'))->where('id_curso','=', $evaluacion->id_curso)->where('id_evaluacion', '=', $leccion)->count();
  if ($count == 0){
    DB::table('calificacion')->insert(	array('id_usuario' => Session::get('user_id'), 'id_curso' => $evaluacion->id_curso, 'id_evaluacion' => $leccion, 'nota' => $nota, 'intentos' => $intentos, 'fecha' => date('Y-m-d H:i:s') )	);
  }
  else
  {
    $intentos = Calificacion::where('id_usuario', '=', Session::get('user_id'))->where('id_curso','=', $evaluacion->id_curso)->where('id_evaluacion', '=', $leccion)->sum('intentos');
    $intentos = $intentos + 1;
    $nota2 = Calificacion::where('id_usuario', '=', Session::get('user_id'))->where('id_curso','=', $evaluacion->id_curso)->where('id_evaluacion', '=', $leccion)->sum('nota');
    if($nota > $nota2)
    {
      Calificacion::where('id_usuario', '=', Session::get('user_id'))->where('id_curso','=', $evaluacion->id_curso)->where('id_evaluacion', '=', $leccion)->update(array('nota' => $nota, 'fecha' => date('Y-m-d H:i:s'), 'intentos' => $intentos));
    }
    else
    {
      Calificacion::where('id_usuario', '=', Session::get('user_id'))->where('id_curso','=', $evaluacion->id_curso)->where('id_evaluacion', '=', $leccion)->update(array('intentos' => $intentos));
    }
  }
  if($nota >= 70)
  { //ERROR DETECTADO
    $count0 = Avance::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $evaluacion->id_curso)->where('semana','=', $evaluacion->semana)->where('tipo','=', 'evaluacion')->count();
    if($count0 == 0){
      $count = Calificacion::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $evaluacion->id_curso)->count();
      $count2 = Evaluacion::where('id_curso', '=', $evaluacion->id_curso)->where('semana','<=', $evaluacion->semana)->where('semana','>', 0)->count();
      $count3 = Evaluacion::where('id_curso', '=', $evaluacion->id_curso)->where('semana','>', 0)->count();
      //EXCEPCION DE PORCENTAJE
      if($count3 == 0)
      {
        $porcentaje = 0;
      }
      else
      {
        $porcentaje = intval($count*100/$count3);
      }

      if($count == $count2)
      {
        DB::table('avance')->insert(	array('id_usuario' => Session::get('user_id'), 'id_curso' => $evaluacion->id_curso, 'semana' => $evaluacion->semana, 'tipo' => 'evaluacion', 'porcentaje'=>$porcentaje ,'fecha' => date('Y-m-d H:i:s') ) );
        $avanza = "si";
        if($porcentaje == 100)
        {
          $avanza = "completo";
        }
      }
    }
  }

  return $nota."x".$avanza;

});

Route::get('validar-inteligencia',  function()
{
  $data = Input::all();

  $preguntas = $data['preguntas'];
  $respuestas = $data['respuestas'];
  $evaluacion = Evaluacion::find(0);
  $postData = $evaluacion->getPreguntasQuiz();
  $contador=0;
  $kinestesico=0;
  $linguistico=0;
  $visual=0;
  $musical=0;
  $logico=0;
  $intrapersonal=0;
  $interpersonal=0;
  $maximo = 0;
  $ganador = "Kinestésico";

  foreach ($postData as $pregunta)
  {
    if($pregunta["respuesta"] === "Kinestésico")
    {
      $kinestesico += $respuestas[$contador];
      if($kinestesico>$maximo){
        $maximo = $kinestesico;
        $ganador = "Kinestésico";
      }
    }
    else if($pregunta["respuesta"] === "Visual")
    {
      $visual += $respuestas[$contador];
      if($visual>$maximo){
        $maximo = $visual;
        $ganador = "Visual";
      }
    }
    else if($pregunta["respuesta"] === "Lingüístico")
    {
      $linguistico += $respuestas[$contador];
      if($linguistico>$maximo){
        $maximo = $linguistico;
        $ganador = "Lingüístico";
      }
    }
    else if($pregunta["respuesta"] === "Musical")
    {
      $musical += $respuestas[$contador];
      if($musical>$maximo){
        $maximo = $musical;
        $ganador = "Musical";
      }
    }
    else if($pregunta["respuesta"] === "Lógico")
    {
      $logico += $respuestas[$contador];
      if($logico>$maximo){
        $maximo = $logico;
        $ganador = "Lógico";
      }
    }
    else if($pregunta["respuesta"] === "Interpersonal")
    {
      $interpersonal += $respuestas[$contador];
      if($interpersonal>$maximo){
        $maximo = $interpersonal;
        $ganador = "Interpersonal";
      }
    }
    else if($pregunta["respuesta"] === "Intrapersonal")
    {
      $intrapersonal += $respuestas[$contador];
      if($intrapersonal>$maximo){
        $maximo = $intrapersonal;
        $ganador = "Intrapersonal";
      }
    }
    $contador++;
  }

  $respuesta = "\nTu tipo de inteligencia es:\n".$ganador;

  $usuario = (Session::get('user_id'));

  if($kinestesico == $maximo || $musical == $maximo ){
    Usuario::where('id', '=', $usuario)->update(array('tipo_inteligencia' => 'Kinestésico'));
    Session::put('inteligencia', 'Kinestésico');
  }else if($visual == $maximo || $logico == $maximo ){
    Usuario::where('id', '=', $usuario)->update(array('tipo_inteligencia' => 'Visual'));
    Session::put('inteligencia', 'Visual');
  }else{
    Usuario::where('id', '=', $usuario)->update(array('tipo_inteligencia' => 'Lingüístico'));
    Session::put('inteligencia', 'Lingüístico');
  }
  return $respuesta;

});

Route::get('postear-en-microforo',  function()
{
  $data = Input::all();

  $leccion = $data['leccion'];
  $mensaje = $data['mensaje'];
  $pregunta = $data['pregunta'];
  $usuario = Session::get('user_id');

  if($pregunta == '')
  $pregunta_leccion = PreguntaLeccion::create(array('id_usuario'=>$usuario, 'id_leccion'=>$leccion, 'pregunta'=>$mensaje, 'fecha_creacion'=> date('Y-m-d H:i:s'), 'relacion'=> 0 ));
  else
  $pregunta_leccion = PreguntaLeccion::create(array('id_usuario'=>$usuario, 'id_leccion'=>$leccion, 'pregunta'=>$mensaje, 'relacion'=> intval($pregunta), 'fecha_creacion'=> date('Y-m-d H:i:s') ) );


  return Session::get('user');

});

Route::get('guardar_color',  function()
{
  $data = Input::all();

  $curso = $data['curso'];
  $color1= $data['color1'];
  $color2 = $data['color2'];

  Badge::where('id_curso', '=', $curso)->update(array('color1' => $color1, 'color2' => $color2));

  return $curso." ".$color1." ".$color2;

});

//
//RUTAS PARA EL ACCESO A LOGIN
//
Route::get('login-facebook',array('as'=>'login-facebook','uses'=>'LoginController@loginWithFacebook'));
Route::get('login-twitter',array('as'=>'login-twitter','uses'=>'LoginController@loginWithTwitter'));
Route::get('login-google',array('as'=>'login-google','uses'=>'LoginController@loginWithGoogle'));

Route::post('login-facebook',array('as'=>'login-facebook','uses'=>'LoginController@loginWithFacebook'));
Route::post('login-twitter',array('as'=>'login-twitter','uses'=>'LoginController@loginWithTwitter'));
Route::post('login-google',array('as'=>'login-google','uses'=>'LoginController@loginWithGoogle'));

//
//RUTAS QUE TOMA EL USUARIO ESTUDIANTE
//
Route::get('mis-badges', array('as' => 'mis-badges', function()
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  $usuario = Usuario::find(Session::get('user_id'));
  $cursos = $usuario->misCursos();
  $avances = Avance::where('tipo','=','evaluacion')->where('id_usuario','=',$usuario->id)->orderBy('id_curso','DESC')->orderBy('fecha','ASC')->get();
  return View::make('mis-badges')->with('cursos', $cursos)->with('usuario', $usuario)->with('avances',$avances);
}));

Route::get('mis-cursos', array('as' => 'mis-cursos', function()
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  $usuario = Usuario::find(Session::get('user_id'));
  $cursos = $usuario->misCursos();

  return View::make('mis-cursos')->with('cursos', $cursos)->with('usuario', $usuario);
}));

Route::get('desuscribirse/{id}', array('as' => 'desuscribirse', function($id)
{
  $usuario = Session::get('user_id');
  RelacionUsuarioCurso::where('tipo_relacion', '=', 'Estudiante')->where('id_usuario', '=', $usuario)->where('id_curso', '=', $id)->update(array('estado' => 'inactivo'));
  return Redirect::to('index');
}))->where('id', '[0-9]+');

Route::get('ver-curso/{id}', array('as' => 'ver-curso', function($id)
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  if(Session::get('tipo_usuario') != "Administrador" && RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->count() == 0)
  return Redirect::to('index');

  $curso = Curso::find($id);

  $editable = false;
  if(Session::get('tipo_usuario') == "Administrador" || RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->where('estado', '=', 'activo' )->where('tipo_relacion','=','Profesor Admin')->count() > 0)
  $editable = true;

  return View::make('Estudiante/ver-curso')->with('curso', $curso)->with('editable', $editable);
}))->where('id', '[0-9]+');

Route::get('prueba-inteligencias', array('as' => 'prueba-inteligencias', function()
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  if(Session::get('tipo_usuario') != "Administrador" && RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->count() == 0)
  return Redirect::to('index');

  //$evaluacion = Evaluacion::find(2);
  $evaluacion = Evaluacion::find(0);
  return View::make('Estudiante/pruebainteligencia')->with('evaluacion', $evaluacion);
}));

Route::get('ver-curso-info/{id}', array('as' => 'ver-curso-info', function($id)
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');


  $count = RelacionUsuarioCurso::where('tipo_relacion', '=', 'Estudiante')->where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->count();
  $count2 = RelacionUsuarioCurso::where('tipo_relacion', '=', 'Estudiante')->where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('estado', '=', 'inactivo')->count();
  if ($count2 > 0){
    RelacionUsuarioCurso::where('tipo_relacion', '=', 'Estudiante')->where('id_usuario', '=',  Session::get('user_id'))->where('id_curso', '=', $id)->update(array('estado' => 'activo'));
  }
  else if($count == 0)
  {
    DB::table('relacion_usuario_curso')->insert(	array('id_usuario' => Session::get('user_id'), 'id_curso' => $id, 'tipo_relacion' => 'Estudiante', 'fecha_creacion' => date('Y-m-d H:i:s'), 'estado' => 'activo')	);
  }


  if(Session::get('tipo_usuario') != "Administrador" && RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->count() == 0)
  return Redirect::to('index');

  $counter = RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->where('tipo_relacion','<>','Estudiante')->where('estado','=','activo')->count();

  $usuario = Usuario::find(Session::get('user_id'));

  if($usuario->tipo_inteligencia == "" && $counter == 0 && Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('prueba-inteligencias');

  $curso = Curso::find($id);


  $editable = false;
  if(Session::get('tipo_usuario') == "Administrador" || RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->where('estado', '=', 'activo' )->where('tipo_relacion','=','Profesor Admin')->count() > 0)
  $editable = true;
  return View::make('Estudiante/info')->with('curso', $curso)->with('editable', $editable);
}))->where('id', '[0-9]+');

Route::get('ver-curso-contenido/{id}', array('as' => 'ver-curso-contenido', function($id)
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  if(Session::get('tipo_usuario') != "Administrador" && RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->count() == 0)
  return Redirect::to('index');

  $count = Registro::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->count();
  $count3 = Leccion::where('id_curso', '=', $id)->where('semana','>', 0)->count();

  if($count3 == 0)
  {
    $porcentaje = 0;
  }
  else
  {
    $porcentaje = intval($count*100/$count3);
  }
  $curso = Curso::find($id);


  $editable = false;
  if(Session::get('tipo_usuario') == "Administrador" || RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->where('estado', '=', 'activo' )->where('tipo_relacion','=','Profesor Admin')->count() > 0)
  $editable = true;

  return View::make('Estudiante/contenido')->with('curso', $curso)->with('porcentaje', $porcentaje)->with('cantidad', $count3)->with('editable', $editable);
}))->where('id', '[0-9]+');

Route::get('ver-curso-tareas/{id}', array('as' => 'ver-curso-tareas', function($id)
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  if(Session::get('tipo_usuario') != "Administrador" && RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->count() == 0)
  return Redirect::to('index');

  $count = Calificacion::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->count();
  $count3 = Evaluacion::where('id_curso', '=', $id)->where('semana','>', 0)->count();

  if($count3 >0){
    $porcentaje = intval($count*100/$count3);
  }
  else {
    $porcentaje = 0;
  }

  $curso = Curso::find($id);

  $editable = false;
  if(Session::get('tipo_usuario') == "Administrador" || RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->where('estado', '=', 'activo' )->where('tipo_relacion','=','Profesor Admin')->count() > 0)
  $editable = true;

  return View::make('Estudiante/tareas')->with('curso', $curso)->with('porcentaje', $porcentaje)->with('cantidad', $count3)->with('editable', $editable);
}))->where('id', '[0-9]+');

Route::get('ver-curso/{id}/clase/{id2}', array('as' => 'ver-clase', function($id, $id2)
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  if(Session::get('tipo_usuario') != "Administrador" && RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->count() == 0)
  return Redirect::to('index');

  $curso = Curso::find($id);
  $leccion = Leccion::find($id2);
  $count = Registro::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('id_leccion', '=', $id2)->count();
  if($count == 0){
    DB::table('registro')->insert(	array('id_usuario' => Session::get('user_id'), 'id_curso' => $id, 'id_leccion' => $id2));

    $count0 = Avance::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('semana','=', $leccion->semana)->where('tipo','=', 'clases')->count();
    if($count0 == 0){
      $count = Registro::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->count();
      $count2 = Leccion::where('id_curso', '=', $id)->where('semana','<=', $leccion->semana)->where('semana','>', 0)->count();
      $count3 = Leccion::where('id_curso', '=', $id)->where('semana','>', 0)->count();

      if($count3 >0){
        $porcentaje = intval($count*100/$count3);
      }
      else {
        $porcentaje = 0;
      }

      if($count == $count2)
      {
        DB::table('avance')->insert(	array('id_usuario' => Session::get('user_id'), 'id_curso' => $id, 'semana' => $leccion->semana, 'tipo' => 'clases', 'porcentaje'=>$porcentaje ,'fecha' => date('Y-m-d H:i:s') ) );
      }
    }
  }
  return View::make('Estudiante/clase')->with('curso', $curso)->with('leccion', $leccion);
}))->where('id', '[0-9]+')->where('id2', '[0-9]+');

Route::get('ver-curso/{id}/tarea/{id2}', array('as' => 'ver-tarea', function($id, $id2)
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  if(Session::get('tipo_usuario') != "Administrador" && RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->count() == 0)
  return Redirect::to('index');

  $badge = Badge::find($id);
  $curso = Curso::find($id);
  $evaluacion = Evaluacion::find($id2);

  $editable = false;
  if(Session::get('tipo_usuario') == "Administrador" || RelacionUsuarioCurso::where('id_usuario','=',Session::get('user_id'))->where('id_curso','=',$id)->where('estado', '=', 'activo' )->where('tipo_relacion','=','Profesor Admin')->count() > 0)
  $editable = true;

  return View::make('Estudiante/evaluacion')->with('curso', $curso)->with('evaluacion', $evaluacion)->with('badge',$badge)->with('editable', $editable);

}))->where('id', '[0-9]+')->where('id2', '[0-9]+');


//
//RUTAS DEL ADMINISTRADOR
//
Route::get('administrador', array('as' => 'administrador', function()
{
  if(Session::get('user_id') == "" || Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('index');

  $cursos = Curso::where('id_curso', '<>', '0')->get();
  return View::make('Administrador/index')->with('cursos', $cursos);
}));

Route::get('administrador/estadisticas', array('as' => 'administrador-estadisticas', function()
{
  if(Session::get('user_id') == ""  || Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('index');

  $cursos = Curso::where('id_curso', '<>', '0')->get();
  return View::make('Administrador/estadisticas')->with('cursos', $cursos);
}));

Route::get('administrador/listar-estadisticas', array('as' => 'administrador-listar-estadisticas', function()
{
  if(Session::get('user_id') == "" )
  return Redirect::to('index');

  $relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('tipo_relacion', '=', 'Profesor Admin')->get();
  if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('index');

  return View::make('Administrador/listar-estadisticas')->with('cursos', $relaciones);
}));

Route::get('administrador/listar-cursos', array('as' => 'administrador-listar-cursos', function()
{
  if(Session::get('user_id') == "" )
  return Redirect::to('index');

  $relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('tipo_relacion', '=', 'Profesor Admin')->get();
  if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('index');

  return View::make('Administrador/listar-cursos')->with('cursos', $relaciones);
}));

Route::get('administrador/ver-estadisticas/{id}', array('as' => 'administrador-ver-estadisticas', function($id)
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  $relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('tipo_relacion', '<>', 'Estudiante')->get();
  if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('index');

  $cantidad = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('tipo_relacion', '=', 'Profesor Admin')->count();
  $relacion = "admin";
  if($cantidad == 0 && Session::get('tipo_usuario') != "Administrador")
  $relacion = "basico";

  $curso = Curso::find($id);

  return View::make('Administrador/ver-estadisticas')->with('curso', $curso)->with('relacion', $relacion);
}));

Route::get('administrador/crear-curso',array('as'=>'crear-curso','uses'=>'CursoController@create'));
Route::get('administrador/crear-curso/{id}',array('as'=>'crear-curso-2', 'uses'=>'TemarioController@create'));
Route::get('administrador/crear-inicio/{id}',array('as'=>'crear-curso-4b', 'uses'=>'TemarioController@create1b'));
Route::get('administrador/crear-contenido/{id}',array('as'=>'crear-curso-5', 'uses'=>'TemarioController@create2'));
Route::get('administrador/crear-leccion/{id}',array('as'=>'crear-curso-6', 'uses'=>'LeccionController@create'));
Route::get('administrador/crear-evaluacion/{id}',array('as'=>'crear-curso-7', 'uses'=>'EvaluacionController@create'));
Route::get('administrador/crear-preguntas/{id}',array('as'=>'crear-curso-8', 'uses'=>'PreguntaController@create'));

Route::get('administrador/asignar-color/{id}', array('as'=>'crear-curso-9', function($id){

  if(Session::get('user_id') == '')
  return Redirect::to('index');

  $relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('tipo_relacion', '=', 'Profesor Admin')->get();
  if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('index');

  if(Badge::where('id_curso', '=', $id)->count() == 0)
  {
    DB::table('badge')->insert(	array('id_curso' => $id, 'color1' => '#FFFFFF', 'color2' => '#000000')	);
  }

  $badge = Badge::find($id);
  $curso = Curso::find($id);
  return View::make('Administrador/asignar-color')->with('curso', $curso)->with('badge', $badge);

}))->where('id', '[0-9]+');

Route::get('administrador/asignar-profesor/{id}',array('as'=>'crear-curso-3', function($id) {

  if(Session::get('user_id') == '')
  return Redirect::to('index');

  $relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('tipo_relacion', '=', 'Profesor Admin')->get();
  if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('index');

  $profesores = Usuario::all();
  $curso = Curso::find($id);
  return View::make('Administrador/asignar-profe')->with('profesores', $profesores)->with('curso', $curso);
}))->where('id', '[0-9]+');

Route::get('administrador/asignar-profesor/{id}-{nombre}',array('as'=>'crear-curso-4', function($id, $nombre) {

  if(Session::get('user_id') == '')
  return Redirect::to('index');

  $relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('tipo_relacion', '=', 'Profesor Admin')->get();
  if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('index');

  $profesores = Usuario::all();
  $profesores2 = Usuario::where('nombre', 'ILIKE', '%'.$nombre.'%')->get();
  $curso = Curso::find($id);
  return View::make('Administrador/asignar-profe2')->with('profesores', $profesores)->with('profesores2', $profesores2)->with('curso', $curso);
}))->where('id', '[0-9]+');


Route::get('administrador/editar-curso/{id}',array('as'=>'editar-curso', function($id) {

  if(Session::get('user_id') == '')
  return Redirect::to('index');

  $relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('tipo_relacion', '=', 'Profesor Admin')->get();
  if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
  return Redirect::to('index');

  $curso = Curso::find($id);
  return View::make('Administrador/ver')->with('curso', $curso);
}))->where('id', '[0-9]+');



//Ruta para redireccionar los profesores buscados en las 2 anteriores rutas
Route::get('redirect-asignar-profesores',array('as'=>'redirect-asignar-profesores', function() {
  $datos = Input::all();
  $id = $datos['id'];
  $nombre = $datos['nombre'];
  $profesores = Usuario::all();
  $profesores2 = Usuario::where('nombre', 'ILIKE', '%'.$nombre.'%')->get();
  $curso = Curso::find($id);
  return Redirect::Route('crear-curso-4', array($id, $nombre));
}));

//Ruta para redireccionar los contenidos creados en el administrador
Route::get('redirect-temario-curso',array('as'=>'redirect-temario-curso', function() {
  $datos = Input::all();
  $id = $datos['id_curso'];
  $tipo_contenido = $datos['tipo_contenido'];
  $curso = Curso::find($id);
  return Redirect::Route('crear-curso-5', array($id));
}));

//Ruta para asignar profesor a un curso
Route::get('asignar-profesor/{id_curso}/{id_usuario}/{tipo}', array('as'=>'asignar-profesor', function($id_curso, $id_usuario, $tipo) {
  DB::table('relacion_usuario_curso')->insert(	array('id_usuario' => $id_usuario, 'id_curso' => $id_curso, 'tipo_relacion' => $tipo, 'fecha_creacion' => date('Y-m-d H:i:s'), 'estado' => 'activo')	);
  return Redirect::route('crear-curso-3', $id_curso);
}))->where('id_curso', '[0-9]+');

//Ruta para eliminar una asignacion de profesor a un curso
Route::get('desasignar-profesor/{id_curso}/{id_usuario}/{tipo}', array('as'=>'desasignar-profesor', function($id_curso, $id_usuario, $tipo) {
  RelacionUsuarioCurso::where('tipo_relacion', '=', $tipo)->where('id_usuario', '=', $id_usuario)->where('id_curso', '=', $id_curso)->delete();
  return Redirect::route('crear-curso-3', $id_curso);
}))->where('id_curso', '[0-9]+');


Route::resource('curso', 'CursoController');
Route::resource('usuario', 'UsuarioController');
Route::resource('evaluacion', 'EvaluacionController');
Route::resource('leccion', 'LeccionController');
Route::resource('pregunta', 'PreguntaController');
Route::resource('pregunta_leccion', 'PreguntaLeccionController');
Route::resource('temario', 'TemarioController');

Route::get('temario/{id}/edit1b', array('uses' => 'TemarioController@edit1b', 'as' => 'editar-temario-inicio'));
Route::get('temario/{id}/edit2', array('uses' => 'TemarioController@edit2', 'as' => 'editar-temario-semanal'));
Route::get('temario/{id}/edit', array('uses' => 'TemarioController@edit', 'as' => 'editar-temario-info-curso'));
Route::get('leccion/{id}/edit', array('uses' => 'LeccionController@edit', 'as' => 'editar-leccion'));
Route::get('evaluacion/{id}/edit', array('uses' => 'EvaluacionController@edit', 'as' => 'editar-evaluacion'));
Route::get('pregunta/{id}/edit', array('uses' => 'PreguntaController@edit', 'as' => 'editar-pregunta'));

Route::get('borrar-pregunta/{id}', array('as'=>'borrar-pregunta', function($id)
{
  $pregunta = Pregunta::find($id);
  $id_tarea = $pregunta->id_evaluacion;
  $tarea = Evaluacion::find($id_tarea);
  $evaluacion = $tarea->id_curso;

  $pregunta->delete();

  return Redirect::route('ver-tarea', array($evaluacion, $id_tarea));

}))->where('id', '[0-9]+');

//
// RUTAS DEL Chat
//
Route::get("chat", array('as'=>'chat', function()
{
  if(Session::get('user_id') == "")
  return Redirect::to('index');

  if(Session::get('user') == "")
  return Redirect::to('index');

  $nombre = Session::get('user', 'Anonimo');

  return View::make("index/index")->with('nombre', $nombre);
}));
