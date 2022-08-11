<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * 
 * @property int $id
 * @property int $plan_id
 * @property int $student_id
 * @property int $subject_id
 * @property string|null $name_on_card
 * @property string|null $card_number
 * @property string|null $cvc
 * @property string|null $expiration_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Plan $plan
 * @property User $user
 * @property Subject $subject
 *
 * @package App\Models
 */
class Payment extends Model
{
	protected $table = 'payments';

	protected $casts = [
		'plan_id' => 'int',
		'student_id' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'plan_id',
		'student_id',
		'subject_id',
		'name_on_card',
		'card_number',
		'cvc',
		'expiration_date'
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
