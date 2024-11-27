<?php

namespace App\Repository\Eloquent;

use App\Models\TimeSheet;
use App\Repository\TimesheetRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TimesheetRepository extends Repository implements TimesheetRepositoryInterface
{
    public function __construct(TimeSheet $model)
    {
        parent::__construct($model);
    }

    public function getTimeSheetFiltered()
    {
        $query = $this->model::query();
        $query->whereNull('parent_id');
        if (request('start_date') && request('end_date'))
            $query->whereDate('from', '>=', request('start_date'))
                ->whereDate('from', '<=', request('end_date'));

        if (request('project_id'))
            $query->where('project_id', request('project_id'));

        if (auth('api')->user()->hasRole('super_admin') && request('user_id'))
            $query->where('user_id', request('user_id'));
        else
            $query->where('user_id', auth('api')->id());

        $query->withAvg('children', 'activity');
        $query->withAvg('children', 'idle');

        // Store the base query in a subQuery : converts the Eloquent query builder instance into a base query builder instance.
        $subQuery = $query->toBase();

        if (request('time_type') == 'active') {
            $subQuery->having('children_avg_activity', '>=', 20);
        } else if (request('time_type') == 'idle') {
            $subQuery->having('children_avg_activity', '<', 20);
        }

        // Reattach the subQuery back to the original query builder
        $finalQuery = $this->model::fromSub($subQuery, 'sub');

        $finalQuery->with('project');

        return $finalQuery->get();
    }

    public function getDayActivityFiltered()
    {
        $query = $this->model::query();
        $query->whereNotNull('parent_id');
        if (request('day'))
            $query->whereDate('from', '=', request('day'));

        $query->orderBy('from');
        $query->withCount('images');
        return $query->get();


//        $query->withAvg('children', 'activity');
//        $query->withAvg('children', 'idle');
//
//        // Store the base query in a subQuery : converts the Eloquent query builder instance into a base query builder instance.
//        $subQuery = $query->toBase();
//
//        if (request('time_type') == 'active') {
//            $subQuery->having('children_avg_activity', '>=', 20);
//        } else if (request('time_type') == 'idle') {
//            $subQuery->having('children_avg_activity', '<', 20);
//        }
//
//        // Reattach the subQuery back to the original query builder
//        $finalQuery = $this->model::fromSub($subQuery, 'sub');
//
//        $finalQuery->with('project');
//
//        return $finalQuery->get();

    }

}
