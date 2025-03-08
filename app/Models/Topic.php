<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id', 'teacher_id', 'title', 'description'
    ];

    use HasFactory;

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
