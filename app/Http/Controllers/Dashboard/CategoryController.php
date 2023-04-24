<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list(){
        $categories = Category::when(request('search'),function($query){
            $query->where('name','like','%'.request('search').'%');
        })
        ->orderBy('updated_at','desc')
        ->paginate(5);
        $categories->appends(request()->all());
        return view('dashboard.category.list',compact('categories'));
    }

    //direct to category create Page
    public function create(){
        return view('dashboard.category.create');
    }

    //category store
    public function store(Request $request){
        $this->categoryValidation($request);
        $data = $this->getRequestData($request);
        Category::create($data);
        return redirect()->route('category#list')
                ->with('success','Category Successfully Created');
    }

    //direct to category edit page
    public function edit($id){
        $category=Category::find($id);
        return view('dashboard.category.edit',compact('category'));
    }

    //category update
    public function update(Request $request){
        $this->categoryValidation($request);
        $category = $this->getRequestData($request);
        Category::find($request->ID)->update($category);
        return redirect()->route('category#list')
                ->with('success','Category Successfully Updated');
    }

    //delete category
    public function delete($id){
        Category::find($id)->delete();
        return back()->with('success','Category Successfully Destory');
    }

    //get store data function
    private function getRequestData($request){
        return [
            'name'=>$request->categoryName,
        ];
    }

    //validation for storing category function
    private function categoryValidation($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'.$request->ID,
        ],[
            'categoryName.required' => 'Need to fill Category Name',
            'categoryName.unique' => 'Category Name is already exit',
        ])->validate();
    }
}
