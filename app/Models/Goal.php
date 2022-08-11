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
 * @property int $unit_id
 * @property int $topic_id
 * @property string|null $end_date
 * @property string|null $creator_name
 * @property string|null $instructor_name
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Subject $subject
 * @property Topic $topic
 * @property Unit $unit
 * @property User $user
 * @property Collection|GoalMedia[] $goal_media
 * @property Collection|TakenGoal[] $taken_goals
 *
 * @package App\Models
 */
class Goal extends Model
{
	protected $table = 'goals';

	protected $casts = [
		'user_id' => 'int',
		'subject_id' => 'int',
		'unit_id' => 'int',
		'topic_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'subject_id',
		'unit_id',
		'topic_id',
		'end_date',
		'creator_name',
		'instructor_name',
		'status'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

	public function unit()
	{
		return $this->belongsTo(Unit::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function goal_media()
	{
		return $this->hasMany(GoalMedia::class);
	}

	public function taken_goals()
	{
		return $this->hasMany(TakenGoal::class);
	}
}
