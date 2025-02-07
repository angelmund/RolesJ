<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Torneo
 * 
 * @property int $id
 * @property string $nombre
 * @property int $modalidad_id
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Modalidade $modalidade
 * @property Collection|Jornada[] $jornadas
 * @property Collection|Equipo[] $equipos
 * @property Collection|Posicione[] $posiciones
 *
 * @package App\Models
 */
class Torneo extends Model
{
	protected $table = 'torneos';

	protected $casts = [
		'modalidad_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'modalidad_id',
		'fecha_inicio',
		'fecha_fin'
	];

	public function modalidad()
	{
		return $this->belongsTo(Modalidad::class, 'modalidad_id');
	}

	public function jornadas()
	{
		return $this->hasMany(Jornada::class);
	}

	public function equipos()
	{
		return $this->belongsToMany(Equipo::class, 'jugador_equipo_torneo')
					->withPivot('id', 'jugador_id')
					->withTimestamps();
	}

	public function posiciones()
	{
		return $this->hasMany(Posicione::class);
	}
}
