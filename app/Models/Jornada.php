<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jornada
 * 
 * @property int $id
 * @property int $torneo_id
 * @property int $numero_jornada
 * @property Carbon $fecha
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Torneo $torneo
 * @property Collection|Partido[] $partidos
 *
 * @package App\Models
 */
class Jornada extends Model
{
	protected $table = 'jornadas';

	protected $casts = [
		'torneo_id' => 'int',
		'numero_jornada' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'torneo_id',
		'numero_jornada',
		'fecha'
	];

	public function torneo()
	{
		return $this->belongsTo(Torneo::class);
	}

	public function partidos()
	{
		return $this->hasMany(Partido::class);
	}
}
