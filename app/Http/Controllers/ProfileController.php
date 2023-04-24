<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //Direct to User Profie Detail Page
    public function details(){
        return view('auth.profile.details');
    }

    //Direct to User Profile Edit Page
    public function edit(){
        return view('auth.profile.edit');
    }

    //profile Update function
    public function update(Request $request){
        // dd($request->file('image'));
        $this->checkValidation($request);
        $data = $this->getUpdateData($request);

        if ($request->hasFile('image')) {
            $image = Auth::user()->image;
            if ($image != null) {
                Storage::delete('public/images/profile_images/'.$image);
            }
            $data['image'] = storeProfileImage($request->file('image'));
        }
        Auth::user()->update($data);
        return redirect()->route('profile#details')
            ->with('success','Your Profile Updated Successfuly');
    }

    //validation check
    private function checkValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'phone' => 'required',
            'address' => 'required',
        ])->validate();
    }

    //get user profile update  data
    private function getUpdateData($request){
        return [
            'name' => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'address'  => $request->address,
        ];
    }
}
