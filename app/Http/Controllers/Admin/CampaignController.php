<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view('pages.campaign.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory
    {
        return view('pages.campaign.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign): View|Application|Factory
    {
        return view('pages.campaign.update')->with([
            'id' => $campaign->id,
        ]);
    }


    public function show(Campaign $campaign): View|Application|Factory
    {
        return view('pages.campaign.show')->with([
            'id' => $campaign->id,
        ]);
    }
}
