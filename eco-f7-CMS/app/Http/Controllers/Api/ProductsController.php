<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductGallery;

class ProductsController extends Controller
{
    public function view()
    {
        return Product::all();
    }

    public function viewByCategoryId($categoryId){
        return Product::where('category_id', $categoryId)->get();
    }

    public function getProductWithGallery($productId){
        $prodcut = Product::find($productId);

        return response()->json([
            'id'            => $prodcut->id,
            'category_id'   => $prodcut->category_id,
            'name'          => $prodcut->name,
            'price'         => $prodcut->price,
            'description'   => $prodcut->description,
            'quantity'      => $prodcut->stock_quantity,
            'thumbnail'     => $prodcut->thumbnail,
            'gallery'       => ProductGallery::where('product_id', $prodcut->id)->get()
        ]);


    }
}
