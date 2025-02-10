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
 * @property int $categoria_id
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Categoria $categoria
 * @property Modalidade $modalidade
 * @property Collection|Equipo[] $equipos
 * @property Collection|Jornada[] $jornadas
 * @property Collection|Posicione[] $posiciones
 *
 * @package App\Models
 */
class Torneo extends Model
{
	protected $table = 'torneos';

	protected $casts = [
		'modalidad_id' => 'int',
		'categoria_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'modalidad_id',
		'categoria_id',
		'fecha_inicio',
		'fecha_fin'
	];

	public function categoria()
	{
		return $this->belongsTo(Categoria::class);
	}

	public function modalidad()
	{
		return $this->belongsTo(Modalidad::class, 'modalidad_id');
	}

	public function equipos()
	{
		return $this->belongsToMany(Equipo::class)
					->withPivot('id')
					->withTimestamps();
	}

	public function jornadas()
	{
		return $this->hasMany(Jornada::class);
	}

	public function posiciones()
	{
		return $this->hasMany(Posicion::class);
	}
}
