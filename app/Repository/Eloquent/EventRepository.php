<?php

namespace App\Repository\Eloquent;


use App\Models\Event;
use App\Repository\EventRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EventRepository extends Repository implements EventRepositoryInterface {

    protected Model $model;

    public function __construct(Event $model){
        parent::__construct($model);
    }


}
