<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroupOfficial extends Model
{
    protected $table = 'student_group_officials';

    protected $fillable = ['phone', 'internship_company', 'phone_family', 'email', 'student_id', 'supervisor_company'];


    use HasFactory;
}
