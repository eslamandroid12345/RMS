<?php

namespace App\Repository\Eloquent;

use App\Models\Permission;
use App\Repository\PermissionsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PermissionsRepository extends Repository implements PermissionsRepositoryInterface
{
protected Model $model;
public function __construct(Permission $model)
{
    parent::__construct($model);
}
public function getPermssions(){
    return $this->model->whereNotIn('id',[27,28,29,30])->orderBy('name')->get();
}
}
