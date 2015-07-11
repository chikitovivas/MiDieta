<?php namespace App\Http\Controllers;

use App\Alimentos;
use Request;
use Redirect;
use Response;

class AlimentosC extends Controller {

/* Alimentos controller, se encuentran las tablas y llamadas a todo lo que se refiere alimentos */

        public function index()
	{
                $alimentos = Alimentos::all();
		return view('alimentos')->with('alimentos',$alimentos);
	}

        public function postAlimentos()
        {
            $alimento = new Alimentos;
            
            $data = Request::all();
            //Si el alimento no existe
            if(($food =  Alimentos::findByName($data['nombre'])) == NULL ){
                if($alimento->validator($data))
                {
                    // Si la data es valida se la asignamos al usuario
                    $alimento->fill($data);

                    // Guardamos el usuario
                    $alimento->save();

                    return Redirect::back();
                }else{
                    return  Redirect::back()
                            ->withErrors($alimento->errors)
                            ->withInput();
                }                
            }else{
                //Si existe el alimento, lo updeteamos
                if($alimento->validator($data))
                {
                    // Si la data es valida se la asignamos al usuario
                    $food->fill($data);

                    // Guardamos el usuario
                    $food->save();

                    return Redirect::back();
                }else{
                    return  Redirect::back()
                            ->withErrors($alimento->errors)
                            ->withInput();
                }
            }
            

            
        }

        public function GetInfoA()
        {
            $data = Request::all(); 
            $info = Alimentos::getInfoAlimento($data['id']);
            return Response::json(['success'=>true,'info'=>$info[0]]);
        }

        
        
}
