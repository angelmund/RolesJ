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
 * @property int|null $numero_camiseta
 * @property string|null $foto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|JugadorEquipo[] $jugador_equipos
 *
 * @package App\Models
 */
class Jugador extends Model
{
	protected $table = 'jugadores';

	protected $casts = [
		'edad' => 'int',
		'numero_camiseta' => 'int'
	];

	protected $fillable = [
		'nombre',
		'edad',
		'numero_camiseta',
		'foto'
	];

	public function jugador_equipos()
	{
		return $this->hasMany(JugadorEquipo::class, 'jugador_id');
	}
}
