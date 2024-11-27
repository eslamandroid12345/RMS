<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\Report;
use App\Models\ReportReview;
use App\Models\ReportView;
use App\Models\Team;
use App\Models\User;
use App\Repository\ReportRepositoryInterface;
use App\Repository\ReportReviewRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\TeamRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ReportReviewRepository extends Repository implements ReportReviewRepositoryInterface {

    protected Model $model;

    public function __construct(ReportReview $model){
        parent::__construct($model);
    }


}
