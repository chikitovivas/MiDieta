<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Tipo_comida extends Model{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tipo_comida';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'Tipo'];

        public function validator(array $data)
	{
		return Validator::make($data, [
			'Tipo' => 'required|max:255',
		]);
	}
}
