<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable , HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function token()
    {
        return JWTAuth::fromUser($this);
    }

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

    public function teams(){
        return $this->belongsToMany(Team::class , 'team_users');
    }
    public function team(){
        return $this->belongsToMany(Team::class , 'team_users')->limit(1);
    }
    public function projects(){
        return $this->belongsToMany(Project::class , 'project_members');
    }
    public function roles(){
        return $this->belongsToMany(Role::class , 'role_user');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'permission_user');
    }
    public function reports(){
        return $this->hasMany(Report::class,'author_id');
    }
    public function reviews(){
        return $this->hasMany(ReportReview::class,'reciver_id');
    }
    public function rate():Attribute{
        return  Attribute::make(get:function (){
            return $this->reviews()->avg('rating');
        });
    }
//    public function team(){
//            if($this->teams()->count()>0)
//            return $this->teams()?->first();
//            return null;
//    }
    public function tasks(){
        return $this->belongsToMany(Task::class,'task_members')->where('tasks.task_id',null);
    }

    public function tasksCount():Attribute{
        return  Attribute::make(get:function (){
            return $this->tasks()->count();
        });
    }

}
