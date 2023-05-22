<?php

namespace App\Services;

use App\Http\Resources\CountryResource;
use Illuminate\Support\Facades\DB;

class CountryService
{
    public function getAllCountry()
    {
        $country = DB::table('countries')
            ->orderBy('name', 'asc')
            ->get();

        return CountryResource::collection($country);
    }
}
