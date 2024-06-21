<?php

namespace App\Livewire\Forms;

use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class ManageMembersForm extends Form
{
    public ?Channel $channel = null;

    public string $searchMembers = '';

    public function addMember(int $userId)
    {
        $this->channel->users()->attach($userId);
    }

    public function removeMember(int $userId)
    {
        $this->channel->users()->detach($userId);
    }

    public function getMembers()
    {
        $members = [];
        $notMembers = [];

        if ($this->channel) {
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

        return [
            'members' => $members,
            'notMembers' => $notMembers,
        ];
    }
}
