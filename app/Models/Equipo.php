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
		return $this->belongsToMany(Torneo::class, 'jugador_equipo_torneo')
					->withPivot('id', 'jugador_id')
					->withTimestamps();
	}

	public function partidos()
	{
		return $this->hasMany(Partido::class, 'equipo_visitante_id');
	}

	public function posiciones()
	{
		return $this->hasMany(Posicione::class);
	}

	// Definir la relación con el modelo Jugador a través de la tabla pivote
    public function jugadores()
    {
        return $this->belongsToMany(Jugador::class, 'jugador_equipo_torneo', 'equipo_id', 'jugador_id');
    }
}
