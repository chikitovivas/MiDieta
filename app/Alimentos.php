<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use DB;

class Alimentos extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'alimentos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nombre', 'indiceg', 'carbohidratos', 'calorias'];
       // public $idAlimentos;
        
        
        public function historial(){
           return $this->belongsToMany('App\Historial','Historial_id'); 
        }


        public function validator(array $data)
	{
		return Validator::make($data, [
			'nombre' => 'required',
			'indiceg' => 'max:255|integer',
                        'carbohidratos' => 'required|max:255|integer',
			'calorias' => 'required|max:255|integer',
		]);
	}
        /* Funcion para buscar un alimento por el id */
        public static function findById($id)
        {
             return Alimentos::where('id' , '=', $id)
            ->first();
        }
        /* Funcion para buscar un alimento por su nombre */
        public static function findByName($name)
        {
             return Alimentos::where('nombre' , '=', $name)
            ->first();
        }
        /* Funcion para obtener todos los alimentos solo retorna id y nombre */
        public static function getAllAlimentos(){
            $results = DB::select("SELECT alimentos.id as id, alimentos.nombre as comida
                                   FROM alimentos
                                   ORDER BY id ASC");
            return $results;
        }
        /* Funcion para retornar la informacion alimenticia de los alimentos */
        public static function getInfoAlimento($data){
            
            $results = DB::select("SELECT alimentos.calorias as calorias, alimentos.carbohidratos as carbohidratos, alimentos.indiceg as indiceg
                                   FROM alimentos
                                   WHERE alimentos.id = :id", ['id' => $data]) ;
            return $results;
        }
}
