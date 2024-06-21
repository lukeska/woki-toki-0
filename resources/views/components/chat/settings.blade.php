<div>
    <div class="border-b px-6 space-x-4">
        @foreach(\App\Enums\ChannelSettings::cases() as $channelSettings)
            <button wire:click="manageSettings('{{ $channelSettings->value }}')"
                    class="py-1 inline-block border-b-2 -mb-px {{ $channelSettings === $currentSettingPage ? 'border-black' : 'border-transparent' }}">
                <span class="font-semibold">{{ $channelSettings->label() }}</span>
            </button>
        @endforeach
    </div>

    @if($currentSettingPage === \App\Enums\ChannelSettings::About)
        <x-chat.channel-details :channel="$channel"/>
    @elseif($currentSettingPage === \App\Enums\ChannelSettings::Members)
        <x-chat.manage-members
            wire:model.live="form.searchMembers"
            :channel="$channel"
            :members="$members"
            :notMembers="$notMembers"
        />
    @endif
</div>
