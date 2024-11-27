<?php

namespace App\Providers;

use App\Repository\AttachmentRepositoryInterface;
use App\Repository\Eloquent\AttachmentRepository;
use App\Repository\Eloquent\EventRepository;
use App\Repository\Eloquent\HolidayRepository;
use App\Repository\Eloquent\LinkRepository;
use App\Repository\Eloquent\PermissionsRepository;
use App\Repository\Eloquent\ProjectRepository;
use App\Repository\Eloquent\RoleRepository;
use App\Repository\Eloquent\SettingsRepository;
use App\Repository\Eloquent\TaskMemberRepository;
use App\Repository\Eloquent\TaskRepository;
use App\Repository\Eloquent\TeamRepository;
use App\Repository\Eloquent\TimeSheetGapRepository;
use App\Repository\Eloquent\TimesheetRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\ProjectEstimateRepository;
use App\Repository\Eloquent\ProjectEstimateScopeRepository;
use App\Repository\Eloquent\ContractualTeamRepository;

use App\Repository\EventRepositoryInterface;
use App\Repository\HolidayRepositoryInterface;
use App\Repository\LinkRepositoryInterface;
use App\Repository\PermissionsRepositoryInterface;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\SettingsRepositoryInterface;
use App\Repository\Eloquent\ReportRepository;
use App\Repository\Eloquent\ReportReviewRepository;
use App\Repository\ReportRepositoryInterface;
use App\Repository\ReportReviewRepositoryInterface;
use App\Repository\TaskMemberRepositoryInterface;
use App\Repository\TaskRepositoryInterface;
use App\Repository\TeamRepositoryInterface;
use App\Repository\TimeSheetGapRepositoryInterface;
use App\Repository\TimesheetRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\ProjectEstimateRepositoryInterface;
use App\Repository\ProjectEstimateScopeRepositoryInterface;
use App\Repository\ContractualTeamRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(UserRepositoryInterface::class , UserRepository::class);
        $this->app->bind(TeamRepositoryInterface::class , TeamRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class , SettingsRepository::class);
        $this->app->bind(ReportRepositoryInterface::class , ReportRepository::class);
        $this->app->bind(ReportReviewRepositoryInterface::class , ReportReviewRepository::class);
        $this->app->bind(RoleRepositoryInterface::class , RoleRepository::class);
        $this->app->bind(PermissionsRepositoryInterface::class , PermissionsRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class , ProjectRepository::class);
        $this->app->bind(AttachmentRepositoryInterface::class , AttachmentRepository::class);
        $this->app->bind(LinkRepositoryInterface::class , LinkRepository::class);
        $this->app->bind(EventRepositoryInterface::class , EventRepository::class);
        $this->app->bind(TaskRepositoryInterface::class , TaskRepository::class);
        $this->app->bind(TaskMemberRepositoryInterface::class , TaskMemberRepository::class);
        $this->app->bind(TimesheetRepositoryInterface::class , TimesheetRepository::class);
        $this->app->bind(TimeSheetGapRepositoryInterface::class , TimeSheetGapRepository::class);
        $this->app->bind(HolidayRepositoryInterface::class , HolidayRepository::class);
        $this->app->bind(ProjectEstimateRepositoryInterface::class , ProjectEstimateRepository::class);
        $this->app->bind(ProjectEstimateScopeRepositoryInterface::class , ProjectEstimateScopeRepository::class);
        $this->app->bind(ContractualTeamRepositoryInterface::class , ContractualTeamRepository::class);
    }
}
