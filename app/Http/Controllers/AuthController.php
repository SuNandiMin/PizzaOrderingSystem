<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    //login
    public function loginPage()
    {
        return view('auth.login');
    }

    //register
    public function registerPage()
    {
        return view('auth.register');
    }

    //Direct to change password page
    public function changePasswordPage()
    {
        return view('auth.password.change');
    }
    //Auth's change password function
    public function changePassword(Request $request)
    {
        $this->changePasswordValidationCheck($request);
        $password = Auth::user()->password;
        if (!Hash::check($request->oldPassword, $password)) {
            return back()->with('not-match', 'Password didn\'t match with old password');
        }
        // $user = User::find(Auth::user()->id);
        // $user->update([
        //     'password' => Hash::make($request->newPassword),
        // ]);

        Auth::user()->update([
            'password' => Hash::make($request->newPassword),
        ]);
        Auth::logout();
        return redirect()->route('loginPage');
    }

    //change password validation checking function
    private function changePasswordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => ['required', 'string', 'same:confirmPassword', Password::min(8)],
        ])->validate();
    }
}
