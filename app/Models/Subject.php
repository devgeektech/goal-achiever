<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 * 
 * @property int $id
 * @property string|null $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $image
 * 
 * @property Collection|Goal[] $goals
 * @property Collection|Membership[] $memberships
 * @property Collection|Payment[] $payments
 * @property Collection|Topic[] $topics
 * @property Collection|Unit[] $units
 *
 * @package App\Models
 */
class Subject extends Model
{
	protected $table = 'subjects';

	protected $fillable = [
		'title',
		'image'
	];

	public function goals()
	{
		return $this->hasMany(Goal::class);
	}

	public function memberships()
	{
		return $this->hasMany(Membership::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}

	public function topics()
	{
		return $this->hasMany(Topic::class);
	}

	public function units()
	{
		return $this->hasMany(Unit::class);
	}
}
