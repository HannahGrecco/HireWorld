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
        $hasAllFields = $insight
            && $insight->business_etiquette
            && $insight->decision_making_style
            && $insight->communication_style
            && $insight->things_to_avoid;

        if ($hasAllFields) {
            return $insight;
        }

        $prompt = "Você é um especialista em cultura de negócios internacional.
            Me fale sobre como fazer negócios no {$country->name}.

            Responda APENAS em JSON válido, sem texto adicional, sem markdown, neste formato exato:
            {
                \"business_etiquette\": \"como se comportar em reuniões\",
                \"decision_making_style\": \"como as decisões são tomadas\",
                    \"communication_style\": \"estilo de comunicação\",
                \"things_to_avoid\": \"o que nunca fazer\"
            }";

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . config('app.gemini_api_key'), [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);
        $payload = $response->json();
        $text = data_get($payload, 'candidates.0.content.parts.0.text');
        if (!$text || !is_string($text)) {
            Log::warning('Gemini response missing text payload', [
                'country_id' => $country->id,
                'payload' => $payload,
            ]);
            return null;
        }

        $insight = json_decode($text, true);
        if (!is_array($insight)) {
            Log::warning('Gemini response is not valid JSON', [
                'country_id' => $country->id,
                'text' => $text,
                'json_error' => json_last_error_msg(),
            ]);
            return null;
        }

        $requiredKeys = [
            'business_etiquette',
            'decision_making_style',
                'communication_style',
            'things_to_avoid',
        ];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $insight)) {
                Log::warning('Gemini response missing required key', [
                    'country_id' => $country->id,
                    'missing_key' => $key,
                    'text' => $text,
                ]);
                return null;
            }
        }

        $insight = CulturalInsight::updateOrCreate(
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
