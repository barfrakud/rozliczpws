<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateNationalSettlementRequest;
use App\Http\Requests\CalculateNationalTripRequest;
use App\Services\NationalTripService;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function krajowa()
    {
        return view('national');
    }

    public function krajowaObliczPodroze(CalculateNationalTripRequest $request, NationalTripService $nationalTripService)
    {
        return response()->json($nationalTripService->calculateTripSummary($request->validated()));
    }

    public function krajowaObliczRachunek(CalculateNationalSettlementRequest $request, NationalTripService $nationalTripService)
    {
        return response()->json($nationalTripService->calculateSettlement($request->validated()));
    }

    public function zagraniczna()
    {
        return view('foreign');
    }

    public function pomoc()
    {
        return view('help');
    }

    public function kontakt()
    {
        return view('contact');
    }

    public function podstawa()
    {
        return view('legal');
    }
}
