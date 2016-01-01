<?php

class PreguntaController extends BaseController 
{
      
     
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$preguntas = Pregunta::all();
		return View::make('Pregunta/lista')->with('preguntas', $preguntas);
   	}
   	
   	
   	
   	public function lista()
   	{
		$preguntas = Pregunta::all();
		return View::make('Pregunta/lista')->with('preguntas', $preguntas);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$pregunta = new Pregunta;
		$evaluacion = Evaluacion::find($id);
		return View::make('Pregunta/form')->with('pregunta', $pregunta)->with('evaluacion', $evaluacion);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Creamos un nuevo objeto para nuestro nuevo materia
		$pregunta = new Pregunta;
		// Obtenemos la data enviada por el materia
		$data = Input::all();
				
		// Revisamos si la data es válido
		if ($pregunta->isValid($data))
		{
			// Si la data es valida se la asignamos al materia
			$pregunta->fill($data);
			// Guardamos el materia
			$pregunta->save();
			// Y Devolvemos una redirección a la acción show para mostrar el materia
			//return Redirect::route('pregunta.show', array($pregunta->id));
			return Redirect::route('crear-curso-8', array($data['id_evaluacion']));
		}
		else
		{
			// En caso de error regresa a la acción create con los datos y los errores encontrados
			//return Redirect::route('pregunta.create')->withInput()->withErrors($pregunta->errors);
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
		$pregunta = Pregunta::find($id);
		return View::make('Pregunta/view')->with('pregunta', $pregunta);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pregunta = Pregunta::find($id);
		if (is_null ($pregunta))
		{
		App::abort(404);
		}
		
		$form_data = array('route' => array('pregunta.update', $pregunta->id_pregunta), 'method' => 'PATCH');
        $action    = 'Editar';
        
   		$tematicas = Tematica::lists('nombre','id_tematica');
        return View::make('Pregunta/form', compact('pregunta', 'form_data', 'action'))->with('tematicas', $tematicas);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		   $pregunta = Pregunta::find($id);
			$data = Input::all();

		 // Revisamos si la data es válida y guardamos en ese caso
        if ($pregunta->validAndSave($data))
        {
            // Y Devolvemos una redirección a la acción show para mostrar el materia
            return Redirect::route('pregunta.show', array($pregunta->id_pregunta));
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::route('pregunta.edit', $pregunta->id_pregunta)->withInput()->withErrors($pregunta->errors);
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

