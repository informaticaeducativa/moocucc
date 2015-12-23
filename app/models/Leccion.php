<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Leccion extends Eloquent implements UserInterface, RemindableInterface 
{
 
 	use UserTrait, RemindableTrait;

	public $errors;
    protected $primaryKey = 'id_leccion';

 
 	protected $table = 'leccion';
 	 	
 	protected $fillable = array('id_leccion', 'nombre', 'id_curso', 'server_contenido_grafico', 'contenido_grafico', 'contenido_texto', 'semana');

	//protected $hidden = array('password', 'remember_token');
    public $timestamps = false;

	public function isValid($data)
    {
		$rules = array(
            'id_leccion' => 'required|numeric',
            'nombre' => 'required',
            'id_curso' => 'required|numeric',
            'server_contenido_grafico' => 'required',
            'contenido_grafico' => 'required',
            'contenido_texto' => 'required',
            'semana' => 'required'
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
    
    public function getPreguntasLeccion()
    {
		$preguntas = PreguntaLeccion::where('id_leccion','=', $this->id_leccion)->orderBy('fecha_creacion','ASC')->get();
		return $preguntas;
	}
	
    
}

