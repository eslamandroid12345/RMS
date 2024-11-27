<?php

namespace App\Http\Services\Dashboard\RolePermission;

use App\Repository\PermissionsRepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RolePermissionService
{
    private $roleRepository;
    private $permissionsRepository;
    public function __construct(RoleRepositoryInterface $roleRepository,PermissionsRepositoryInterface $permissionsRepository){
            $this->permissionsRepository=$permissionsRepository;
            $this->roleRepository=$roleRepository;
    }

    public function index(){
        return $this->roleRepository->getAll();
    }
    public function update($id,$request){
        $permissions = $request['permissions'];
        DB::beginTransaction();
        $role=$this->roleRepository->getById($id);
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }else{
            $role->removePermissions();
        }
        DB::commit();
        return redirect(route('roles.index'))->with('success' , __("Updated Successfully"));
    }

}
