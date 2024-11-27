<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subTasks(){
        return $this->hasMany(Task::class ,  'task_id')->orderBy('sort');
    }
    public function team(){
        return $this->belongsTo(Team::class);
    }
    public function parentTask(){
        return $this->belongsTo(Task::class , 'task_id');
    }

    public function members(){
        return $this->belongsToMany(User::class , 'task_members');
    }
    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function finished():Attribute{
        return Attribute::make(get:function (){
            return $this->subTasks()->where('status' , 'FINISHED')->count();
        });
    }
    public function progress(){
        $finished = $this->subTasks()->where('status' , 'FINISHED')->count();
        return $this->subTasks()->count()!=0?number_format(($finished / $this->subTasks()->count()) * 100,2):number_format(0,2);
    }
}
