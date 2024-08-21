<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['supervisor', 'topic', 'campaign_id'];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function captain(): HasOne
    {
        return $this->hasOne(Student::class)->whereHas('groupStudent', function ($q) {
            $q->where('is_captain', true);
        });
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

    public function groupKey()
    {
        return $this->hasOne(GroupKey::class)->orderBy('created_at', 'desc');
    }
}
