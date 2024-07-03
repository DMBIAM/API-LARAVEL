<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Database\Factories\CategoryFactory;

class CategoryController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $category = CategoryFactory::new()->create([
            'name' => $request->input('name')
        ]);

        return response()->json($category, 201);
    }

}
