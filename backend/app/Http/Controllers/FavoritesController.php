<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorites;
use App\Commands\CreateFavoriteCommand;
use App\Commands\DeleteFavoriteCommand;
use App\Commands\FavoriteSearchCommandHandler;
use App\Commands\CommandInvoker;

class FavoritesController extends Controller
{
    
    /**
     * index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $favorites = [];

        if ($request->filled('employee') || $request->filled('company') || $request->filled('category'))
        {
            $favorites = $this->searchWithParams($request);     
        } 
        else 
        {
            $favorites = Favorites::with([
                'employee', 
                'employee.area', 
                'employee.category', 
                'employee.company', 
                'employee.city'
            ])->get();
        }
        return response()->json($favorites, 200);
    }
    
    /**
     * searchWithParams
     *
     * @param  Request $request
     * @return array
     */
    public function searchWithParams($request){
        try {

            $params = [
                'employee' => $request->input('employee'),
                'company' => $request->input('company'),
                'category' => $request->input('category'),
            ];
            
            $command = new FavoriteSearchCommandHandler();
            $favorites = $command->execute($params);
    
            return $favorites;

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
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
            ], 422);
        }                
    }

    public function destroy($id)
    {
        try {
            $command = new DeleteFavoriteCommand($id);
            $invoker = new CommandInvoker();
            $invoker->setCommand($command);
            $invoker->executeCommand();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Validation error, please check the provided id',
                'error' => $th->getMessage(),
            ], 422);
        }
    }
}
