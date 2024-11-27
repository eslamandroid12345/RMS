<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TimeSheet extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['from', 'to'];


    public function time(): Attribute
    {
        return Attribute::make(get: function () {
            return Carbon::parse($this->from)->format('h:i a').' - '.Carbon::parse($this->to)->format('h:i a');
        });
    }
    public function duration(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->from !== null && $this->to !== null)
                return Carbon::parse($this->from)->diffAsCarbonInterval($this->to);
            return null;
        });
    }

    public function formatedDuration(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->duration?->format('%H:%I:%S');
        });
    }

    public function avgActivity(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->activity === null)
                return $this->children()?->avg('activity');
            return $this->activity;
        });
    }

    public function avgIdle(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->idle === null)
                return $this->children()?->avg('idle');
            return $this->idle;
        });
    }


    public function gap()
    {
        return $this->hasOne(TimeSheetGap::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function children()
    {
        return $this->hasMany(TimeSheet::class, 'parent_id');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
