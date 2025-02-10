<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JugadorEquipo
 * 
 * @property int $id
 * @property int $jugador_id
 * @property int $equipo_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Equipo $equipo
 * @property Jugadore $jugadore
 *
 * @package App\Models
 */
class JugadorEquipo extends Model
{
	protected $table = 'jugador_equipo';

	protected $casts = [
		'jugador_id' => 'int',
		'equipo_id' => 'int'
	];

	protected $fillable = [
		'jugador_id',
		'equipo_id'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class);
	}

	public function jugadore()
	{
		return $this->belongsTo(Jugador::class, 'jugador_id');
	}
}
