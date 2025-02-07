<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jugadore
 * 
 * @property int $id
 * @property string $nombre
 * @property int|null $edad
 * @property int|null $numero
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|JugadorEquipoTorneo[] $jugador_equipo_torneos
 *
 * @package App\Models
 */
class Jugador extends Model
{
	protected $table = 'jugadores';

	protected $casts = [
		'edad' => 'int',
		'numero' => 'int'
	];

	protected $fillable = [
		'nombre',
		'edad',
		'numero'
	];

	public function jugador_equipo_torneos()
	{
		return $this->hasMany(JugadorEquipoTorneo::class, 'jugador_id');
	}
}
