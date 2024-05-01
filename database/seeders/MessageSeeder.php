<?php

namespace Database\Seeders;

use App\Models\Channel;
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
        Message::unsetEventDispatcher();

        Channel::all()->each(function (Channel $channel) {
            if($channel->name == 'dungeons-and-dragons') {
                $dndConversation = [
                    ['user_id' => 1, 'content' => "Hey, have you read the latest adventure module?", 'datetime' => '2024-04-13 09:05:00'],
                    ['user_id' => 2, 'content' => "Yeah, I just finished it. It looks amazing!", 'datetime' => '2024-04-13 09:10:00'],
                    ['user_id' => 1, 'content' => "I'm thinking of creating a new character for our next campaign.", 'datetime' => '2024-04-13 09:15:00'],
                    ['user_id' => 2, 'content' => "That sounds exciting! What kind of character are you thinking of?", 'datetime' => '2024-04-13 09:20:00'],
                    ['user_id' => 1, 'content' => "Do you prefer playing as a player or as a dungeon master?", 'datetime' => '2024-04-13 09:25:00'],
                    ['user_id' => 2, 'content' => "I enjoy both, but being a player lets me immerse myself more in the story.", 'datetime' => '2024-04-13 09:30:00'],
                    ['user_id' => 1, 'content' => "That makes sense. I feel like being a DM gives me more creative control.", 'datetime' => '2024-04-13 09:35:00'],
                    ['user_id' => 2, 'content' => "Yeah, being a DM is like being the conductor of an epic story.", 'datetime' => '2024-04-13 09:40:00'],
                    ['user_id' => 1, 'content' => "Exactly! Plus, you get to surprise your players with unexpected twists.", 'datetime' => '2024-04-13 09:45:00'],
                    ['user_id' => 2, 'content' => "I love the feeling of discovery as a player. It's like uncovering a hidden treasure.", 'datetime' => '2024-04-13 09:50:00'],
                    ['user_id' => 1, 'content' => "That's a great way to put it. It's all about the journey.", 'datetime' => '2024-04-13 09:55:00'],
                    ['user_id' => 2, 'content' => "Absolutely. So, what's your favorite part about playing D&D?", 'datetime' => '2024-04-13 10:00:00'],
                    ['user_id' => 1, 'content' => "I think my favorite part is the camaraderie among the players. We're all in it together.", 'datetime' => '2024-04-13 10:05:00'],
                    ['user_id' => 2, 'content' => "I agree. It's like forging bonds through shared adventures.", 'datetime' => '2024-04-13 10:10:00'],
                    ['user_id' => 1, 'content' => "Exactly! Plus, the memories we create together last a lifetime.", 'datetime' => '2024-04-13 10:15:00'],
                    ['user_id' => 2, 'content' => "For sure. I still remember our first campaign like it was yesterday.", 'datetime' => '2024-04-13 10:20:00'],
                    ['user_id' => 1, 'content' => "Me too. It was a wild ride from start to finish.", 'datetime' => '2024-04-13 10:25:00'],
                    ['user_id' => 2, 'content' => "We should organize a reunion game sometime. It would be a blast!", 'datetime' => '2024-04-13 10:30:00'],
                    ['user_id' => 1, 'content' => "That's a fantastic idea! I'll reach out to the old gang and see who's available.", 'datetime' => '2024-04-13 10:35:00'],
                    ['user_id' => 2, 'content' => "Awesome! I can't wait to roll some dice with everyone again.", 'datetime' => '2024-04-13 10:40:00'],
                    ['user_id' => 1, 'content' => "It's settled then. I'll start planning the adventure.", 'datetime' => '2024-04-13 10:45:00'],
                    ['user_id' => 2, 'content' => "Count me in! Let's make it an unforgettable reunion.", 'datetime' => '2024-04-13 10:50:00'],
                    ['user_id' => 1, 'content' => "I'll start brainstorming some plot hooks and encounters.", 'datetime' => '2024-04-13 10:55:00'],
                    ['user_id' => 1, 'content' => "Maybe we could revisit some classic villains from our old campaigns.", 'datetime' => '2024-04-13 11:00:00'],
                    ['user_id' => 2, 'content' => "That's a great idea! Nostalgia mixed with new adventures.", 'datetime' => '2024-04-13 11:05:00'],
                    ['user_id' => 2, 'content' => "I'm sure everyone will love the trip down memory lane.", 'datetime' => '2024-04-13 11:10:00'],
                    ['user_id' => 2, 'content' => "Let me know if you need any help with planning or organizing.", 'datetime' => '2024-04-13 11:15:00'],
                    ['user_id' => 1, 'content' => "Thanks, I appreciate it! Your input will make the reunion even better.", 'datetime' => '2024-04-13 11:20:00'],
                    ['user_id' => 1, 'content' => "I'll create a group chat and start reaching out to everyone.", 'datetime' => '2024-04-13 11:25:00'],
                    ['user_id' => 1, 'content' => "It'll be great to catch up with everyone and relive our epic adventures.", 'datetime' => '2024-04-13 11:30:00'],
                    ['user_id' => 2, 'content' => "Absolutely! I can't wait to hear what everyone has been up to.", 'datetime' => '2024-04-13 11:35:00'],
                    ['user_id' => 2, 'content' => "I'm sure there are plenty of new tales to share since our last adventure.", 'datetime' => '2024-04-13 11:40:00'],
                    ['user_id' => 2, 'content' => "Plus, it'll be fun to see how everyone's characters have evolved.", 'datetime' => '2024-04-13 11:45:00'],
                    ['user_id' => 1, 'content' => "Definitely! It'll be like a mini-reunion of our beloved party.", 'datetime' => '2024-04-13 11:50:00'],
                    ['user_id' => 1, 'content' => "I'll send out the invites today and finalize the details.", 'datetime' => '2024-04-13 11:55:00'],
                    ['user_id' => 1, 'content' => "Get ready for an epic adventure filled with laughter and nostalgia!", 'datetime' => '2024-04-13 12:00:00'],
                    ['user_id' => 2, 'content' => "Hey, have you ever tried playing as a barbarian?", 'datetime' => '2024-04-13 12:05:00'],
                    ['user_id' => 1, 'content' => "Yeah, I played a half-orc barbarian in a one-shot adventure once.", 'datetime' => '2024-04-13 12:10:00'],
                    ['user_id' => 1, 'content' => "It was exhilarating charging into battle and smashing enemies with brute force.", 'datetime' => '2024-04-13 12:15:00'],
                    ['user_id' => 2, 'content' => "That sounds epic! I might have to roll up a barbarian for our next game.", 'datetime' => '2024-04-13 12:20:00'],
                    ['user_id' => 2, 'content' => "Do you have any tips for playing a barbarian effectively?", 'datetime' => '2024-04-13 12:25:00'],
                    ['user_id' => 1, 'content' => "Definitely! The key is to embrace your character's primal instincts and rage.", 'datetime' => '2024-04-13 12:30:00'],
                    ['user_id' => 1, 'content' => "Use your rage to fuel your attacks and shrug off damage like it's nothing.", 'datetime' => '2024-04-13 12:35:00'],
                    ['user_id' => 1, 'content' => "Just be careful not to go berserk and attack your allies by mistake.", 'datetime' => '2024-04-13 12:40:00'],
                    ['user_id' => 2, 'content' => "Got it. I'll channel my inner rage and unleash havoc on our enemies.", 'datetime' => '2024-04-13 12:45:00'],
                    ['user_id' => 2, 'content' => "I can't wait to see the fear in their eyes when they face my barbarian!", 'datetime' => '2024-04-13 12:50:00'],
                    ['user_id' => 1, 'content' => "That's the spirit! Your barbarian is going to be a force to be reckoned with.", 'datetime' => '2024-04-13 12:55:00'],
                    ['user_id' => 1, 'content' => "Just remember to balance brute strength with cunning strategy.", 'datetime' => '2024-04-13 13:00:00'],
                    ['user_id' => 2, 'content' => "I'll keep that in mind. It's all about finding the right moment to strike.", 'datetime' => '2024-04-13 13:05:00'],
                    ['user_id' => 2, 'content' => "Speaking of strategy, do you have any favorite tactics for combat?", 'datetime' => '2024-04-13 13:10:00'],
                    ['user_id' => 1, 'content' => "I'm a big fan of flanking maneuvers and ambushes.", 'datetime' => '2024-04-13 13:15:00'],
                    ['user_id' => 1, 'content' => "Catch your enemies off guard and exploit their weaknesses.", 'datetime' => '2024-04-13 13:20:00'],
                    ['user_id' => 2, 'content' => "Sounds sneaky! I'll have to incorporate those tactics into my gameplay.", 'datetime' => '2024-04-13 13:25:00'],
                    ['user_id' => 2, 'content' => "I can already imagine the look on our DM's face when we pull off a daring ambush.", 'datetime' => '2024-04-13 13:30:00'],
                    ['user_id' => 1, 'content' => "It'll be legendary! Our enemies won't know what hit them.", 'datetime' => '2024-04-13 13:35:00'],
                    ['user_id' => 1, 'content' => "Just make sure to coordinate with the rest of the party to maximize our effectiveness.", 'datetime' => '2024-04-13 13:40:00'],
                    ['user_id' => 2, 'content' => "Got it. Teamwork makes the dream work, right?", 'datetime' => '2024-04-13 13:45:00'],
                    ['user_id' => 2, 'content' => "I'll make sure we're all on the same page when it comes to battle strategies.", 'datetime' => '2024-04-13 13:50:00'],
                    ['user_id' => 1, 'content' => "That's the spirit! With our combined skills and teamwork, we'll be unstoppable.", 'datetime' => '2024-04-13 13:55:00'],
                    ['user_id' => 1, 'content' => "I can't wait to see what kind of epic adventures await us in our next campaign.", 'datetime' => '2024-04-13 14:00:00'],
                    ['user_id' => 2, 'content' => "Agreed! It's going to be an adventure for the ages.", 'datetime' => '2024-04-13 14:05:00'],
                    ['user_id' => 2, 'content' => "I'll make sure to bring my A-game and give it my all.", 'datetime' => '2024-04-13 14:10:00'],
                    ['user_id' => 1, 'content' => "That's what I like to hear! Let's make this campaign one to remember.", 'datetime' => '2024-04-13 14:15:00'],
                    ['user_id' => 1, 'content' => "I'll start preparing some epic quests and challenges for our party.", 'datetime' => '2024-04-13 14:20:00'],
                    ['user_id' => 1, 'content' => "Get ready for an adventure of a lifetime!", 'datetime' => '2024-04-13 14:25:00'],
                ];

                foreach($dndConversation as $message) {
                    Message::factory()->create([
                        'user_id' => $message['user_id'],
                        'channel_id' => $channel->id,
                        'content' => $message['content'],
                        'created_at' => $message['datetime'],
                        'updated_at' => $message['datetime'],
                    ]);
                }
            } else {
                Message::factory(10)
                    ->recycle(User::all())
                    ->recycle($channel)
                    ->state(new Sequence(
                        fn (Sequence $sequence) => [
                            'created_at' => Carbon::create(2024)->addMinutes($sequence->index * 5),
                            'updated_at' => Carbon::create(2024)->addMinutes($sequence->index * 5)
                        ],
                    ))
                    ->create();
            }
        });

    }
}
