<?php

namespace App\Http\Controllers\Country;


use Illuminate\Http\Request;
use App\Models\CountryModel;
class CountryController 
{
    public function show() {
        $country = CountryModel::simplePaginate(15);

        return response()->json(CountryModel::query()->get(), 200);
    }

    public function index($id) {
        $country = CountryModel::query()->find($id);

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



    public function store(Request $request) {
      $country = CountryModel::query()->create($request->all());

      return response()->json([
        'success' => true,
        'data' => $country,
        'message' => 'Country created successfully'
      ], 201);
    }

    public function update(Request $request, $id) {
        $country = CountryModel::query()->find($id);
        $country->update($request->only(['alias', 'name', 'name_en']));
        $country->save();

        return response()->json([
            'success' => true,
            'data' => $country,
            'message' => 'Country updated successfully'
        ], 200);
        
    }

    public function destroy($id) {
        $country = CountryModel::query()->find($id);
        $country->delete();

        return response()->json([
            'success' => true,
            'message' => 'Country deleted successfully'
        ],200);
    }
}