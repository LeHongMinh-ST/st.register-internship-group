<?php

namespace App\Http\Controllers;

use App\Enums\CampaignStatusEnum;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::query()
            ->where('status', CampaignStatusEnum::Active->value)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('pages.client.home', compact('campaigns'));
    }
}
