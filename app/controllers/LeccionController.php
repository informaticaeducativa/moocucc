<?php

class LeccionController extends BaseController
{


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$lecciones = Leccion::all();
		return View::make('Leccion/lista')->with('lecciones', $lecciones);
   	}



   	public function lista()
   	{
		$lecciones = Leccion::all();
		return View::make('Leccion/lista')->with('lecciones', $lecciones);
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

		$leccion = new Leccion;
		$curso = Curso::find($id);
		return View::make('Leccion/form')->with('leccion', $leccion)->with('curso', $curso);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Creamos un nuevo objeto para nuestro nuevo materia
		$leccion = new Leccion;
		// Obtenemos la data enviada por el materia
		$data = Input::all();

		// Revisamos si la data es válido
		if ($leccion->isValid($data))
		{
			// Si la data es valida se la asignamos al materia
			$leccion->fill($data);
			// Guardamos el materia
			$leccion->save();
			// Y Devolvemos una redirección a la acción show para mostrar el materia
			return Redirect::route('crear-curso-6', array($data['id_curso']));
			//return Redirect::route('leccion.show', array($leccion->id_leccion));
		}
		else
		{
			// En caso de error regresa a la acción create con los datos y los errores encontrados
			//return Redirect::route('leccion.create')->withInput()->withErrors($leccion->errors);
			//return Redirect::route('leccion.index');
			//return Redirect::route('leccion.create', array($data['id_curso']))->withInput()->withErrors($leccion->errors);
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
		$leccion = Leccion::find($id);
		return View::make('Leccion/view')->with('leccion', $leccion);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$leccion = Leccion::find($id);
		if (is_null ($leccion))
		{
		App::abort(404);
		}
		$curso = Curso::find($leccion->id_curso);
		$form_data = array('route' => array('leccion.update', $leccion->id_leccion), 'method' => 'PATCH');
        $action    = 'Editar';

   		$tematicas = Tematica::lists('nombre','id_tematica');
        return View::make('Leccion/form', compact('leccion', 'form_data', 'action'))->with('tematicas', $tematicas)->with('curso', $curso);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		   $leccion = Leccion::find($id);
			$data = Input::all();
		 // Revisamos si la data es válida y guardamos en ese caso
        if ($leccion->validAndSave($data))
        {
            // Y Devolvemos una redirección a la acción show para mostrar el materia
            $curso = Curso::find($leccion->id_leccion);
            return Redirect::route('leccion.edit', array($leccion->id_leccion))->with('curso', $curso);
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::route('leccion.edit', $leccion->id_leccion)->withInput()->withErrors($leccion->errors);
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
