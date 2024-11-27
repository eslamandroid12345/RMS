<?php

namespace App\Http\Enums;

enum HolidayStatus: string
{
    use Enumable;

    case PENDING = 'PENDING';
    case APPROVED = 'APPROVED';
    case REJECTED = 'REJECTED';

    public function validationRules()
    {
        $rules = [];
    }

    public function t()
    {
        return match ($this) {
            self::REJECTED => __('general.rejected'),
            self::APPROVED => __('general.approved'),
            self::PENDING => __('general.pending'),
        };
    }
}
