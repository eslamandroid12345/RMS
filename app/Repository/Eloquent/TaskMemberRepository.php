<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\Attachment;
use App\Models\Project;
use App\Models\Report;
use App\Models\TaskMember;
use App\Models\Team;
use App\Models\User;
use App\Repository\AttachmentRepositoryInterface;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\ReportRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\TaskMemberRepositoryInterface;
use App\Repository\TeamRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskMemberRepository extends Repository implements TaskMemberRepositoryInterface {

    protected Model $model;

    public function __construct(TaskMember $model){
        parent::__construct($model);
    }

    public function getMemberStatic($id){
        $query= $this->model::query();
        $query->where('user_id',$id);
        if(request('year')!=null)
            $query->whereYear('created_at',request('year'));
        return $query->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
           DB::raw('COUNT(*) as task_count'),
           'created_at'
        )
            ->groupBy('year', 'month','created_at')
            ->orderBy('month')
            ->get();
    }

}
