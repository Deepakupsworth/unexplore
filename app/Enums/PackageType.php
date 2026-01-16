<?php

namespace App\Enums;

enum PackageType: string
{
    case FIXED = 'fixed';
    case CUSTOMIZED = 'customized';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
