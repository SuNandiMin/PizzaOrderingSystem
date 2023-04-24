<?php

namespace App\Http\Controllers\Pizza;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //order lists
    public function list()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('front-end.pizza.order', compact('orders'));
    }

    //detail for eavh order
    public function detail($code)
    {
        $items = OrderItem::select('order_items.*', 'products.name as product_name')
            ->join('products', 'products.id', 'product_id')
            ->where('order_items.order_code', $code)
            ->get();
        $totalPrice = 3000;
        foreach ($items as $item) {
            $totalPrice += $item->total;
        }
        // dd($totalPrice);
        // dd($items->toArray());
        return view('front-end.pizza.order-detail', compact('items','totalPrice'));
    }

    // store cart list in order table
    public function create(Request $request)
    {
        $totalPrice = 3000;
        foreach ($request->all() as $item) {
            $data = OrderItem::create([
                'user_id' => Auth::user()->id,
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['code'],
            ]);
            $totalPrice += $data->total;
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $totalPrice,
            'order_code' => $item['code'],
            'status' => 0,
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
