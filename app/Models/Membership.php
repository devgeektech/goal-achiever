<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Membership
 * 
 * @property int $id
 * @property int $plan_id
 * @property int $student_id
 * @property int $subject_id
 * @property string|null $plan_days
 * @property string|null $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Plan $plan
 * @property User $user
 * @property Subject $subject
 *
 * @package App\Models
 */
class Membership extends Model
{
	protected $table = 'memberships';

	protected $casts = [
		'plan_id' => 'int',
		'student_id' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'plan_id',
		'student_id',
		'subject_id',
		'plan_days',
		'type',
		'expiry_date'
	];

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'student_id');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
