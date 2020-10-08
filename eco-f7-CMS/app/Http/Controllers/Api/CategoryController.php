<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view(){
        $categories = Category::all();
        return response()->json($categories);
    }

    public function CategoriesWithProducts(){
        $categories = Category::all();

        $newList = [];

        foreach ($categories as $category){
            $list = [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description,
                'icon' => $category->icon,
				'cover' => $category->cover,
                'products' => Product::where('category_id', $category->id)->get(),
            ];

            $newList[] = $list;
        }

        return response()->json($newList);
    }
}
