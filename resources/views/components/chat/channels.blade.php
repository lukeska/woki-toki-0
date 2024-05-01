<div class="px-2 py-4">
    <div class="font-semibold mb-4">Channels</div>
    <div class="space-y-px">
        @foreach($channels as $channel)
            @if($channel->id !== $currentChannel->id)
                <a class="block hover:bg-indigo-100 py-1 px-2 rounded-md text-nowrap overflow-ellipsis w-full overflow-hidden"
                   href="{{ route('chat', ['id' => $channel->id]) }}"
                   title="{{ $channel->name }}"
                >
                    <span class="inline-block mr-2">#</span> <span>{{ $channel->name }}</span>
                </a>
            @else
                <div class="block py-1 px-2 rounded-md font-semibold bg-indigo-400 text-white text-nowrap overflow-ellipsis w-full overflow-hidden"
                     title="{{ $channel->name }}"
                >
                    <span class="inline-block mr-2">#</span> <span>{{ $channel->name }}</span>
                </div>
            @endif
        @endforeach
    </div>
</div>
