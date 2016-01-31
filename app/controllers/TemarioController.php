<?php

class TemarioController extends BaseController
{


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$temarios = Temario::all();
		return View::make('Temario/lista')->with('temarios', $temarios);
   	}



   	public function lista()
   	{
		$temarios = Temario::all();
		return View::make('Temario/lista')->with('temarios', $temarios);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		if(Session::get('user_id') == '')
			return Redirect::to('index');

		$relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('tipo_relacion', '=', 'Profesor Admin')->get();
		if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
			return Redirect::to('index');

		$temario = new Temario;
		$curso = Curso::find($id);
		$temarios = $curso->getTemarios();
		return View::make('Temario/form')->with('temario', $temario)->with('temarios', $temarios)->with('curso', $curso);
	}

	public function create1b($id)
	{
		if(Session::get('user_id') == '')
			return Redirect::to('index');

		$relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('tipo_relacion', '=', 'Profesor Admin')->get();
		if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
			return Redirect::to('index');

		$temario = new Temario;
		$curso = Curso::find($id);
		$temarios = $curso->getTemarios();
		$temarios2 = $curso->getTemariosInicio();
		return View::make('Temario/form1b')->with('temario', $temario)->with('temarios', $temarios)->with('temarios2', $temarios2)->with('curso', $curso);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create2($id)
	{
		if(Session::get('user_id') == '')
			return Redirect::to('index');

		$relaciones = RelacionUsuarioCurso::where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->where('tipo_relacion', '=', 'Profesor Admin')->get();
		if(count($relaciones) == 0 && Session::get('tipo_usuario') != "Administrador")
			return Redirect::to('index');

		$temario = new Temario;
		$curso = Curso::find($id);
		$temarios = $curso->getTemarios();
		$temarios2 = $curso->getTemariosSemana();
		return View::make('Temario/form2')->with('temario', $temario)->with('temarios', $temarios)->with('temarios2', $temarios2)->with('curso', $curso);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Creamos un nuevo objeto para nuestro nuevo materia
		$temario = new Temario;
		// Obtenemos la data enviada por el materia
		$data = Input::all();

		// Revisamos si la data es válido
		if ($temario->isValid($data))
		{
			if($data['tipo_contenido']=='semana')
			{
					if(Temario::where('tipo_contenido','=','semana')->where('id_curso', '=', $data['id_curso'])->where('posicion','=', $data['posicion'])->count() > 0 )
					{
							return Redirect::route('crear-curso-5', array($data['id_curso']));
					}

			}
			// Si la data es valida se la asignamos al materia
			$temario->fill($data);
			// Guardamos el materia
			$temario->save();
			// Y Devolvemos una redirección a la acción show para mostrar el materia
			if($temario->tipo_contenido == "semana")
				return Redirect::route('crear-curso-5', array($temario->id_curso));
			if($temario->tipo_contenido == "inicio")
				return Redirect::route('crear-curso-4b', array($temario->id_curso));
			return Redirect::route('crear-curso-2', array($temario->id_curso));
		}
		else
		{
			// En caso de error regresa a la acción create con los datos y los errores encontrados

			return Redirect::route('index');
			//return Redirect::route('temario.create')->withInput()->withErrors($temario->errors);
		}

	}



	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$temario = Temario::find($id);
		return View::make('Temario/view')->with('temario', $temario);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$temario = Temario::find($id);
		if (is_null ($temario))
		{
		App::abort(404);
		}
		$curso = Curso::find($temario->id_curso);
		$form_data = array('route' => array('temario.update', $temario->id_temario), 'method' => 'PATCH');
        $action    = 'Editar';

        return View::make('Temario/form', compact('temario', 'form_data', 'action'))->with('curso', $curso);
	}

  public function edit1b($id)
	{
		$temario = Temario::find($id);
		if (is_null ($temario))
		{
		App::abort(404);
		}
		$curso = Curso::find($temario->id_curso);
		$form_data = array('route' => array('temario.update1b', $temario->id_temario), 'method' => 'PATCH');
        $action    = 'Editar';

        return View::make('Temario/form1b', compact('temario', 'form_data', 'action'))->with('curso', $curso);
	}

  public function edit2($id)
	{
		$temario = Temario::find($id);
		if (is_null ($temario))
		{
		App::abort(404);
		}
		$curso = Curso::find($temario->id_curso);
		$form_data = array('route' => array('temario.update2', $temario->id_temario), 'method' => 'PATCH');
        $action    = 'Editar';

        return View::make('Temario/form2', compact('temario', 'form_data', 'action'))->with('curso', $curso);
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		   $temario = Temario::find($id);
			$data = Input::all();



		 		// Revisamos si la data es válida y guardamos en ese caso
        if ($temario->validAndSave($data))
        {
            // Y Devolvemos una redirección a la acción show para mostrar el materia
            //return Redirect::route('temario.show', array($temario->id_temario));
            $curso = Curso::find($temario->id_temario);
            if($temario->tipo_contenido == 'info_curso'){
                return Redirect::route('temario.edit', $temario->id_temario)->with('curso', $curso);
            }
            else if($temario->tipo_contenido == 'inicio'){
                return Redirect::route('editar-temario-inicio', $temario->id_temario)->with('curso', $curso);
            }
            else {
                return Redirect::route('editar-temario-semanal', $temario->id_temario)->with('curso', $curso);
            }

        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            if($temario->tipo_contenido == 'info_curso'){
                return Redirect::route('temario.edit', $id)->withInput()->withErrors($temario->errors);
            }
            else if($temario->tipo_contenido == 'inicio'){
                return Redirect::route('editar-temario-inicio', $id)->withInput()->withErrors($temario->errors);
            }
            else {
                return Redirect::route('editar-temario-semanal', $id)->withInput()->withErrors($temario->errors);
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
