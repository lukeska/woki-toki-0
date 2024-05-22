@props(['members', 'notMembers'])

<div>
    <div class="px-6 py-4">
        <input {{ $attributes }} id="search" type="text"
               placeholder="Find members"
               class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
    </div>

    @if($members)
        <div class="py-2">
            @foreach($members as $member)
                <div class="px-6 py-2 flex items-center space-x-2">
                    <img class="h-8 w-8 rounded-full object-cover"
                         src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}"/>
                    <span>{{ $member->name }}</span>
                </div>
            @endforeach
        </div>
    @endif

    @if($notMembers && $notMembers->count())
        <div class="py-4 bg-stone-50 border-t border-b">
            <div class="px-6 font-semibold text-sm">Not in this channel</div>
            <div class="py-4">
                @foreach($notMembers as $member)
                    <div class="px-6 py-2 flex items-center justify-between hover:bg-stone-200">
                        <div class="flex items-center space-x-2">
                            <img class="h-8 w-8 rounded-full object-cover"
                                 src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}"/>
                            <span>{{ $member->name }}</span>
                        </div>
                        <button wire:click="addMember('{{ $member->id }}')"
                                class="font-semibold text-indigo-600 hover:underline">Add
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
