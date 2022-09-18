<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use App\Http\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return $this->success(CountryResource::collection(Country::all()));
    }

    public function store(CountryRequest $request)
    {
        return $this->success(CountryResource::make(Country::create($request->validated())), 'Country Created Successfully');
    }

    public function show($id)
    {
        return $this->success(new CountryResource(Country::with('cities')->find($id)));
    }

    public function update(Country $country, UpdateCountryRequest $request)
    {
        $country->update($request->validated());
        return $this->success(CountryResource::make($country), 'Country Updated Successfully');
    }

    
    public function destroy($id)
    {
        $country = Country::find($id);
        if (!$country) {
            return $this->error('No Countries To Delete', 404);
        }
        $country->delete();
        return $this->success(new CountryResource($country), 'Data Deleted Successfully');
    }
}
