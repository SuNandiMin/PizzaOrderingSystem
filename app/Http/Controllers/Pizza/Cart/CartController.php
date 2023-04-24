<?php

namespace App\Http\Controllers\Pizza\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //cart list page
    public function list()
    {
        $carts = Cart::where('carts.user_id', Auth::user()->id)
            ->select('carts.*', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image')
            ->join('products', 'product_id', 'products.id')
            ->get();

        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product_price * $cart->qty;
        };
        return view('front-end.pizza.cart', compact('carts', 'total'));
    }

    //if click at to cart and store this product in cart functon
    public function addToCart(Request $request)
    {
        // $carts =Cart::all();
        // $productId = $request['productId'];
        // if (isset($carts->product_id)) {
        //     logger(";af;");
        // }
        // logger($carts);
        // foreach ($carts as $cart) {
        //     if ($cart->product_id == $request['productId']) {
        //         logger($cart->qty+$request['qty']);
        //     }
        // }
        $data = $this->getData($request);
        Cart::create($data);

        return response()->json([
            'status' => 'success',
        ],200);
    }

    // delete the cart
    // public function delete($id)
    // {
    //     Cart::find($id)->delete();
    //     return back()->with('success', 'Delete success');
    // }

    //delete product in cart whrn clck cross btn
    public function clear(Request $request){
        Cart::where('user_id',Auth::user()->id)
            ->where('product_id',$request->product_id)
            ->delete();
    }
    //delete all carts
    public function clearAll(){
        Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'status' => 'success',
        ],200);
    }

    //get data for add to cart dfunction
    private function getData($request)
    {
        return [
            'user_id' => Auth::user()->id,
            'product_id' => $request['productId'],
            'qty' => $request['qty'],
        ];
    }
}
