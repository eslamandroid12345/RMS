<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\Team;
use App\Models\User;
use App\Repository\RepositoryInterface;
use App\Repository\TeamRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeamRepository extends Repository implements TeamRepositoryInterface {

    protected Model $model;

    public function __construct(Team $model){
        parent::__construct($model);
    }



}
