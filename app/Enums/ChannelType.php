<?php

namespace App\Enums;

enum ChannelType: string
{
    case Any = 'any';
    case Public = 'public';
    case Private = 'private';

    public function label()
    {
        return match ($this) {
            self::Any => 'Any channel type',
            self::Public => 'Public',
            self::Private => 'Private',
        };
    }
}
