<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $role
 * @property string|null $profile_image
 * @property string|null $country
 * @property string|null $age
 * 
 * @property Collection|GoalAssignment[] $goal_assignments
 * @property Collection|Goal[] $goals
 * @property Collection|Membership[] $memberships
 * @property Collection|Payment[] $payments
 * @property Collection|TakenGoal[] $taken_goals
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'users';

	protected $casts = [
		'role' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'role',
		'profile_image',
		'country',
		'age'
	];

	public function goal_assignments()
	{
		return $this->hasMany(GoalAssignment::class, 'student_id');
	}

	public function goals()
	{
		return $this->hasMany(Goal::class);
	}

	public function memberships()
	{
		return $this->hasMany(Membership::class, 'student_id');
	}

	public function payments()
	{
		return $this->hasMany(Payment::class, 'student_id');
	}

	public function taken_goals()
	{
		return $this->hasMany(TakenGoal::class, 'student_id');
	}
}
