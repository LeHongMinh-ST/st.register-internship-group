<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id', 'name', 'code', 'dob', 'class',
        'course_id', 'credit',
        'condition', 'note', 'group_id'
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }



    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function groupStudent()
    {
        return $this->hasOne(GroupStudent::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('code', 'like', '%'.$search.'%');
        }

        return $query;
    }
}
