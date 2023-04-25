<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AllController extends Controller
{
    public function getAllData()
    {
        $products = Product::with('category')->get();
        $categories = Category::get();
        $users = User::with('carts', 'orders')->get();
        $contacts = Contact::all();

        $data = [
            'contacts' => $contacts,
            'categotries' => $categories,
            'users' => $users,
            'products' => $products,
        ];

        return response()->json($data, 200,);
    }

    //creating category
    public function categoryCreate(Request $request)
    {
        $category = Category::create($request->toArray());
        return response()->json($category, 200);
    }

    //get category detail
    public function categoryDetail($id){
        $category = Category::where('id',$id)->first();

        if (isset($category)) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'data' => $category
            ], 200);
        }

        return response()->json([
            'status' => false,
            'code' => 400,
            'message' => 'id called on null function',
        ], 400);

    }

    //updating category
    public function updateCategory(Request $request, $id)
    {
        // dd($request->toArray());
        $category = Category::where('id',$id)->first();

        if (isset($category)) {
            $data=$this->getCategoryData($request);
            $category->update($data);
            $data = Category::orderBy('updated_at', 'desc')->first();
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Category updated successully',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => false,
            'code' => 400,
            'message' => 'id called on null function',
        ], 400);
    }

    //deleting category
    public function categoryDelete($id)
    {
        $category = Category::where('id',$id)->first();

        if (isset($category)) {
            $category->delete();
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Category deleted successully',
                'deleted data' => $category
            ], 200);
        }

        return response()->json([
            'status' => false,
            'code' => 400,
            'message' => 'id call on null'
        ], 400);
    }

    //creating contact
    public function contactCreate(Request $request)
    {
        // dd($request->header());
        $contact = Contact::create([
            'message' => $request->message,
            'user_id' => $request->user_id
        ]);
        return response()->json($contact, 200);
    }

    //get category data for update
    private function getCategoryData($request){
        return [
            'name' => $request->name,
        ];
    }
}
