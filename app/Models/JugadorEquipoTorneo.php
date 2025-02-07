<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JugadorEquipoTorneo
 * 
 * @property int $id
 * @property int $jugador_id
 * @property int $equipo_id
 * @property int $torneo_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Equipo $equipo
 * @property Jugadore $jugadore
 * @property Torneo $torneo
 *
 * @package App\Models
 */
class JugadorEquipoTorneo extends Model
{
	protected $table = 'jugador_equipo_torneo';

	protected $casts = [
		'jugador_id' => 'int',
		'equipo_id' => 'int',
		'torneo_id' => 'int'
	];

	protected $fillable = [
		'jugador_id',
		'equipo_id',
		'torneo_id'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class);
	}

	public function jugador()
	{
		return $this->belongsTo(Jugador::class, 'jugador_id');
	}

	public function torneo()
	{
		return $this->belongsTo(Torneo::class);
	}
}
