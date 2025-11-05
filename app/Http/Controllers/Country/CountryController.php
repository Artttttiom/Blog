<?php

namespace App\Http\Controllers\Country;


use Illuminate\Http\Request;
use App\Models\CountryModel;
class CountryController 
{
    public function country() {
        return response()->json(CountryModel::get(), 200);
    }

    public function countries($id) {
        $country = CountryModel::find($id);

        if (!$country) {
            return response()->json([
                'message' => 'Country not faund',
                'status' => 404
            ], 404);
        }

          return response()->json([
                'data' => $country,
                'status' => 200
            ], 200);
    }
}
