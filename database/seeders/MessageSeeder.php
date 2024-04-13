<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::factory(10)
            ->recycle(User::all())
            ->state(new Sequence(
                fn (Sequence $sequence) => [
                    'created_at' => Carbon::create(2024)->addMinutes($sequence->index * 5),
                    'updated_at' => Carbon::create(2024)->addMinutes($sequence->index * 5)
                ],
            ))
            ->create();
    }
}
