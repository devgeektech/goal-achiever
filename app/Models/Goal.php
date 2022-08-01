<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Goal
 * 
 * @property int $id
 * @property int $user_id
 * @property int $subject_id
 * @property string|null $unit
 * @property string|null $topic
 * @property string|null $creator_name
 * @property string|null $instructor_name
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Subject $subject
 * @property User $user
 * @property Collection|GoalMedia[] $goal_media
 *
 * @package App\Models
 */
class Goal extends Model
{
	protected $table = 'goals';

	protected $casts = [
		'user_id' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'subject_id',
		'unit',
		'topic',
		'creator_name',
		'instructor_name',
		'status'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function goal_media()
	{
		return $this->hasMany(GoalMedia::class);
	}
}
