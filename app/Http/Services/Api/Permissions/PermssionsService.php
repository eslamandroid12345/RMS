<?php

namespace App\Http\Services\Api\Permissions;

use App\Http\Resources\Role\PermissionResource;
use App\Http\Resources\Role\RoleDetailsResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\PermissionsRepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\catchError;
use function App\delete_model;
use function App\responseFail;
use function App\responseSuccess;
use function App\store_model;
use function App\update_model;

class PermssionsService
{

    public function __construct(private PermissionsRepositoryInterface $permissionsRepository
        , private GetService $get){

    }


    public function getPermssions(){
        return $this->get->handle(PermissionResource::class , $this->permissionsRepository  , 'getPermssions');
    }

}
