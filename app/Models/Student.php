<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'student_number',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'address',
        'parent_name',
        'parent_phone_number',
        'grade',
        'major'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
