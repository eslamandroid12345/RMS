<?php

namespace App\Http\Controllers\Api\Holiday;

use App\Http\Controllers\Controller;
use App\Http\Requests\Holiday\HolidayRequest;
use App\Http\Requests\Holiday\HolidayResponseRequest;
use App\Http\Services\Api\Holiday\HolidayService;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function __construct(public readonly HolidayService $service){

    }
    public function index(){
        return $this->service->index();
    }
    public function show($id){
        return $this->service->show($id);
    }
    public function store(HolidayRequest $request){
        return $this->service->store($request);
    }
    public function storeResponse(HolidayResponseRequest $request){
        return $this->service->storeResponse($request);
    }
}
