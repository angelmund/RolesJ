<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Posicione
 * 
 * @property int $id
 * @property int $torneo_id
 * @property int $equipo_id
 * @property int $puntos
 * @property int $partidos_jugados
 * @property int $partidos_ganados
 * @property int $partidos_empatados
 * @property int $partidos_perdidos
 * @property int $goles_a_favor
 * @property int $goles_en_contra
 * @property int $diferencia_goles
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Equipo $equipo
 * @property Torneo $torneo
 *
 * @package App\Models
 */
class Posicione extends Model
{
	protected $table = 'posiciones';

	protected $casts = [
		'torneo_id' => 'int',
		'equipo_id' => 'int',
		'puntos' => 'int',
		'partidos_jugados' => 'int',
		'partidos_ganados' => 'int',
		'partidos_empatados' => 'int',
		'partidos_perdidos' => 'int',
		'goles_a_favor' => 'int',
		'goles_en_contra' => 'int',
		'diferencia_goles' => 'int'
	];

	protected $fillable = [
		'torneo_id',
		'equipo_id',
		'puntos',
		'partidos_jugados',
		'partidos_ganados',
		'partidos_empatados',
		'partidos_perdidos',
		'goles_a_favor',
		'goles_en_contra',
		'diferencia_goles'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class);
	}

	public function torneo()
	{
		return $this->belongsTo(Torneo::class);
	}
}
