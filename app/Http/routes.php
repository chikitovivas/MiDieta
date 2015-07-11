<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::get('prueba', 'WelcomeController@prueba');

/* Home */
Route::get('home', 'HomeController@index');
Route::post('postHistorial','HomeController@postHistorial');

Route::get('home/{idHistorial}/{comida}/delete','HomeController@deleteComida');

/* Alimentos */
Route::get('alimentos', 'AlimentosC@index');
Route::post('postAlimento','AlimentosC@postAlimentos');
Route::post('getInfoA','AlimentosC@GetInfoA');

/* Historial */
Route::any('historial','HomeController@graficaH');
                /* PDF */
Route::get('historial/{from}/{to}/{letter}/{p_e}/pdf_email', 'HomeController@pdf_email');


/* Perfil */
Route::get('perfil', 'HomeController@perfil');
Route::post('updatePerfil', 'HomeController@Updateperfil');



