<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\Team;
use App\Models\User;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository implements UserRepositoryInterface
{

    protected Model $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getMembers()
    {
        $query = $this->model::query();
        $query->whereHasRole('user');
        $query->where('id', '!=', auth('api')->id());
        if (request('team_id')) {
            $query->whereHas('teams', function ($query) {
                $query->where('teams.id', request('team_id'));
            });
        }
        if (request('rate')) {
            if (request('rate') == 0) {
                return $query->get()->sortBy('rate', descending: true);
            } elseif (request('rate') == 1) {
                return $query->get()->sortBy('rate', descending: false);
            }
        }
        return $query->get();
    }

    public function getAdmins()
    {
        $query = $this->model::query();
        $query->whereHasRole('admin');
        $query->where('id', '!=', auth('api')->id());
        return $query->get();
    }

    public function getAllMembers()
    {
        $query = $this->model::query();
        $query->where('id','!=',auth('api')->id());
        $query->where('status', 1);
        return $query->get();
    }

    public function users()
    {
        return $this->model->whereHasRole('user')->get();
    }

    public function getMemberStatics()
    {

        $query = $this->model::query();
        return $query->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as task_count')
        )
            ->groupBy('year', 'month')
            ->get();
    }

    public function prepareRatingStatics($id = null)
    {
        $query = $this->model::query();
        if (request('team_id')) {
            $query->whereHas('teams', function ($query) {
                $query->where('teams.id', request('team_id'));
            });
        }
        if ($id)
            $query->where('users.id', $id);
        $query->select(['users.name as name', 'users.color as color',
            DB::raw('MONTH(report_reviews.created_at) as month'),
            DB::raw('YEAR(report_reviews.created_at) as year'),
            DB::raw('AVG(report_reviews.rating) as average_rating')])
            ->leftJoin('report_reviews', 'users.id', '=', 'report_reviews.reciver_id')
            ->groupBy('users.id', 'users.name', 'month', 'year', 'color')
            ->having('average_rating', '>', 0);
        $query->orderBy('month');
        if (request('year') != null)
            $query->whereYear('report_reviews.created_at', request('year'));
        if (request('month') != null)
            $query->whereMonth('report_reviews.created_at', request('month'));

        return $query->get();
    }

    public function getRatingStatics()
    {
        $dataFromDb = $this->prepareRatingStatics();
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $userData = [];
        foreach ($dataFromDb as $record) {
            $userName = $record['name'];

            if (!isset($userData[$userName])) {
                // Initialize the user data array
                $userData[$userName] = [
                    'name' => $userName,
                    'data' => array_fill(0, count($months), 0),
                ];
            }
            $monthIndex = $record['month'] - 1;
            $userData[$userName]['data'][$monthIndex] = $record['average_rating'];
        }
        return array_values($userData);
    }

    public function getUserRatingStatics($id)
    {
        $allData = $this->prepareRatingStatics($id);
        $user = null;
        foreach ($allData as $data) {
            $user['month'][] = Carbon::create(null, $data->month, 1)->format('F');
            $user['values'][] = $data->average_rating;
        }
        return $user;
    }

    public function prepareTasksStatics($id)
    {
        $query = $this->model::query();
        $query->whereHas('teams', function ($query) use ($id) {
            $query->where('teams.id', $id);
        });
        $query->select([
            'users.name as name',
            'users.color as color',
            DB::raw('MONTH(tasks.created_at) as month'),
            DB::raw('YEAR(tasks.created_at) as year'),
            DB::raw('COUNT(DISTINCT tasks.id) as total_task_count'),
            DB::raw('COUNT(CASE WHEN tasks.status = "FINISHED" THEN 1 ELSE NULL END) as finished_task_count'),
            DB::raw('COUNT(CASE WHEN tasks.status = "IN PROGRESS" THEN 1 ELSE NULL END) as in_progress_task_count'),
            DB::raw('COUNT(CASE WHEN tasks.status = "HOLD" THEN 1 ELSE NULL END) as hold_task_count'),
        ])
            ->leftJoin('task_members', 'users.id', '=', 'task_members.user_id')
            ->leftJoin('tasks', 'task_members.task_id', '=', 'tasks.id')
            ->groupBy('users.name', 'month', 'year', 'color')
            ->having('total_task_count', '>', 0);

        if (\request()->has('date')) {
            if (request('date') == 0) {
                $query->where('tasks.created_at', '>', Carbon::now()->subMonth());
            } else if (request('date') == 1) {
                $query->where('tasks.created_at', '>', Carbon::now()->subMonths(3));
            } else if (request('date') == 2) {
                $query->where('tasks.created_at', '>', Carbon::now()->subMonths(6));
            }
        }
        if (request('year') != null)
            $query->whereYear('tasks.created_at', request('year'));
        return $query->get();

    }

    public function getTasksStatics()
    {
        $teams = Team::all();
        $data = [];
        foreach ($teams as $k => $team) {
            $team_data = $this->prepareTasksStatics($team->id);
            $names = [];
            $percent = [];
            foreach ($team_data as $i => $user) {
                $names[] = $user->name;
                $total_tasks = $user->total_task_count;
                $finished_task_count = $user->finished_task_count;
                $percent[] = intval($total_tasks > 0 ? ($finished_task_count / $total_tasks) * 100 : 0);
            }
            $data[$team->name]['names'] = $names;
            $data[$team->name]['values'] = $percent;
            $data[$team->name]['team_name'] = $team->name;
        }
        return array_values($data);
    }
}
