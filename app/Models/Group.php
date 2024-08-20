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
}
