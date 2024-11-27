<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Event\EventController;
use App\Http\Controllers\Api\Holiday\HolidayController;
use App\Http\Controllers\Api\Panel\PanelController;
use App\Http\Controllers\Api\Project\ProjectController;
use App\Http\Controllers\Api\ProjectEstimate\ProjectEstimateController;
use App\Http\Controllers\Api\Report\ReportController;
use App\Http\Controllers\Api\Report\ReportReviewController;
use App\Http\Controllers\Api\Members\MemberController;
use App\Http\Controllers\Api\Task\TaskController;
use App\Http\Controllers\Api\Teams\TeamController;
use App\Http\Controllers\Api\Role\RoleController;
use App\Http\Controllers\Api\Role\PermissionsController;
use App\Http\Controllers\Api\Settings\SettingController;
use App\Http\Controllers\Api\Attachment\AttachmentController;
use App\Http\Controllers\Api\Links\LinkController;
use App\Http\Controllers\Api\Statics\StaticController;
use App\Http\Controllers\Api\ContractualTeams\ContractualTeamsController;
use App\Http\Controllers\Api\Timesheet\TimesheetController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth');
});


Route::middleware(['auth:api'])->group(function () {

    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionsController::class);

    Route::get('/', [PanelController::class, 'index']);

    Route::apiResource('project-estimates', ProjectEstimateController::class);
    Route::post('project-estimates-scope/{id}', [ProjectEstimateController::class,'storeScope']);
    Route::delete('project-estimates-scope/{id}', [ProjectEstimateController::class,'deleteScope']);

    Route::apiResource('{project_estimates:id}/contractual-teams', ContractualTeamsController::class);

    Route::controller(ProjectController::class)->prefix('projects')->group(function () {
        Route::get('/assigned', 'assignedProjects');
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::post('/{id}', 'update');
        Route::put('/{id}', 'toggleStatus');
        Route::get('/{id}/members', 'getAsignee');
    });
    Route::post('/sort/projects', [ProjectController::class, 'sort']);


    Route::controller(ReportController::class)->prefix('reports')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
    });

    Route::post('review', [ReportReviewController::class, 'store'])->name('review.store');
    Route::get('rate/statics', [StaticController::class, 'rateStatics']);
    Route::get('tasks/statics', [StaticController::class, 'tasksStatics']);
    Route::get('members/admins', [MemberController::class ,'admins']);
    Route::get('members/all', [MemberController::class ,'getAllMembers']);
    Route::apiResource('members', MemberController::class);
    Route::controller(MemberController::class)->group(function () {
        Route::post('members/{member}', 'update');
        Route::put('toggle/member/{id}', 'toggleMember');
        Route::get('statics/{id}', 'getMemberStatics');
    });

    Route::apiResource('teams', TeamController::class);
    Route::controller(TeamController::class)->group(function () {
        Route::post('teams/{team}', 'update');
        Route::get('team/members', 'members');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('settings', 'index');
        Route::post('settings/update', 'update');
        Route::post('update/password', 'updatePassword');
    });

    Route::controller(AttachmentController::class)->group(function () {
        Route::post('attachments', 'store');
        Route::post('attachments/update', 'update');
        Route::delete('attachments/{id}', 'destroy');
        Route::get('attachments/{id}', 'show');
    });
    Route::controller(LinkController::class)->group(function () {
        Route::post('links', 'store');
        Route::post('links/update', 'update');
        Route::delete('links/{id}', 'destroy');
        Route::get('links/{id}', 'show');
    });

    Route::apiResource('events', EventController::class);
    Route::controller(EventController::class)->group(function () {
        Route::post('events/{id}', 'update');
    });
    Route::controller(TaskController::class)->prefix('tasks')->group(function () {
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::post('/sub', 'storeSubTask');
        Route::put('/sub/{id}', 'updateSubTask');
        Route::delete('/{id}', 'destroy');
        Route::put('/toggle/{id}', 'toggle');
        Route::post('/sort', 'sort');
    });
    Route::controller(TimesheetController::class)->prefix('timesheet')->group(function () {
        //desktop
        Route::post('/session', 'attachSession');
        Route::put('/{id}', 'stop');
        Route::post('/', 'store');
        //website
        Route::get('/{id}/images', 'getImages');
        Route::delete('/{id}', 'destroy');
        Route::get('/day/activity', 'dayActivity');
        Route::get('/', 'index');
    });
    Route::controller(HolidayController::class)->prefix('holidays')->group(function () {
        Route::post('/response', 'storeResponse');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::get('/', 'index');
    });
    Route::get('/to-do', [TaskController::class, 'toDo']);
//    Route::get('/locale',[PanelController::class,'locale']);
});

