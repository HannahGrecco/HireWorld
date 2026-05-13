<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Services\HolidayService;
use App\Services\ExchangeRateService;
use App\Services\CulturalInsightService;


class CountryController extends Controller
{
    public function index (Request $request){
        $search = $request->search;
        $countries = Country::when($search, function($query,$search){
            $query->where('name', 'like', "%{$search}%");
        })->get();
        return view('countries.index', compact('countries'));
    }

    public function show ($id) {
        $country = Country::findOrFail($id);

        $serviceRate = new ExchangeRateService();
        $service = new HolidayService();
        $serviceInsight = new CulturalInsightService();
        $rates = $serviceRate->getRate($country) ?? [];
        $holidays = $service->getHolidays($country) ?? [];
        $insights = $serviceInsight->getCulturalInsight($country) ?? [];


        return view('countries.show', compact('country', 'holidays', 'rates', 'insights'));

    }

}
