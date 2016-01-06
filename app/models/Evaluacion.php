<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Evaluacion extends Eloquent implements UserInterface, RemindableInterface 
{
 
 	use UserTrait, RemindableTrait;

	public $errors;
    protected $primaryKey = 'id_evaluacion';

 
 	protected $table = 'evaluacion';
 	 	
 	protected $fillable = array('id_evaluacion', 'nombre', 'semana', 'id_curso', 'calificable');

	//protected $hidden = array('password', 'remember_token');
    public $timestamps = false;

	public function isValid($data)
    {
		$rules = array(
            'nombre' => 'required',
            'semana' => 'required|numeric',
            'id_curso' => 'required|numeric',
            'calificable' => 'required'
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;

    }
    
    public function validAndSave($data)
    {
        // Revisamos si la data es válida
        if ($this->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $this->fill($data);
            // Guardamos el usuario
            $this->save();
            
            return true;
        }
        
        return false;
    }
    
    public function getPreguntas() {
		$preguntas = Pregunta::where('id_evaluacion','=', $this->id_evaluacion)->orderBy('id_pregunta', 'ASC')->get();
		return $preguntas;
	}
	
	public function getPreguntasQuiz() {
		$preguntas = Pregunta::where('id_evaluacion','=', $this->id_evaluacion)->select('respuesta')->orderBy('id_pregunta', 'ASC')->get();
		return $preguntas;
	}
	
	public function getIdCurso() {
		$evaluacion = Evaluacion::where('id_evaluacion','=', $this->id_evaluacion)->first();
		return $evaluacion->id_curso;
	}
	
	public function getRealizado($curso){
		$count = Calificacion::where('id_evaluacion','=', $this->id_evaluacion)->where('id_curso','=', $curso)->where('id_usuario','=', Session::get('user_id'))->count();
		if($count > 0)
			return true;
		return false;
	}
	
	public function getCalificacion(){
		$calificacion = Calificacion::where('id_evaluacion','=', $this->id_evaluacion)->where('id_usuario','=', Session::get('user_id'))->first();
		return $calificacion->nota.'% - intentos:'.$calificacion->intentos;
	}
	    
}

