<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 * 
 * @property int $id
 * @property int $subject_id
 * @property int $unit_id
 * @property string|null $name
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Subject $subject
 * @property Unit $unit
 *
 * @package App\Models
 */
class Topic extends Model
{
	protected $table = 'topics';

	protected $casts = [
		'subject_id' => 'int',
		'unit_id' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'unit_id',
		'name',
		'status'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function unit()
	{
		return $this->belongsTo(Unit::class);
	}
}
