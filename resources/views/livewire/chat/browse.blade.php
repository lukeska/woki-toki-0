<div class="container mx-auto max-w-5xl p-6">

    <div class="flex justify-between items-center">
        <h1 class="font-bold text-lg">All channels</h1>

        <x-secondary-button @click="$dispatch('start-creating-channel')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <span>Create channel</span>
        </x-secondary-button>
    </div>

    <div class="py-4">
        <input wire:model.live="search" id="search" type="text"
               placeholder="Find channels"
               class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
    </div>

    <div class="mb-2">
        <x-chat.channels-sort-and-filters :channelMembershipStatus="$channelMembershipStatus"
                                          :channelType="$channelType"
                                          :channelSort="$channelSort"
        />
    </div>

    <div class="bg-white rounded-md shadow divide-y">
        @foreach($channels as $channel)
            <div class="group px-6 py-4 flex justify-between space-x-4">
                <div class="overflow-hidden">
                    <div class="font-semibold flex items-center">
                        <x-chat.channel-icon :channel="$channel"/>
                        <span>{{ $channel->name }}</span>
                    </div>
                    <div class="text-sm text-gray-500 flex">
                        @if(auth()->user()->belongsToChannel($channel))
                            <span class="text-green-500 font-semibold shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="size-4 inline-block -mt-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>

                                <span>Joined -&nbsp;</span>
                            </span>
                        @endif
                        <span
                            class="shrink-0">{{ $channel->users_count }} {{ str('member')->plural($channel->users_count) }}</span>

                        @if($channel->topic)
                            <span class="text-gray-400 truncate">&nbsp;- {{ $channel->topic }}</span>
                        @endif
                    </div>
                </div>

                <div class="w-52 shrink-0 hidden group-hover:block">

                    <a class="font-semibold py-2 px-4 rounded-md border inline-block w-24 text-center mr-2"
                       href="{{ route('chat', ['id' => $channel->id]) }}">Visit</a>

                    @if(auth()->user()->belongsToChannel($channel))
                        <button wire:click="leaveChannel({{ $channel->id }})"
                                class="font-semibold py-2 px-4 rounded-md border w-24">
                            Leave
                        </button>
                    @else
                        <button wire:click="joinChannel({{ $channel->id }})"
                                class="font-semibold py-2 px-4 rounded-md border w-24">
                            Join
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="py-4">
        {{ $channels->links() }}
    </div>

    <livewire:chat.create-channel/>
</div>
