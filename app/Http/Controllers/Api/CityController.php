<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponser;
use App\Http\Requests\CityRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return $this->success(CityResource::collection(City::all()));
    }

    public function store(CityRequest $request)
    {
        return $this->success(CityResource::make(City::create($request->validated())), 'City Created Successfully');
    }

    public function show($id)
    {
        return $this->success(new CityResource(City::with('areas')->find($id)));
    }

    public function update(City $city, UpdateCityRequest $request)
    {
        $city->update($request->validated());
        return $this->success(CityResource::make($city), 'City Updated Successfully');
    }

    
    public function destroy($id)
    {
        $city = City::find($id);
        if (!$city) {
            return $this->error('No Countries To Delete', 404);
        }
        $city->delete();
        return $this->success(new CityResource($city), 'Data Deleted Successfully');
    }
}
