<?php

namespace App\Http\Controllers\Pizza;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //sorting pizzas by using Ajax
    public function sorting(Request $request){

        if($request->status == 'asc'){
            return Product::orderBy('created_at','asc')->get();
        }
        elseif ($request->status == 'desc') {
            return Product::orderBy('created_at','desc')->get();
        }

    }

    //increasing view count function
    public function increasingViewCount(Request $request){
        $product=Product::where('id',$request->productId)->first();
        $viewCount = $product->view_count;
        $product->update([
            'view_count' => $viewCount+1,
        ]);
    }
}
