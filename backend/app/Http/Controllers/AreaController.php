<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use Database\Factories\AreaFactory;

class AreaController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $areas = Area::all();

        return response()->json($areas);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $area = AreaFactory::new()->create([
            'name' => $request->input('name')
        ]);

        return response()->json($area, 201);
    }

}
