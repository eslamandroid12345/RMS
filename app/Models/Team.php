<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory , LanguageToggle;
    protected $guarded = ['id'];

    public function getNameAttribute(){
        return $this->t('name');
    }
    public function icon() : Attribute {
        return Attribute::make(
            get: function ($value) {
                if ($value !== null) {
                    return url($value);
                }
                return null;
            }
        );
    }


    public function members(){
        return $this->belongsToMany(User::class , 'team_users');
    }
    public function rate(){
        return $this->members();
    }


    public function contractualTeams()
    {
        return $this->hasMany(ContractualTeam::class,'team_id');
    }

}

