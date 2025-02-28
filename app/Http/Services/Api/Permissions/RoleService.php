<?php

namespace App\Http\Services\Api\Role;

use App\Http\Resources\Role\RoleDetailsResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\catchError;
use function App\delete_model;
use function App\responseFail;
use function App\responseSuccess;
use function App\store_model;
use function App\update_model;

class RoleService
{

    public function __construct(private RoleRepositoryInterface $roleRepository , private GetService $get){}


    public function getRoles(){
        return $this->get->handle(RoleResource::class , $this->roleRepository  , 'getRoles');
    }

    public function getDetails($id){
        return $this->get->handle(RoleDetailsResource::class , $this->roleRepository  , 'getById' , [$id] , true);
    }

    public function store($request){
        $data = $request->except('permissions');
        DB::beginTransaction();
        try {
            $role = store_model($this->roleRepository , $data , true);
            $role->givePermissions($request['permissions']);
            DB::commit();
            return responseSuccess(message: __('messages.Added Successfully'));
        }catch (\Exception $e){

            DB::rollBack();
            return responseFail(message: __('Something Went Wrong'));
        }
    }

    public function update($id , $request){
        $data = $request->except('permissions');
        DB::beginTransaction();
        try {
            if ($id == 1)
                return responseFail(message: __('messages.SuperAdmin Cannot Be Modifying'));
            $role = update_model($this->roleRepository , $id ,  $data , true);
            $role->syncPermissions($request['permissions']);
            DB::commit();
            return responseSuccess(message: __('messages.Updated Successfully'));
        }catch (\Exception $e){
            catchError($e);
        }
    }

    public function delete($id){
        if ($id == 1)
            return responseFail(message: __('messages.SuperAdmin Cannot Be Modifying'));
        return delete_model($this->roleRepository , $id);
    }
}
