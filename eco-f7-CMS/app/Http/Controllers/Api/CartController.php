<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use App\Cart;

class CartController extends Controller
{
    public function myCart(){

        //Get the current user form its token
        $currentUser = JWTAuth::parseToken()->authenticate();

        //Find the user's cart
        $myCart = Cart::where('user_id', $currentUser->id)->get();

        //Return the cart as JSON
        return response()->json($myCart);
    }

    public function addToMyCart(Request $request){

        //Get current user form its token
        $currentUser = JWTAuth::parseToken()->authenticate();

        //Calculate the total
        $total = $request->product_price * $request->quantity;

        //Insert the details to the cart
        DB::table('carts')->insert([
            'user_id'       => $currentUser->id,
            'product_id'    => $request->product_id,
            'product_name'  => $request->product_name,
            'product_price' => $request->product_price,
            'quantity'      => $request->quantity,
            'total_price'   => $total
        ]);

        //Return success message
        return response()->json([
            'message' => 'Product Added Successfully'
        ]);
    }

    public function myCartTotal(){

        //Get current user form its token
        $currentUser = JWTAuth::parseToken()->authenticate();

        //Find user's cart
        $myCart = Cart::where('user_id', $currentUser->id)->get();

        //Empty array
        $totalList = [];

        //Get total price for each product in user's cart
        foreach ($myCart as $cart){
            $totalList[] = $cart->total_price;
        }

        //Calculate the total
        $total = array_sum($totalList);

        //Return the total as JSON
        return response()->json(compact('total'));
    }

    public function removeFromMyCart($cartId){

        //Find the product by id
        $product = Cart::find($cartId);

        //Remove the product
        $product->delete();

        //Return success message
        return response()->json([
            'Message' => 'successfully deleted from your cart!'
        ]);
    }

    public function clearMyCart(){
        $currentUser = JWTAuth::parseToken()->authenticate();

        Cart::where('user_id', $currentUser->id)->delete();

        return response()->json([
            'status'    => 'Success',
            'message'   => 'Your Cart Cleared.'
        ]);
    }
}
