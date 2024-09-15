<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class GroupOfficial extends Model
{
    use HasFactory;


    protected $fillable = ['supervisor', 'topic', 'campaign_id', 'teacher_id', 'department', 'code'];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function groupKey(): MorphOne
    {
        return $this->morphOne(GroupKey::class, 'groupkeyable', 'group_type', 'group_id')->orderBy('created_at', 'desc');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->whereHas('students', function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('code', 'like', '%'.$search.'%');
            });
        }

        return $query;
    }
}
