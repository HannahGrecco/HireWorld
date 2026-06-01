<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;
use App\Models\TechSalary;

class ImportTechSalaries extends Command
{
    protected $signature = 'salaries:import {year}';
    protected $description = 'Importa dados do Stack Overflow Developer Survey';

    public function handle(): void
    {
        $year = $this->argument('year');
        $path = storage_path("app/surveys/results_{$year}.csv");

        if (!file_exists($path)) {
            $this->error("Arquivo não encontrado: {$path}");
            return;
        }

        $file = fopen($path, 'r');
        $header = fgetcsv($file);

        $cols = [
            'country'             => array_search('Country', $header),
            'dev_type'            => array_search('DevType', $header),
            'salary_usd_yearly'   => array_search('ConvertedCompYearly', $header),
            'years_code'          => array_search('YearsCode', $header),
            'work_exp'            => array_search('WorkExp', $header),
            'employment_type'     => array_search('Employment', $header),
            'remote_work'         => array_search('RemoteWork', $header),
            'ed_level'            => array_search('EdLevel', $header),
        ];

        $count = 0;
        $batch = [];
        $countryMap = Country::query()
            ->select(['id', 'name'])
            ->get()
            ->mapWithKeys(fn($country) => [mb_strtolower(trim($country->name)) => $country->id])
            ->toArray();

        $this->info("Importando survey {$year}...");

        while (($row = fgetcsv($file)) !== false) {
            $country = $row[$cols['country']] ?? null;
            $salary  = $row[$cols['salary_usd_yearly']] ?? null;

            if (!$country || !$salary || $country === '' || $salary === '') {
                continue;
            }

            $countryId = $countryMap[mb_strtolower(trim($country))] ?? null;

            $batch[] = [
                'country_id'        => $countryId,
                'country'           => $country,
                'dev_type'          => $row[$cols['dev_type']] ?: null,
                'salary_usd_yearly' => (float) $salary,
                'years_code'        => is_numeric($row[$cols['years_code']]) ? (float) $row[$cols['years_code']] : null,
                'work_exp'          => is_numeric($row[$cols['work_exp']]) ? (float) $row[$cols['work_exp']] : null,
                'employment_type'   => $row[$cols['employment_type']] ?: null,
                'remote_work'       => $row[$cols['remote_work']] ?: null,
                'ed_level'          => $row[$cols['ed_level']] ?: null,
                'survey_year'       => (int) $year,
                'created_at'        => now(),
                'updated_at'        => now(),
            ];

            if (count($batch) >= 500) {
                TechSalary::insert($batch);
                $count += count($batch);
                $batch = [];
                $this->line("  {$count} registros inseridos...");
            }
        }

        if (!empty($batch)) {
            TechSalary::insert($batch);
            $count += count($batch);
        }

        fclose($file);
        $this->info("Concluído! {$count} registros importados.");
    }
}
