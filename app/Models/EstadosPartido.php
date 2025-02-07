<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadosPartido
 * 
 * @property int $id
 * @property string $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Partido[] $partidos
 *
 * @package App\Models
 */
class EstadosPartido extends Model
{
	protected $table = 'estados_partido';

	protected $fillable = [
		'estado'
	];

	public function partidos()
	{
		return $this->hasMany(Partido::class, 'estado_id');
	}
}
