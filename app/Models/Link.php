<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function creator(){
        return $this->belongsTo(User::class , 'created_by');
    }
    public function getCreatedAtAttribute($val){
        return Carbon::parse($val)->format('j.n.Y, g:i A');
    }
}
