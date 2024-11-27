<?php

namespace App\Models;

use App\Http\Enums\HolidayStatus;
use App\Http\Enums\HolidayType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isNull;

class Holiday extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function title(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->user_id === auth('api')->id())
                return HolidayType::fromName($this->type)->t();
            else
                return HolidayType::fromName($this->type)->t() . __('general.from') . $this->user?->name;
        });
    }

    public function isRight(): Attribute
    {
        return Attribute::make(get: fn() => $this->user_id === auth('api')->id());
    }

    public function canResponse(): Attribute
    {
        return Attribute::make(get: fn() => $this->status != HolidayStatus::APPROVED->value
            && $this->assignees()?->where('users.id', auth('api')->id())->exists()
            && $this->parent_id === null );
    }

    public function createdAtFormat(): Attribute
    {
        return Attribute::make(get: function () {
            $date = Carbon::parse($this->created_at);
            if ($date->isToday()) {
                return __('general.today') . $date->format('h : i : s A');
            } else if ($date->isYesterday()) {
                return __('general.yesterday') . $date->format('h : i : s A');
            } else {
                return $date->format('M d, Y h : i : s A');
            }
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(Holiday::class, 'parent_id');
    }

    public function assignedResponses()
    {
        return $this->hasMany(Holiday::class, 'parent_id')
            ->whereHas('assignees', function ($q) {
                $q->where('users.id', auth('api')->id());
            });
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class);
    }

}
