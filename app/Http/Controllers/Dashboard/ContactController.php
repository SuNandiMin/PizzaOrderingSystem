<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //contacts lists
    public function contactList(){
        $contacts = Contact::paginate(5);
        return view('dashboard.contact.list',compact('contacts'));
    }
}
