<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Services\TechSalaryService;
use App\Services\HolidayService;
use App\Services\ExchangeRateService;
use App\Services\CulturalInsightService;
use Barryvdh\DomPDF\Facade\Pdf;


class CountryController extends Controller
{
    public function index (Request $request){
        $search = $request->search;
        $normalizedSearch = $search ? trim($search) : null;

        $query = Country::query();

        if ($normalizedSearch) {
            $query->where('name', 'like', "%{$normalizedSearch}%")
                ->orWhere('iso_code', 'like', "%{$normalizedSearch}%");
        }

        $countries = $query->get();

        if ($normalizedSearch && $countries->count() === 1) {
            return redirect()->route('countries.show', $countries->first()->id);
        }

        return view('countries.index', compact('countries'));
    }

    public function show ($id) {
        $country = Country::findOrFail($id);

        $serviceTechSalary = new TechSalaryService();
        $serviceRate = new ExchangeRateService();
        $service = new HolidayService();
        $serviceInsight = new CulturalInsightService();
        $rates = $serviceRate->getRate($country) ?? [];
        $holidays = $service->getHolidays($country) ?? [];
        $insights = $serviceInsight->getCulturalInsight($country) ?? [];
        $techSalaries = $serviceTechSalary->getForCountry($country) ?? [];

        return view('countries.show', compact('country', 'holidays', 'rates', 'insights', 'techSalaries'));

    }
    public function generatePdf ($id){
        $country = Country::findOrFail($id);


        $serviceTechSalary = new TechSalaryService();
        $serviceRate = new ExchangeRateService();
        $service = new HolidayService();
        $serviceInsight = new CulturalInsightService();
        $rates = $serviceRate->getRate($country) ?? [];
        $holidays = $service->getHolidays($country) ?? [];
        $insights = $serviceInsight->getCulturalInsight($country) ?? [];
        $techSalaries = $serviceTechSalary->getForCountry($country) ?? [];

        $pdf = Pdf::loadView('countries.pdf', compact('country', 'holidays', 'rates', 'insights', 'techSalaries'));

        return $pdf->download("{$country->name}-hireworld.pdf");
    }

}
