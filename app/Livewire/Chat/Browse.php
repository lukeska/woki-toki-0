<?php

namespace App\Livewire\Chat;

use App\Enums\ChannelsMembershipStatus;
use App\Enums\ChannelSort;
use App\Enums\ChannelType;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Browse extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url(as: 'membership')]
    public ChannelsMembershipStatus $channelMembershipStatus = ChannelsMembershipStatus::All;

    #[Url(as: 'type')]
    public ChannelType $channelType = ChannelType::Any;

    #[Url]
    public ChannelSort $channelSort = ChannelSort::Alphabetical;

    protected function getChannels()
    {
        $query = auth()->user()->browsableChannels();

        $query = $this->applySearch($query);
        $query = $this->applyMembershipStatus($query);
        $query = $this->applyChannelType($query);
        $query = $this->applySorting($query);

        return $query->paginate(10);
    }

    protected function applySearch(Builder $query): Builder
    {
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        return $query;
    }

    protected function applyMembershipStatus(Builder $query): Builder
    {
        if ($this->channelMembershipStatus == ChannelsMembershipStatus::NotMember) {
            $query->whereDoesntHave('users', function ($query) {
                $query->where('user_id', auth()->id());
            });
        } elseif ($this->channelMembershipStatus == ChannelsMembershipStatus::Member) {
            $query->whereHas('users', function ($query) {
                $query->where('user_id', auth()->id());
            });
        }

        return $query;
    }

    protected function applyChannelType(Builder $query): Builder
    {
        if ($this->channelType == ChannelType::Public) {
            $query->where('private', false);
        } elseif ($this->channelType == ChannelType::Private) {
            $query->where('private', true);
        }

        return $query;
    }

    protected function applySorting(Builder $query): Builder
    {
        if ($this->channelSort == ChannelSort::Latest) {
            $query->latest();
        } elseif ($this->channelSort == ChannelSort::Oldest) {
            $query->oldest();
        } elseif ($this->channelSort == ChannelSort::Alphabetical) {
            $query->orderBy('name');
        } elseif ($this->channelSort == ChannelSort::ReverseAlphabetical) {
            $query->orderByDesc('name');
        } elseif ($this->channelSort == ChannelSort::MostMembers) {
            $query->orderBy('users_count', 'desc');
        } elseif ($this->channelSort == ChannelSort::LeastMembers) {
            $query->orderBy('users_count', 'asc');
        }

        return $query;
    }

    public function setChannelMembershipStatus(ChannelsMembershipStatus $status)
    {
        $this->channelMembershipStatus = $status;
    }

    public function setChannelType(ChannelType $type)
    {
        $this->channelType = $type;
    }

    public function setChannelSort(ChannelSort $sort)
    {
        $this->channelSort = $sort;
    }

    public function joinChannel(int $channelId)
    {
        auth()->user()->channels()->attach($channelId);

        return redirect()->to(route('chat', ['id' => $channelId]));
    }

    public function leaveChannel(int $channelId): void
    {
        auth()->user()->channels()->detach($channelId);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.chat.browse')->with([
            'channels' => $this->getChannels(),
        ]);
    }
}
