<?php

namespace App\Http\Controllers\Api\Statics;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\Statics\StaticsService;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function __construct(private StaticsService $staticsService){

    }
    public function rateStatics(){
        return $this->staticsService->rateStatics();
    }
    public function tasksStatics(){
        return $this->staticsService->tasksStatics();
    }
}
