<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Country;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name,cca2,region,currencies,languages,timezones,flag');

        if ($response->failed()){
            $this->command->error('Falhou ao buscar países');
            return;
        }

        $countries = $response->json();

        foreach($countries as $data){
            Country::updateOrCreate(
                ['iso_code' => $data['cca2']],
                [
                    'name'              => $data['name']['common'],
                    'region'            => $data['region'] ?? null,
                    'currency_code'     => array_key_first($data['currencies'] ?? []),
                    'official_language' => array_values($data['languages'] ?? [])[0] ?? null,
                    'timezone'          => $data['timezones'][0] ?? null,
                    'flag_emoji'        => $data['flag'] ?? null,
                ]
            );

        }
        $this->command->info('Países importados com sucesso!');
    }
}
