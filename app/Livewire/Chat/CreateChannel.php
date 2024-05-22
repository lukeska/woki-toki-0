<?php

namespace App\Livewire\Chat;

use App\Livewire\Forms\ManageMembersForm;
use App\Models\Channel;
use App\Rules\Slug;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateChannel extends Component
{
    public ManageMembersForm $form;

    public bool $currentlyCreatingChannel = false;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $topic = '';

    public bool $private = false;

    #[Computed]
    public function stepNumber(): int
    {
        if ($this->form->channel) {
            return 2;
        }

        return 1;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'unique:channels', new Slug],
            'topic' => 'sometimes|max:256',
            'private' => 'bool',
        ];
    }

    public function create()
    {
        $user = auth()->user();

        $validated = array_merge(
            $this->validate(),
            [
                'user_id' => $user->id,
                'team_id' => $user->currentTeam->id,
            ]
        );

        $this->form->channel = Channel::create($validated);

        $this->form->channel->users()->attach($user);
    }

    public function addMember(int $userId)
    {
        $this->form->addMember($userId);
    }

    #[On('start-creating-channel')]
    public function startCreatingChannel()
    {
        $this->currentlyCreatingChannel = true;
    }

    public function stopCreatingChannel()
    {
        if (! $this->form->channel) {
            $this->currentlyCreatingChannel = false;

            $this->reset(['name', 'topic']);
            $this->resetValidation();
        } else {
            return redirect()->to(route('chat', ['id' => $this->form->channel->id]));
        }
    }

    public function setAsPublic()
    {
        $this->private = false;
    }

    public function setAsPrivate()
    {
        $this->private = true;
    }

    public function render()
    {
        return view('livewire.chat.create-channel')
            ->with($this->form->getMembers());
    }
}
