<?php

namespace App\Http\Enums;

enum HolidayType: string
{
    use Enumable;

    case DAY = 'DAY';
    case PERMISSION = 'PERMISSION';
    case REMOTE = 'REMOTE';
    case OTHER = 'OTHER';

    public function validationRules()
    {
        $rules = [];
    }

    public function t()
    {
        return match ($this) {
            self::PERMISSION => __('general.PERMISSION'),
            self::DAY => __('general.DAY'),
            self::REMOTE => __('general.REMOTE'),
            self::OTHER => __('general.OTHER'),
        };
    }
}
