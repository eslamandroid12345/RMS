<?php

namespace App\Repository\Eloquent;

use App\Models\Holiday;
use App\Repository\HolidayRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class HolidayRepository extends Repository implements HolidayRepositoryInterface
{
    public function __construct(Holiday $model)
    {
        parent::__construct($model);
    }

    public function getPermissions()
    {
        $query = $this->model::query();
        $query->whereNull('parent_id');

        if (request()->from !== null && request()->to !== null)
            $query->whereDate('updated_at', '>=', request()->from)
                ->whereDate('updated_at', '<=', request()->to);

        if (request()->user_id !== null)
            $query->where('user_id', request()->user_id);
        else if (request()->team_id !== null && request()->user_id === null)
            $query->whereHas('user', function ($user_query) {
                $user_query->whereHas('teams', function ($teams_query) {
                    $teams_query->where('teams.id', request()->team_id);
                });
            });
        else if (request()->team_id === null && request()->user_id === null)
            $query->where(function ($query) {
                $query->where('user_id', auth('api')->id())
                    ->orWhereHas('assignees', function ($q) {
                        $q->where('users.id', auth('api')->id());
                    });
            });

        if (request()->status !== null)
            $query->where('status', request()->status);

        if (request()->type !== null)
            $query->where('type', request()->type);

        $query->with('user');
        return $query->get();
    }

    public function getSinglePermission($id)
    {
        $query = $this->model::query();
        $query->where('id', $id);
        $query->with(['user.team', 'assignedResponses.user.team']);
        return $query->first();
    }


}
