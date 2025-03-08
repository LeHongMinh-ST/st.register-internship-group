<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;

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

    public function login()
    {
        return view('pages.teacher.login');
    }

    public function campaigns()
    {
        return view('pages.teacher.campaigns');
    }

    public function groups(Campaign $campaignId)
    {
        return view('pages.teacher.groups', compact('campaignId'));
    }

    public function logout(Request $request)
    {
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('teacher.teacher-login')->with('success', 'Đăng xuất thành công!');
    }

    public function topic()
    {
        return view('pages.teacher.topic.index');
    }

    public function topicCreate()
    {
        return view('pages.teacher.topic.create');
    }

    public function topicEdit()
    {
        return view('pages.teacher.topic.edit');
    }
}
