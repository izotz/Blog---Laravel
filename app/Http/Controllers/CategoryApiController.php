<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        if ($request->name == "") {
            return response(["msg" => "Name required"], 400);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return $category;
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        if ($request->name == "") {
            return response(["msg" => "Name required"], 400);
        }

        $category->name = $request->name;
        $category->save();

        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $category;
    }
}
