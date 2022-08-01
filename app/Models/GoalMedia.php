<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoalMedia
 * 
 * @property int $id
 * @property int $goal_id
 * @property string|null $media
 * @property string|null $ext
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Goal $goal
 *
 * @package App\Models
 */
class GoalMedia extends Model
{
	protected $table = 'goal_media';

	protected $casts = [
		'goal_id' => 'int'
	];

	protected $fillable = [
		'goal_id',
		'media',
		'ext'
	];

	public function goal()
	{
		return $this->belongsTo(Goal::class);
	}
}
