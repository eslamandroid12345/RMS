<?php

namespace App\Http\Services\Dashboard\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService{

    public function login($request){
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if($token){
            if (\auth()->user()->status == false)
                return back()->with('error' , __('messages.member_not_activated'));
            return redirect(route('home'))->with('success' , 'Logged In');
        }
        return back()->with('error' , __('messages.wrong credentials'));
    }
    public function updatePassword($request){
        $user=User::findorfail($request->id);
                if(!Hash::check($request->old_password,$user->password)){
                  return back()->with('error' , __('messages.Old_Password_Wrong'));
                }else{
                    $user->update(['password'=>Hash::make($request->new_password)]);
                  return back()->with('success' , __('Updated Successfully'));
                }
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
