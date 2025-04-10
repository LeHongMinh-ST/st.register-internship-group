<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.report.index');
    }

    public function show($campaignId)
    {
        $campaign = Campaign::findOrFail($campaignId);
        return view('pages.report.show', compact('campaign'));
    }
    
}
