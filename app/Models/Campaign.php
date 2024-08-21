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
}
