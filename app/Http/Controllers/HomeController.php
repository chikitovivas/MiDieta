<?php namespace App\Http\Controllers;

use App\Historial;
use App\Alimentos;
use App\Historial_has_Alimentos;
use app\User;
use errors;
use DB;
use Redirect;
use Hash;

use Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Mail;

use App;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *CONSTRUCTOR
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
                date_default_timezone_set('America/Caracas');
                $this->timezone = date('Y-m-d');
                
	}

	/**
	 * Show the application dashboard to the user.
	 *Index, Home
	 * @return Response 
	 */

        
	public function index()
	{  /* Si no existe un historial de desayuno(1) para mostrar, se crea */
            if(Historial::getHistorial(\Auth::user()->id,$this->timezone,1) == NULL)
            {
                $this->crear_historial(1);
            }
            /* Si no existe un historial de almuerzo(2) para mostrar, se crea */
            if(Historial::getHistorial(\Auth::user()->id,$this->timezone,2) == NULL)
            {
                $this->crear_historial(2);
            }
            /* Si no existe un historial de cena(3) para mostrar, se crea */
            if(Historial::getHistorial(\Auth::user()->id,$this->timezone,3) == NULL)
            {
                $this->crear_historial(3);
            }
            
            
            /* $Hist[0] = Desayuno
             * $Hist[1] = Almuerzo
             * $Hist[2] = Cena  */
            /* Se busca los historiales de hoy, del usuario */
           $Desayuno =  Historial::getHistorial(\Auth::user()->id,$this->timezone,1);
           $Almuerzo = Historial::getHistorial(\Auth::user()->id,$this->timezone,2);
           $Cena =  Historial::getHistorial(\Auth::user()->id,$this->timezone,3);       
           $total = array(
               '1' => $Desayuno[0]->calorias + $Almuerzo[0]->calorias + $Cena[0]->calorias,
               '2' => $Desayuno[0]->carbohidratos + $Almuerzo[0]->carbohidratos + $Cena[0]->carbohidratos,
               '3' => $Desayuno[0]->indiceg + $Almuerzo[0]->indiceg + $Cena[0]->indiceg    
           ); 
           
           /* Se busca las comidas de esos historiales */
            $comidas_desayuno = Historial::getAlimentos_de_historial($Desayuno[0]->id);
            /* Si hay almuerzo, se buscan las comidas del almuerzo  */
            $comidas_almuerzo = Historial::getAlimentos_de_historial($Almuerzo[0]->id);              
            /* Si hay cena, se busca las comidas de la cena */
            $comidas_cena = Historial::getAlimentos_de_historial($Cena[0]->id);
               
            
            /* alimentos para los select */
            $alimentos = ['' => ''] + Alimentos::lists('nombre','id');
            /* Enteros, para la cantidad del alimento a ingerir */
            $enteros = 
                    array(
                    
                        '1' => 1, 
                        '2' => 2,
                        '3' => 3, 
                        '4' => 4,
                        '5' => 5, 
                        '6' => 6,
                        '7' => 7, 
                        '8' => 8,
                        '9' => 9, 
                        '10' => 10
                    
                    );
            
            if(($total[1] > 2000) || ($total[2] > 1000) || 
                    ($Desayuno[0]->calorias > 700) || ($Almuerzo[0]->calorias > 700) || ($Cena[0]->calorias > 700) ){
                       
                return view('home')
                    ->with('Desayuno',$Desayuno)
                    ->with('Almuerzo',$Almuerzo)
                    ->with('Cena',$Cena)
                    ->with('comidas_desayuno',$comidas_desayuno)
                    ->with('comidas_almuerzo',$comidas_almuerzo)
                    ->with('comidas_cena',$comidas_cena)
                    ->with('alimentos',$alimentos)
                    ->with('enteros',$enteros)
                    ->with('total',$total)
                    ->withErrors(['Esta introduciendo mas de lo debido']);     
            }
            
            /* Redireccion */
            return view('home')
                    ->with('Desayuno',$Desayuno)
                    ->with('Almuerzo',$Almuerzo)
                    ->with('Cena',$Cena)
                    ->with('comidas_desayuno',$comidas_desayuno)
                    ->with('comidas_almuerzo',$comidas_almuerzo)
                    ->with('comidas_cena',$comidas_cena)
                    ->with('alimentos',$alimentos)
                    ->with('enteros',$enteros)
                    ->with('total',$total);     
	}
        
        /*
         * Se a#ade nueva comida al historial
         *          */
        
        public function postHistorial()
	{
            /* Nueva comida para el historial */
            $Historial = new Historial_has_Alimentos;
            /* Post de todos los datos */
            $data = Request::all();
            /* Si no hay una comida introducida en este historial */
            if( Historial_has_Alimentos::findH($data['Historial_id'],$data['Alimentos_id']) == NULL)
            {
                // Si la data es valida se la asignamos al historial
                $Historial->fill($data);

                // Guardamos el la nueva comida del historial
                $Historial->save();
                /* Se busca el historial actual */
                $info = Historial::find($data['Historial_id']);
                
                if($info->Tipo_Comida_id == 1){
                    /* Se update los datos de los totales en historial (Desayuno) */
                    Historial::updateHistorial($data['Historial_id'],
                                               $info->total_calorias + ($data['desayuno_calorias'] * $data['cantidad']),
                                               $info->total_carbohidratos + ($data['desayuno_carbohidratos'] * $data['cantidad']),
                                               Historial::nuevoIG($info->id ,$info->total_carbohidratos + $data['desayuno_carbohidratos'])
                                              );
                }else if($info->Tipo_Comida_id == 2){
                    /* Se update los datos de los totales en historial (Almuerzo) */
                    Historial::updateHistorial($data['Historial_id'],
                                               $info->total_calorias + ($data['almuerzo_calorias'] * $data['cantidad']),
                                               $info->total_carbohidratos + ($data['almuerzo_carbohidratos'] * $data['cantidad']),
                                               Historial::nuevoIG($info->id ,$info->total_carbohidratos + $data['almuerzo_carbohidratos'])
                                              );                    
                }else{
                    /* Se update los datos de los totales en historial (Cena) */
                    Historial::updateHistorial($data['Historial_id'],
                                               $info->total_calorias + ($data['cena_calorias'] * $data['cantidad']),
                                               $info->total_carbohidratos + ($data['cena_carbohidratos'] * $data['cantidad']),
                                               Historial::nuevoIG($info->id ,$info->total_carbohidratos + $data['cena_carbohidratos'])
                                             );                    
                }
                /* Redireccion */
                return Redirect::back();             
            }else{
                /* Redireccion */
                return  Redirect::back()->withErrors(['Ya introdujo esta comida']);
                
            }        
	}


        /* 
         *   
         * Para borrar una comida de un historial
         * 
         *          */
        public function deleteComida($historial_id,$comida_id)
        {
            $cantidad = DB::table('Historial_has_Alimentos')->where('Historial_id', '=', $historial_id) 
                                                            ->where('Alimentos_id', '=', $comida_id )->get();
            /* Borramos el alimento del historial */
            Historial_has_Alimentos::deleteComida($historial_id,$comida_id);
            /* Buscamos los datos del alimento borrado */
            $infoA = Alimentos::findById($comida_id);
            /* Buscamos los datos del Historial */
            $infoH = Historial::find($historial_id);
            /* Actualizamos los valores de los totales en el historial */
            Historial::updateHistorial($historial_id,$infoH['total_calorias']-($infoA['calorias'] * $cantidad[0]->cantidad),
                                       $infoH['total_carbohidratos']-($infoA['carbohidratos'] * $cantidad[0]->cantidad),
                                       Historial::nuevoIG($infoH['id'] ,$infoH['total_carbohidratos'] - $infoA['carbohidratos'])                               
                                      );
            /* Redireccion */
            return Redirect::to('home');
                    
        }
        public function crear_historial($Tipo_comida) {
                /* Instaciamos un nuevo historial */
                $nuevo_historial = new Historial;
                /* Seteamos los valores del nuevo historial */
                $valores_historial = 
                    array(
                    
                        'users_id' => \Auth::user()->id, 
                        'fecha' => $this->timezone,
                        'Tipo_Comida_id' => $Tipo_comida, 
                        'total_indiceg' => 0,
                        'total_carbohidratos' => 0, 
                        'total_calorias' => 0
                    
                    );
                /* Llenamos los datos del nuevo historial */
                $nuevo_historial->fill($valores_historial);
                /* Lo guardamos */
                $nuevo_historial->save();
        }
        
	public function historial()
	{
            return view('historial');
	}
	public function perfil()
	{
            $user = User::find(\Auth::user()->id);
            return view('perfil')
                    ->with('user',$user);
	}        
        
        
	public function updatePerfil()
	{
            $usuario = User::find(\Auth::user()->id);
            $data = Request::all();
            if(($data['password'] !== '') && ($data['re-password'] !== '')){
                if($data['password'] === $data['re-password']){
          /*  $data_usuario = 
                    array(
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => $data['password'],
                        'email_doctor' => $data['email_doctor']
                        
                        
                    );*/
                    $data['password'] = Hash::make($data['password']);
                    $usuario->fill($data);

                    $usuario->save();

                    return Redirect::to('perfil');          
                    //return $data['password'];
                }else{
                    //Redirect::to('perfil')
                    return "chao"; 
                }          
            }
            
            $new = array(
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'email_doctor' => $data['email_doctor']
                
            );
            
            $usuario->fill($new);

            $usuario->save();

            return Redirect::to('perfil'); 
            //return "correcto";
            
                }            
        
        public function graficaH() {
            $data = Request::all();
            $letras = 
                array(                   
                    'd' => 'd', 
                    'm' => 'm',
                    'a' => 'a',             
                ); 
            if($data == NULL){
                return view('index')
                        ->with('muestra',0)
                        ->with('date_from','')
                        ->with('date_to', '')
                        ->with('letras',$letras);
            }else{
                $query='call get_graf_D('.\Auth::user()->id.',"'.$data['date_from'].'","'.$data['date_to'].'","'.$data['letter'].'");';
                $results = DB::select($query);
                $i = 0;
                if($results == NULL){
                    return Redirect::back()->withErrors(['No hay historial entre estas dos fechas'])
                                           ->with('muestra',0);
                }else{
                    
                foreach($results as $result){
                    $carb_m[$i] = $result->total_carbohidratos;
                    $calo_m[$i] = $result->total_calorias;
                    $indi_m[$i] = $result->total_indice;  
                    $i++;
                }               
                return view('index')
                        ->with('carb_m',$carb_m)
                        ->with('calo_m',$calo_m)
                        ->with('indi_m',$indi_m)
                        ->with('cantidad',$i)
                        ->with('muestra',1)
                        ->with('letras',$letras)
                        ->with('letter', $data['letter'])
                        ->with('date_from', $data['date_from'])
                        ->with('date_to', $data['date_to']);    
                }

            }

        }
        
        public function pdf_email($date_from,$date_to,$letter,$p_m){
            $data = Request::all();
            $query='call get_graf_D('.\Auth::user()->id.',"'.$date_from.'","'.$date_to.'","'.$letter.'");';
                $results = DB::select($query);
                $i = 0;
                if($results == NULL){
                    return Redirect::back()->withErrors(['No hay historial entre estas dos fechas'])
                                           ->with('muestra',0);
                }else{
                    
                foreach($results as $result){
                    $carb_m[$i] = $result->total_carbohidratos;
                    $calo_m[$i] = $result->total_calorias;
                    $indi_m[$i] = $result->total_indice;  
                    $date[$i] = $result->fecha;  
                    $carga[$i] = ($indi_m[$i] * $carb_m[$i] / 300);
                    $i++;
                }       
                $fecha = $this->timezone;
                $user = User::find(\Auth::user()->id);
                
                $promedio_cg = 0; 
                if($i > 0){                  
                    for($x = 0; $x < $i; $x++){                                     
                        $promedio_cg += $carga[$x];                                                                                                                      
                    }
                    $promedio_cg = $promedio_cg / ($i );          
                }
                if($p_m == 1){
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadHTML(
                            view('PDF_file_planificamidieta')
                                ->with('carb_m',$carb_m)
                                ->with('calo_m',$calo_m)
                                ->with('indi_m',$indi_m)
                                ->with('cantidad',$i)
                                ->with('fecha_actual',$fecha)
                                ->with('carga_glucemica',$carga)
                                ->with('usuario',$user)
                                ->with('promedio_cg',$promedio_cg)
                                ->with('fecha',$date)
                                );
                    return $pdf->stream();
                }else{
                    Mail::send('PDF_file_planificamidieta',
                                ['carb_m' => $carb_m,
                                'calo_m'=>$calo_m,
                                'indi_m'=>$indi_m,
                                'cantidad'=>$i,
                                'fecha_actual'=>$fecha,
                                'carga_glucemica'=>$carga,
                                'usuario'=>$user,
                                'promedio_cg'=>$promedio_cg,
                                'fecha'=>$date], 
                                function($message) use ($user)
                                {  
                                    $message->from($user->email, $user->name);
                                    $message->subject("Reporte dieta");
                                    $message->to($user->email_doctor);
                                }
                               );
                      return Redirect::back();         
                }
   
            }
        }
        
}