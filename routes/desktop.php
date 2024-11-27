<?php


use App\Http\Controllers\Api\Timesheet\TimesheetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Desktop Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Desktop routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(['auth:api'])->group(function () {
    Route::controller(TimesheetController::class)->prefix('timesheet')->group(function () {
        Route::post('/session', 'attachSession');
        Route::put('/{id}', 'stop');
        Route::post('/', 'store');
    });
});

