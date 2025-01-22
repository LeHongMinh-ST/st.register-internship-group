<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view('pages.company.index');
    }

    public function create()
    {
        return view('pages.company.create');
    }

    public function edit($id)
    {
        return view('pages.company.edit');
    }

    public function companyCampaignIndex()
    {
        return view('pages.company-campaign.index');
    }

    public function companyCampaignShow(Campaign $campaign)
    {
        return view('pages.company-campaign.show')->with([
            'id' => $campaign->id,
        ]);
    }
}
