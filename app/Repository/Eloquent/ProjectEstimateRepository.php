<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\ProjectEstimate;
use App\Repository\ProjectEstimateRepositoryInterface;

use Illuminate\Database\Eloquent\Model;

class ProjectEstimateRepository extends Repository implements ProjectEstimateRepositoryInterface
{
    protected Model $model;

    public function __construct(ProjectEstimate $model)
    {
        parent::__construct($model);
    }

    public function getAllProjectsEstimates()
    {
        return $this->model::query()->get();
    }
}
