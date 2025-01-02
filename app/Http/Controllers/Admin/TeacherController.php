<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return view('pages.teacher.index');
    }

    public function downloadTemplateTeacher()
    {
        $filePath = public_path('templates/teacher.xlsx');
        return response()->download($filePath);
    }

    public function edit()
    {
        return view('pages.teacher.edit');
    }
}
