<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Http\Services\Api\Role\RoleService;
use App\Repository\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct(private RoleService $roleService){
//        $this->middleware('isSuperAdmin');
    }

    public function index(){
        return $this->roleService->getRoles();
    }

    public function show($id){
        return $this->roleService->getDetails($id);
    }

    public function store(RoleRequest $request){
        return $this->roleService->store($request);
    }

    public function update($id , RoleRequest $request){
        return $this->roleService->update($id , $request);
    }

    public function destroy($id){
        return $this->roleService->delete($id);
    }


}
