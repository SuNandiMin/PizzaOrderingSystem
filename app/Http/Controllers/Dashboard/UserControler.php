<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserControler extends Controller
{
    //direct to user list view
    public function list()
    {
        $users = User::all();

        // if ($request->has('view_deleted')) {
        //     $users = $users->onlyTrashed();
        // }

        return view('dashboard.customer.list', compact('users'));
    }

    //deleted users list
    public function deleteList()
    {
        $users = User::onlyTrashed()->get();
        return view('dashboard.customer.deleted-list', compact('users'));
    }

    // user change role funcstion
    public function changeRole(Request $request, $id)
    {
        User::find($id)->update([
            'role' => $request->role,
        ]);
        return redirect()->back()
            ->with('success', ' User\'s role changed successfully ');
    }

    //user change role function with ajax
    public function changeRoleAjax(Request $request){
        // logger($request->all());
        User::where('id',$request->userId)->update([
            'role' => $request->role
        ]);
        return response()->json([
            'status' => 'success'
        ],200);
    }

    //Admin can delete other user's account
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success', $user->name . '\' account deleted successfully');
    }

    //restore one user ass from trash
    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return back();
    }

    //restore all user from trash
    public function restoreAll()
    {
        User::onlyTrashed()->restore();
        return redirect()->route('user#list');
    }

    //restore one user ass from trash
    public function hardDelete($id)
    {
        User::withTrashed()->find($id)->forceDelete();
        return back();
    }
}
