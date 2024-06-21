<?php

namespace App\Enums;

enum ChannelSettings: string
{
    case About = 'about';
    case Members = 'members';

    public function label()
    {
        return match ($this) {
            self::About => 'About',
            self::Members => 'Members',
        };
    }
}
