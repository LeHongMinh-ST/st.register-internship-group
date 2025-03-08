<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Authenticatable
{
    protected $fillable = ['code', 'name', 'email', 'phone', 'topic', 'description', 'status', 'department', 'dob'];


    use HasFactory;

    protected $hidden = ['remember_token'];

    protected $casts = [
        'dob' => 'date', 
    ];

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')
                ->orWhere('department', 'like', '%' . $search . '%');
        }

        return $query;
    }
    
    public function officialGroups(): HasMany
    {
        return $this->hasMany(GroupOfficial::class, 'teacher_id');
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class, 'teacher_id');
    }
}
