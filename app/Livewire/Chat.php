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

    public bool $currentlyManagingSettings = false;

    public string $searchMembers = '';

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

    public function manageSettings()
    {
        $this->currentlyManagingSettings = true;
    }

    public function stopManagingSettings()
    {
        $this->currentlyManagingSettings = false;

        $this->reset(['searchMembers']);
    }

    public function addMember(int $userId)
    {
        $this->channel->users()->attach($userId);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $messages = Message::query()
            ->where('channel_id', $this->channel->id)
            ->with('user')
            ->orderBy('created_at')
            ->get();

        $members = [];
        $notMembers = [];

        if ($this->currentlyManagingSettings) {
            if ($this->searchMembers) {
                $members = $this->channel->users()
                    ->where('name', 'like', "%{$this->searchMembers}%")
                    ->get();

                $notMembers = Auth::user()->currentTeam->users()
                    ->whereNotIn('users.id', $members->pluck('id'))
                    ->where('users.name', 'like', "%{$this->searchMembers}%")
                    ->get();
            } else {
                $members = $this->channel->users;
            }
        }

        return view('livewire.chat')
            ->title($this->channel->name)
            ->with([
                'channels' => auth()->user()->channels,
                'messages' => $messages,
                'membersCount' => $this->channel->users()->count(),
                'members' => $members,
                'notMembers' => $notMembers,
            ]);
    }
}
