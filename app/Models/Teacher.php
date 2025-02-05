<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['code', 'name', 'email', 'phone', 'topic', 'description', 'status', 'department'];


    use HasFactory;

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')
                ->orWhere('department', 'like', '%' . $search . '%');
        }

        return $query;
    }
}
