<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Partido
 * 
 * @property int $id
 * @property int $jornada_id
 * @property int $equipo_local_id
 * @property int $equipo_visitante_id
 * @property int $estado_id
 * @property int $goles_local
 * @property int $goles_visitante
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Equipo $equipo
 * @property EstadosPartido $estados_partido
 * @property Jornada $jornada
 *
 * @package App\Models
 */
class Partido extends Model
{
	protected $table = 'partidos';

	protected $casts = [
		'jornada_id' => 'int',
		'equipo_local_id' => 'int',
		'equipo_visitante_id' => 'int',
		'estado_id' => 'int',
		'goles_local' => 'int',
		'goles_visitante' => 'int'
	];

	protected $fillable = [
		'jornada_id',
		'equipo_local_id',
		'equipo_visitante_id',
		'estado_id',
		'goles_local',
		'goles_visitante'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
	}

	public function estados_partido()
	{
		return $this->belongsTo(EstadosPartido::class, 'estado_id');
	}

	public function jornada()
	{
		return $this->belongsTo(Jornada::class);
	}
}
