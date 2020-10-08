<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductGallery;

class ProductsController extends Controller
{
    public function addProduct(Request $request){

        $imagesStorePath = public_path() . '/products/images';

        $thumbnail = $request->file('thumbnail');
        $thumbnailName = $thumbnail->getClientOriginalName();
        $thumbnail->move($imagesStorePath, $thumbnailName);
        $thumbnailURL = url('/products/images/'.$thumbnailName);

        $newProduct = new Product();
        $newProduct->category_id    = $request->category_id;
        $newProduct->name           = $request->name;
        $newProduct->price          = $request->price;
        $newProduct->description    = $request->description;
        $newProduct->thumbnail      = $thumbnailURL;
        $newProduct->stock_quantity = $request->stock_quantity;
        $newProduct->save();

        //Store Product Images
        $galleryStorePath = public_path() . '/products/images/gallery';

        foreach ($request->gallery as $image){

            $imageName = $image->getClientOriginalName();
            $image->move($galleryStorePath, $imageName);
            $imageURL = url('/products/images/gallery/'.$imageName);

            $newProductGallery = new ProductGallery();
            $newProductGallery->product_id = $newProduct->id;
            $newProductGallery->image = $imageURL;
            $newProductGallery->save();

        }

        //Return success message
        return response()->json([
            'status'    => 'Success',
            'message'   => 'Product Added Successfully.'
        ]);
    }

    public function updateProduct($productID, Request $request){

        $updateProduct = Product::find($productID);

        if($request->file('thumbnail')){
            $imagesStorePath = public_path() . '/products/images';
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = $thumbnail->getClientOriginalName();
            $thumbnail->move($imagesStorePath, $thumbnailName);
            $thumbnailURL = url('/products/images/'.$thumbnailName);

            $updateProduct->thumbnail  = $thumbnailURL;
        }

        $updateProduct->category_id    = $request->category_id;
        $updateProduct->name           = $request->name;
        $updateProduct->price          = $request->price;
        $updateProduct->description    = $request->description;
        $updateProduct->stock_quantity = $request->stock_quantity;
        $updateProduct->save();



        if($request->gallery){
            //Store Product Images
            $galleryStorePath = public_path() . '/products/images/gallery';

            foreach ($request->gallery as $image){

                $imageName = $image->getClientOriginalName();
                $image->move($galleryStorePath, $imageName);
                $imageURL = url('/products/images/gallery/'.$imageName);

                $newProductGallery = ProductGallery::where('product_id', $productID)->get();
                $newProductGallery->image = $imageURL;
                $newProductGallery->save();
            }
        }

        //Return success message
        return response()->json([
            'status'    => 'Success',
            'message'   => 'Product Updated Successfully.'
        ]);
    }

    public function deleteProduct($productID){

        $productGallery = ProductGallery::where('product_id', $productID);
        $productGallery->delete();

        $product = Product::find($productID);
        $product->delete();

        return response()->json([
            'status'    => 'Success',
            'message'   => 'Successfully deleted the product'
        ]);
    }
}
