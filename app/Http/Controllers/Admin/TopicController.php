<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;

class TopicController extends Controller
{
    public function index()
    {
        return view('pages.topic.index');
    }

    public function show($campaignId)
    {
        $campaign = Campaign::findOrFail($campaignId);
        return view('pages.topic.show', compact('campaign'));   
    }
}
