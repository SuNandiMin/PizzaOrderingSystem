<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //contactPage
    public function contactPage(){
        $messages=Contact::where('id',Auth::user()->id)->get();
        return view('front-end.contact',compact('messages'));
    }

    //sentContact
    public function sentMessage(Request $request){
        Contact::create([
            'user_id' => Auth::user()->id,
            'message'=> $request->message,
        ]);
        return redirect()->route('pizza#list');
    }
}
