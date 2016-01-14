<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Calificacion extends Eloquent implements UserInterface, RemindableInterface 
{
 
 	use UserTrait, RemindableTrait;

	public $errors;
    protected $primaryKey = array('id_usuario', 'id_evaluacion');
 
 	protected $table = 'calificacion';
 	 	
 	protected $fillable = array('id_usuario', 'id_curso', 'id_evaluacion', 'nota', 'fecha', 'intentos');

    public $timestamps = false;

	public function isValid($data)
    {
		$rules = array(
            'id_usuario' => 'required|numeric',
            'id_curso' => 'required|numeric',
            'id_evaluacion' => 'required|numeric',
            'nota' => 'required|numeric',
            'fecha' => 'required',
            'intentos' => 'required|numeric'
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
    
    public function getEvaluacion()
    {
		$evaluacion = Evaluacion::find($this->id_evaluacion);
		return $evaluacion;
	}
	
	public function getCurso()
    {
		$curso = Curso::find($this->id_curso);
		return $curso;
	}
	
	public function getUsuario()
	{
		$usuario = Usuario::find($this->id_usuario);
		return $usuario;
	}
	
    
}

