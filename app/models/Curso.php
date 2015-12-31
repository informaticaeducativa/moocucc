<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Curso extends Eloquent implements UserInterface, RemindableInterface 
{
 
 	use UserTrait, RemindableTrait;

	public $errors;
    protected $primaryKey = 'id_curso';

 
 	protected $table = 'curso';
 	 	
 	protected $fillable = array('id_curso', 'nombre', 'fecha_inicio', 'imagen_presentacion', 'comienzo', 'id_tematica', 'nivel', 'duracion', 'esfuerzo', 'precio', 'prerrequisitos');

	//protected $hidden = array('password', 'remember_token');
    public $timestamps = false;

	public function isValid($data)
    {
		$rules = array(
            'nombre' => 'required',
            'fecha_inicio' => 'required',
            'imagen_presentacion' => 'required',            
            'comienzo' => 'required',
            'id_tematica' => 'required|numeric',
            'nivel' => 'required',
            'duracion' => 'required',
            'esfuerzo' => 'required',
            'precio' => 'required',
            'prerrequisitos' => 'required'
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
    
	public function getTematica() {
		$tematica = Tematica::find($this->id_tematica);
		return $tematica->nombre;
	}
	
	public function getLecciones($semana) {
		$lecciones = Leccion::where('id_curso','=', $this->id_curso)->where('semana','=', $semana)->orderBy('id_leccion', 'ASC')->get();
		return $lecciones;
	}
	
	public function getEvaluaciones($semana) {
		$evaluaciones = Evaluacion::where('id_curso','=', $this->id_curso)->where('semana','=', $semana)->get();
		return $evaluaciones;
	}
	
	public function getFechaInicio(){
		if($this->comienzo == "Auto-aprendizaje"){		return $this->comienzo;		}
		else if($this->fecha_inicio > date("Y-m-d")){	return "Proximo a iniciar (".$this->fecha_inicio.")";	}
		else{	return "En curso";	}
	}
	
	public function getTemarios(){
		$temarios = Temario::where('id_curso','=', $this->id_curso)->where('tipo_contenido', '=', 'info_curso')->get();
		return $temarios;
	}
	
	public function getTemariosInicio(){
		$temarios = Temario::where('id_curso','=', $this->id_curso)->where('tipo_contenido', '=', 'inicio')->get();
		return $temarios;
	}
	
	public function getTemariosSemana(){
		$temarios = Temario::where('id_curso','=', $this->id_curso)->where('tipo_contenido', '=', 'semana')->orderBy('posicion', 'ASC')->get();
		return $temarios;
	}
	
	public function getProfesoresAdmin(){
		$profesores = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Profesor Admin')->get();
		return $profesores;
	}
	
	public function getProfesoresAsistentes(){
		$profesores = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Profesor Basico')->get();
		return $profesores;
	}
	
	
    
}

