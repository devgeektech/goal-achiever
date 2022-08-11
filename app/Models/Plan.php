<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Plan
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $price
 * @property string|null $months
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Membership[] $memberships
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class Plan extends Model
{
	protected $table = 'plans';

	protected $fillable = [
		'name',
		'price',
		'months'
	];

	public function memberships()
	{
		return $this->hasMany(Membership::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}
}
