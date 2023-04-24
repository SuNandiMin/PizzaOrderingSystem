<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct to produuct list view
    public function list()
    {
        $products = Product::when(request('search'), function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('price', '<=', request('search'))
                ->orWhereHas('category', function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%');
                });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // $products = Product::select('products.*', 'categories.name as category_name')
        //     ->when(request('search'), function ($query) {
        //         $query->where('products.name', 'like', '%' . request('search') . '%')
        //             ->orWhere('price', '<=', request('search'));
        //             // ->orWhere('categories.category_name', 'like', '%' . request('search') . '%');
        //             //I can't get search by category name from raw join
        //     })
        //     ->join('categories', 'products.category_id', 'categories.id')
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(2);

        $products->appends(request()->all());
        return view('dashboard.product.list', compact('products'));
    }

    #show detail for each product
    public function show($id)
    {
        $product = Product::select('products.*', 'categories.name as category_name')
            ->join('categories', 'products.category_id', 'categories.id')
            ->find($id);
        return view('dashboard.product.details', compact('product'));
    }

    //direct to product create page
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.product.create', compact('categories'));
    }

    //Storing created product function
    public function store(Request $request)
    {
        $this->productRequestValidation($request, "store");
        $data = $this->getRequestData($request);
        if ($request->hasFile('image')) {
            $data['image'] = storePizzaPicture($request->file('image'));
        }

        Product::create($data);

        return redirect()->route('product#list')
            ->with('success', 'Product Create Success');
    }

    //direct to product edit page
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('dashboard.product.edit', compact('product', 'categories'));
    }

    //Updating existed function
    public function update(Request $request)
    {
        $this->productRequestValidation($request, "update");
        $data = $this->getRequestData($request);
        $product = Product::find($request->ID);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($product->image != null) {
                Storage::delete('public/images/pizza_images/' . $product->image);
            }
            $data['image'] = storePizzaPicture($image);
        }
        $product->update($data);
        return redirect()->route('product#list')
            ->with('success', 'Product Update Success');
    }

    //product destory function
    public function delete($id)
    {
        Product::find($id)->delete();
        return redirect()->route('product#list')
            ->with('success', 'Product Delete Success');
    }

    //Validation function for Product Data from Request
    private function productRequestValidation($request, $action)
    {
        $validationRules =
            Validator::make($request->all(), [
                'productName' => 'required',
                'category' => 'required',
                'productDescription' => 'required|min:20',
                'productPrice' => 'required',
                'image' => $action == "store" ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file',
                'productWaitingTime' => 'required',

            ])->validate();
    }

    //get data from request function
    private function getRequestData($request)
    {
        return [
            'name' => $request->productName,
            'category_id' => $request->category,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'waiting_time' => $request->productWaitingTime,
            'view_count' =>0,
        ];
    }
}
