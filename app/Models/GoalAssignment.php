<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoalAssignment
 * 
 * @property int $id
 * @property int $goal_id
 * @property int $student_id
 * @property string|null $feedback
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Goal $goal
 * @property User $user
 *
 * @package App\Models
 */
class GoalAssignment extends Model
{
	protected $table = 'goal_assignments';

	protected $casts = [
		'goal_id' => 'int',
		'student_id' => 'int'
	];

	protected $fillable = [
		'goal_id',
		'student_id',
		'feedback'
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
