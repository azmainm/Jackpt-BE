<?php

namespace Database\Seeders;

use App\Domains\Country\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(file_get_contents(storage_path().'/country/country.json'));
        foreach ($countries as $country) {
            Country::create([
                'name' => $country->name,
                'code' => $country->code,
                'currency' => $country->currency,
                'capital' => $country->capital,
                'continent' => $country->continent,
            ]);
        }
    }
}
