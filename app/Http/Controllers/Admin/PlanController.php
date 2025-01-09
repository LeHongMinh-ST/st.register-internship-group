<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanDetail;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view('pages.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory
    {
        return view('pages.plan.create');
    }

    public function show(Plan $plan): View|Application|Factory
    {
        return view('pages.plan.show')->with([
            'id' => $plan->id,
        ]);
    }

    public function edit(Plan $plan): View|Application|Factory
    {
        return view('pages.plan.edit')->with([
            'id' => $plan->id,
        ]);
    }

    public function editPlanDetail(PlanDetail $planDetail): View|Application|Factory
    {
        $planTemplateId = $planDetail->planTemplate->id;
        return view('pages.plan.detail-edit')->with([
            'id' => $planDetail->id,
            'planTemplateId' => $planTemplateId,
        ]);
    }

    public function createPlanDetail(Plan $plan): View|Application|Factory
    {
        return view('pages.plan.detail-create')->with([
            'id' => $plan->id,
        ]);
    }
}
