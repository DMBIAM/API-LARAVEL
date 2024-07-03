<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Database\Factories\CityFactory;

class CityController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $cities = City::all();

        return response()->json($cities);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $city = CityFactory::new()->create([
            'name' => $request->input('name')
        ]);

        return response()->json($city, 201);
    }

}
