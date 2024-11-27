<?php

namespace App\Repository\Eloquent;

use App\Models\Role;
use App\Repository\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends Repository implements RoleRepositoryInterface
{
    protected Model $model;
    public function __construct(Role $role){
        parent::__construct($role);
    }

    public function getRoles(){
        return $this->model::whereNot('name' , 'super_admin')->get();
    }


}
