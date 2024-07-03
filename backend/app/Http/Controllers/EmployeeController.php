<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Factories\ConcreteEmployeeFactory;


class EmployeeController extends Controller
{
   
    /**
     * Store a newly created employee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        

        try {
            $factory = new ConcreteEmployeeFactory();

            $request->validate([
                'name' => 'required|string',
                'lastname' => 'required|string',
                'date' => 'required|date',
                'mail' => 'required|email',
                'area' => 'required|exists:areas,id',
                'category' => 'required|exists:categories,id',
                'company' => 'required|exists:companies,id',
                'city' => 'required|exists:cities,id',
                'satisfaction' => 'required|integer|min:0|max:100',
            ]);

            $employee = $factory->create([
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'date' => $request->input('date'),
                'mail' => $request->input('mail'),
                'area_id' => $request->input('area'),
                'category_id' => $request->input('category'),
                'company_id' => $request->input('company'),
                'city_id' => $request->input('city'),
                'satisfaction' => $request->input('satisfaction'),
            ]);
            return response()->json($employee, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Validation error, please check the provided data',
            ], 422);
        }      
        
    }

}
