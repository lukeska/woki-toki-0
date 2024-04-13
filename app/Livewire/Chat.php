<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public string $message = '';

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
            'team_id' => auth()->user()->currentTeam->id,
            'content' => $this->message,
        ]);

        $this->reset();
    }

    public function received($event)
    {
        dump(Auth::user()->name . ' received the message: ' . $event['message']['content']);
    }

    public function render()
    {
        $messages = Message::query()
            ->where('team_id', auth()->user()->currentTeam->id)
            ->with('user')
            ->orderBy('created_at')
            ->get();

        return view('livewire.chat')->with([
            'messages' => $messages,
        ]);
    }
}
