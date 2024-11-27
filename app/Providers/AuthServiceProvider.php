<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Http\Enums\HolidayStatus;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('assignedToTask', function ($user, $task) {
            return ($task->members()?->where('user_id', $user->id)->exists() || auth('api')->user()->hasPermission('tasks-create'));
        });

        Gate::define('canReviewReport', function ($user, $report) {
            return $report->reciver_id == auth('api')->id();
        });

        Gate::define('response-permission', function (User $user, $holiday) {
            return $holiday->status != HolidayStatus::APPROVED->value
                && $holiday->assignees()?->where('users.id', auth('api')->id())->exists();
        });
    }
}
