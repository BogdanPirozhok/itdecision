<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Repositories\CategoryRepository;

class CategoryController extends AdminController
{
    
    public function create (CategoryRepository $category)
    {
    	return response()->json([
		    'id' => $category->categoryCreate()
		]);
    }

    public function edit (CategoryRepository $category)
    {
    	return response()->json([
		    'done' => $category->categoryEdit()
		]);
    }

    public function delete (Request $request)
    {
    	return response()->json([
		    'done' => Categories::where('id', $request->all()['id'])->delete()
		]);
    }
}
