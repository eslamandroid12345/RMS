<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Services\Dashboard\Auth\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function loginForm(){
        return view('dashboard.site.auth.login');
    }
    public function updatePassword(UpdatePasswordRequest $request){
        return $this->authService->updatePassword($request);
    }


    public function login(LoginRequest $request){
        return $this->authService->login($request);
    }
    public function logout(){
        return $this->authService->logout();
    }
}
