<div class="px-2 py-4">
    <div class="flex justify-between items-center mb-4">
        <div class="font-semibold">Channels</div>

        <div class="flex space-x-2">
            <a href="{{ route('browse') }}" class=" w-10 h-10 border hover:border-gray-300 rounded-md flex items-center justify-center
        ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
                </svg>
            </a>
            <button @click="$dispatch('start-creating-channel')"
                    class="w-10 h-10 border hover:border-gray-300 rounded-md flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>

            </button>
        </div>
    </div>
    <div class="space-y-px">
        @foreach($channels as $channel)
            @if($channel->id !== $currentChannel->id)
                <a class="flex items-center hover:bg-indigo-100 py-1 px-2 rounded-md text-nowrap overflow-ellipsis w-full overflow-hidden"
                   href="{{ route('chat', ['id' => $channel->id]) }}"
                   title="{{ $channel->name }}"
                >
                    <x-chat.channel-icon :channel="$channel"/>
                    <span class="truncate">{{ $channel->name }}</span>
                </a>
            @else
                <div
                    class="flex items-center py-1 px-2 rounded-md font-semibold bg-indigo-400 text-white text-nowrap overflow-ellipsis w-full overflow-hidden"
                    title="{{ $channel->name }}"
                >
                    <x-chat.channel-icon :channel="$channel"/>
                    <span class="truncate">{{ $channel->name }}</span>
                </div>
            @endif
        @endforeach
    </div>
</div>
