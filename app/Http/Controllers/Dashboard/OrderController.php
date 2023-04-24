<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    //order list
    public function list(Request $request)
    {
        // $orders = Order::orWhere('status',$request->status)->paginate(5);
        $query = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->when(request('search'), function ($q) {
            $q->where('orders.order_code', request('search'));
        });

        if($request->statusForFilter != null) {
            $query->where('orders.status', $request->statusForFilter);
        }

            $orders =$query->paginate(5);
        return view('dashboard.order.list', compact('orders'));
    }

    //order items list
    public function itemList($code)
    {
        $order = Order::select('orders.*','users.name as user_name')
            ->where('order_code',$code)
            ->leftJoin('users','users.id','orders.user_id')
            ->first();
        $orderItems = OrderItem::select('order_items.*', 'products.name as product_name','products.image as product_image')
            ->join('products', 'products.id', 'product_id')
            ->where('order_code', $code)
            ->paginate(7);
        return view('dashboard.order.item-list', compact('orderItems','order'));
    }

    //filter bt status Ajax
    // public function filterByStatus(Request $request)
    // {
    //     if ($request->status == 'null') {
    //         return Order::get();
    //     } else {
    //         return  Order::where('status', $request->status)
    //             ->get();
    //     }
    // }


    //change status
    public function changeStatus(Request $request)
    {
        logger($request->all());
        Order::where('order_code', $request->orderCode)->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => 'success',
        ], 200);
    }
}
