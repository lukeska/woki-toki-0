<?php

namespace App\Livewire;

use App\Models\Channel;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Chat extends Component
{
    public string $message = '';

    public Channel $channel;

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->channel = Channel::where('team_id', Auth::user()->currentTeam->id)
                ->findOrFail($id);

            return;
        }

        $this->channel = Auth::user()->currentTeam->channels->first();
    }

    public function getListeners()
    {
        $teamId = Auth::user()->currentTeam->id;

        return [
            "echo-private:chat.{$teamId},MessageSent" => 'received',
        ];
    }

    public function send()
    {
        Message::create([
            'user_id' => auth()->id(),
            'channel_id' => $this->channel->id,
            'content' => $this->message,
        ]);

        $this->reset(['message']);
    }

    public function received($event)
    {
        // do nothing here, this was called just ot trigger a re-render
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $channels = Channel::query()
            ->where('team_id', auth()->user()->currentTeam->id)
            ->get();

        $messages = Message::query()
            ->where('channel_id', $this->channel->id)
            ->with('user')
            ->orderBy('created_at')
            ->get();

        return view('livewire.chat')
            ->title($this->channel->name)
            ->with([
                'channels' => $channels,
                'messages' => $messages,
            ]);
    }
}
