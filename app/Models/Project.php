<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function image() : Attribute {
        return Attribute::make(
            get: function ($value) {
                if ($value !== null) {
                    return url($value);
                }
                return null;
            }
        );
    }


    public function creator(){
        return $this->belongsTo(User::class , 'created_by');
    }

    public function members(){
        return $this->belongsToMany(User::class , 'project_members');
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function attachments(){
        return $this->hasMany(Attachment::class);
    }
    public function links(){
        return $this->hasMany(Link::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class)->whereNull('task_id')->orderBy('sort');
    }
    public function linksCount():Attribute{
        return  Attribute::make(get: function (){
            return $this->links()->count();
        });
    }
    public function attachmentsCount():Attribute{
        return  Attribute::make(get: function (){
            return $this->attachments()->count();
        });
    }
    public function eventsCount():Attribute{
        return  Attribute::make(get: function (){
            return $this->events()->count();
        });
    }
    public function progress(){
        if ($this->tasks()->count()>0){
            $finished = $this->tasks()->where('status' , 'FINISHED')->count();
            return ($finished / $this->tasks()->count()) * 100;
        }
       return 0;
    }


}
