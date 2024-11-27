<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\ContractualTeam;
use App\Repository\ContractualTeamRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ContractualTeamRepository extends Repository implements ContractualTeamRepositoryInterface {

    protected Model $model;

    public function __construct(ContractualTeam $model)
    {
        parent::__construct($model);
    }

    public function getAllTeamsForProject($id)
    {
        return $this->model::query()->where('project_estimate_id',$id)->get();
    }

}
