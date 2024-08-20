<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function index(Campaign $campaign)
    {
        return view('pages.client.research', [
            'campaignId' => $campaign->id
        ]);
    }
}
