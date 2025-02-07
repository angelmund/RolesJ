<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Modalidade
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Torneo[] $torneos
 *
 * @package App\Models
 */
class Modalidad extends Model
{
	protected $table = 'modalidades';

	protected $fillable = [
		'nombre'
	];

	public function torneos()
	{
		return $this->hasMany(Torneo::class, 'modalidad_id');
	}
}
