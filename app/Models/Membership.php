<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Membership
 * 
 * @property int $id
 * @property int $plan_id
 * @property int $student_id
 * @property int $subject_id
 * @property string|null $plan_days
 * @property string|null $type
 * @property string|null $subscription
 * @property string|null $expiry_date
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
	use SoftDeletes;
	
	protected $table = 'memberships';

	protected $casts = [
		'plan_id' => 'int',
		'student_id' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'plan_id',
		'student_id',
		'plan_days',
		'type',
		'subscription',
		'expiry_date',
		'transaction_id'
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
