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

	public function getAllLecciones() {
		$lecciones = Leccion::where('id_curso','=', $this->id_curso)->orderBy('id_leccion', 'ASC')->get();
		return $lecciones;
	}
		
	public function getLecciones($semana) {
		$lecciones = Leccion::where('id_curso','=', $this->id_curso)->where('semana','=', $semana)->orderBy('id_leccion', 'ASC')->get();
		return $lecciones;
	}
	
	public function getEvaluaciones($semana) {
		$evaluaciones = Evaluacion::where('id_curso','=', $this->id_curso)->where('semana','=', $semana)->get();
		return $evaluaciones;
	}
		
	public function getAllEvaluaciones() {
		$evaluaciones = Evaluacion::where('id_curso','=', $this->id_curso)->where('semana','>', 0)->get();
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

	public function getProfesoresAdminApi(){
		$lista = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Profesor Admin')->get();
		$profesores = array();
		foreach ($lista as $profe) {
			$profesores[] = Usuario::where('id','=', $profe->id_usuario)->get();
		}
		return $profesores;
	}
	
	public function getProfesoresAsistentes(){
		$profesores = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Profesor Basico')->get();
		return $profesores;
	}

	public function getProfesoresAsistentesApi(){
		$lista = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Profesor Basico')->get();
		$profesores = array();
		foreach ($lista as $profe) {
			$profesores[] = Usuario::where('id','=', $profe->id_usuario)->get();
		}

		return $profesores;
	}
	
	public function getInscritos(){
		$inscritos = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Estudiante')->where('estado','=', 'activo')->count();
		return $inscritos;
	}
	
	public function getInscritosTotal(){
		$inscritos = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Estudiante')->count();
		return $inscritos;
	}
	
	public function getRetirados(){
		$inscritos = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Estudiante')->where('estado','=', 'inactivo')->count();
		return $inscritos;
	}
	
	public function getInscritosJSON(){
		$inscritos = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Estudiante')->where('estado','=', 'activo')->count();
		$retirados = RelacionUsuarioCurso::where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Estudiante')->where('estado','=', 'inactivo')->count();
		return Response::json(array(array("value" => $inscritos, 'label'=>'inscritos'), array("value" => $retirados, 'label'=>'retirados')));
	}
	
	public function getDemografiaJSON(){
		$demografia = DB::table('relacion_usuario_curso')
    ->join('usuario', 'relacion_usuario_curso.id_usuario', '=', 'usuario.id')
     ->join('ciudad', 'usuario.ciudad', '=', 'ciudad.id_ciudad')
   ->selectRaw('ciudad.nombre as label, count(ciudad.id_ciudad) as value')
   ->where('id_curso','=', $this->id_curso)
    ->where('tipo_relacion','=', 'Estudiante')
    ->where('estado','=', 'activo')
    ->groupBy('ciudad.nombre')
    ->get();
		//$demografia = RelacionUsuarioCurso::groupBy('estado')->selectRaw('sum(id_usuario) as sum, estado')->where('id_curso','=', $this->id_curso)->where('tipo_relacion','=', 'Estudiante')->lists('sum','estado');
		return Response::json(($demografia));
	}
	
	public function getDemografiaPaisJSON(){
		$demografia = DB::table('relacion_usuario_curso')
    ->join('usuario', 'relacion_usuario_curso.id_usuario', '=', 'usuario.id')
     ->join('pais', 'usuario.pais', '=', 'pais.id_pais')
   ->selectRaw('pais.nombre as label, count(pais.id_pais) as value')
   ->where('id_curso','=', $this->id_curso)
    ->where('tipo_relacion','=', 'Estudiante')
    ->where('estado','=', 'activo')
    ->groupBy('pais.nombre')
    ->get();

		return Response::json(($demografia));
	}	
		
	public function getInscritosUniversidadJSON(){
		$inscritos = DB::table('relacion_usuario_curso')
    ->join('usuario', 'relacion_usuario_curso.id_usuario', '=', 'usuario.id')
     ->join('universidad', 'usuario.universidad', '=', 'universidad.id_universidad')
   ->selectRaw('universidad.nombre as label, count(universidad.id_universidad) as value')
   ->where('id_curso','=', $this->id_curso)
    ->where('tipo_relacion','=', 'Estudiante')
    ->where('estado','=', 'activo')
    ->groupBy('universidad.nombre')
    ->get();

		return Response::json(($inscritos));
	}	


	public function toArray()
    {
        $array = parent::toArray();
        $array['nombre_tematica'] = $this->getTematica();
        $array['fecha_inicio_semantica'] = $this->getFechaInicio();
        $array['imagen_presentacion_url'] = "http://www.informaticaeducativaucc.com/imagenes/".$this->imagen_presentacion;
        $array['profesores_admin'] = $this->getProfesoresAdminApi();
        $array['profesores_asistentes'] = $this->getProfesoresAsistentesApi();
        return $array;
    }
	

	
    
}



