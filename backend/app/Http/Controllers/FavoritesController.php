<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorites;
use App\Commands\CreateFavoriteCommand;
use App\Commands\CommandInvoker;

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
        try {
            $request->validate([
                'employee' => 'required|exists:employees,id',
            ]);
    
            $command = new CreateFavoriteCommand([
                'employee_id' => $request->input('employee'),
            ]);
    
            $invoker = new CommandInvoker();
            $invoker->setCommand($command);
            $favorite = $invoker->executeCommand();
    
            return response()->json($favorite, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Validation error, please check the provided data',
                'error' => $th->getMessage(),
            ], 422);
        }                
    }
}
