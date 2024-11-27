<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'reciver_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reviews()
    {
        return $this->hasMany(ReportReview::class);
    }

    public function rating(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->reviews()->avg('rating');
            }
        );
    }

    public function canResponse(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->reciver_id == auth('api')->id() && $this->reviews()?->count() == 0;
            }
        );
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value == "WAITING_REPLY") {
                    return __('dashboard.WAITING_REPLY');
                } else if ($value == "RESPONDED") {
                    return __('dashboard.RESPONDED');
                }
            }
        );
    }

    public function getCreatedAtAttribute($val)
    {
        $createdAt = Carbon::parse($val);
        // Check if it's today
        if ($createdAt->isToday()) {
            $formattedDate = 'Today ' . $createdAt->format('h:i:s A');
        } elseif ($createdAt->isYesterday()) {
            $formattedDate = 'Yesterday ' . $createdAt->format('h:i:s A');
        } else {
            $formattedDate = $createdAt->format('F d, Y h:i:s A');
        }
        return $formattedDate;
    }

    public function reciver()
    {
        return $this->belongsTo(User::class, 'reciver_id');
    }

    public function team(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->user->teams()->first()->name;
        });
    }
}
