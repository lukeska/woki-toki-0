@props(['channel' => null])

<div class="px-6 py-4 bg-gray-100">
    <div class="bg-white border rounded-md divide-y">
        <div class="px-6 py-4">
            <div class="text-sm text-black font-semibold mb-1">Topic</div>
            <div class="text-base">{{ $channel->topic }}</div>
        </div>
        <div class="px-6 py-4">
            <div class="text-sm text-black font-semibold mb-1">Created by</div>
            <div class="text-base">{{ $channel->user->name }} on {{ $channel->created_at->format('F j, Y') }}</div>
        </div>
        <div class="px-6 py-4">
            @if(auth()->user()->belongsToChannel($channel))
                <x-danger-button wire:click="leaveChannel" wire:loading.attr="disabled">
                    Leave Channel
                </x-danger-button>
            @else
                <x-button wire:click="addMember()" wire:loading.attr="disabled">
                    Join Channel
                </x-button>
            @endif
        </div>
    </div>
</div>
