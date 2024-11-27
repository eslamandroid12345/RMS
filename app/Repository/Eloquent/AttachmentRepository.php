<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\Attachment;
use App\Models\Project;
use App\Models\Report;
use App\Models\Team;
use App\Models\User;
use App\Repository\AttachmentRepositoryInterface;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\ReportRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\TeamRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AttachmentRepository extends Repository implements AttachmentRepositoryInterface {

    protected Model $model;

    public function __construct(Attachment $model){
        parent::__construct($model);
    }


}
