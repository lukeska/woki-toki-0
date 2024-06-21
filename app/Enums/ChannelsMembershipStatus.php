<?php

namespace App\Enums;

enum ChannelsMembershipStatus: string
{
    case All = 'all';
    case Member = 'member';
    case NotMember = 'not-member';

    public function label()
    {
        return match ($this) {
            self::All => 'All Channels',
            self::Member => 'My Channels',
            self::NotMember => 'Other Channels',
        };
    }
}
