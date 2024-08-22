<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start', 'end', 'max_student_group'];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function isExpired()
    {
        $now = Carbon::now()->timestamp;
        $end = Carbon::make($this->end)->endOfDay()->timestamp;
        return $end < $now;
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($campaign) {
            GroupStudent::query()
                ->whereIn('student_id', $campaign->students->pluck('id')->toArray())
                ->delete();

            Student::query()->where('campaign_id', $campaign->id)->delete();
            GroupKey::query()->whereIn('group_id', $campaign->groups->pluck('id')->toArray())->delete();
            Group::query()->where('campaign_id', $campaign->id)->delete();
        });
    }
}
