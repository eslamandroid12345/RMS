<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\Report;
use App\Models\Team;
use App\Models\User;
use App\Repository\ReportRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\TeamRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use function App\responseFail;

class ReportRepository extends Repository implements ReportRepositoryInterface
{

    protected Model $model;

    public function __construct(Report $model)
    {
        parent::__construct($model);
    }

    public function getReports()
    {
        $query = $this->model::query();

        $query->where('reciver_id', auth('api')->id())
            ->orwhere('author_id', auth()->id());
        if (\request()->has('team_id') && \request('team_id') != "ALL") {
            if (request('team_id') != null) {
                $query->whereHas('user', function ($query) {
                    $query->whereHas('teams', function ($q) {
                        $q->where('teams.id', request('team_id'));
                    });
                });
            }
        }

        if (\request()->has('status') && \request('status') != "ALL") {
            $query->where('status', request('status'));
        }
        if (request()->has('from_date') && request()->has('to_date')) {
            if (request('from_date') != null && request('to_date') != null) {
                $query->whereDate('created_at', '>=', request('from_date'))
                    ->whereDate('created_at', '<=', request('to_date'));
            }
        }
//        if(request()->has('year')){
//            if(request('year')!=null){
//                $query->whereYear('created_at',request('year'));
//            }
//        }
        return $query->orderByDesc('id')->paginate(25);
    }


    public function getReport($id)
    {
        $report = $this->model::findOrFail($id);
        if (auth('api')->id() == $report['author_id'] || auth('api')->id() == $report['reciver_id']) {
            return $report;
        }
        return responseFail(status: 403, message: __('messages.You Are Not Authorized For This Action'));
    }

    public function todayReports()
    {
        return $this->model->whereDate('created_at', now()->format('Y-m-d'))->get();
    }

    public function recievedReports($reports)
    {
        return $reports->where('status', 'RECEIVED');
    }

    public function veiwedReports($reports)
    {
        return $reports->where('status', 'VIEWED');
    }

    public function recentReports($user_id = null)
    {
        $twoDaysAgo = now()->subDays(15);

        return $this->model::query()
            ->when($user_id, function ($query) use ($user_id) {
                $query->where('author_id', $user_id);
            })
            ->where('created_at', '>=', $twoDaysAgo)
            ->where('created_at', '<=', now())
            ->orderByDesc('created_at')
            ->get();
    }

}
