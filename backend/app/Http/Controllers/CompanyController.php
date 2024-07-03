<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Database\Factories\CompanyFactory;

class CompanyController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $companies = Company::all();

        return response()->json($companies);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $city = CompanyFactory::new()->create([
            'name' => $request->input('name')
        ]);

        return response()->json($city, 201);
    }

}
