<?php

namespace App\Http\Services\Api\Event;

use App\Http\Resources\Events\EventResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\EventRepositoryInterface;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class EventService
{

    public function __construct(private EventRepositoryInterface $eventRepository,protected GetService $getService){
    }
    public function show($id){
        return $this->getService->handle(EventResource::class,$this->eventRepository,'getById',[$id],true);
    }
    public function store($request){
        $data = $request->validated();
        return store_model($this->eventRepository , $data , false);
    }
    public function update($id,$request){
        $data=$request->validated();
        return update_model($this->eventRepository,$id,$data);
    }
    public function destroy($id){
        return delete_model($this->eventRepository,$id);
    }

}
