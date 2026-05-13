<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Country;

class ExchangeRateService
{
    /**
     * Create a new class instance.
     */
    public function getRate(Country $country)
    {
        //API URL WAS SWITCHED TO config('app.open_exchange_rates_key SO THAT THE APP ID DON'T GET EXPOSED
        $response = Http::get("https://openexchangerates.org/api/latest.json?app_id=" . config('app.open_exchange_rates_key'));

        if($response->failed()){
            Log::warning('ExchangeRate API request failed.');
            return [];
        }

        $rates = $response->json();
        $taxa = $rates['rates'][$country->currency_code];
        return $taxa;
    }
}
