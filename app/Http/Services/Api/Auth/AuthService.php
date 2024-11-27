<?php

namespace App\Http\Services\Api\Auth;

use App\Http\Resources\User\UserResource;
use App\Http\Traits\Responser;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService{
    use Responser;


    public function __construct(private UserRepositoryInterface $userRepository){}


    public function login($request){
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        if($token){
            if (\auth('api')->user()->status == false)
                return $this->responseFail(message: __('messages.member_not_activated'));
            return $this->responseSuccess(message: "Logged In" , data: UserResource::make(\auth('api')->user()));
        }
        return $this->responseFail(message: __('messages.wrong credentials'));
    }
    public function updatePassword($request){
        $user= $this->userRepository->getById($request->id);
        if(!Hash::check($request->old_password,$user->password)){
            return $this->responseFail(message: __('messages.Old_Password_Wrong'));
        }else{
            $this->userRepository->update($request->id , ['password'=>Hash::make($request->new_password)]);
            return $this->responseSuccess(message: __('messages.Updated Successfully'));
        }
    }
    public function logout(){
        auth()->logout();
        return $this->responseSuccess(200 , __('messages.Logged Out'));
    }
}
