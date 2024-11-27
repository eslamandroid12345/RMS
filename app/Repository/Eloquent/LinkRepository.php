<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\Attachment;
use App\Models\Link;
use App\Models\Project;
use App\Models\Report;
use App\Models\Team;
use App\Models\User;
use App\Repository\AttachmentRepositoryInterface;
use App\Repository\LinkRepositoryInterface;
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

class LinkRepository extends Repository implements LinkRepositoryInterface {

    protected Model $model;

    public function __construct(Link $model){
        parent::__construct($model);
    }


}
