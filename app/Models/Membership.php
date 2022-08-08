<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
		'plan_id',
		'student_id',
		'subject_id',
		'plan_days',
		'type'
	];
}
