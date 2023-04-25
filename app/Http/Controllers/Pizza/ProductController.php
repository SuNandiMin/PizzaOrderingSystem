<?php

namespace App\Http\Controllers\Pizza;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //direct to pizza lists Page(All start)
    public function list()
    {
        $categories = Category::all();
        $products = Product::when(request('search'), function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('price', '<=', request('search'));
            })
            ->paginate(3);

        $products->appends(request()->all());
        return view('front-end.pizza.pizza_list', compact('products', 'categories'));
    }

    //filter by category function
    public function categoryFilter($id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('price', '<=', request('search'));
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
        $products->appends(request()->all());
        return view('front-end.pizza.pizza_list', compact('products', 'categories'));
    }

    //pizza detail page
    public function detail($id){
        $product = Product::find($id);
        $products = Product::where('category_id',$product->category_id)
        ->get()
        ->except($id);
        // dd($products->toArray(),$product->toArray());
        return view('front-end.pizza.detail',compact('product','products'));
    }
}
