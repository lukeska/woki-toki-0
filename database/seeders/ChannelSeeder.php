<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Lottery;

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
            'lego-news',
        ]);

        foreach ($gamesChannelNames as $channelName) {
            $channel = Channel::factory()->create([
                'user_id' => $luca->id,
                'name' => $channelName,
                'private' => fake()->randomElement([true, false]),
            ]);

            if ($channelName == 'dungeons-and-dragons') {
                $luca->channels()->attach($channel);
                $viola->channels()->attach($channel);
            } else {
                Lottery::odds(1, 2)
                    ->winner(fn () => $luca->channels()->attach($channel))
                    ->choose();
            }
        }

        foreach ($legoChannelNames as $channelName) {
            $channel = Channel::factory()->create([
                'user_id' => $viola->id,
                'name' => $channelName,
                'private' => fake()->randomElement([true, false]),
            ]);

            Lottery::odds(1, 2)
                ->winner(fn () => $viola->channels()->attach($channel))
                ->choose();
        }

        User::whereNotIn('id', [1, 2])->each(function ($user) {
            $user->channels()->attach(Channel::inRandomOrder()->limit(3)->get());
        });
    }
}
