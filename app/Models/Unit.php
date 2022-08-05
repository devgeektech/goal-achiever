<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Unit
 * 
 * @property int $id
 * @property int $subject_id
 * @property string|null $name
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Subject $subject
 * @property Collection|Topic[] $topics
 *
 * @package App\Models
 */
class Unit extends Model
{
	protected $table = 'units';

	protected $casts = [
		'subject_id' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'name',
		'status'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function topics()
	{
		return $this->hasMany(Topic::class);
	}
}
