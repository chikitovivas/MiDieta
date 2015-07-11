<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use DB;

class Historial_has_Alimentos extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Historial_has_Alimentos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['Historial_id', 'Alimentos_id', 'cantidad'];
       // public $idAlimentos;
        
        
        public function historial(){
           return $this->belongsToMany('App\Historial','Historial_id'); 
        }
        
        public function alimentos(){
           return $this->belongsToMany('App\Alimentos','Alimentos_id'); 
        }


        public function validator(array $data)
	{
		return Validator::make($data, [
			'Historial_id' => 'required',
			'Alimentos_id' => 'required',
                        'cantidad' => 'required|integer'

		]);
	}
        /* Funcion para borrar una comida de un historial */
        public static function deleteComida($historial_id,$comida_id)
        {
         DB::statement("DELETE FROM Historial_has_Alimentos
                        WHERE Historial_has_Alimentos.Historial_id = :historial and
                              Historial_has_Alimentos.Alimentos_id = :comida",   
                    ['historial' => $historial_id,'comida' => $comida_id]);           
        }
        public static function findH($historial_id,$comida_id)
        {
            $results = DB::select("SELECT *
                                      FROM Historial_has_Alimentos
                                      WHERE Historial_has_Alimentos.Historial_id = :historial and
                                            Historial_has_Alimentos.Alimentos_id = :comida",   
                                    ['historial' => $historial_id,'comida' => $comida_id]);  
            return $results;
        }
}
