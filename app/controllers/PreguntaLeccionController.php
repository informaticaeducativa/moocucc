<?php

class PreguntaLeccionController extends BaseController 
{
      
     
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$preguntas_leccion = PreguntaLeccion::all();
		return View::make('Pregunta_leccion/lista')->with('preguntas_leccion', $preguntas_leccion);
   	}
   	
   	
   	
   	public function lista()
   	{
		$preguntas_leccion = PreguntaLeccion::all();
		return View::make('Pregunta_leccion/lista')->with('preguntas_leccion', $preguntas_leccion);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$pregunta_leccion = new PreguntaLeccion;
		return View::make('Pregunta_leccion/form')->with('pregunta_leccion', $pregunta_leccion);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Creamos un nuevo objeto para nuestro nuevo materia
		$pregunta_leccion = new PreguntaLeccion;
		// Obtenemos la data enviada por el materia
		$data = Input::all();
				
		// Revisamos si la data es válido
		if ($pregunta_leccion->isValid($data))
		{
			// Si la data es valida se la asignamos al materia
			$pregunta_leccion->fill($data);
			// Guardamos el materia
			$pregunta_leccion->save();
			// Y Devolvemos una redirección a la acción show para mostrar el materia
			return Redirect::route('pregunta_leccion.show', array($pregunta_leccion->id));
		}
		else
		{
			// En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('pregunta_leccion.create')->withInput()->withErrors($pregunta_leccion->errors);
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
		$pregunta_leccion = PreguntaLeccion::find($id);
		return View::make('Pregunta_leccion/view')->with('pregunta_leccion', $pregunta_leccion);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pregunta_leccion = PreguntaLeccion::find($id);
		if (is_null ($pregunta_leccion))
		{
		App::abort(404);
		}
		
		$form_data = array('route' => array('pregunta_leccion.update', $pregunta_leccion->id_pregunta_leccion), 'method' => 'PATCH');
        $action    = 'Editar';
        
        return View::make('Pregunta_leccion/form', compact('pregunta_leccion', 'form_data', 'action'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		   $pregunta_leccion = Pregunta_leccion::find($id);
			$data = Input::all();

		 // Revisamos si la data es válida y guardamos en ese caso
        if ($pregunta_leccion->validAndSave($data))
        {
            // Y Devolvemos una redirección a la acción show para mostrar el materia
            return Redirect::route('pregunta_leccion.show', array($pregunta_leccion->id_pregunta_leccion));
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::route('pregunta_leccion.edit', $pregunta_leccion->id_pregunta_leccion)->withInput()->withErrors($pregunta_leccion->errors);
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

