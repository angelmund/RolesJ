<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipo
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $escudo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Torneo[] $torneos
 * @property Collection|JugadorEquipo[] $jugador_equipos
 * @property Collection|Partido[] $partidos
 * @property Collection|Posicione[] $posiciones
 *
 * @package App\Models
 */
class Equipo extends Model
{
	protected $table = 'equipos';

	protected $fillable = [
		'nombre',
		'escudo'
	];

	public function torneos()
	{
		return $this->belongsToMany(Torneo::class)
					->withPivot('id')
					->withTimestamps();
	}

	public function jugador_equipos()
	{
		return $this->hasMany(JugadorEquipo::class);
	}

	public function partidos()
	{
		return $this->hasMany(Partido::class, 'equipo_visitante_id');
	}

	public function posiciones()
	{
		return $this->hasMany(Posicion::class);
	}
}
