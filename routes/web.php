<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Members\MemberController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Report\ReportReviewController;
use App\Http\Controllers\Teams\TeamController;
use App\Http\Controllers\Settings\SettingController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\RolesPermissions\RolesPermissionsController;
use App\Http\Controllers\StaticticController;

Route::group([
    'prefix' => LaravelLocalization::setLocale() ,
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

        Route::controller(AuthController::class)->prefix('auth')->group(function (){
            Route::get('login' , 'loginForm')->name('loginForm');
            Route::post('login' , 'login')->name('login');
            Route::get('logout' , 'logout')->name('auth.logout')->middleware('auth');
        });

        Route::middleware('auth')->group(function (){
            Route::get('/' , [PanelController::class,'index'])->name('home');

        });

        Route::post('update/password',[AuthController::class,'updatePassword'])->name('update.password');
        Route::resource('members' , MemberController::class);
        Route::post('members/toggle' , [MemberController::class , 'toggleMember'])->name('members.toggle');

        Route::resource('teams' , TeamController::class)->except('show');
        Route::resource('reports' , ReportController::class);
        Route::resource('statictic' , StaticticController::class);
        Route::resource('roles' , RolesPermissionsController::class)->only('edit','index','update');
        Route::get('send' , [ReportController::class , 'sendEmail'])->name('sendEmail');
        Route::get('showdetails' , [TeamController::class , 'showdetails'])->name('showdetails');

        Route::post('review' , [ReportReviewController::class , 'store'])->name('review.store');





        Route::resource('settings' , SettingController::class)->only('edit','update');

});




