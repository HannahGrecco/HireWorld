<?php

namespace App\Services;

use App\Models\Country;
use App\Models\TechSalary;
use Illuminate\Support\Facades\Cache;

class TechSalaryService
{
    public function getForCountry(Country|string $country, int $year = null): ?array
    {
        $countryName = $country instanceof Country ? $country->name : $country;
        $countryId = $country instanceof Country
            ? $country->id
            : Country::where('name', $countryName)->value('id');
        $countryKey = $country instanceof Country
            ? ($country->iso_code ?? (string) $country->id)
            : $countryName;

        $yearQuery = TechSalary::query();
        if ($countryId) {
            $yearQuery->where('country_id', $countryId);
        } else {
            $yearQuery->where('country', $countryName);
        }

        $year = $year ?? $yearQuery->max('survey_year');
        if ($countryId && !$year) {
            $year = TechSalary::where('country', $countryName)->max('survey_year');
        }

        if (!$year) {
            return null;
        }

        $cacheKey = 'tech_salary_' . md5($countryKey . '_' . $year);

        return Cache::remember($cacheKey, now()->addMonths(6), function () use ($countryName, $countryId, $year) {
            $data = TechSalary::query()
                ->when($countryId, fn($q) => $q->where('country_id', $countryId))
                ->where('survey_year', $year)
                ->whereNotNull('salary_usd_yearly')
                ->where('salary_usd_yearly', '>', 0)
                ->get();

            if ($data->isEmpty() && $countryId) {
                $data = TechSalary::where('country', $countryName)
                    ->where('survey_year', $year)
                    ->whereNotNull('salary_usd_yearly')
                    ->where('salary_usd_yearly', '>', 0)
                    ->get();
            }

            if ($data->isEmpty()) {
                return null;
            }

            return [
                'survey_year'     => $year,
                'total_responses' => $data->count(),

                // Salário geral
                'salary' => [
                    'average' => round($data->avg('salary_usd_yearly')),
                    'median'  => $this->median($data->pluck('salary_usd_yearly')),
                    'min'     => round($data->min('salary_usd_yearly')),
                    'max'     => round($data->max('salary_usd_yearly')),
                ],

                // Por tipo de dev
                'by_dev_type' => $data->whereNotNull('dev_type')
                    ->groupBy('dev_type')
                    ->map(fn($group) => [
                        'count'   => $group->count(),
                        'average' => round($group->avg('salary_usd_yearly')),
                        'median'  => $this->median($group->pluck('salary_usd_yearly')),
                    ])
                    ->sortByDesc('average')
                    ->take(10)
                    ->toArray(),

                // Por senioridade (baseado em work_exp)
                'by_seniority' => [
                    'junior' => $this->salaryStats($data->filter(fn($r) => $r->work_exp !== null && $r->work_exp <= 2)),
                    'mid'    => $this->salaryStats($data->filter(fn($r) => $r->work_exp !== null && $r->work_exp > 2 && $r->work_exp <= 5)),
                    'senior' => $this->salaryStats($data->filter(fn($r) => $r->work_exp !== null && $r->work_exp > 5)),
                ],

                // Por tipo de emprego
                'by_employment' => $data->whereNotNull('employment_type')
                    ->groupBy('employment_type')
                    ->map(fn($group) => [
                        'count'   => $group->count(),
                        'average' => round($group->avg('salary_usd_yearly')),
                    ])
                    ->sortByDesc('count')
                    ->toArray(),

                // Por modalidade de trabalho
                'by_remote' => $data->whereNotNull('remote_work')
                    ->groupBy('remote_work')
                    ->map(fn($group) => [
                        'count'   => $group->count(),
                        'average' => round($group->avg('salary_usd_yearly')),
                    ])
                    ->sortByDesc('count')
                    ->toArray(),

                // Por escolaridade
                'by_education' => $data->whereNotNull('ed_level')
                    ->groupBy('ed_level')
                    ->map(fn($group) => [
                        'count'   => $group->count(),
                        'average' => round($group->avg('salary_usd_yearly')),
                    ])
                    ->sortByDesc('average')
                    ->toArray(),
            ];
        });
    }

    private function median($values): int
    {
        $sorted = $values->sort()->values();
        $count  = $sorted->count();

        if ($count === 0) return 0;

        $mid = (int) floor($count / 2);

        return $count % 2 === 0
            ? round(($sorted[$mid - 1] + $sorted[$mid]) / 2)
            : round($sorted[$mid]);
    }

    private function salaryStats($collection): array
    {
        if ($collection->isEmpty()) {
            return ['count' => 0, 'average' => 0, 'median' => 0];
        }

        return [
            'count'   => $collection->count(),
            'average' => round($collection->avg('salary_usd_yearly')),
            'median'  => $this->median($collection->pluck('salary_usd_yearly')),
        ];
    }
}
