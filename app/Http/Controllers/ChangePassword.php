<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ChangePassword extends Controller
{
    public function ChangePassword()
    {
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        if (Hash::check($request->oldpassword, Auth::user()->password)) {
            $userLogin = User::find(Auth::id());
            $userLogin->password = Hash::make($request->password);
            $userLogin->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Change Password Successfully');
        } else {
            return redirect()->back()->with('error', 'Failed To Change Password, Wrong Current Password');
        }
    }


    public function EditProfile()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.body.edit_profile', compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request)
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->back()->with('success', 'Update Profile Successfully');
        } else {
            return redirect()->back();
        }
    }
}
