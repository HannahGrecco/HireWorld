<?php

namespace App\Services;

use App\Models\Country;
use App\Models\CulturalInsight;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CulturalInsightService
{
    /**
     * Create a new class instance.
     */
    public function getCulturalInsight(Country $country)
    {
        $insight = CulturalInsight::where('country_id', $country->id)
        ->where('generated_at', '>=', now()->subMonths(6))
        ->first();
        if($insight) {
            return $insight;
        } else {
            $prompt = "Você é um especialista em cultura de negócios internacional.
            Me fale sobre como fazer negócios no {$country->name}.

            Responda APENAS em JSON válido, sem texto adicional, sem markdown, neste formato exato:
            {
                \"business_etiquette\": \"como se comportar em reuniões\",
                \"decision_making_style\": \"como as decisões são tomadas\",
                \"communication_style\": \"estilo de comunicação\",
                \"things_to_avoid\": \"o que nunca fazer\"
            }";
        }

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . config('app.gemini_api_key'), [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);
        $text = $response->json()['candidates'][0]['content']['parts'][0]['text'];
        $insight = json_decode($text, true);

        CulturalInsight::updateOrCreate(
            ['country_id' => $country->id],
            [
                'business_etiquette'    => $insight['business_etiquette'],
                'decision_making_style' => $insight['decision_making_style'],
                'communication_style'   => $insight['communication_style'],
                'things_to_avoid'       => $insight['things_to_avoid'],
                'generated_by_ai'       => true,
                'generated_at'          => now(),
            ]
        );

        return $insight;
    }
}
