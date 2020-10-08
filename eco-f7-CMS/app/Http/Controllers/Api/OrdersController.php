<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\OrderInfo;
use App\OrderProduct;
use Illuminate\Http\Request;
use JWTAuth;

class OrdersController extends Controller
{
    public function MyOrders(){
        $currentUser = JWTAuth::parseToken()->authenticate();

        $myOrders = OrderInfo::where('user_id', $currentUser->id)->get();

        return response()->json($myOrders);
    }

    public function MyOrder($orderId){
        $orderProducts = OrderProduct::where('order_id', $orderId)->get();

        return response()->json($orderProducts);
    }

    public function AddToMyOrder(Request $request){

        $currentUser = JWTAuth::parseToken()->authenticate();

        $myOrder = new OrderInfo;
        $myOrder->user_id                   = $currentUser->id;
        $myOrder->order_status              = $request->orderStatus;
        $myOrder->order_shipping_address    = $request->shippingAddress;
        $myOrder->order_total_price         = $request->orderTotalPrice;
        $myOrder->save();

        foreach ($request->orderProducts as $orderProduct){

            $myOrderProducts = new OrderProduct;
            $myOrderProducts->order_id              = $myOrder->id;
            $myOrderProducts->product_id            = $orderProduct['product_id'];
            $myOrderProducts->product_name          = $orderProduct['product_name'];
            $myOrderProducts->product_price         = $orderProduct['product_price'];
            $myOrderProducts->product_quantity      = $orderProduct['quantity'];
            $myOrderProducts->product_total_price   = $orderProduct['total_price'];
            $myOrderProducts->save();
        }

        return response()->json([
            'status'    => 'Success',
            'message'   => 'Order Added Successfully.'
        ]);
    }
}
