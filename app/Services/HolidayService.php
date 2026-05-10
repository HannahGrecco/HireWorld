<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\PublicHoliday;
use App\Models\Country;

class HolidayService
{
    /**
     * Create a new class instance.
     */
    public function getHolidays(Country $country)
    {
        $currentYear = now()->year;
        $existing_holidays = PublicHoliday::where('country_id', $country->id)->where('year', $currentYear)->count();
        if($existing_holidays >0){
            return $existing_holidays;
        } else
        {
            $response = Http::get("https://date.nager.at/api/v3/PublicHolidays/{$currentYear}/{$country->iso_code}");

            if ($response->failed()){
                Log::warning('HolidayService API request failed.', [
                    'country_id' => $country->id,
                    'iso_code' => $country->iso_code,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return;
            }

            $holydays = $response->json();
            if (!is_array($holydays)) {
                Log::warning('HolidayService API returned invalid payload.', [
                    'country_id' => $country->id,
                    'iso_code' => $country->iso_code,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return;
            }

        foreach ($holydays as $holyday) {
            PublicHoliday::create([
                'country_id' => $country->id,
                'name'       => $holyday['name'],
                'date'       => $holyday['date'],
                'year'       => $currentYear,
                'is_fixed'   => true,
            ]);
        }
        }
    }
}
