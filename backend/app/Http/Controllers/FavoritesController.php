<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorites;
use Database\Factories\FavoritesFactory;

class FavoritesController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $areas = Favorites::all();

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
        $request->validate([
            'employee' => 'required|exists:employees,id',
        ]);

        $area = FavoritesFactory::new()->create([
            'employee_id' => $request->input('employee')
        ]);

        return response()->json($area, 201);
    }

}
