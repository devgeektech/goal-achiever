<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'unit',
        'topic',
        'document',
        'video',
        'exam_document',
        'creator_name',
        'instructor_name'
    ];
}
