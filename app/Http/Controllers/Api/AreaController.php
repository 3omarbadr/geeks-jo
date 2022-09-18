<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponser;
use App\Http\Requests\AreaRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Http\Requests\UpdateAreaRequest;

class AreaController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return $this->success(AreaResource::collection(Area::all()));
    }

    public function store(AreaRequest $request)
    {
        return $this->success(AreaResource::make(Area::create($request->validated())), 'Area Created Successfully');
    }

    public function show($id)
    {
        return $this->success(new AreaResource(Area::find($id)));
    }

    public function update(Area $area, UpdateAreaRequest $request)
    {
        $area->update($request->validated());
        return $this->success(AreaResource::make($area), 'Area Updated Successfully');
    }

    
    public function destroy($id)
    {
        $area = Area::find($id);
        if (!$area) {
            return $this->error('No Countries To Delete', 404);
        }
        $area->delete();
        return $this->success(new AreaResource($area), 'Data Deleted Successfully');
    }
}
