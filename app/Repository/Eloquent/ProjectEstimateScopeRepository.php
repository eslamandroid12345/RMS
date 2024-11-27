<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\ProjectEstimateScope;
use App\Repository\ProjectEstimateScopeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProjectEstimateScopeRepository extends Repository implements ProjectEstimateScopeRepositoryInterface
{
    protected Model $model;

    public function __construct(ProjectEstimateScope $model)
    {
        parent::__construct($model);
    }
}
