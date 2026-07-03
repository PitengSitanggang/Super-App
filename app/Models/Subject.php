<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'code',
        'group',
        'name'
    ];

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher');
    }

    public function lessonPlans()
    {
        return $this->hasMany(LessonPlan::class);
    }
}
