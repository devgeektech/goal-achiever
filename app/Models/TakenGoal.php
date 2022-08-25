<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TakenGoal
 * 
 * @property int $id
 * @property int $goal_id
 * @property int $student_id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Goal $goal
 * @property User $user
 *
 * @package App\Models
 */
class TakenGoal extends Model
{
	protected $table = 'taken_goals';

	protected $casts = [
		'goal_id' => 'int',
		'student_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'goal_id',
		'student_id',
		'status',
		'subject_id',
		'unit_id',
		'topic_id',
		'end_date'
	];

	public function goal()
	{
		return $this->belongsTo(Goal::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'student_id');
	}
}
