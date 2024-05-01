<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $luca = User::find(1);
        $viola = User::find(2);

        $gamesChannelNames = collect([
            'dungeons-and-dragons',
            'pathfinder',
            'warhammer-fantasy-roleplay',
            'call-of-cthulhu',
            'shadowrun',
            'gurps',
            'vampire-the-masquerade',
            'star-wars-edge-of-the-empire',
            'the-world-of-darkness',
            'runequest',
            'cyberpunk-2020',
            'deadlands',
            'traveller',
            'legend-of-the-five-rings',
            'mouse-guard',
            'ars-magica',
            'fiasco',
            'fate-core',
            'numenera',
            'mutants-and-masterminds',
        ]);

        $legoChannelNames = collect([
            'lego-sets',
            'lego-builds',
            'lego-minifigures',
            'lego-mocs',
            'lego-technic',
            'lego-city',
            'lego-star-wars',
            'lego-harry-potter',
            'lego-architecture',
            'lego-ideas',
            'lego-creator',
            'lego-ninjago',
            'lego-friends',
            'lego-marvel',
            'lego-duplo',
            'lego-education',
            'lego-video-games',
            'lego-animation',
            'lego-community',
            'lego-news'
        ]);

        $luca->ownedTeams->each(function ($team) use ($luca, $gamesChannelNames) {
            foreach ($gamesChannelNames as $channelName) {
                $team->channels()->create([
                    'user_id' => $luca->id,
                    'name' => $channelName,
                ]);
            }
        });

        $viola->ownedTeams->each(function ($team) use ($viola, $legoChannelNames) {
            foreach ($legoChannelNames as $channelName) {
                $team->channels()->create([
                    'user_id' => $viola->id,
                    'name' => $channelName,
                ]);
            }
        });
    }
}
