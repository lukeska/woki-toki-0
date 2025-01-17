<?php

namespace App\Livewire;

use App\Enums\ChannelSettings;
use App\Livewire\Forms\ManageMembersForm;
use App\Models\Channel;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Chat extends Component
{
    public string $message = '';

    public ManageMembersForm $form;

    public bool $currentlyManagingSettings = false;

    public ChannelSettings $currentSettingPage = ChannelSettings::About;

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->form->channel = Channel::where('team_id', Auth::user()->currentTeam->id)
                ->findOrFail($id);

            return;
        }

        $this->form->channel = Auth::user()->currentChannels()->first();
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
            'channel_id' => $this->form->channel->id,
            'content' => $this->message,
        ]);

        $this->reset(['message']);
    }

    public function received($event)
    {
        // do nothing here, this was called just ot trigger a re-render
    }

    public function manageSettings(?ChannelSettings $settingPage = ChannelSettings::About)
    {
        $this->currentlyManagingSettings = true;
        $this->currentSettingPage = $settingPage;
    }

    public function stopManagingSettings()
    {
        $this->currentlyManagingSettings = false;

        $this->reset(['currentSettingPage']);
        $this->form->reset(['searchMembers']);
    }

    public function addMember(?int $userId = null)
    {
        $this->form->addMember($userId ?? auth()->id());
    }

    public function leaveChannel()
    {
        $this->form->removeMember(auth()->id());

        $this->stopManagingSettings();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $messages = Message::query()
            ->where('channel_id', $this->form->channel->id)
            ->with('user')
            ->orderBy('created_at')
            ->get();

        if ($this->currentlyManagingSettings) {
            ['members' => $members, 'notMembers' => $notMembers] = $this->form->getMembers();
        } else {
            $members = [];
            $notMembers = [];
        }

        return view('livewire.chat')
            ->title($this->form->channel->name)
            ->with([
                'channels' => auth()->user()->currentChannels,
                'messages' => $messages,
                'membersCount' => $this->form->channel->users()->count(),
                'members' => $members,
                'notMembers' => $notMembers,
            ]);
    }
}
