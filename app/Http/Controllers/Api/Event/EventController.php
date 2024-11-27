<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventRequest;
use App\Http\Services\Api\Event\EventService;
use App\Models\Report;
use http\Env\Request;
use Illuminate\Database\Eloquent\Casts\Attribute;

class EventController extends Controller
{


    public function __construct(private EventService $eventService){
        $this->middleware('permission:events-create')->only('store');

    }


    public function show ($id){
        return $this->eventService->show($id);
    }

    public function store(EventRequest $request){
        return $this->eventService->store($request);
    }
    public function update($id,EventRequest $request){
        return $this->eventService->update($id,$request);
    }
    public function destroy($id){
        return $this->eventService->destroy($id);
    }
    public function team():Attribute{
        return Attribute::make(get:function (){
            return $this->user->teams()->first()->name;
        });
    }
}
