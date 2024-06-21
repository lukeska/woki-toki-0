<?php

namespace App\Enums;

enum ChannelSort: string
{
    case Alphabetical = 'alphabetical';
    case ReverseAlphabetical = 'reverse-alphabetical';
    case Latest = 'latest';
    case Oldest = 'oldest';
    case MostMembers = 'most-members';
    case LeastMembers = 'least-members';

    public function label()
    {
        return match ($this) {
            self::Latest => 'Newest Channels',
            self::Oldest => 'Oldest Channels',
            self::Alphabetical => 'A to Z',
            self::ReverseAlphabetical => 'Z to A',
            self::MostMembers => 'Most Members',
            self::LeastMembers => 'Least Members',
        };
    }
}
