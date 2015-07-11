<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use DB;

    class Historial extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'historial';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['users_id','fecha','Tipo_Comida_id','total_indiceg','total_carbohidratos','total_calorias'];

        public function user(){
            return $this->belongsTo('App\User');
        }
        
        
        public function tipo_Comida(){
           return $this->hasOne('App\Tipo_comida'); 
        }
        public function alimentos(){
           return $this->belongsToMany('App\Alimentos','Alimentos_id'); 
        }
        
        
        public function validator(array $data)
	{
		return Validator::make($data, [
			'users_id' => 'required|max:255',
			'fecha' => 'required|date',
                        'Tipo_Comida_id' => 'required',
			'total_indiceg' => 'integer',
                        'total_carbohidratos' => 'integer',
                        'total_calorias' => 'integer',
		]);
	}
        /* Funcion obtener todos los historiales del dia, de un usuario dado*/
        public static function getHistorial($users_id,$fecha,$Tipo_Comida){
            $results = DB::select("SELECT historial.id as id, historial.Tipo_Comida_id as id_comida, historial.total_calorias as calorias, 
                                          historial.total_carbohidratos as carbohidratos, historial.total_indiceg as indiceg
                                   FROM historial
                                   WHERE historial.Tipo_Comida_id = :tipo and
                                         historial.users_id = :us_id and historial.fecha = :fecha", 
                                         ['fecha' => $fecha,'us_id' => $users_id, 'tipo' => $Tipo_Comida] );
            return $results;
        }

        
        /* Funcion para buscar los alimentos de un historial */
        public static function getAlimentos_de_historial($historial_id){
            $results = DB::select("SELECT alimentos.nombre as comida, alimentos.calorias as calorias, alimentos.carbohidratos as carbohidratos,
                                          alimentos.indiceg as indiceg, alimentos.id as id, ali.cantidad as cantidad
                                   FROM (SELECT historial_has_alimentos.Alimentos_id as id, historial_has_alimentos.cantidad
                                         FROM historial_has_alimentos 
                                         WHERE historial_has_alimentos.Historial_id = :historial) as ali, alimentos
                                   WHERE alimentos.id = ali.id", ['historial' => $historial_id]);
            return $results;
        }
        /* Funcion para update el valor de los totales del historial */
        public static function updateHistorial($historial_id,$t_calorias,$t_carbohidratos,$t_indiceg){
            $results = DB::statement("  UPDATE historial
                                        SET historial.total_calorias= :calorias, historial.total_carbohidratos= :carbohidratos, 
                                            historial.total_indiceg= :indiceg
                                        WHERE historial.id = :historial ", 
                                        ['historial' => $historial_id, 
                                         'calorias' => $t_calorias,
                                         'carbohidratos' => $t_carbohidratos,  
                                         'indiceg' => $t_indiceg
                                            ]);
        }
       
        public static function nuevoIG($historial, $t_carb){
            $historiales =  Historial::getAlimentos_de_historial($historial);
            $total_carb = $t_carb;
            $sumar = 0;
            
            foreach($historiales as $h){
                $sumar += (($h->carbohidratos/$total_carb) * $h->indiceg) * $h->cantidad;               
            }          
            return $sumar;
        }
}
