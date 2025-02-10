<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EquipoTorneo
 * 
 * @property int $id
 * @property int $equipo_id
 * @property int $torneo_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Equipo $equipo
 * @property Torneo $torneo
 *
 * @package App\Models
 */
class EquipoTorneo extends Model
{
	protected $table = 'equipo_torneo';

	protected $casts = [
		'equipo_id' => 'int',
		'torneo_id' => 'int'
	];

	protected $fillable = [
		'equipo_id',
		'torneo_id'
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
