<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $campaign = Campaign::query()->where('start', '<', $now)
            ->where('end', '>', $now)->first();
        if (!$campaign) {
            abort(404);
        }

        return redirect()->route('internship.register', $campaign->id);
    }
}
