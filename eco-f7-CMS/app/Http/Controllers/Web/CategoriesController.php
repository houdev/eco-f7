<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function addNewCategory(Request $request){

        //Choose folder to store the categories images
        $imageStorePath = public_path() . '/categories/images';

        //Get the icon from the request and upload it to the server
        $icon = $request->file('icon');
        $iconName = $icon->getClientOriginalName();
        $icon->move($imageStorePath, $iconName);
        $iconURL = url('/categories/images/'.$iconName);

        //Get the cover from the request and upload it to the server
        $cover = $request->file('cover');
        $coverName = $cover->getClientOriginalName();
        $cover->move($imageStorePath, $coverName);
        $coverURL = url('/categories/images/' . $coverName);

        //Add the new category
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->icon = $iconURL;
        $category->cover = $coverURL;
        $category->save();

        return response()->json([
            'status'    => 'Success',
            'message'   => 'Successfully added new category'
        ]);
    }

    public function updateCategory($categoryID, Request $request){

        $category = Category::find($categoryID);

        if($newName = $request->name){
            $category->name = $newName;
        }
        if($newDescription =  $request->description){
            $category->description = $newDescription;
        }

        //Choose folder to store the categories images
        $imageStorePath = public_path() . '/categories/images';

        if($icon = $request->file('icon')){
            //Get the icon from the request and upload it to the server
            $iconName = $icon->getClientOriginalName();
            $icon->move($imageStorePath, $iconName);
            $iconURL = url('/categories/images/'.$iconName);

            //Update the category's icon
            $category->icon = $iconURL;
        }

        if ($cover = $request->file('cover')){
            //Get the cover from the request and upload it to the server
            $coverName = $cover->getClientOriginalName();
            $cover->move($imageStorePath, $coverName);
            $coverURL = url('/categories/images/' . $coverName);

            //Update the category's cover
            $category->cover = $coverURL;
        }

        //Save the category updates
        $category->save();

        return response()->json([
            'status'    => 'Success',
            'message'   => 'Successfully updated the category'
        ]);
    }

    public function deleteCategory($categoryID){
        $category = Category::find($categoryID);
        $category->delete();

        return response()->json([
            'status'    => 'Success',
            'message'   => 'Successfully deleted the category'
        ]);
    }
}
